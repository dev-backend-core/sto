<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Scout Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
        <h1 class="sitename">СТО</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Главная</a></li>
          <li><a href="#services">Услуги</a></li>
          <li><a href="#testimonials">Отзывы</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="#contact">Записаться</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
   <section id="hero" class="hero section dark-background">
        <div class="container" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content" data-aos="fade-up" data-aos-delay="100">
                    
                    <!-- Таг над заголовком -->
                    <div class="hero-tag">
                        <i class="bi bi-wrench-adjustable"></i>
                        <span>Профессиональный автосервис</span>
                    </div>
                    
                    <!-- Главный заголовок -->
                    <h1>Надежный ремонт и <span class="highlight">обслуживание авто</span> с гарантией</h1>
                    
                    <!-- Подзаголовок -->
                    <p class="lead">Вернем ваш автомобиль в идеальное состояние. Быстрая диагностика, честные цены и оригинальные запчасти.</p>
                    
                    <!-- Преимущества -->
                    <ul class="hero-features">
                        <li><i class="bi bi-check-circle"></i> Компьютерная диагностика за 30 минут</li>
                        <li><i class="bi bi-check-circle"></i> Гарантия на работы и запчасти до 1 года</li>
                        <li><i class="bi bi-check-circle"></i> Опытные мастера со стажем от 7 лет</li>
                    </ul>
                    
                    <!-- Кнопки действия -->
                    <div class="hero-cta">
                        <a href="#contact" class="btn btn-primary">Записаться на ремонт</a>
                        <a href="tel:+74951234567" class="btn btn-link"><i class="bi bi-telephone"></i> +7 (495) 123-45-67</a>
                    </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-image-wrapper" data-aos="fade-up" data-aos-delay="300">
                    
                   
                    <img src="{{ asset('assets/img/clients/service.png') }}" alt="Ремонт автомобиля" class="img-fluid hero-image">
                    
                   
                    <div class="stat-card top-right">
                        <div class="stat-value">5 000+</div>
                        <div class="stat-label">Отремонтированных авто</div>
                        <div class="stat-icon">
                        <i class="bi bi-car-front"></i>
                        </div>
                    </div>
                    
                   
                    <div class="stat-card bottom-left">
                        <div class="stat-value">99%</div>
                        <div class="stat-label">Довольных клиентов</div>
                        <div class="stat-icon">
                        <i class="bi bi-shield-check"></i>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="services" class="about section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Заголовок секции -->
        <div class="row justify-content-center mb-5">
        <div class="col-lg-8 text-center" data-aos="fade-up" data-aos-delay="200">
            <h2 class="section-heading">Наши услуги</h2>
            <p class="lead">Предоставляем полный спектр услуг по техническому обслуживанию и ремонту автомобилей любых марок.</p>
        </div>
        </div>

       
        <div class="row g-4 mb-5">
          @forelse ($services as $item)
              <div class="col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-box d-flex align-items-center justify-content-between p-3 border rounded shadow-sm h-100">
                    <h5 class="mb-0 me-2 text-wrap fw-semibold fs-6">{{ $item->name }}</h5>
                    <span class="badge bg-primary-subtle text-primary fs-6 flex-shrink-0">от {{ $item->price }} ₽</span>
                </div>
              </div>
          @empty
              <p>ошибка при загрузке страницы</p>
          @endforelse

        </div>

       
        <div class="row align-items-center about-showcase">
        
      
        <div class="col-lg-6 order-lg-2" data-aos="fade-left" data-aos-delay="300">
            <div class="about-image-grid">
            <img src="{{ asset('assets/img/clients/service.png') }}" class="img-grid-main" alt="Ремонт авто">
            <img src="{{ asset('assets/img/services/services-12.webp') }}" class="img-grid-secondary" alt="Диагностика">
            <div class="experience-badge" data-aos="zoom-in" data-aos-delay="500">
                <span class="years">100%</span>
                <span class="text">Гарантия качества</span>
            </div>
            </div>
        </div>

       
        <div class="col-lg-6 order-lg-1" data-aos="fade-right" data-aos-delay="200">
            <div class="about-content-box">
            <h3>Качественный сервис для вашего авто</h3>
            <p class="mb-4">Используем современное дилерское оборудование и профессиональный инструмент. Подбираем оригинальные запчасти или проверенные аналоги под ваш бюджет.</p>

            <!-- Прогресс-бары: Объём выполняемых работ / Популярность услуг -->
            <div class="progress-item">
                <div class="d-flex justify-content-between">
                <span class="progress-title">Диагностика и автоэлектрика</span>
                <span class="progress-percent">100%</span>
                </div>
                <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="progress-item">
                <div class="d-flex justify-content-between">
                <span class="progress-title">Ремонт подвески и тормозной системы</span>
                <span class="progress-percent">95%</span>
                </div>
                <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="progress-item">
                <div class="d-flex justify-content-between">
                <span class="progress-title">Обслуживание КПП и двигателей</span>
                <span class="progress-percent">90%</span>
                </div>
                <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

           
            <button  class="btn btn-discover mt-4">Посмотреть весь прайс-лист</button>
            </div>
        </div>

        </div>

    </div>

    </section><!-- /About Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section">

      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="clients-slider">
          <div class="clients-track track-1" data-aos="fade-right" data-aos-delay="200">
            <div class="clients-slide">
              <img src="assets/img/clients/mercedes-benz-4.svg" style="max-height: none;" class="img-fluid" alt="Client 4">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/bmw-logo.svg" class="img-fluid" alt="Client 1">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/tesla-pure.svg" class="img-fluid" alt="Client 5">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/honda-11.svg" class="img-fluid" alt="Client 2">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/audi-new-logo.svg" class="img-fluid" alt="Client 6">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/porsche-1.svg" style="max-height: none;" class="img-fluid" alt="Client 7">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/toyota-1.svg" style="max-height: none;" class="img-fluid" alt="Client 8">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/honda-11.svg" class="img-fluid" alt="Client 2">
            </div>

           <!--Duplicate for seamless looping-->
              <div class="clients-slide">
              <img src="assets/img/clients/mercedes-benz-4.svg" style="max-height: none;" class="img-fluid" alt="Client 4">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/bmw-logo.svg" class="img-fluid" alt="Client 1">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/tesla-pure.svg" class="img-fluid" alt="Client 5">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/honda-11.svg" class="img-fluid" alt="Client 2">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/audi-new-logo.svg" class="img-fluid" alt="Client 6">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/porsche-1.svg" style="max-height: none;" class="img-fluid" alt="Client 7">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/toyota-1.svg" style="max-height: none;" class="img-fluid" alt="Client 8">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/honda-11.svg" class="img-fluid" alt="Client 2">
            </div>
          </div>
        </div>

        <div class="clients-slider">
          <div class="clients-track track-2" data-aos="fade-left" data-aos-delay="300">
             <div class="clients-slide">
              <img src="assets/img/clients/honda-11.svg" class="img-fluid" alt="Client 2">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/tesla-pure.svg" class="img-fluid" alt="Client 5">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/mercedes-benz-4.svg" style="max-height: none;" class="img-fluid" alt="Client 4">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/porsche-1.svg" style="max-height: none;" class="img-fluid" alt="Client 7">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/bmw-logo.svg" class="img-fluid" alt="Client 1">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/toyota-1.svg" style="max-height: none;" class="img-fluid" alt="Client 8">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/audi-new-logo.svg" class="img-fluid" alt="Client 6">
            </div>
             <div class="clients-slide">
              <img src="assets/img/clients/mercedes-benz-4.svg" style="max-height: none;" class="img-fluid" alt="Client 4">
            </div>
            

           <!--Duplicate for seamless looping--> 
            <div class="clients-slide">
              <img src="assets/img/clients/bmw-logo.svg" class="img-fluid" alt="Client 1">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/honda-11.svg" class="img-fluid" alt="Client 2">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/toyota-1.svg" style="max-height: none;" class="img-fluid" alt="Client 8">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/tesla-pure.svg" class="img-fluid" alt="Client 5">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/mercedes-benz-4.svg" style="max-height: none;" class="img-fluid" alt="Client 4">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/porsche-1.svg" style="max-height: none;" class="img-fluid" alt="Client 7">
            </div>
            <div class="clients-slide">
              <img src="assets/img/clients/audi-new-logo.svg" class="img-fluid" alt="Client 6">
            </div>
             <div class="clients-slide">
              <img src="assets/img/clients/mercedes-benz-4.svg" style="max-height: none;" class="img-fluid" alt="Client 4">
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Clients Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

    <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Отзывы наших клиентов</h2>
            <p>Что говорят автовладельцы о качестве ремонта и обслуживания в нашем автосервисе</p>
        </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">
        <!-- Отзыв 3 -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="testimonial-item">
            <div class="stars">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
            </div>
            <p>Обслуживаю здесь уже вторую машину. Делал капиталку коробки передач — переключает идеально, никаких пинков. Отдельный респект за чистую клиентскую зону с кофе и WI-FI, где можно комфортно подождать авто.</p>
            <div class="testimonial-footer">
                <div class="testimonial-author">
                <img src="{{ asset('assets/img/person/person-m-7.webp') }}" alt="Даниил" class="img-fluid rounded-circle" loading="lazy">
                <div>
                    <h5>Даниил Василенко</h5>
                    <span>Владелец Toyota Camry</span>
                </div>
                </div>
                <div class="quote-icon">
                <i class="bi bi-quote"></i>
                </div>
            </div>
            </div>
        </div><!-- End Testimonial Item -->

        <!-- Отзыв 4 -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="testimonial-item">
            <div class="stars">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
            </div>
            <p>Очень честный сервис. На другом СТО начитали ремонт ходовой на 40 тысяч, решил перепроверить тут. Оказалось, нужно было заменить только один ступичный подшипник и стойку стабилизатора. Сэкономили мне кучу денег!</p>
            <div class="testimonial-footer">
                <div class="testimonial-author">
                <img src="{{ asset('assets/img/person/person-f-9.webp') }}" alt="Елена" class="img-fluid rounded-circle" loading="lazy">
                <div>
                    <h5>Елена Яковлева</h5>
                    <span>Владелица Nissan Qashqai</span>
                </div>
                </div>
                <div class="quote-icon">
                <i class="bi bi-quote"></i>
                </div>
            </div>
            </div>
        </div><!-- End Testimonial Item -->

        <!-- Отзыв 5 -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
            <div class="testimonial-item">
            <div class="stars">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
            </div>
            <p>Делал плановое ТО: замена масла в ДВС и всех фильтров. Понравилось, что заглянули под днище и бесплатно проверили состояние тормозов и подвески. Приятный сервис, аккуратное отношение к машине.</p>
            <div class="testimonial-footer">
                <div class="testimonial-author">
                <img src="{{ asset('assets/img/person/person-f-11.webp') }}" alt="Ольга" class="img-fluid rounded-circle" loading="lazy">
                <div>
                    <h5>Ольга Тихонова</h5>
                    <span>Владелица Hyundai Creta</span>
                </div>
                </div>
                <div class="quote-icon">
                <i class="bi bi-quote"></i>
                </div>
            </div>
            </div>
        </div><!-- End Testimonial Item -->

        <!-- Отзыв 6 -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
            <div class="testimonial-item">
            <div class="stars">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
            </div>
            <p>Обращался по ремонту автоэлектрики — не работал кондиционер и глючила приборка. Электрик быстро разобрался с проводкой. Все работы заранее согласовали по телефону. Рекомендую!</p>
            <div class="testimonial-footer">
                <div class="testimonial-author">
                <img src="{{ asset('assets/img/person/person-m-12.webp') }}" alt="Дмитрий" class="img-fluid rounded-circle" loading="lazy">
                <div>
                    <h5>Дмитрий Тимофеев</h5>
                    <span>Владелец Skoda Octavia</span>
                </div>
                </div>
                <div class="quote-icon">
                <i class="bi bi-quote"></i>
                </div>
            </div>
            </div>
        </div><!-- End Testimonial Item -->

        </div>

    </div>

    </section><!-- /Testimonials Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <!-- Section Title -->
        <div class="container section-title" >
            <h2>Контакты</h2>
            <p>Свяжитесь с нами для записи на ремонт или получения бесплатной консультации специалиста</p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="contact-main-wrapper">
            <div class="map-wrapper">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48559.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="contact-content">
                <div class="contact-cards-container">
                <div class="contact-card">
                    <div class="icon-box">
                    <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="contact-text">
                    <h4>Наш адрес</h4>
                    <p>г. Москва, ул. Автомобильная, д. 15, стр. 2</p>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="icon-box">
                    <i class="bi bi-envelope"></i>
                    </div>
                    <div class="contact-text">
                    <h4>Email</h4>
                    <p>info@autoservice-example.ru</p>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="icon-box">
                    <i class="bi bi-telephone"></i>
                    </div>
                    <div class="contact-text">
                    <h4>Телефон</h4>
                    <p>+7 (495) 123-45-67</p>
                    </div>
                </div>

                <div class="contact-card">
                    <div class="icon-box">
                    <i class="bi bi-clock"></i>
                    </div>
                    <div class="contact-text">
                    <h4>Режим работы</h4>
                    <p>Пн–Вс: 09:00 — 21:00 (без выходных)</p>
                    </div>
                </div>
                </div>

                <div class="contact-form-container">
                <h3>Записаться на сервис</h3>
                <p>Оставьте заявку, и наш мастер-приемщик перезвонит вам в течение 10 минут для уточнения деталей и расчета стоимости.</p>

                <form action="{{ route('form') }}" method="POST" >
                    @csrf
                    <div class="row">
                      <div class="col-md-6 form-group">
                          <input 
                          type="text" 
                          name="name" class="form-control"
                          id="name"
                          value="{{ old('name') }}"
                          placeholder="Ваше имя" 
                          required>
                      </div>
                      <div class="col-md-6 form-group mt-3 mt-md-0">
                          <input 
                          type="tel" 
                          class="form-control" 
                          name="phone" 
                          id="phone" 
                          value="{{ old('phone') }}"
                          placeholder="Ваш телефон" 
                          required>
                      </div>
                    </div>
                    <div class="form-group mt-3">
                      <input 
                      type="email" 
                      value="{{ old('email') }}"
                      class="form-control" 
                      name="email" 
                      placeholder="example@gmail.com" 
                      required>
                    </div>
                   
                    <div class="form-group mt-3">
                        <select id="car_brand" name="car_brand" class="form-control" required>
                            <option value="" disabled selected>-- Выберите марку --</option>
                            <option value="Audi (A4)">Audi (A4)</option>
                            <option value="BMW (3-Series)">BMW (3-Series)</option>
                            <option value="Mercedes-Benz (C-Class)">Mercedes-Benz (C-Class)</option>
                            <option value="Volkswagen (Golf)">Volkswagen (Golf)</option>
                            <option value="Toyota (RAV4)">Toyota (RAV4)</option>
                            <option value="Porsche (911)">Porsche (911)</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <select id="service" name="service_id" class="form-control" required>
                            <option value="" disabled {{ old('car_brand') ? '' : 'selected' }}>-- Выберите услугу --</option>

                            @foreach($services as $service)
                              <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach

                        </select>
                    </div>
                     <div class="form-group mt-3">
                        <label class="mb-3">Дата и время визита </label>
                        <div class="date-time-container">
                            
                          <div id="calendarStep">
                              <input 
                              type="date" 
                              value="{{ old('date') }}"
                              id="booking_date" 
                              name="date" 
                              class="form-control">
                          </div>

                          <div id="timeStep" class="time-slots-container hidden">
                              <h4>
                                  <p>Время на <strong id="selectedDateLabel"></strong>:</p>
                                  <button type="button" class="btn" id="changeDateBtn">Изменить дату</button>
                              </h4>
                              
                              <div class="time-grid">
                                  <div class="time-pill" data-time="09:00">09:00</div>
                                  <div class="time-pill" data-time="11:00">11:00</div>
                                  <div class="time-pill" data-time="13:00">13:00</div>
                                  <div class="time-pill" data-time="15:00">15:00</div>
                                  <div class="time-pill" data-time="17:00">17:00</div>
                                  <div class="time-pill" data-time="19:00">19:00</div>
                              </div>

                              <input 
                              type="hidden" 
                              id="booking_time" 
                              value="{{ old('time') }}"
                              name="time" 
                              required>
                          </div>

                        </div>
                    </div>

                    <div class="my-3">

                      @if ($errors->any())
                          <div class="error-message">
                              <ul class="mb-0">
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif

                      @session('success')
                        <div class="sent-message">{{ $value }}</div>
                      @endsession
                
                    </div>

                    <div class="form-submit">
                    <button type="submit">Отправить заявку</button>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-telegram"></i></a>
                        <a href="#"><i class="bi bi-whatsapp"></i></a>
                    </div>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </section><!-- /Contact Section -->

  </main>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>