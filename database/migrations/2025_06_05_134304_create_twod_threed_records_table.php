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
        Schema::create('twod_threed_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('number',20)->nullable();
            $table->string('type')->nullable(); // '2D' or '3D'
            $table->integer('amount')->nullable();
            $table->char('status', length: 1)->nullable(); // 'pending', 'completed', 'failed'

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('twod_threed_records');
    }
};
