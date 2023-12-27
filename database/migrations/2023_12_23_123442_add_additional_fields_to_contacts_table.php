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
            $table->string('middle_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('threads')->nullable();
            $table->string('youtube')->nullable();
            $table->string('website')->nullable();
            $table->string('preferred_contact_method')->nullable();
            $table->string('general_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('middle_name');
            $table->dropColumn('phone');
            $table->dropColumn('linkedin');
            $table->dropColumn('twitter');
            $table->dropColumn('threads');
            $table->dropColumn('youtube');
            $table->dropColumn('website');
            $table->dropColumn('preferred_contact_method');
            $table->dropColumn('general_notes');
        });
    }
};
