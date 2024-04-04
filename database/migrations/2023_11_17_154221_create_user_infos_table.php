<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->foreignId('position_id')->nullable();
            $table->longText('full_name')->nullable();
            $table->longText('mobile_no')->nullable();
            $table->string('address')->nullable();
            $table->longText('skills')->nullable();
            $table->longText('about_me')->nullable();
            $table->string('profile_img')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('admission_date')->nullable();
            $table->string('collage_name')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_infos');
    }
};
