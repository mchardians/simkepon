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
        Schema::create('cicilan', function (Blueprint $table) {
            $table->id();
            $table->date('cicilan_date')->nullable(false)->useCurrent();
            $table->integer('amount')->nullable(false)->default(0);
            $table->string('month', 9)->nullable(false);
            $table->char('year', 4)->nullable(false);
            $table->enum('iuran', ['masak', 'gas_minyak', 'kas', 'tabungan', 'bisaroh', 'transport', 'darurat'])->nullable(false);
            $table->text('description')->nullable(false);
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
        Schema::dropIfExists('cicilan');
    }
};
