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
        Schema::create('twodledger_numbers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('two_d_ledger_id');
            $table->unsignedBigInteger('two_d_number_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('amount')->nullable();
            $table->date('date')->nullable();
            $table->char('isPaid',1)->default(1);
            
            $table->foreign('two_d_ledger_id')->references('id')->on('two_d_ledgers')->onDelete('cascade');
            $table->foreign('two_d_number_id')->references('id')->on('twodnumbers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('twodledger_numbers');
    }
};
