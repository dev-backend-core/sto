<?php

namespace App\Filament\Exports;

use App\Models\Product; // Можно использовать любую модель как заглушку
use App\Models\Appointment;
use App\Models\ServiceProduct;
use Illuminate\Support\Facades\DB;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class FinancialStatsExport extends Exporter
{
    // Используем любую базовую модель, Filament этого требует
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('metric_name')
                ->label('Показатель СТО'),
            ExportColumn::make('metric_value')
                ->label('Значение за месяц'),
        ];
    }

    /**
     * Самый важный шаг: мы игнорируем стандартные строки модели Product
     * и вместо них вручную собираем массив со статистикой из 3 таблиц!
     */
    public function getRows(?array $state = null): array
    {
        // 1. Количество записей СТО за текущий месяц
        $totalAppointments = Appointment::whereMonth('created_at', now()->month)->count();

        // 2. Количество использованных расходников (из связующей таблицы)
        $totalConsumables = ServiceProduct::sum('quantity_needed') ?? 0;

        // 3. Общая стоимость услуг (выручка)
        $totalRevenue = Appointment::whereMonth('created_at', now()->month)->sum('price') ?? 0;

        // 4. Затраты на расходники
        $totalCosts = DB::table('product_service')
            ->join('products', 'product_service.product_id', '=', 'products.id')
            ->select(DB::raw('SUM(product_service.quantity_needed * products.price) as total_cost'))
            ->first()->total_cost ?? 0;

        // 5. Чистая прибыль
        $netProfit = $totalRevenue - $totalCosts;

        // Возвращаем кастомный массив данных для Excel
        return [
            ['metric_name' => 'Всего записей (услуг) за месяц', 'metric_value' => $totalAppointments],
            ['metric_name' => 'Использовано расходников (шт.)', 'metric_value' => $totalConsumables],
            ['metric_name' => 'Общая стоимость услуг (выручка)', 'metric_value' => number_format($totalRevenue, 2, ',', ' ') . ' ₽'],
            ['metric_name' => 'Затраты на материалы', 'metric_value' => number_format($totalCosts, 2, ',', ' ') . ' ₽'],
            ['metric_name' => 'Чистая прибыль СТО', 'metric_value' => number_format($netProfit, 2, ',', ' ') . ' ₽'],
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        return 'Финансовый отчет СТО успешно сгенерирован!';
    }
}