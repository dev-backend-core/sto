<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="bg-gray-100 min-h-screen p-4 md:p-6">
    <div class="max-w-5xl mx-auto space-y-6">
        
        <div class="flex items-center justify-between">
            <a href="#" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white rounded-xl shadow-sm transition-all border border-gray-300 hover:bg-gray-50">
                ← Назад к списку услуг
            </a>
            
            <div class="px-4 py-2 bg-emerald-100 border border-emerald-300 rounded-xl shadow-sm" style="background-color:#5beb5bbf;">
                <span class="text-sm font-bold text-emerald-800 flex items-center gap-1.5" style="color:green;">
                    ● Активная услуга
                </span>
            </div>
        </div>

        <form action="#" method="POST" class="bg-white rounded-xl shadow-md border border-gray-200/80 overflow-hidden">
            @csrf
            
            <div 
            style="display: flex;
                justify-content: space-between;
                padding: 1.5rem;
                font-size: large;">
                <div>
                    <h1 
                    style="font-weight: 600;font-size: larger;">Редактирование технологической карты</h1>
                    <p style="font-weight: 200;font-size: medium;">Измените параметры услуги и связанные расходные материалы в одном месте.</p>
                </div>
                
                <button type="submit" class=" px-3 border border-emerald-300 rounded-xl font-bold flex items-center" style="background-color:#4f46e5b0; color:aliceblue; font-size: 16px;">
                    💾 Сохранить
                </button>
            </div>

            <div class="p-6 border-b border-gray-100 bg-white">
                <h3 class="text-sm font-bold text-indigo-600 uppercase tracking-wider mb-4">Основные настройки услуги</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1.5">Название услуги</label>
                        <input type="text" name="service_name" value="Замена моторного масла" class="w-full px-3 py-2 text-sm text-gray-900 bg-white rounded-xl border border-gray-300 focus:ring-1 focus:ring-indigo-500 transition-all font-semibold">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1.5">Стоимость (₽)</label>
                        <div class="relative">
                            <input type="number" name="price" value="1500" class="w-full pl-3 pr-8 py-2 text-sm text-gray-900 bg-white rounded-xl border border-gray-300 focus:ring-1 focus:ring-indigo-500 transition-all font-bold">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1.5">Длительность (мин.)</label>
                        <div class="relative">
                            <input type="number" name="duration" value="30" class="w-full pl-3 pr-12 py-2 text-sm text-gray-900 bg-white rounded-xl border border-gray-300 focus:ring-1 focus:ring-indigo-500 transition-all font-bold">
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white">
                <h3 class="text-sm font-bold text-indigo-600 uppercase tracking-wider mb-3">Необходимые запчасти и расходники</h3>
                <p class="text-xs text-gray-500 mb-4">Отметьте галочками используемые товары и укажите их количество на одну услугу.</p>

                <div class="overflow-x-auto border border-gray-400 rounded-xl">
                    <table class="w-full border-collapse text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-xs font-bold uppercase tracking-wider text-gray-600 border-b border-gray-400" style="height: 40px;">
                                <th class="w-16 px-4 py-3 text-center" style="border-right:rgb(195, 198, 202) solid 1px;">Использовать</th>
                                <th class="px-4 py-3 text-left" style="border-right: rgb(195, 198, 202) solid 1px;">Название детали</th>
                                <th class="px-4 py-3 text-center" style="border-right: rgb(195, 198, 202) solid 1px;">Остаток на складе</th>
                                <th class="w-32 px-4 py-3 text-center" style="border-right: rgb(195, 198, 202) solid 1px;">Кол-во на услугу</th>
                                <th class="w-16 px-4 py-3 text-center">Удалить</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr >
                                <td class="px-4 py-3 text-center">
                                    <input type="checkbox" name="products[]" value="2" checked class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900" style="padding: 0.5rem;">
                                    Фильтр масляный MANN-FILTER
                                </td>
                                <td class="px-4 py-3 text-center text-gray-500" style="padding: 0.5rem;">15 шт.</td>
                                <td class="px-4 py-3" style="padding: 0.5rem;">
                                    <input type="number" name="quantities[2]" value="1" class="w-20 mx-auto block text-center  text-sm rounded-lg border border-gray-300 bg-white focus:ring-1 focus:ring-indigo-500 font-medium">
                                </td>
                                <td class="px-4 py-3 text-center" style="padding: 0.5rem;">
                                    <button type="button" class="text-gray-400 hover:text-red-600 p-1.5 hover:bg-red-50 rounded-lg transition-all" title="Убрать из услуги">
                                        🗑️
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="p-6 bg-gray-50 border-t border-gray-200 space-y-3">
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider" style="margin-bottom: 10px;">Добавить расходник со склада:</label>
                
                <div class="relative w-full max-w-md">
                    <input type="text" 
                           placeholder="Введите название детали для поиска..." 
                           class="w-full pl-4 pr-4 py-2.5 text-sm text-gray-900 bg-white rounded-xl border border-gray-300 focus:ring-1 focus:ring-indigo-500 transition-all shadow-sm"
                    >
                    
                    <div class="z-10 left-0 mt-2 w-full bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden" >
                        
                        <button type="button" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50 flex justify-between items-center transition-colors" style="padding: 0.5rem;">
                            <span class="font-medium">🛢️ Масло Mobil 1 0W-20 (1л)</span>
                            <span class="text-xs bg-gray-100 rounded-md text-gray-500" style="width:3rem;height:1.5rem; padding-top:4px;">12 л.</span>
                        </button>
                        
                        <button type="button" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50 flex justify-between items-center border-t border-gray-100 transition-colors" style="padding: 0.5rem;">
                            <span class="font-medium">🔌 Фильтр масляный Bosch</span>
                            <span class="text-xs bg-gray-100 rounded-md text-gray-500" style="width:3rem;height:1.5rem; padding-top:4px;">8 шт.</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>