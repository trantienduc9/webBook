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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_Sach');
            $table->unsignedBigInteger('ID_Kh')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('SoLuong');
            $table->decimal('Gia', 10, 2);
            $table->enum('trang_thai', ['hoanthanh', 'danggiao','huydon','khac'])->default('khac');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
