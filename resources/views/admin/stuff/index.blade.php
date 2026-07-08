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
        /* Современные CSS переменные для легкой кастомизации */
        :root {
            --bg-primary: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --accent: #3b82f6;
            --accent-hover: #1d4ed8;
            --success-bg: #f0fdf4;
            --success-text: #166534;
            --success-border: #bbf7d0;
            --danger-bg: #fef2f2;
            --danger-text: #991b1b;
            --danger-border: #fecaca;
            --border-color: #e2e8f0;
            --border-radius: 10px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-main);
        }

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
            font-size: 26px;
            font-weight: 700;
            color: #0f172a;
        }

        /* Двухколоночная сетка */
        .layout-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 30px;
            align-items: start;
        }

        @media (max-width: 900px) {
            .layout-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ===== СТИЛИ ФОРМЫ ДОБАВЛЕНИЯ ===== */
        .form-container {
            background: var(--bg-card);
            border-radius: var(--border-radius);
            padding: 28px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }

        .form-container h2 {
            font-size: 18px;
            margin-bottom: 24px;
            color: #0f172a;
            border-left: 4px solid var(--accent);
            padding-left: 12px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 8px;
            color: #475569;
        }

        .form-group input[type="text"],
        .form-group input[type="tel"],
        .form-group input[type="email"],
        .form-group select {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 14px;
            color: var(--text-main);
            background-color: #ffffff;
            transition: all 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .form-group input[type="file"] {
            display: block;
            margin-top: 6px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .form-actions {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn {
            padding: 11px 20px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            border: none;
            transition: background-color 0.2s;
        }

        .btn-primary {
            background-color: var(--accent);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
        }

        .btn-secondary {
            background-color: #f1f5f9;
            color: #475569;
        }

        .btn-secondary:hover {
            background-color: #e2e8f0;
        }


        /* ===== СТИЛИ СПИСКА И КАРТОЧЕК ===== */
        .list-container h2 {
            font-size: 18px;
            margin-bottom: 24px;
            color: #0f172a;
        }

        .cards-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .employee-card {
            background: var(--bg-card);
            border-radius: var(--border-radius);
            padding: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            display: flex;
            gap: 20px;
            align-items: flex-start;
            position: relative;
        }

        /* Заглушка под фото (в реальном проекте будет <img>) */
        .employee-photo-placeholder {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background-color: #e2e8f0;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 20px;
            flex-shrink: 0;
        }

        .employee-details {
            flex-grow: 1;
        }

        .employee-name {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .employee-position {
            font-size: 13px;
            font-weight: 600;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        /* Компактный блок с мета-данными для СТО */
        .employee-meta-box {
            font-size: 13px;
            color: #334155;
            background: #f8fafc;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
            border: 1px solid #f1f5f9;
        }

        .employee-meta-box p {
            margin-bottom: 6px;
        }

        .employee-meta-box p:last-child {
            margin-bottom: 0;
        }

        /* Бейджи статусов */
        .status-badge {
            position: absolute;
            top: 24px;
            right: 24px;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background-color: var(--success-bg);
            color: var(--success-text);
            border: 1px solid var(--success-border);
        }

        .status-away {
            background-color: var(--danger-bg);
            color: var(--danger-text);
            border: 1px solid var(--danger-border);
        }

        /* Кнопка перехода */
        .btn-detail {
            display: inline-block;
            font-size: 13px;
            font-weight: 600;
            color: var(--accent);
            text-decoration: none;
            border: 1px solid var(--accent);
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .btn-detail:hover {
            background-color: var(--accent);
            color: white;
        }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <div class="flex flex-1">
                
                <main class="flex-1 p-8 bg-gray-50">
                    @if (isset($header))
                        <header class="mb-6">
                            <div class="max-w-7xl mx-auto">
                                {{ $header }}
                            </div>
                        </header>
                    @endif
                    
                    <div class="container">
                    <div class="dashboard-header" >
                        <h1>Панель управления персоналом СТО</h1>
                        <div class="relative w-64">
                            <input type="text" 
                                placeholder="Поиск сотрудника..." 
                                class="w-full pl-10 pr-4 py-2 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                            >
                        </div>
                    </div>

                    <div class="layout-grid">
                        
                        <div class="form-container">
                            <h2>Новый сотрудник</h2>
                            <form action="/admin/employees/store" method="POST" enctype="multipart/form-data">
                                
                                <div class="form-group">
                                    <label for="first_name">Имя</label>
                                    <input type="text" id="first_name" name="first_name" placeholder="Например: Василий" required>
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Фамилия</label>
                                    <input type="text" id="last_name" name="last_name" placeholder="Например: Петров" required>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Номер телефона</label>
                                    <input type="tel" id="phone" name="phone" placeholder="+375 (29) 123-45-67" required>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Почта</label>
                                    <input type="email" id="email" name="email" placeholder="12@gmail.com" required>
                                </div>

                                <div class="form-group">
                                    <label for="position">Должность в автосервисе</label>
                                    <select id="position" name="position" required>
                                        <option value="">-- Выберите должность --</option>
                                        <option value="receptionist">Мастер-приемщик</option>
                                        <option value="chief_mechanic">Старший механик</option>
                                        <option value="mechanic">Автомеханик / Слесарь</option>
                                        <option value="electrician">Автоэлектрик</option>
                                        <option value="painter">Маляр-колорист</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="specialization">Специализация (марки / узлы)</label>
                                    <input type="text" id="specialization" name="specialization" placeholder="Например: VAG, BMW, Ремонт ДВС, Ходовая">
                                </div>

                                <div class="form-group">
                                    <label for="avatar">Фотография мастера</label>
                                    <input type="file" id="avatar" name="avatar" accept="image/*">
                                </div>

                                <div class="form-actions">
                                    <button type="button" class="btn btn-secondary">Отмена</button>
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </form>
                        </div>

                        <div class="list-container">
                            <h2>Текущий состав команды</h2>
                            
                            <div class="cards-container">
                                
                                <div class="employee-card">
                                    <div class="employee-photo-placeholder">ВП</div>
                                    <span class="status-badge status-active">На смене/в отпуске</span>
                                    
                                    <div class="employee-details">
                                        <h3 class="employee-name">Василий Петров</h3>
                                        <p class="employee-position">Старший механик</p>
                                        
                                        <div class="employee-meta-box">
                                            <p><strong>Специализация:</strong> Двигатели, КПП, подвеска (Немецкие бренды)</p>
                                            <p><strong>В боксе сейчас:</strong> Audi A6 (Гос. номер: 7711 AB-7)</p>
                                        </div>
                                        
                                        <a href="{{ route('staff.profile') }}" class="btn-detail">Подробный профиль</a>
                                    </div>
                                </div>

                                <div class="employee-card">
                                    <div class="employee-photo-placeholder" style="background-color: #cbd5e1;">ДС</div>
                                    <span class="status-badge status-away">Выходной</span>
                                    
                                    <div class="employee-details">
                                        <h3 class="employee-name">Дмитрий Сергеев</h3>
                                        <p class="employee-position">Автоэлектрик</p>
                                        
                                        <div class="employee-meta-box">
                                            <p><strong>Специализация:</strong> Компьютерная диагностика, ЭБУ, мультимедиа</p>
                                            <p><strong>В боксе сейчас:</strong> Нет активных задач</p>
                                        </div>
                                        
                                        <a href="{{ route('staff.profile') }}" class="btn-detail">Подробный профиль</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                </main>
            </div>
        </div>
    </body>
</html>
