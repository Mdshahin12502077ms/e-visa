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
        Schema::create('Smtps', function (Blueprint $table) {
            $table->id();
            $table->string('app_name');
            $table->string('mail_mailer')->default('smtp');
            $table->string('mail_host');
            $table->integer('mail_port');
            $table->string('mail_username');
            $table->text('mail_password');
            $table->string('mail_encryption')->nullable();
            $table->string('mail_from_address');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Smtps');
    }
};
