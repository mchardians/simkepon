<?php

use App\Models\Pemasukan;
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
        Schema::create('detail_pemasukan', function (Blueprint $table) {
            $table->id();
            $table->string('month', 9)->nullable(false);
            $table->char('year', 4)->nullable(false);
            $table->integer('amount')->nullable(false)->default(0);
            $table->enum('iuran', ['masak', 'gas_minyak', 'kas', 'tabungan', 'bisaroh', 'transport', 'darurat'])->nullable(false);
            $table->foreignIdFor(Pemasukan::class);
            $table->timestamps();

            $table->foreign('pemasukan_id')->references('id')->on('pemasukan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pemasukan');
    }
};
