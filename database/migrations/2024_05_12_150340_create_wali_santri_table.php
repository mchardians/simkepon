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
            $table->string('nik', 16)->nullable(false)->unique();
            $table->string('name', 255)->nullable(false);
            $table->string('email')->nullable(false)->unique();
            $table->enum('education', [
                'belum sekolah', 'sd', 'smp', 'sma',
                'diploma', 'sarjana', 'magister', 'doktor'
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
