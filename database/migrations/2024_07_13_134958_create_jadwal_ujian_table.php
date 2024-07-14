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
        Schema::create('jadwal_ujian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            $table->string('judul');
            $table->enum('kategori', ['Proposal', 'Pendadaran']);
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('ruangan')->nullable();
            $table->unsignedBigInteger('penguji1_id');
            $table->unsignedBigInteger('penguji2_id');
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();

            $table->foreign('penguji1_id')->references('id')->on('pembimbing')->onDelete('restrict');
            $table->foreign('penguji2_id')->references('id')->on('pembimbing')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_ujian');
    }
};
