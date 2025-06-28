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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('validity');
            $table->integer('maximum_stay_per_entry');
            $table->string('entries_type')->default('single');
            $table->integer('travaller')->default(1);
            $table->decimal('service_fee', 10, 2);
            $table->decimal('goverment_fee', 10, 2);
            $table->string('processing_time')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
