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
        Schema::create('produksi', function (Blueprint $table) {
            $table->id('idproduksi')->primary();
            $table->date('tanggalproduksi');
            $table->float('biayaproduksi');
            $table->unsignedBigInteger('idbarang');
            $table->float('qttyproduksi');
            $table->enum('status', ['Preproduksi', 'Produksi', 'Selesai'])->default('Preproduksi');
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
        Schema::dropIfExists('produksi');
    }
};
