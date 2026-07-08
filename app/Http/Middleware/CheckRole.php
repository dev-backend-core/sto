<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Если пользователь вообще не вошел — выкидываем
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Сначала войдите в систему.');
        }

        // 2. Проверяем, есть ли роль текущего юзера в списке разрешенных ролей
        // Функция in_array('admin', ['admin', 'owner']) проверяет совпадение
        if (!in_array(Auth::user()->role, $roles)) {
            
            // Если роли юзера нет в списке — выкидываем на главную
            return redirect('/')->with('error', 'У вас нет доступа к этому разделу.');
        }

        // Если роли совпали — пропускаем запрос дальше
        return $next($request);
    }
}
