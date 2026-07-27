<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index(){
        $services = Service::all();
        return view('home', [
            'services' => $services
        ]);
    }

    public function form(Request $request){
        $validator = Validator::make($request->all(), [
        'name'       => 'required|string|max:70',
        'email'      => 'required|email',
        'phone'      => 'required|string|max:20',
        'car_brand'  => 'required|string',
        'service_id' => 'required|integer|exists:services,id',
        'date'       => 'required|date',
        'time'       => 'required|date_format:H:i',
        ]);

        // Если валидация провалилась:
        if ($validator->fails()) {
            return redirect()->to(url()->previous() . '#contact') // Имя нужного роута (или redirect('/url'))
            ->withErrors($validator)                // Пробрасываем ошибки
            ->withInput();                         // Сохраняем введенные данные в форме
        }

        
        try{
            DB::transaction(function () use ($request) {
            
                // ВНИМАНИЕ: у firstOrCreate второй аргумент — это массив с остальными полями!
                $client = Client::firstOrCreate(
                    ['phone' => $request->phone],
                    [
                        'name'  => $request->name,
                        'email' => $request->email,
                    ]
                );

                // 2. Марка и модель
                if (preg_match('/^(.*?)\s*\((.*?)\)$/', $request->car_brand, $matches)) {
                    $brand = trim($matches[1]); 
                    $model = trim($matches[2]); 
                } else {
                    $brand = $request->car_brand;
                    $model = 'не указана';
                }
            

                // 3. Машина
                $car = $client->cars()->create([
                    'brand' => $brand,
                    'model' => $model,
                ]);

                // 4. Запись на сервис
                // дата и время склеиваются в одну строку 'YYYY-MM-DD HH:MM:SS'
                $client->appointments()->create([
                    'car_id'           => $car->id,
                    'service_id'       => $request->service_id,
                    'appointment_date' => $request->date . ' ' . $request->time,
                ]);

                return redirect('/#contact')->with('success', 'Ваша заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.');

            });  

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Произошла ошибка при сохранении заявки: ' . $e->getMessage()]);
        }
    }
}
