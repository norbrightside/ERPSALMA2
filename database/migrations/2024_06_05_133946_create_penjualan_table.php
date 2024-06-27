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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('nofak')->primary();
            $table->date('tanggalpenjualan');
            $table->unsignedBigInteger('idpelanggan');
            $table->unsignedBigInteger('idbarang');
            $table->float('nilaitransaksi');
            $table->float('qttypenjualan');
            $table->enum('status', ['Order Baru', 'Lunas','Pengiriman', 'Selesai'])->default('Order Baru');
            $table->foreign('idpelanggan')->references('idpelanggan')->on('pelanggan')->onDelete('cascade');
            $table->foreign('idbarang')->references('idbarang')->on('produk')->onDelete('cascade');
            $table->timestamp('updated_at')->nullable();;
            $table->timestamp('created_at')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
