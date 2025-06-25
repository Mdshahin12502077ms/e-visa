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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('traveller');
            $table->string('processing_time')->nullable();

            $table->decimal('gob_taxes', 10, 2)->default(0);
            $table->decimal('sub_total', 10, 2);
            $table->decimal('total', 10, 2);

            $table->enum('payment_status', ['paid', 'due'])->default('due');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('visa_infos_id');
            $table->unsignedBigInteger('package_id');

            $table->enum('status', [
                'pending',
                'under_review',
                'documents_required',
                'accepted',
                'rejected',
                'processing',
                'completed',
                'cancelled'
            ])->default('pending');
            // Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('visa_infos_id')->references('id')->on('visa_infos')->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
