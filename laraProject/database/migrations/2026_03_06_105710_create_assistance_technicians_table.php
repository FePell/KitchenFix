<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Run the migrations
    //Tecnico Centro Assistenza ----------------------------------------------------
    public function up(): void
    {
        Schema::create('assistance_technicians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('specialization');
            $table->foreignId('assistance_center_id')->constrained('assistance_centers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    //Reverse the migrations
    public function down(): void
    {
        Schema::dropIfExists('assistance_technicians');
    }
};
