<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('farmer_loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to registrations
            $table->string('land_size');
            $table->string('khasra_number');
            $table->decimal('amount', 15, 2);
            $table->string('status')->default('pending');
            $table->timestamps();

            // Establish the relationship with the registrations table
            $table->foreign('user_id')->references('id')->on('registrations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmer_loans');
    }
};
