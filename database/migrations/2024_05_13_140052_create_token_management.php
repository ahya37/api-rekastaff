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
        Schema::create('token_management', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id'); //related to table users
            $table->string('access_token');
            $table->datetime('expired_at');
            $table->tinyinteger('is_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_management');
    }
};
