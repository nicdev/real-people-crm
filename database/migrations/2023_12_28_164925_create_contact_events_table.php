<?php

use App\Models\Contact;
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
        Schema::create('contact_events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Contact::class);
            $table->string('name');
            $table->string('description')->nullable();
            $table->date('date');
            $table->time('time')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('contact_method_id')->constrained()->nullable();
            $table->text('recap')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_events');
    }
};
