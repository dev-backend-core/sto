<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автомобильное Бюро | Продажа и Обслуживание</title>
    <style>
        /* Перенос премиального стиля из макета */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: #ffffff;
            color: #2b2b2b;
            line-height: 1.5;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 30px;
        }

        /* Шапка сайта */
        header {
            background-color: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid #eaeaea;
          
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-box {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-circle {
            width: 35px;
            height: 35px;
            background-color: #e31e24; /* Фирменный красный */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
            font-size: 18px;
        }

        .logo-text {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #1a1a1a;
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            color: #7a7a7a;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: #e31e24;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .phone-link {
            color: #1a1a1a;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-red {
            background-color: #e31e24;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: background-color 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-red:hover {
            background-color: #be1318;
        }

        /* Главный экран (Hero) */
        .hero-section {
            background-color: #1e2124;
            color: #fff;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            min-height: 520px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            align-items: center;
            width: 100%;
        }

        .hero-content {
            padding: 60px 0;
            position: relative;
            z-index: 2;
        }

        .hero-sub {
            font-size: 13px;
            color: #a0a0a0;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        .hero-section h1 {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.1;
            text-transform: uppercase;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }

        .hero-section h1 span {
            color: #e31e24;
        }

        .hero-desc {
            color: #bcbcbc;
            font-size: 15px;
            margin-bottom: 35px;
        }

        .hero-action {
            display: inline-flex;
            background-color: #2b2f33;
            padding: 6px;
            border-radius: 6px;
            align-items: center;
            max-width: 320px;
        }

        .hero-action span {
            padding: 0 15px;
            font-size: 13px;
            color: #cfcfcf;
        }

        .btn-arrow {
            background-color: #3f4449;
            color: #fff;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .hero-image-block {
            position: relative;
            height: 100%;
            display: flex;
            justify-content: flex-end;
        }

        .hero-car-img {
            max-width: 120%;
            height: auto;
            object-fit: contain;
            transform: scale(1.15) translate(40px, 10px);
        }

        /* Плашка со статистикой */
        .stats-bar {
            background-color: #16181a;
            border-top: 1px solid #2b2f33;
            padding: 20px 0;
            color: #909090;
            font-size: 12px;
        }

        .stats-box {
            display: flex;
            justify-content: flex-start;
            gap: 60px;
        }

        .stat-item strong {
            color: #fff;
            display: block;
            font-size: 14px;
            margin-bottom: 2px;
        }

        /* Стильная, ровная сетка по 4 квадрата в ряд */
        .clean-services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); /* Авто-выравнивание: по 4 в ряд на десктопе, по 2 или 1 на мобилке */
            gap: 20px;
            margin-bottom: 1rem;
        }

        /* Квадратики с закругленными углами */
        .service-box {
            background-color: #ffffff;
            border: 1px solid #eef2f5;
            border-radius: 12px; /* Красивые закругленные углы */
            padding: 25px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 240px; /* Одинаковая высота для всех */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
        }

        .section-headline{
            margin-bottom: 1rem;
            text-align: center;
        }

        /* Эффект при наведении — карточка мягко приподнимается, а рамка краснеет */
        .service-box:hover {
            transform: translateY(-4px);
            border-color: #e31e24;
            box-shadow: 0 10px 20px rgba(227, 30, 36, 0.05);
        }

        .service-box h3 {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .service-box p {
            font-size: 13px;
            color: #7a7a7a;
            line-height: 1.4;
        }

        /* Нижняя часть карточки (Цена + Кнопка) */
        .service-box-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #f7f9fa;
        }

        .service-box-footer .price {
            font-size: 14px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .service-link {
            font-size: 12px;
            font-weight: 600;
            color: #e31e24; /* Красная стрелочка */
            text-decoration: none;
            transition: color 0.2s;
        }

        .service-link:hover {
            color: #be1318;
        }

        /* Секция нашей интерактивной формы */
        .booking-section {
            padding: 2rem 0;
            background-color: #f7f9fa;
            border-top: 1px solid #eaeaea;
        }

        .booking-box {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            border: 1px solid #eaeaea;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #1a1a1a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            background-color: #f7f9fa;
            border: 1px solid #e2e8f0;
            color: #1a1a1a;
            border-radius: 4px;
            font-size: 15px;
            transition: all 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #e31e24;
            background-color: #fff;
        }

        /* Контейнер интерактивного времени */
        .date-time-container {
            background-color: #f7f9fa;
            padding: 20px;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
        }

        .hidden { display: none !important; }

        .time-slots-container h4 {
            font-size: 14px;
            margin-bottom: 15px;
            color: #1a1a1a;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-back {
            background: none;
            border: none;
            color: #e31e24;
            cursor: pointer;
            font-size: 12px;
            text-decoration: underline;
            font-weight: 600;
        }

        .time-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* Овальные тайм-пилюли */
        .time-pill {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            color: #1a1a1a;
            padding: 10px 22px;
            border-radius: 50px; /* Овальная форма */
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.2s;
            text-align: center;
        }

        .time-pill:hover {
            border-color: #e31e24;
            color: #e31e24;
        }

        .time-pill.selected {
            background-color: #e31e24;
            border-color: #e31e24;
            color: #ffffff;
        }

        .booking-box .btn-submit {
            width: 100%;
            padding: 15px;
            font-size: 14px;
            margin-top: 10px;
        }

        /* Бренды в подвале макета */
        .brands-section {
            padding: 40px 0;
            border-top: 1px solid #eaeaea;
            text-align: center;
            background-color: #fff;
        }

        .brands-grid {
            display: flex;
            justify-content: space-between;
            align-items: center;
            opacity: 0.4;
            flex-wrap: wrap;
            gap: 20px;
        }

        .brand-item {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #000;
        }

        footer {
            background-color: #1e2124;
            color: #7a7a7a;
            text-align: center;
            padding: 25px 0;
            font-size: 12px;
            border-top: 1px solid #2b2f33;
        }
    </style>
</head>
<body>

    <header>
        <div class="container header-box">
            <div class="logo-box">
                <div class="logo-circle">A</div>
                <div class="logo-text">Автомобильное Бюро</div>
            </div>
            <nav class="nav-links">
                <a href="#services">Услуги</a>
                <a href="#booking">Запись на сервис</a>
            </nav>
            <div class="header-right">
                <a href="tel:+78123893021" class="phone-link">+7 812 389 30 21</a>
                <a href="#booking" class="btn-red">Записаться</a>
            </div>
        </div>
    </header>

    <section class="hero-section">
        <div class="container hero-grid">
            <div class="hero-content">
                <div class="hero-sub">Автомобильное Бюро Карпов</div>
                <h1>Обслуживание<br><span>автомобилей.</span></h1>
                <div class="hero-desc">Обслуживание, дооснащение и профессиональный ремонт.</div>
                
                <div class="hero-action">
                    <span>Онлайн-запись на обслуживание</span>
                    <button class="btn-arrow" onclick="location.href='#booking'">➔</button>
                </div>
            </div>
            <div class="hero-image-block">
                <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=800" alt="Porsche" class="hero-car-img">
            </div>
        </div>
    </section>

    <div class="stats-bar">
        <div class="container stats-box">
            <div class="stat-item"><strong>8 лет</strong>опыт работы</div>
            <div class="stat-item"><strong>более 50 000</strong>проверенных авто</div>
            <div class="stat-item"><strong>более 20 000</strong>довольных клиентов</div>
        </div>
    </div>

    <section class="services-section" id="services">
        <div class="container">
            <h2 class="section-headline">Наши <span>услуги.</span></h2>
            
            <div class="clean-services-grid">
                
                <div class="service-box">
                    <div class="service-box-content">
                        <h3>Дооснащение оборудованием</h3>
                        <p>Установка фаркопов, камер кругового обзора 360, парктроников и автосигнализаций.</p>
                    </div>
                    <div class="service-box-footer">
                        <span class="price">от 80 BYN</span>
                        <a href="#booking" class="service-link">Записаться →</a>
                    </div>
                </div>

                <div class="service-box">
                    <div class="service-box-content">
                        <h3>Оклейка пленками</h3>
                        <p>Оклейка элементов кузова качественной полиуретановой и виниловой защитной пленкой.</p>
                    </div>
                    <div class="service-box-footer">
                        <span class="price">от 150 BYN</span>
                        <a href="#booking" class="service-link">Записаться →</a>
                    </div>
                </div>

                <div class="service-box">
                    <div class="service-box-content">
                        <h3>Техническое обслуживание</h3>
                        <p>Замена моторного масла, всех фильтров, свечей зажигания и комплексная проверка ходовой.</p>
                    </div>
                    <div class="service-box-footer">
                        <span class="price">от 45 BYN</span>
                        <a href="#booking" class="service-link">Записаться →</a>
                    </div>
                </div>

                <div class="service-box">
                    <div class="service-box-content">
                        <h3>Реставрация дисков</h3>
                        <p>Качественная порошковая покраска дисков и суппортов, исправление геометрии и сколов.</p>
                    </div>
                    <div class="service-box-footer">
                        <span class="price">от 120 BYN</span>
                        <a href="#booking" class="service-link">Записаться →</a>
                    </div>
                </div>

                </div>
        </div>
    </section>

    <section class="booking-section" id="booking">
        <div class="container">
            <div class="booking-box">
                <h2 class="section-headline" style="text-align: center; font-size: 24px; margin-bottom: 30px;">Запись на <span>сервис</span></h2>
                
                <form action="#" method="POST" id="mainBookingForm">
                    
                    <div class="form-group">
                        <label for="name">Ваше имя *</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Иван" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Номер телефона *</label>
                        <input type="tel" id="phone" name="phone" class="form-control" placeholder="+375 (29) XXX-XX-XX" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email для подтверждения *</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="example@gmail.com" required>
                    </div>

                    <div class="form-group">
                        <label for="car_brand">Марка автомобиля *</label>
                        <select id="car_brand" name="car_brand" class="form-control" required>
                            <option value="" disabled selected>-- Выберите марку --</option>
                            <option value="audi">Audi (A4, A6, Q5)</option>
                            <option value="bmw">BMW (3-Series, 5-Series, X5)</option>
                            <option value="mercedes">Mercedes-Benz (C-Class, E-Class)</option>
                            <option value="volkswagen">Volkswagen (Golf, Passat)</option>
                            <option value="toyota">Toyota (Camry, RAV4)</option>
                            <option value="porsche">Porsche (911, Cayenne, Macan)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="service">Выберите услугу *</label>
                        <select id="service" name="service_id" class="form-control" required>
                            <option value="" disabled selected>-- Выберите из списка --</option>
                            <option value="1">Дооснащение оборудованием</option>
                            <option value="2">Оклейка защитными пленками</option>
                            <option value="3">Техническое обслуживание</option>
                            <option value="4">Реставрация колесных дисков</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Дата и время визита *</label>
                        <div class="date-time-container">
                            
                            <div id="calendarStep">
                                <input type="date" id="booking_date" name="date" class="form-control">
                            </div>

                            <div id="timeStep" class="time-slots-container hidden">
                                <h4>
                                    <span>Время на <strong id="selectedDateLabel"></strong>:</span>
                                    <button type="button" class="btn-back" id="changeDateBtn">Изменить дату</button>
                                </h4>
                                
                                <div class="time-grid">
                                    <div class="time-pill" data-time="09:00">09:00</div>
                                    <div class="time-pill" data-time="11:00">11:00</div>
                                    <div class="time-pill" data-time="13:00">13:00</div>
                                    <div class="time-pill" data-time="15:00">15:00</div>
                                    <div class="time-pill" data-time="17:00">17:00</div>
                                    <div class="time-pill" data-time="19:00">19:00</div>
                                </div>

                                <input type="hidden" id="booking_time" name="time" required>
                            </div>

                        </div>
                    </div>

                    <button type="submit" class="btn-red btn-submit">Подтвердить запись</button>
                </form>
            </div>
        </div>
    </section>

   

    <footer>
        <div class="container">
            <p>&copy; 2026 Автомобильное Бюро. Все права защищены.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dateInput = document.getElementById('booking_date');
            const calendarStep = document.getElementById('calendarStep');
            const timeStep = document.getElementById('timeStep');
            const selectedDateLabel = document.getElementById('selectedDateLabel');
            const changeDateBtn = document.getElementById('changeDateBtn');
            const timePills = document.querySelectorAll('.time-pill');
            const timeInput = document.getElementById('booking_time');

            // Ограничение: текущий месяц
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            
            const minDate = `${yyyy}-${mm}-${dd}`;
            const lastDay = new Date(yyyy, today.getMonth() + 1, 0).getDate();
            const maxDate = `${yyyy}-${mm}-${lastDay}`;

            dateInput.min = minDate;
            dateInput.max = maxDate;

            // Календарь -> Овалы
            dateInput.addEventListener('change', function () {
                if (this.value) {
                    const formattedDate = this.value.split('-').reverse().join('.');
                    selectedDateLabel.textContent = formattedDate;

                    calendarStep.classList.add('hidden');
                    timeStep.classList.remove('hidden');
                }
            });

            // Назад к календарю
            changeDateBtn.addEventListener('click', function () {
                dateInput.value = '';
                timeInput.value = '';
                timePills.forEach(p => p.classList.remove('selected'));
                
                timeStep.classList.add('hidden');
                calendarStep.classList.remove('hidden');
            });

            // Выбор овала времени
            timePills.forEach(pill => {
                pill.addEventListener('click', function () {
                    timePills.forEach(p => p.classList.remove('selected'));
                    this.classList.add('selected');
                    timeInput.value = this.getAttribute('data-time');
                });
            });

            // Валидация перед отправкой
            document.getElementById('mainBookingForm').addEventListener('submit', function (e) {
                if (!timeInput.value) {
                    e.preventDefault();
                    alert('Пожалуйста, выберите время для визита!');
                }
            });
        });
    </script>
</body>
</html>