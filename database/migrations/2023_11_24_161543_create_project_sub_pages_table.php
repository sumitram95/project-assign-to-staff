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
        Schema::create('project_sub_pages', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('project_page_id');
            $table->unsignedBigInteger('project_page_id');
            $table->longText('project_sub_page_name');
            $table->timestamps();

            $table->foreign('project_page_id')->references('id')->on('project_pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_sub_pages');
    }
};
