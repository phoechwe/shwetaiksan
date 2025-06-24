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
        Schema::create('threed_ledger_numbers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('threed_ledger_id');
            $table->unsignedBigInteger('threed_number_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('amount')->nullable();
            $table->date('date')->nullable();
            $table->char('isPaid', 1)->default(1);

            $table->foreign('threed_ledger_id')->references('id')->on('threed_ledgers')->onDelete('cascade');
            $table->foreign('threed_number_id', 3)->references('id')->on('threed_numbers')->onDelete('cascade');
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
        Schema::dropIfExists('threed_ledger_numbers');
    }
};
