<tr class="hover:bg-gray-50 transition-colors group cursor-pointer" style="font-size:medium">
    <td class="px-6 py-4 text-gray-900" >
        <a href="#" class="block group-hover:text-indigo-600 transition-colors">
            {{ $service->name }}
        </a>
    </td>
    <td class="px-6 py-4">{{ number_format($service->price, 0, '.', ' ') }} ₽</td>
    <td class="px-6 py-4 text-gray-500">{{ $service->duration_minutes }} мин.</td>
    <td class="px-6 py-4">
        <a href="{{ route('services.details') }}" class="text-indigo-600 hover:text-indigo-900 hover:underline">Детали и расходники →</a>
    </td>
    <td class="px-6 py-4">
        <button type="button" 
        style="padding: 3px 10px;
        background-color: #d00000bd;" class="text-white rounded-lg transition-all" title="Убрать из услуги">
            -
        </button>
    </td>
    <td style="display: flex; justify-content: center;">
        <div class="text-left" style="padding: 1rem; width: 10rem;">
            <h2 class="font-bold text-gray-950" style="background-color:rgb(2, 173, 2); padding: 5px 10px; border-radius: 0.5rem; text-align: center; color:aliceblue; font-weight: 500; font-size: 16px;">Активный/Неактивный</h2>
        </div>
    </td>
</tr>