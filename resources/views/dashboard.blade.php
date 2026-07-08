<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        
    </x-slot>

    

   @if(auth()->user()->isOwner())
        <div class="p-6 bg-green-100 text-green-800 rounded-lg">
            <h3>Панель Владельца СТО</h3>
            <p>Здесь будут графики чистой прибыли, отчеты по деньгам и управление всеми сотрудниками.</p>
        </div>
    @endif

    @if(auth()->user()->isAdmin())
        <div class="p-6 bg-blue-100 text-blue-800 rounded-lg">
            <h3>Панель Администратора</h3>
            <p>Здесь будет расписание боксов, запись клиентов и управление складом запчастей.</p>
        </div>
    @endif

    @if(auth()->user()->isMechanic())
        <div class="p-6 bg-yellow-100 text-yellow-800 rounded-lg">
            <h3>Экран Механика</h3>
            <p>Привет, {{ auth()->user()->name }}! Вот твои задачи и машины на сегодня.</p>
        </div>
    @endif
</x-app-layout>
