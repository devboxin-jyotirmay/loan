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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->decimal('actual_loan', 10, 2); 
            $table->decimal('interest_rate', 5, 2)->default(8);
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('weekly_emi', 10, 2)->nullable();
            $table->string('term');
            $table->enum('status', ['Pending', 'Approved', 'Paid'])->default('Pending');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
