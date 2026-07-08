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
                        <h2 class="text-xl font-bold text-gray-950">Расходники</h2>
                        <p class="mt-1 text-gray-500" style="font-size:medium">Управление технологическими картой расходников.</p>
                    </div>

                    <div class="flex flex-row items-center gap-3">
                        
                        <div class="relative w-64">
                            <input type="text" 
                                placeholder="Поиск услуги..." 
                                class="w-full pl-10 pr-4 py-2 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                            >
                        </div>

                        <div class="flex bg-gray-200 p-1 rounded-lg text-sm font-medium text-gray-600">
                            <button type="button" data-filter="all" class="filter-btn px-3 py-1.5 rounded-md bg-white text-gray-900 shadow-sm transition-all">
                                Все
                            </button>
                            <button type="button" data-filter="available" class="filter-btn px-3 py-1.5 rounded-md hover:text-gray-900 transition-all">
                                В наличии
                            </button>
                            <button type="button" data-filter="unavailable" class="filter-btn px-3 py-1.5 rounded-md hover:text-gray-900 transition-all">
                                Не в наличии
                            </button>
                            <button type="button" data-filter="deleted" class="filter-btn px-3 py-1.5 rounded-md hover:text-gray-900 transition-all">
                                Удаленные
                            </button>
                        </div>

                        <button id="open-modal-btn" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold bg-blue-100 hover:bg-blue-200 rounded-lg shadow-sm transition-colors whitespace-nowrap text-gray-700">
                            Добавить
                        </button>

                        <div id="add-product-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm transition-opacity">
                            
                            <div class="bg-white rounded-xl shadow-xl border border-gray-200 w-full max-w-md overflow-hidden transform transition-all m-4">
                                
                                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
                                    <h3 class="text-lg font-bold text-gray-900">Добавить новую услугу</h3>
                                    <button id="close-modal-btn" type="button" class="text-gray-400 hover:text-gray-600 font-semibold text-xl leading-none">&times;</button>
                                </div>
                                
                                <form id="add-product-form" class="p-6 space-y-4">
                                    <div>
                                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Название</label>
                                        <input type="text" required name="name" placeholder="Например: Стрижка окрашивание" 
                                            class="w-full px-3 py-2 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1" style="margin-bottom: 0.4rem; margin-top: 0.5rem;">Стоимость (₽)</label>
                                        <input type="number" required min="0" name="price" placeholder="500" 
                                            class="w-full px-3 py-2 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1" style="margin-bottom: 0.4rem; margin-top: 0.5rem;">Количество</label>
                                            <input type="number" required min="0" name="quantity" placeholder="1" 
                                                class="w-full px-3 py-2 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">На складе</label>
                                            <input type="number" required min="0" name="stock" placeholder="10" 
                                                class="w-full px-3 py-2 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                                        <button id="cancel-modal-btn" type="button" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors">
                                            Отмена
                                        </button>
                                        <button type="submit" class="px-4 py-2 text-sm font-semibold bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm transition-colors">
                                            Сохранить
                                        </button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <table class="w-full border-collapse product-table">
                    <thead>
                        <tr class="bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200 text-center" style="height: 40px;">
                            <th class="px-6 py-3">Название</th>
                            <th class="px-6 py-3">Стоимость</th>
                            <th class="px-6 py-3">Количество</th>
                            <th class="px-6 py-3">Остаток на складе</th>
                            <th class="px-6 py-3">Действие</th>
                            <th class="px-6 py-3">Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-50 transition-colors group text-center" style="font-size:medium">
                            
                            <td class="px-6 py-4 text-gray-900"><p class="view-mode">Товар 1</p></td>
                            <td class="px-6 py-4"><p class="view-mode">10 ₽</p></td>
                            <td class="px-6 py-4"><p class="view-mode">10 шт.</p></td>
                            <td class="px-6 py-4"><p class="view-mode">10 шт.</p></td>
                            <td class="px-6 py-4">
                                <button type="button" style="padding: 3px 10px; background-color:#f19e09;" class="edit-btn text-white rounded-lg transition-all" title="Изменить">
                                    Изменить
                                </button>
                                <span>/</span>
                                <button type="button" style="padding: 3px 10px; background-color:#d20f0f;" class="edit-btn text-white rounded-lg transition-all" title="Изменить">
                                    Удалить
                                </button>
                                <button type="button" style="padding: 3px 10px; background-color:#02ad02; display: none;" class="save-btn text-white rounded-lg transition-all" title="Сохранить">
                                    Сохранить
                                </button>
                            </td>
                            <td style="display: flex; justify-content: center;">
                                <div class="text-left" style="padding: 1rem; width: 10rem;">
                                    <h2 class="font-bold text-gray-950" style="background-color:rgb(2, 173, 2); padding: 5px 10px; border-radius: 0.5rem; text-align: center; color:aliceblue; font-weight: 500; font-size: 16px;">В наличии</h2>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors group text-center" style="font-size:medium">
                            
                            <td class="px-6 py-4 text-gray-900"><p class="view-mode">Товар 1</p></td>
                            <td class="px-6 py-4"><p class="view-mode">10 ₽</p></td>
                            <td class="px-6 py-4"><p class="view-mode">10 шт.</p></td>
                            <td class="px-6 py-4"><p class="view-mode">10 шт.</p></td>
                            <td class="px-6 py-4">
                                <button type="button" style="padding: 3px 10px; background-color:#f19e09;" class="edit-btn text-white rounded-lg transition-all" title="Изменить">
                                    Изменить
                                </button>
                                <span>/</span>
                                <button type="button" style="padding: 3px 10px; background-color:#d20f0f;" class="edit-btn text-white rounded-lg transition-all" title="Изменить">
                                    Удалить
                                </button>
                                <button type="button" style="padding: 3px 10px; background-color:#02ad02; display: none;" class="save-btn text-white rounded-lg transition-all" title="Сохранить">
                                    Сохранить
                                </button>
                            </td>
                            
                            <td style="display: flex; justify-content: center;">
                                 <div class="text-left" style="padding: 1rem; width: 10rem;">
                                    <h2 class="font-bold text-gray-950" style="background-color:rgb(124, 124, 124); padding: 5px 12px; border-radius: 0.5rem; text-align: center; color:aliceblue; font-weight: 500; font-size: 16px;">Не в наличии</h2>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors group text-center" style="font-size:medium">
                            
                            <td class="px-6 py-4 text-gray-900"><p class="view-mode">Товар 1</p></td>
                            <td class="px-6 py-4"><p class="view-mode">10 ₽</p></td>
                            <td class="px-6 py-4"><p class="view-mode">10 шт.</p></td>
                            <td class="px-6 py-4"><p class="view-mode">10 шт.</p></td>
                            <td class="px-6 py-4">
                                <button type="button" style="padding: 3px 10px; background-color:#f19e09;" class="edit-btn text-white rounded-lg transition-all" title="Изменить">
                                    Изменить
                                </button>
                                
                                <button type="button" style="padding: 3px 10px; background-color:#02ad02; display: none;" class="save-btn text-white rounded-lg transition-all" title="Сохранить">
                                    Сохранить
                                </button>
                            </td>
                         
                            <td style="display: flex; justify-content: center;">
                                <div class="text-left" style="padding: 1rem; width: 10rem;">
                                    <h2 class="font-bold text-gray-950" style="background-color: #d20f0f; padding: 5px 12px; border-radius: 0.5rem; text-align: center; color:aliceblue; font-weight: 500;">Удаленные</h2>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Находим все таблицы, которые можно редактировать
        document.querySelectorAll('.product-table').forEach(table => {
            
            table.addEventListener('click', (e) => {
                // Проверяем, кликнули ли мы по кнопке "Изменить"
                if (e.target.classList.contains('edit-btn')) {
                    const row = e.target.closest('tr');
                    const editBtn = e.target;
                    const saveBtn = row.querySelector('.save-btn');
                    
                    // Перебираем первые 4 ячейки с данными (Название, Стоимость, Количество, Остаток)
                    const cells = row.querySelectorAll('td');
                    for (let i = 0; i < 4; i++) {
                        const cell = cells[i];
                        const paragraph = cell.querySelector('.view-mode');
                        if (!paragraph) continue;
                        
                        // Получаем чистый текст без " ₽" и " шт." для удобного редактирования
                        let currentText = paragraph.textContent.trim();
                        
                        // Создаем инпут
                        const input = document.createElement('input');
                        input.type = i === 0 ? 'text' : 'text'; // можно поменять на number для индексов 1,2,3
                        input.value = currentText;
                        input.className = 'w-full px-2 py-1 border rounded text-center text-gray-900 focus:outline-none focus:border-blue-500';
                        
                        // Сохраняем исходные суффиксы, чтобы вернуть их при сохранении
                        if (i === 1 && currentText.includes('₽')) input.dataset.suffix = ' ₽';
                        if ((i === 2 || i === 3) && currentText.includes('шт.')) input.dataset.suffix = ' шт.';
                        
                        // Очищаем инпут от суффиксов для редактирования чистого числа
                        if (input.dataset.suffix) {
                            input.value = currentText.replace(input.dataset.suffix, '').trim();
                        }
                        
                        // Скрываем параграф и вставляем инпут
                        paragraph.style.display = 'none';
                        cell.appendChild(input);
                    }
                    
                    // Переключаем видимость кнопок
                    editBtn.style.display = 'none';
                    saveBtn.style.display = 'inline-block';
                }
                
                // Проверяем, кликнули ли мы по кнопке "Сохранить"
                if (e.target.classList.contains('save-btn')) {
                    const row = e.target.closest('tr');
                    const saveBtn = e.target;
                    const editBtn = row.querySelector('.edit-btn');
                    
                    const cells = row.querySelectorAll('td');
                    for (let i = 0; i < 4; i++) {
                        const cell = cells[i];
                        const paragraph = cell.querySelector('.view-mode');
                        const input = cell.querySelector('input');
                        
                        if (input && paragraph) {
                            let newValue = input.value.trim();
                            const suffix = input.dataset.suffix || '';
                            
                            // Возвращаем текст в параграф с суффиксом (если он был)
                            paragraph.textContent = newValue + suffix;
                            
                            // Удаляем инпут и показываем параграф обратно
                            input.remove();
                            paragraph.style.display = 'block';
                        }
                    }
                    
                    // Переключаем кнопки обратно
                    saveBtn.style.display = 'none';
                    editBtn.style.display = 'inline-block';
                    
                    // Здесь вы можете вызвать функцию отправки данных на сервер/бэкенд
                    console.log('Данные строки успешно сохранены локально!');
                }
            });
        });
    });

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


    document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('add-product-modal');
    const openBtn = document.getElementById('open-modal-btn');
    const closeBtn = document.getElementById('close-modal-btn');
    const cancelBtn = document.getElementById('cancel-modal-btn');
    const form = document.getElementById('add-product-form');

    // Функция открытия модального окна
    const openModal = () => {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Отключаем прокрутку страницы под модальным окном
    };

    // Функция закрытия модального окна
    const closeModal = () => {
        modal.classList.add('hidden');
        document.body.style.overflow = ''; // Возвращаем прокрутку страницы
        form.reset(); // Сбрасываем введенные поля
    };

    // Слушатели событий для открытия/закрытия
    openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    // Закрытие при клике на темную область вокруг формы
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Обработка отправки формы
    form.addEventListener('submit', (e) => {
        e.preventDefault(); // Предотвращаем перезагрузку страницы

        // Собираем данные из инпутов
        const formData = new FormData(form);
        const newProduct = {
            name: formData.get('name'),
            price: formData.get('price'),
            quantity: formData.get('quantity'),
            stock: formData.get('stock'),
            status: formData.get('status') // 'available' или 'unavailable'
        };

        // ТУТ ВАША ЛОГИКА ДОБАВЛЕНИЯ:
        // Сейчас просто выведем объект в консоль
        console.log('Новый продукт готов к добавлению:', newProduct);

        /* Здесь вы можете вызвать функцию добавления строки в таблицу на лету, 
           либо сделать fetch-запрос на ваш бэкенд (сервер)
        */

        // Закрываем окно после успешной отправки
        closeModal();
    });
});
</script>
    </body>
</html>
