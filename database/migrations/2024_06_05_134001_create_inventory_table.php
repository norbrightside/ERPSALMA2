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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id()->primary();
            $table->unsignedBigInteger('idgudang');
            $table->date('tanggal');
            $table->unsignedBigInteger('idbarang');
            $table->enum('status', ['Antrian Masuk', 'Diterima', 'Antrian Keluar', 'Dikirim'])->default('Antrian Masuk');
            $table->float('qtty');
            $table->timestamps(); // Ini akan membuat created_at dan updated_at sebagai timestamp

            // Definisi foreign key constraints
            $table->foreign('idgudang')->references('idgudang')->on('gudang')->onDelete('cascade');
            $table->foreign('idbarang')->references('idbarang')->on('produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
}
;