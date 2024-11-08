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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->integer('parent_id')->default(0); // Có thể cần một giá trị mặc định
            $table->text('description')->nullable(); // Có thể để null nếu không bắt buộc
            $table->longText('content')->nullable(); // Có thể để null nếu không bắt buộc
            $table->string('slug')->nullable(); // Không có giá trị mặc định
            $table->integer('active')->default(1); // Mặc định là active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
