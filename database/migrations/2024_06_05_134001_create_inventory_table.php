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
            $table->id('idgudang');
            $table->string('lokasigudang');
            $table->date('tanggal');
            $table->unsignedBigInteger('idbarang');
            $table->float('qtty');
            $table->foreign('idbarang')->references('idbarang')->on('produk')->onDelete('cascade');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
