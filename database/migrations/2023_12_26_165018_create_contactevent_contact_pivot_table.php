<?php

use App\Models\Contact;
use App\Models\ContactEvent;
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
        Schema::create('contact_contactevent', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Contact::class);
            $table->foreignIdFor(ContactEvent::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_contactevent');
    }
};
