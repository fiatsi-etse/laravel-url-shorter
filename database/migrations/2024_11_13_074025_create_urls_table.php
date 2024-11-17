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
        Schema::create('urls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('original_url');
            $table->string('generated_url')->unique();
            $table->boolean('active')->default(true);
            $table->date('expiry_at')->nullable()->default(null);
            $table->integer('user_id');


            $table->foreign('user_id')->references('id')->on('users');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urls');
    }
};
