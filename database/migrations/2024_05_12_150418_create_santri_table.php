<?php

use App\Models\WaliSantri;
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
        Schema::create('santri', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 18)->nullable(false)->unique();
            $table->string('name', 255)->nullable(false);
            $table->enum('gender', ['laki-laki', 'perempuan'])->nullable(false);
            $table->date('birth_day')->nullable(false);
            $table->string('picture', 255)->nullable(true);
            $table->text('address')->nullable(false);
            $table->foreignIdFor(WaliSantri::class);
            $table->timestamps();

            $table->foreign('wali_santri_id')->references('id')->on('wali_santri');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santri');
    }
};
