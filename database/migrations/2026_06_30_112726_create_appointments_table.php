<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained(); 
            $table->foreignId('car_id')->constrained();

            $table->foreignId('service_id')->constrained();
            $table->foreignId('box_id')->constrained();
            
            // Механик уволился? Поле станет NULL, но вся история ремонта и деньги сохранятся!
            $table->foreignId('mechanic_id')
                ->nullable() // Обязательно делаем поле nullable, чтобы туда мог записаться NULL
                ->constrained('users')
                ->onDelete('set null'); // Меняем cascade на set null
                
            $table->dateTime('appointment_date')->index();
            $table->string('status')->default('new')->index(); // enum лучше заменить на string для гибкости
            $table->string('payment_status')->default('unpaid')->index();

            $table->softDeletes();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
