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
        Schema::create('carnet_adresses', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('person_name')->nullable();
            $table->string('address_label')->nullable();
            $table->string('apartment_suite_note')->nullable();
            $table->boolean('has_google_address')->default(false);
            $table->text('google_address')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carnet_adresses');
    }
};
