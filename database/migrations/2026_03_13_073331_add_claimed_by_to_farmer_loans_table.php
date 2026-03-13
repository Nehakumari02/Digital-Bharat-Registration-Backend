<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('farmer_loans', function (Blueprint $blueprint) {
            // This stores the ID of the bank user who claimed the lead
            // unsignedBigInteger ensures it matches the 'id' type of the users table
            $blueprint->unsignedBigInteger('claimed_by')->nullable()->after('status');

            // Optional: Add a foreign key to ensure data integrity
            $blueprint->foreign('claimed_by')->references('id')->on('registrations')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('farmer_loans', function (Blueprint $blueprint) {
            $blueprint->dropForeign(['claimed_by']);
            $blueprint->dropColumn('claimed_by');
        });
    }
};