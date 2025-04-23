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
    Schema::create('doctors', function (Blueprint $table) {
      $table->id(); // العمود الأساسي
      $table->foreignId('user_id'); // معرف المستخدم
      $table->string('name')->nullable(); // اسم الطبيب
      $table->string('image')->nullable(); // الصورة
      $table->string('specialization')->nullable(); // التخصص
      $table->string('sex')->nullable(); // الجنس
      $table->string('license_number')->nullable(); // رقم الترخيص
      $table->string('email')->nullable(); // البريد الإلكتروني
      $table->string('phone_number')->nullable(); // رقم الهاتف
      $table->string('address')->nullable(); // العنوان
      $table->string('working_hours')->nullable(); // أوقات العمل
      $table->string('status')->nullable(); // الحالة
      $table->integer('number_of_patients')->nullable(); // عدد المرضى
      $table->float('rating')->nullable(); // التقييم
      $table->integer('experience')->nullable(); // سنوات الخبرة
      $table->text('certifications')->nullable(); // الشهادات
      $table->timestamps(); // تاريخ الإنشاء والتحديث
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('doctors');
  }
};
