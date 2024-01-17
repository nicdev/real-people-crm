<?php

use App\Models\Contact;
use App\Models\ContactMethod;
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
            $default = ContactMethod::whereName('Email')->first()->id;
            $table->foreignId('preferred_contact_method_id')->default($default)->change();
            Contact::whereNull('preferred_contact_method_id')->update(['preferred_contact_method_id' => $default]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->foreignId('preferred_contact_method_id')->nullable()->change();
        });
    }
};
