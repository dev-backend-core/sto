<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                
            <div class="p-6 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                    <div class="text-left">
                        <h2 class="text-xl font-bold text-gray-950">Услуги СТО</h2>
                        <p class="mt-1 text-gray-500" style="font-size:medium">Управление прайс-листом и технологическими картами расходников.</p>
                    </div>

                    <div class="flex flex-row items-center gap-3">
                        
                        <div class="relative w-64">
                            <input type="text" 
                                placeholder="Поиск услуги..." 
                                class="w-full pl-10 pr-4 py-2 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                            >
                        </div>

                        <div class="flex bg-gray-200 p-1 rounded-lg text-sm font-medium text-gray-600 relative">
    
                            <button type="button" data-filter="all" class="filter-btn px-3 py-1.5 rounded-md bg-white text-gray-900 shadow-sm transition-all">
                                Все
                            </button>
                            
                            <button type="button" data-filter="time" class="filter-btn px-3 py-1.5 rounded-md hover:text-gray-900 transition-all">
                                Время
                            </button>
                            
                            <button type="button" data-filter="price" class="filter-btn px-3 py-1.5 rounded-md hover:text-gray-900 transition-all">
                                Цена
                            </button>
                            
                            <div class="relative inline-block">
                                <button type="button" id="status-dropdown-btn" data-filter="status-all" class="filter-btn px-3 py-1.5 rounded-md hover:text-gray-900 transition-all flex items-center gap-1">
                                    <span>Статус</span>
                                    <svg class="w-4 h-4 transition-transform duration-200" id="status-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div id="status-dropdown-menu" class="hidden absolute left-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-100 z-50 overflow-hidden py-1">
                                    <button type="button" data-status="active" class="status-opt-btn w-full text-left px-4 py-2 hover:bg-gray-50 text-gray-700 hover:text-gray-950 transition-colors">
                                        Активный
                                    </button>
                                    <button type="button" data-status="inactive" class="status-opt-btn w-full text-left px-4 py-2 hover:bg-gray-50 text-gray-700 hover:text-gray-950 transition-colors">
                                        Неактивный
                                    </button>
                                </div>
                            </div>

                        </div>

                        <a href="{{ route('services.store') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold bg-blue-100 rounded-lg shadow-sm transition-colors whitespace-nowrap text-gray-600">
                            Новая услуга
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse" >
                        <thead>
                            <tr class="bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200 text-center" style="height: 40px;">
                                <th class="px-6 py-3">Название услуги</th>
                                <th class="px-6 py-3">Базовая стоимость</th>
                                <th class="px-6 py-3">Длительность</th>
                                <th class="px-6 py-3">Детали и расходники</th>
                                <th class="px-6 py-3">Удалить</th>
                                <th class="px-6 py-3">Статус</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm text-gray-700 text-center">
                            @each('admin.services.components.service-row', $services, 'service', 'admin.services.components.empty-row')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const statusBtn = document.getElementById('status-dropdown-btn');
    const statusMenu = document.getElementById('status-dropdown-menu');
    const statusArrow = document.getElementById('status-arrow');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const statusOptionButtons = document.querySelectorAll('.status-opt-btn');

    // 1. Показ / Скрытие выпадающего меню Статуса
    statusBtn.addEventListener('click', (e) => {
        // Чтобы клик по кнопке не закрывал её сразу же через document listener
        e.stopPropagation(); 
        
        const isHidden = statusMenu.classList.contains('hidden');
        if (isHidden) {
            statusMenu.classList.remove('hidden');
            statusArrow.classList.add('rotate-180'); // Красиво переворачиваем стрелочку
        } else {
            closeStatusDropdown();
        }
    });

    // Функция закрытия дропдауна
    function closeStatusDropdown() {
        statusMenu.classList.add('hidden');
        statusArrow.classList.remove('rotate-180');
    }

    // Закрываем дропдаун, если кликнули в любую другую область экрана
    document.addEventListener('click', () => {
        closeStatusDropdown();
    });

    // 2. Визуальное переключение основных вкладок (Все, Время, Цена, Статус)
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-white', 'text-gray-900', 'shadow-sm');
                btn.classList.add('hover:text-gray-900');
            });
            button.classList.add('bg-white', 'text-gray-900', 'shadow-sm');
            button.classList.remove('hover:text-gray-900');

            // Если кликнули НЕ на Статус, то сбрасываем текст кнопки статуса на дефолтный
            if (button !== statusBtn) {
                statusBtn.querySelector('span').textContent = 'Статус';
            }
        });
    });

    // 3. Обработка клика по подпунктам "Активный" / "Неактивный"
    statusOptionButtons.forEach(optButton => {
        optButton.addEventListener('click', (e) => {
            e.stopPropagation(); // предотвращаем закрытие
            
            const selectedStatus = optButton.getAttribute('data-status'); // "active" или "inactive"
            const statusText = optButton.textContent.trim();

            // Меняем текст главной кнопки на выбранный статус (например, "Статус: Активный")
            statusBtn.querySelector('span').textContent = `${statusText}`;

            // Закрываем меню
            closeStatusDropdown();

            // ТУТ ВАША ЛОГИКА ФИЛЬТРАЦИИ ТАБЛИЦЫ
            console.log(`Фильтруем строки по статусу: ${selectedStatus}`);
            
            /* Пример: 
               filterRowsByStatus(selectedStatus);
            */
        });
    });
});
</script>
