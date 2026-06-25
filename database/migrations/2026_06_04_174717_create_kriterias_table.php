<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('kriterias', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria', 100);
            $table->decimal('bobot', 5, 2);
            $table->enum('jenis', ['benefit', 'cost'])->default('benefit');
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('kriterias'); }
};