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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->string('customer_name');

            $table->string('customer_phone');

            $table->foreignId('service_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('barber_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('schedule_id')
                ->constrained()
                ->onDelete('cascade');

            $table->date('booking_date');

            $table->time('booking_time');

            $table->enum('status', [
                'need_payment',
                'paid',
                'completed',
                'cancelled'
            ])->default('need_payment');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
