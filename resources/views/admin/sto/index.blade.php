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
        <style>
             .dashboard-header {
                margin-bottom: 15px;
                display: flex;
                justify-content: space-between;
            }

            .dashboard-header h1 {
                font-size: 25px;
                font-weight: 700;
                color: #0f172a;
            }
            :root {
                --primary-color: #1f4e78;
                --bg-color: #f8fafc;
                --card-bg: #ffffff;
                --text-main: #334155;
                --border-color: #e2e8f0;
                --input-focus: #3b82f6;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: var(--bg-color);
                color: var(--text-main);
                margin: 0;
                
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 1rem 0rem;
            }

            

            h1 {
                color: var(--primary-color);
                margin: 0;
                font-size: 24px;
            }

            .btn-export {
                background-color: #107c41;
                color: white;
                border: none;
                padding: 10px 16px;
                border-radius: 6px;
                cursor: pointer;
                font-weight: 600;
                font-size: 14px;
                display: flex;
                align-items: center;
                gap: 8px;
                transition: background-color 0.2s;
            }

            .btn-export:hover {
                background-color: #0b592e;
            }

            .table-container {
                background-color: var(--card-bg);
                border: 1px solid var(--border-color);
                border-radius: 8px;
                padding: 16px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.05);
                overflow-x: auto;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                text-align: left;
            }

            th {
                background-color: var(--primary-color);
                color: white;
                padding: 12px;
                font-weight: 600;
                font-size: 14px;
                white-space: nowrap;
            }

            td {
                padding: 10px 12px;
                border-bottom: 1px solid var(--border-color);
                font-size: 14px;
                vertical-align: middle;
            }

            tr:hover {
                background-color: #f8fafc;
            }

            /* Стили для инпутов прямо внутри таблицы */
            .table-input {
                width: 100%;
                padding: 6px 10px;
                border: 1px solid var(--border-color);
                border-radius: 4px;
                font-family: inherit;
                font-size: 13px;
                box-sizing: border-box;
                transition: border-color 0.15s, box-shadow 0.15s;
            }

            .table-input:focus {
                outline: none;
                border-color: var(--input-focus);
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
                background-color: #fff;
            }

            /* Специфический стиль для VIN (моноширинный шрифт, так как там важен каждый символ) */
            .vin-input {
                font-family: 'Courier New', Courier, monospace;
                font-weight: bold;
                text-transform: uppercase;
            }

            .plate-input {
                font-weight: 700;
                text-transform: uppercase;
                text-align: center;
                max-width: 110px;
            }
        </style>
    </head>
<body>
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
        <div class="container">
            <div class="dashboard-header" >
                <h1>Журнал записей СТО</h1>
                <div style="display: flex;">
                    <div class="relative w-64" style="margin-right: 1rem;">
                        <input type="text" 
                            placeholder="Поиск..." 
                            class="w-full pl-10 pr-4 py-2 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                        >
                    </div>
                    <div class="inline-block flex bg-gray-200 p-1 rounded-lg text-sm font-medium text-gray-600 relative">
                        <button type="button" id="status-dropdown-btn" data-filter="status-all" class="filter-btn px-3 py-1.5 rounded-md hover:text-gray-900 transition-all flex items-center gap-1 bg-white text-gray-900 shadow-sm">
                            <span>Сортировать по:</span>
                            <svg class="w-4 h-4 transition-transform duration-200" id="status-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-top: 0.2rem;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div id="status-dropdown-menu" class="hidden absolute left-0 mt-2 w-50 bg-white rounded-lg shadow-lg border border-gray-100 z-50 overflow-hidden py-1">
                            <button type="button" data-status="active" class="status-opt-btn w-full text-left px-4 py-2 hover:bg-gray-50 text-gray-700 hover:text-gray-950 transition-colors">
                                неделя
                            </button>
                            <button type="button" data-status="inactive" class="status-opt-btn w-full text-left px-4 py-2 hover:bg-gray-50 text-gray-700 hover:text-gray-950 transition-colors">
                                месяц
                            </button>
                            
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="table-container">
                <table id="journalTable">
                    <thead>
                        <tr>
                            <th>Услуга</th>
                            <th>Дата и время</th>
                            <th>Мастер</th>
                            <th>Телефон клиента</th>
                            <th>Гос. номер машины</th>
                            <th>VIN-код автомобиля</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Замена моторного масла</td>
                            <td>06.07.2026 / 10:00</td>
                            <td>Иванов Петр</td>
                            <td>+7 (999) 123-45-67</td>
                            <td><input type="text" class="table-input plate-input" value="А123АА77" placeholder="А000АА00">
                            </td>
                            <td><input type="text" class="table-input vin-input" value="1HGCR2F83HA000000" placeholder="17 знаков" maxlength="17">
                            </td>
                        </tr>
                        <tr>
                            <td>Диагностика подвески</td>
                            <td>06.07.2026 / 11:30</td>
                            <td>Сидоров Алексей</td>
                            <td>+7 (999) 765-43-21</td>
                            <td>
                                <input type="text" class="table-input plate-input" value="В777ВВ199" placeholder="А000АА00">
                            </td>
                            <td>
                                <input type="text" class="table-input vin-input" value="" placeholder="Заполнить VIN..." maxlength="17">
                            </td>
                        </tr>
                        <tr>
                            <td>Замена тормозных колодок</td>
                            <td>06.07.2026 14:00</td>
                            <td>Иванов Петр</td>
                            <td>+7 (900) 555-35-35</td>
                            <td>
                                <input type="text"  class="table-input plate-input" value="" placeholder="Ожидание...">
                            </td>
                            <td>
                                <input type="text" class="table-input vin-input" value="JM1BL147600111222" placeholder="17 знаков" maxlength="17">
                            </td>
                        </tr>
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
