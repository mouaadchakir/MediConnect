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
        Schema::create('data_users', function (Blueprint $table) {
            $table->id(); // العمود الأساسي
            $table->foreignId('user_id'); // معرف المستخدم
            $table->string('name')->nullable(); // الاسم
            $table->string('image')->nullable(); // الصورة
            $table->string('email')->nullable(); // البريد الإلكتروني
            $table->string('phone_number')->nullable(); // رقم الهاتف
            $table->string('address')->nullable(); // العنوان
            $table->string('sex')->nullable(); // الجنس
            $table->timestamps();
            // full name, image, email, phone number, address, sex
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_users');
    }
};
