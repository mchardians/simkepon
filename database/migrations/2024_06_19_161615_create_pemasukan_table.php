<?php

use App\Models\Santri;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemasukan', function (Blueprint $table) {
            $table->id();
            $table->char('payment_code', 14)->nullable(false)->unique();
            $table->integer('total_payment')->nullable(false)->default(0);
            $table->dateTime('payment_date')->nullable(false)->useCurrent();
            $table->enum('status', ['lunas', 'belum_lunas'])->nullable(false)->default('belum_lunas');
            $table->foreignIdFor(Santri::class);
            $table->timestamps();

            $table->foreign('santri_id')->references('id')->on('santri');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukan');
    }
};
