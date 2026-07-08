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
            --bg-primary: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --accent: #3b82f6;
            --accent-hover: #1d4ed8;
            --border-color: #e2e8f0;
            --border-radius: 12px;
            
            /* Статусы */
            --success-bg: #f0fdf4;
            --success-text: #166534;
            --success-border: #bbf7d0;
            --warning-bg: #fffbeb;
            --warning-text: #92400e;
            --warning-border: #fde68a;
        }

        .edit-mode {
            display: none !important;
        }

        .position-management-box {
            margin-bottom: 20px;
            min-height: 24px;
            display: flex;
            justify-content: center;
        }

        .edit-mode-select {
            width: 80%;
            padding: 6px 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #3b82f6;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background-color: #fff;
            text-align: center;
        }

        .edit-mode-select:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .edit-mode-input {
            width: 100%;
            padding: 6px 10px;
            margin-top: 4px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            color: #1e293b;
            background-color: #fff;
        }
        
        .edit-mode-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
        }

        .card-actions {
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-edit-trigger {
            background: transparent;
            color: #3b82f6;
            border: 1px solid #3b82f6;
            width: 100%;
            background-color:rgba(59, 131, 246, 0.32);
            padding: 11px 20px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .btn-edit-trigger:hover {
            background: #f0f5ff;
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
            background-color: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .btn-secondary {
            background-color: #f1f5f9;
            color: #475569;
        }

        .btn-secondary:hover {
            background-color: #e2e8f0;
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
            padding: 40px 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Навигация / Хлебные крошки */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 24px;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: var(--accent);
        }

        /* Сетка профиля */
        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
            align-items: start;
        }

        @media (max-width: 850px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Общие стили карточек */
        .card {
            background: var(--bg-card);
            border-radius: var(--border-radius);
            padding: 28px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03), 0 2px 4px -2px rgba(0, 0, 0, 0.03);
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 20px;
            border-left: 4px solid var(--accent);
            padding-left: 12px;
        }

        /* КОЛОНКА 1: Личная карточка мастера */
        .main-info-card {
            text-align: center;
        }

        .profile-avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: #cbd5e1;
            color: #475569;
            font-size: 36px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            border: 4px solid #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .profile-name {
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .profile-position {
            font-size: 13px;
            font-weight: 600;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
        }

        .status-badge {
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 24px;
        }

        .status-active {
            background-color: var(--success-bg);
            color: var(--success-text);
            border: 1px solid var(--success-border);
        }

        .contact-list {
            text-align: left;
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
        }

        .contact-item {
            margin-bottom: 14px;
            font-size: 14px;
        }

        .contact-item:last-child {
            margin-bottom: 0;
        }

        .contact-label {
            display: block;
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 2px;
        }

        .contact-value {
            color: var(--text-main);
            font-weight: 500;
        }

        /* КОЛОНКА 2: Текущая загрузка (Пост / Бокс) */
        .load-box {
            background: #f8fafc;
            border: 1px dashed var(--border-color);
            border-radius: 8px;
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .load-info h4 {
            font-size: 15px;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .load-info p {
            font-size: 13px;
            color: var(--text-muted);
        }

        .car-badge {
            background: #e2e8f0;
            color: #1e293b;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        /* ТАБЛИЦА: История выполненных работ */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 14px;
        }

        .history-table th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 600;
            padding: 14px 16px;
            border-bottom: 2px solid var(--border-color);
        }

        .history-table td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
            vertical-align: middle;
        }

        .history-table tr:last-child td {
            border-bottom: none;
        }

        .history-table tr:hover td {
            background-color: #f8fafc;
        }

        .car-info-cell strong {
            display: block;
            color: #0f172a;
        }

        .car-info-cell span {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Маленький круглый бейдж статуса в таблице */
        .table-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 500;
        }

        .table-status::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-done::before { background-color: #22c55e; }
        .status-warranty::before { background-color: #f59e0b; }
    </style>
</head>
<body>

<div class="container">
    
    <a href="/admin/employees" class="back-link">
        ← Вернуться к списку сотрудников
    </a>

    <div class="profile-grid">
        
       <div class="main-info-card card">
            <form id="edit-employee-form" action="/admin/employees/update/1" method="POST">
                <div class="profile-avatar">ВП</div>
                
                <h2 class="profile-name">Василий Петров</h2>
                
                <div class="position-management-box">
                    <p class="profile-position view-mode">Старший механик</p>
                    
                    <select name="position" class="edit-mode-select edit-mode" required>
                        <option value="receptionist">Мастер-приемщик</option>
                        <option value="chief_mechanic" selected>Старший механик</option>
                        <option value="mechanic">Автомеханик / Слесарь</option>
                        <option value="electrician">Автоэлектрик</option>
                        <option value="painter">Маляр-колорист</option>
                    </select>
                </div>
                
                <span class="status-badge status-active">На смене</span>

                <div class="contact-list">
                    <div class="contact-item">
                        <span class="contact-label">Телефон</span>
                        <span class="contact-value view-mode">+375 (29) 123-45-67</span>
                        <input type="tel" name="phone" class="edit-mode-input edit-mode" value="+375 (29) 123-45-67" required>
                    </div>
                    
                    <div class="contact-item">
                        <span class="contact-label">Почта</span>
                        <span class="contact-value view-mode">123@gmail.com</span>
                        <input type="email" name="email" class="edit-mode-input edit-mode" value="123@gmail.com" required>
                    </div>
                    
                    <div class="contact-item">
                        <span class="contact-label">Специализация</span>
                        <span class="contact-value view-mode">Двигатели, КПП, ходовая часть (VAG, BMW, Mercedes)</span>
                        <input type="text" name="specialization" class="edit-mode-input edit-mode" value="Двигатели, КПП, ходовая часть (VAG, BMW, Mercedes)">
                    </div>
                    
                    <div class="contact-item">
                        <span class="contact-label">Дата приема на работу</span>
                        <span class="contact-value view-mode">12 марта 2024</span>
                        <input type="date" name="hire_date" class="edit-mode-input edit-mode" value="2024-03-12">
                    </div>
                </div>

                <div class="card-actions">
                    <button type="button" id="btn-edit" class="btn btn-edit-trigger">Изменить данные</button>
                    <button type="button" id="btn-cancel" class="btn btn-secondary edit-mode">Отмена</button>
                    <button type="submit" id="btn-save" class="btn btn-primary edit-mode">Сохранить</button>
                </div>
            </form>
        </div>

        <div>
            
            <div class="card">
                <h3 class="card-title">Текущая загрузка</h3>
                <div class="load-box">
                    <div class="load-info">
                        <h4>Пост №2 (Двухстоечный подъемник)</h4>
                        <p>Заказ-наряд №4812 — Капитальный ремонт подвески</p>
                    </div>
                    <div class="car-badge">Audi A6 (7711 AB-7)</div>
                </div>
            </div>

            <div class="card">
                <h3 class="card-title">История выполненных работ</h3>
                
                <div class="table-responsive">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Автомобиль</th>
                                <th>Выполненная работа</th>
                                <th>Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>05.07.2026</td>
                                <td class="car-info-cell">
                                    <strong>Volkswagen Golf</strong>
                                    <span>5544 CE-1</span>
                                </td>
                                <td>Замена комплекта ГРМ, водяного насоса и антифриза</td>
                                <td><span class="table-status status-done">Успешно</span></td>
                            </tr>
                            
                            <tr>
                                <td>02.07.2026</td>
                                <td class="car-info-cell">
                                    <strong>BMW 5er (F10)</strong>
                                    <span>0002 XT-7</span>
                                </td>
                                <td>Диагностика ходовой, замена передних тормозных дисков и колодок</td>
                                <td><span class="table-status status-done">Успешно</span></td>
                            </tr>

                            <tr>
                                <td>28.06.2026</td>
                                <td class="car-info-cell">
                                    <strong>Skoda Octavia A7</strong>
                                    <span>4321 BH-5</span>
                                </td>
                                <td>Ремонт механизма рулевой рейки (замена сальников, пыльников)</td>
                                <td><span class="table-status status-warranty">Гарантийный возврат</span></td>
                            </tr>

                            <tr>
                                <td>24.06.2026</td>
                                <td class="car-info-cell">
                                    <strong>Audi Q5</strong>
                                    <span>9988 OO-7</span>
                                </td>
                                <td>Плановое ТО: Замена масла в ДВС, воздушного и салонного фильтров</td>
                                <td><span class="table-status status-done">Успешно</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
            </div>

        </div>

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnEdit = document.getElementById('btn-edit');
        const btnCancel = document.getElementById('btn-cancel');
        const viewElements = document.querySelectorAll('.view-mode');
        const editElements = document.querySelectorAll('.edit-mode');

        btnEdit.addEventListener('click', function () {
            viewElements.forEach(el => el.style.display = 'none');
            btnEdit.style.display = 'none';

            editElements.forEach(el => {
                if(el.tagName === 'INPUT') {
                    el.style.setProperty('display', 'block', 'important');
                } else {
                    el.style.setProperty('display', 'inline-block', 'important');
                }
            });
        });

        btnCancel.addEventListener('click', function () {
            viewElements.forEach(el => {
                if(el.tagName === 'P') {
                    el.style.display = 'block';
                } else {
                    el.style.display = 'inline';
                }
            });
            btnEdit.style.display = 'inline-block';
            editElements.forEach(el => el.style.setProperty('display', 'none', 'important'));
        });
    });
</script>
</body>
</html>