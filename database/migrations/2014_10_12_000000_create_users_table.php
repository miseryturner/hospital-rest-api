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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('patronymic');
            $table->string('mobile');
            $table->string('password');
            $table->string('policy');
            $table->date('birthday');
            $table->string('gender', 1);
            $table->string('address');
            $table->timestamps();
        });
//        ● last_name – фамилия (строка)
//        ● patronymic – отчество (строка)
//        ● mobile – телефон (строка, минимум 12 цифр)
//        ● password – пароль (строка, минимум 6 символов)
//        ● policy – номер полиса (строка, минимум 16 цифр)
//        ● birthday – дата рождения (дата, формат гггг-мм-дд)
//        ● gender – пол («М» или «Ж»)
//        ● address – адрес (строка)
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
