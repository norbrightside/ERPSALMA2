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
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id('idorder')->primary();
            $table->date('tanggalorder');
            $table->unsignedBigInteger('idsupplier');
            $table->unsignedBigInteger('idbarang');
            $table->unsignedBigInteger('idgudang');
            $table->float('qttyorder');
            $table->float('hargapembelian');
            $table->enum('status',['Pemesanan Baru','Dibayar', 'Diterima'])->default('Pemesanan Baru');
            $table->foreign('idgudang')->references('idgudang')->on('gudang')->onDelete('cascade');
            $table->foreign('idsupplier')->references('idsupplier')->on('supplier')->onDelete('cascade');
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
        Schema::dropIfExists('pembelian');
    }
};
