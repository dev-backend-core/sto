<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function stuff(){
        return view('admin.stuff.index');
    }

    public function stuffProfile(){
        return view('admin.stuff.profile');
    }

    public function services(){
        $services = Service::all(); 
        return view('admin.services.index', compact('services'));
    }

    public function servicesDetails(){
        $pageDetails = [
            "button" => '● Активная/Неактивная услуга ',
            "h1" => 'Редактирование технологической карты',
            "p" => 'Измените параметры услуги и связанные расходные материалы в одном месте.',
        ];
       
        return view('admin.services.show');
    }

    public function store(){
        return view('admin.services.create');
    }

    public function products() {
        return view('admin.products.index');
    }

    public function clients(){
        return view('admin.clients.index');
    }

    public function statistic(){
        return view('admin.statistic.index');
    }
}
