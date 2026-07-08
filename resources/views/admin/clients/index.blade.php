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
    <style>

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }

        .dashboard-header {
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
        }

        .dashboard-header h1 {
            font-size: 25px;
            font-weight: 700;
            color: #0f172a;
        }

       .client-incoming-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        max-width: 400px; /* Чтобы карточка красиво смотрелась в сетке */
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 14px;
    }

    .client-info h3 {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 2px;
    }

    .phone-link {
        font-size: 14px;
        color: #64748b;
        font-weight: 500;
    }

    /* Статус заявки */
    .status-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 4px 8px;
        border-radius: 6px;
        text-transform: uppercase;
    }
    .status-pending {
        background:rgba(34, 197, 94, 0.35);
        color:rgb(20, 116, 55);
        border: 1px solid #bfdbfe;
    }

    /* Разделы данных */
    .data-section {
        margin-bottom: 14px;
    }
    .data-section:last-child {
        margin-bottom: 0;
    }

    .section-label {
        display: block;
        font-size: 11px;
        text-transform: uppercase;
        color: #94a3b8;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .car-details strong {
        font-size: 15px;
        color: #1e293b;
    }

    .plate-number {
        display: inline-block;
        margin-left: 8px;
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        padding: 1px 6px;
        border-radius: 4px;
        font-weight: 700;
        font-size: 12px;
    }

    .service-section {
        background: #f8fafc;
        padding: 12px;
        border-radius: 8px;
        border-left: 3px solid #3b82f6;
    }

    .requested-service {
        font-size: 14px;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .total-spent { font-size: 16px; color: #22c55e; font-weight: bold; }
    </style>
<body>
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <div class="container">
            <div class="dashboard-header" >
                <h1>Панель клиентов СТО</h1>
                <div class="flex flex-row items-center gap-3">
                    
                    <div class="relative w-64">
                        <input type="text" 
                            placeholder="Поиск..." 
                            class="w-full pl-10 pr-4 py-2 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                        >
                    </div>

                    <div class="flex bg-gray-200 p-1 rounded-lg text-sm font-medium text-gray-600">
                        <button type="button" data-filter="all" class="filter-btn px-3 py-1.5 rounded-md bg-white text-gray-900 shadow-sm transition-all">
                            Все
                        </button>
                        <button type="button" data-filter="available" class="filter-btn px-3 py-1.5 rounded-md hover:text-gray-900 transition-all">
                            Цена
                        </button>
                        <button type="button" data-filter="unavailable" class="filter-btn px-3 py-1.5 rounded-md hover:text-gray-900 transition-all">
                            Визиты
                        </button>
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                <div class="client-incoming-card">
                    <div class="card-header">
                        <div class="client-info">
                            <h3>Александр Козлов</h3>
                            <span class="phone-link">+375 (29) 999-99-99</span>
                        </div>
                        <span class="status-badge status-pending">8 визитов</span>
                    </div>

                    <div class="card-body">
                        
                        <div class="data-section">
                            <span class="section-label">Автомобиль клиента</span>
                            <div class="car-details">
                                <strong>BMW 5er (F10)</strong>
                                <span class="plate-number">1111 AX-7</span>
                            </div>
                        </div>

                        <div class="data-section">
                            <span class="section-label">Всего оплачено услуг:</span>
                            <div class="car-details">
                                <span class="total-spent">2 450 б.р.</span>
                            </div>
                        </div>

                        <div class="data-section">
                            <span class="section-label" >Последнее обслуживание:</span>
                            <p style="font-style: italic; ">19.04.2026 — Замена тормозных дисков (Механик: В. Петров)</p>
                        </div>
                    </div>
                </div>

                <div class="client-incoming-card">
                    <div class="card-header">
                        <div class="client-info">
                            <h3>Александр Козлов</h3>
                            <span class="phone-link">+375 (29) 999-99-99</span>
                        </div>
                        <span class="status-badge status-pending">8 визитов</span>
                    </div>

                    <div class="card-body">
                        
                        <div class="data-section">
                            <span class="section-label">Автомобиль клиента</span>
                            <div class="car-details">
                                <strong>BMW 5er (F10)</strong>
                                <span class="plate-number">1111 AX-7</span>
                            </div>
                        </div>

                        <div class="data-section">
                            <span class="section-label">Всего оплачено услуг:</span>
                            <div class="car-details">
                                <span class="total-spent">2 450 б.р.</span>
                            </div>
                        </div>

                        <div class="data-section">
                            <span class="section-label" >Последнее обслуживание:</span>
                            <p style="font-style: italic; ">19.04.2026 — Замена тормозных дисков (Механик: В. Петров)</p>
                        </div>
                    </div>
                </div>
                <div class="client-incoming-card">
                    <div class="card-header">
                        <div class="client-info">
                            <h3>Александр Козлов</h3>
                            <span class="phone-link">+375 (29) 999-99-99</span>
                        </div>
                        <span class="status-badge status-pending">8 визитов</span>
                    </div>

                    <div class="card-body">
                        
                        <div class="data-section">
                            <span class="section-label">Автомобиль клиента</span>
                            <div class="car-details">
                                <strong>BMW 5er (F10)</strong>
                                <span class="plate-number">1111 AX-7</span>
                            </div>
                        </div>

                        <div class="data-section">
                            <span class="section-label">Всего оплачено услуг:</span>
                            <div class="car-details">
                                <span class="total-spent">2 450 б.р.</span>
                            </div>
                        </div>

                        <div class="data-section">
                            <span class="section-label" >Последнее обслуживание:</span>
                            <p style="font-style: italic; ">19.04.2026 — Замена тормозных дисков (Механик: В. Петров)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const tableSections = document.querySelectorAll('.table-section'); // Секции с таблицами

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // 1. Меняем визуальный стиль активной кнопки
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-white', 'text-gray-900', 'shadow-sm');
                btn.classList.add('hover:text-gray-900');
            });
            button.classList.add('bg-white', 'text-gray-900', 'shadow-sm');
            button.classList.remove('hover:text-gray-900');

            // 2. Логика фильтрации таблиц
            const filterValue = button.getAttribute('data-filter');

            tableSections.forEach(section => {
                const category = section.getAttribute('data-category');

                if (filterValue === 'all' || filterValue === category) {
                    section.style.display = 'block'; // Показываем
                } else {
                    section.style.display = 'none';  // Скрываем
                }
            });
        });
    });
});
</script>
</body>
</html>