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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile')->unique();
            $table->string('email')->unique(); // Unique prevents duplicate accounts
            $table->string('password');
            $table->string('category');

            // Address Fields
            $table->string('pincode');
            $table->string('district');
            $table->string('city');
            $table->string('state');

            // --- STUDENT FIELDS ---
            $table->string('college_name')->nullable();
            $table->string('standard_year')->nullable();
            $table->string('stream')->nullable();
            $table->string('roll_number')->nullable();
            $table->string('gpa')->nullable();
            $table->string('graduation_year')->nullable();
            $table->text('skills')->nullable();

            // --- BUSINESS FIELDS ---
            $table->string('company_name')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('turnover')->nullable();
            $table->string('employee_count')->nullable();
            $table->string('business_website')->nullable();
            $table->string('establishment_year')->nullable();

            // --- BANK FIELDS ---
            $table->string('bank_name')->nullable();
            $table->string('interest_rate')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('ifsc_code')->nullable();

            // --- FARMER FIELDS ---
            $table->string('crop_name')->nullable();
            $table->string('crop_price')->nullable();
            $table->string('land_size')->nullable();

            // System Fields
            $table->string('custom_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};