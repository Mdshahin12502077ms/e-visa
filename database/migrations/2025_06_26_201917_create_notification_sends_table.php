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
        Schema::create('notification_sends', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longtext('comment');
            $table->unsignedBigInteger('notified_to')->unsigned();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->boolean('is_read')->default(0);
            $table->foreign('notified_to')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_sends');
    }
};
