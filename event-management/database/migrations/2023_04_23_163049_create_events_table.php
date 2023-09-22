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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            // Create one to many relationship so that one user
            // can own many events. Using shortcut method
            // foreignIdFor() creates both the column that holds
            // the relationship and add an foreign key for that
            // column
            $table->foreignIdFor(User::class);
            $table->string('name');
            $table->text('description')->nullable();

            $table->dateTime('start_time');
            $table->dateTime('end_time');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};