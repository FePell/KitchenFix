<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Run the migrations
    //Staff Aziendale --------------------------------------------------------------
    public function up(): void
    {
        Schema::create('staff_technicians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamps();
        });
    }

    //Reverse the migrations
    public function down(): void
    {
        Schema::dropIfExists('staff_technicians');
    }
};
