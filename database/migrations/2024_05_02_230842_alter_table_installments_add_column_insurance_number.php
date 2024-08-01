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
        Schema::table('installments', function (Blueprint $table) {
            $table->string('insurance_number', 30)->nullable(); // número do seguro
            $table->decimal('installment_total_value', 12,2)->nullable(); // total da parcela + seguro
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
