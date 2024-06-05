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
            $table->id('idorder');
            $table->date('tanggalorder');
            $table->unsignedBigInteger('idsupplier');
            $table->unsignedBigInteger('idbarang');
            $table->float('qttyorder');
            $table->float('hargapembelian');
            $table->foreign('idsupplier')->references('idsupplier')->on('supplier')->onDelete('cascade');
            $table->foreign('idbarang')->references('idbarang')->on('produk')->onDelete('cascade');
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