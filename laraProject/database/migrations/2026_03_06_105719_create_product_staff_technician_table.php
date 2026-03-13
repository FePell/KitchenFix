<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Run the migrations
    //Prodotti x Staff -------------------------------------------------------------
    public function up(): void
    {
        Schema::create('product_staff_technician', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('staff_technician_id')->constrained('staff_technicians')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'staff_technician_id']);
        });
    }

    //Reverse the migrations
    public function down(): void
    {
        Schema::dropIfExists('product_staff_technician');
    }
};
