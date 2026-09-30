<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Заголовок нашего блока --}}
        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-3">
            Информация о цвете даты
        </h3>
            
           {{-- Контейнер для элементов --}}
        <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; align-items: center;">
            
            {{-- Синий --}}
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <span style="width: 14px; height: 14px; background-color: #3b82f6; border-radius: 9999px; display: inline-block; flex-shrink: 0; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);"></span>
                <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">— Статус Подтвержден</span>
            </div>

            {{-- Красный --}}
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <span style="width: 14px; height: 14px; background-color: #ef4444; border-radius: 9999px; display: inline-block; flex-shrink: 0; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);"></span>
                <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">— Отменен</span>
            </div>

            {{-- Зеленый --}}
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <span style="width: 14px; height: 14px; background-color: #22c55e; border-radius: 9999px; display: inline-block; flex-shrink: 0; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);"></span>
                <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">— Выполнено успешно</span>
            </div>

            {{-- Желтый --}}
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <span style="width: 14px; height: 14px; background-color: #f59e0b; border-radius: 9999px; display: inline-block; flex-shrink: 0; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);"></span>
                <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">В работе</span>
            </div>

        </div>
    </x-filament::section>
</x-filament-widgets::widget>
