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
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('preferred_contact_method');
            $table->foreignId('contact_method_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('preferred_contact_method')->nullable();
            $table->dropForeign(['preferred_contact_method_id']);
            $table->dropColumn('preferred_contact_method_id');
        });
    }
};
