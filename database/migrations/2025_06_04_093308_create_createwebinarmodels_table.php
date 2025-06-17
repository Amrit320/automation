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
        Schema::create('createwebinarmodels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('topic');
            $table->date('date');
            $table->time('time');
            $table->enum('status', ['active', 'inactive'])->default('inactive'); // Enum status
            $table->string('speakers');
            $table->string('speakers_designation');
            $table->string('zoom_meeting_id')->nullable();
            $table->string('zoom_meeting_url')->nullable();
            $table->string('banner')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('createwebinarmodels');
    }
};
