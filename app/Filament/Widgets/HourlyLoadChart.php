<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HourlyLoadChart extends ChartWidget
{
    protected ?string $heading = 'Загруженность СТО по часам (Часы пик)';
    protected static ?int $sort = 2;
    // Оставляем свойство пустым или null по умолчанию
    public ?string $filter = null; 

    // Метод mount() срабатывает при загрузке виджета в браузере
    public function mount(): void
    {
        // Carbon::now()->weekday() возвращает: 
        // 0 для Понедельника, 1 для Вторника ... 6 для Воскресенья.
        // Это идеально совпадает с функцией WEEKDAY() в MySQL!
        $this->filter = (string) (Carbon::now()->dayOfWeekIso - 1);
    }
    
    protected function getFilters(): ?array
    {
        return [
            '0' => 'Понедельник',
            '1' => 'Вторник',
            '2' => 'Среда',
            '3' => 'Четверг',
            '4' => 'Пятница',
            '5' => 'Суббота',
            '6' => 'Воскресенье',
        ];
    }
   

    protected function getData(): array
    {
        $dayOfWeek = $this->filter;
        // 1. Вытаскиваем час из времени записи и считаем количество посещений
        // Если у вас поле datetime, то HOUR(appointment_date) тоже сработает
        $hourlyData = Appointment::select(
                DB::raw('HOUR(appointment_date) as hour'), 
                DB::raw('count(*) as count')
            )
            ->whereNotNull('appointment_date')
            ->where(DB::raw('WEEKDAY(appointment_date)'), $dayOfWeek)
            ->groupBy('hour')
            ->orderBy('hour')
            ->pluck('count', 'hour')
            ->toArray();

        // 2. Формируем ось X (рабочие часы СТО, например с 8:00 до 20:00)
        $labels = [];
        $data = [];

        foreach (range(8, 20) as $hour) {
            $labels[] = sprintf('%02d:00', $hour);
            // Если в этот час записей не было, ставим 0
            $data[] = $hourlyData[$hour] ?? 0; 
        }

        // 3. Возвращаем настройки для Chart.js
        return [
            'datasets' => [
                [
                    'label' => 'Количество автомобилей',
                    'data' => $data,
                    'borderColor' => '#3b82f6', // Красивый синий цвет (Tailwind primary)
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)', // Легкая заливка под линией
                    'fill' => 'start', // Заливать пространство от нуля до линии
                    'tension' => 0.5, // Магия! Делает линию плавной и сглаженной вместо угловатой
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'min' => 0, // Начинаем строго с нуля
                    'suggestedMax' => 5,
                    'ticks' => [
                        'stepSize' => 1, // Шаг деления — строго 1 (никаких дробных!)
                        'precision' => 0, // Округлять до целых, убирая знаки после запятой
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
