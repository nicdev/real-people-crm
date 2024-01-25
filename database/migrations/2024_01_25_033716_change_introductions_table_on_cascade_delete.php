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
        Schema::table('introductions', function (Blueprint $table) {
            $table->dropForeign(['first_contact_id']);
            $table->dropForeign(['second_contact_id']);
            $table->dropForeign(['user_id']);
            $table->foreign('first_contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreign('second_contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
