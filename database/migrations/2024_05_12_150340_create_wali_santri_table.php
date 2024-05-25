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
        Schema::create('wali_santri', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false);
            $table->string('email')->nullable(false)->unique();
            $table->enum('education', [
                'Belum sekolah', 'SD/Sederajat', 'SMP/Sederajat', 'SMA/Sederajat',
                'Diploma I-III', 'Strata I', 'Strata II', 'Strata III'
            ])->nullable(false);
            $table->string('job', 50)->nullable(false);
            $table->string('phone', 13)->nullable(false)->unique();
            $table->text('address')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wali_santri');
    }
};
