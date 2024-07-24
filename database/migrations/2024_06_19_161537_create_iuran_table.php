<?php

use App\Models\Santri;
use Illuminate\Support\Facades\DB;
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
        Schema::create('iuran', function (Blueprint $table) {
            $table->id();
            $table->integer('masak')->nullable(false)->default(0);
            $table->integer('gas_minyak')->nullable(false)->default(0);
            $table->integer('kas')->nullable(false)->default(0);
            $table->integer('tabungan')->nullable(false)->default(0);
            $table->integer('bisaroh')->nullable(false)->default(0);
            $table->integer('transport')->nullable(false)->default(0);
            $table->integer('darurat')->nullable(false)->default(0);
            $table->date('date')->nullable(false)->useCurrent();
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
        Schema::dropIfExists('iuran');
    }
};
