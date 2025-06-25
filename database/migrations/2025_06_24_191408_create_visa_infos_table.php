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
        Schema::create('visa_infos', function (Blueprint $table) {
            $table->id();
             $table->string('passport_from');
            $table->string('passport_to_id'); // could reference countries table
            $table->string('full_name');
            $table->string('dob');
            $table->string('nationality');
            $table->string('pass_port_number')->unique();
            $table->string('email_address');
            $table->string('phone_number');

            $table->unsignedBigInteger('package_id');
            $table->string('nid_front_end')->nullable(); // NID front image path
            $table->string('nid_back_end')->nullable();  // NID back image path

            $table->enum('face_verified_at', ['yes', 'no'])->default('no');

            $table->unsignedBigInteger('created_by'); // references users.id



            // Foreign Keys
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_infos');
    }
};
