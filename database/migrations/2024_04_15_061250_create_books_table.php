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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->integer('id_category')->comment('1: Tiểu thuyết, 2: Truyện ngắn, 3: Huyền bí, 4: Kinh điển, 5: Kiếm hiệp, 6: Lịch sử, 7: Thơ, 8: Phiêu lưu, 9: Khoa học viễn tưởng, 10: Khác');
            $table->string('TenSach');
            $table->string('TacGia');
            $table->text('MoTa')->nullable();
            $table->decimal('Gia', 10, 2);
            $table->integer('SoLuongTrongKho');
            $table->longText('URL')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
