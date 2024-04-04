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
        Schema::create('errors_in_websites', function (Blueprint $table) {
            $table->id();
            $table->longText('error');
            $table->string('controller_name');
            $table->string('method');
            $table->integer('line_number');
            $table->integer('count_error');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('errors_in_websites');
    }
};
