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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nim')->unique();
            $table->string('nama');
            $table->year('angkatan');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('email')->unique();
            $table->string('telp');
            $table->text('alamat');
            $table->unsignedBigInteger('pembimbing_id')->nullable();
            $table->foreign('pembimbing_id')->references('id')->on('pembimbing')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
