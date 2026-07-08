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
            :root {
                --primary-color: #1f4e78;
                --bg-color: #f8fafc;
                --card-bg: #ffffff;
                --text-main: #334155;
                --text-muted: #64748b;
                --accent-blue: #ddebf7;
                --alert-critical: #fce4d6;
                --alert-critical-text: #c00000;
                --alert-warning: #fff2cc;
                --alert-warning-text: #7f6000;
                --border-color: #e2e8f0;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: var(--bg-color);
                color: var(--text-main);
                margin: 0;
            }

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

            .container {
                max-width: 1000px;
                margin: 0 auto;
                padding: 1rem 0rem;
            }

            

            h1 {
                color: var(--primary-color);
                margin: 0;
                font-size: 24px;
            }

            /* Стили для карточек (KPI) */
            .metrics-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 20px;
                margin-bottom: 32px;
            }

            .card {
                background-color: var(--card-bg);
                border: 1px solid var(--border-color);
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            }

            .card-title {
                font-size: 14px;
                color: var(--text-muted);
                margin-bottom: 8px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .card-value {
                font-size: 28px;
                font-weight: bold;
                color: var(--primary-color);
            }

            /* Стили для таблицы */
            .table-section {
                background-color: var(--card-bg);
                border: 1px solid var(--border-color);
                border-radius: 8px;
                padding: 24px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            }

            .table-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 16px;
            }

            .table-section h2 {
                font-size: 18px;
                color: var(--text-main);
                margin: 0;
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
            }

            td {
                padding: 12px;
                border-bottom: 1px solid var(--border-color);
                font-size: 14px;
            }

            tr:hover {
                background-color: #f8fafc;
            }

            /* Статусы остатков */
            .status-badge {
                padding: 4px 8px;
                border-radius: 4px;
                font-weight: 600;
                font-size: 12px;
                display: inline-block;
            }

            .status-critical {
                background-color: var(--alert-critical);
                color: var(--alert-critical-text);
            }

            .status-warning {
                background-color: var(--alert-warning);
                color: var(--alert-warning-text);
            }

            /* Кнопка экспорта */
            .btn-export {
                background-color: #107c41; /* Цвет Microsoft Excel */
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
        </style>
    </head>
<body>
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
        <div class="container">
            <div class="dashboard-header" >
                <h1>Панель статистики СТО</h1>
            </div>

            <div class="metrics-grid">
                <div class="card">
                    <div class="card-title">Общая выручка за месяц</div>
                    <div class="card-value">1 250 000 ₽</div>
                </div>
                <div class="card">
                    <div class="card-title">Обслужено машин</div>
                    <div class="card-value">340 шт.</div>
                </div>
            </div>

            <div class="table-section">
                <div class="table-header">
                    <h2 class="card-title" style="color: var(--text-muted);">Товары, заканчивающиеся на складе</h2>
                    <button class="btn-export" onclick="exportTableToCSV('stock_report.csv')">
                        Экспорт в Excel
                    </button>
                </div>
                
                <table id="stockTable">
                    <thead>
                        <tr>
                            <th>Наименование товара</th>
                            <th>Текущий остаток</th>
                            <th>Мин. остаток</th>
                            <th>Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Моторное масло Synthetic 5W-30</td>
                            <td>5 шт.</td>
                            <td>20 шт.</td>
                            <td><span class="status-badge status-critical">Критический</span></td>
                        </tr>
                       
                        <tr>
                            <td>Тормозные колодки Front-A</td>
                            <td>8 шт.</td>
                            <td>10 шт.</td>
                            <td><span class="status-badge status-warning">Внимание</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>