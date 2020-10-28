<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfitToPesananDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesanan_details', function (Blueprint $table) {
            $table->string('kas')->nullable()->after('banyak');
            $table->string('pro')->nullable()->after('jumlah_harga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pesanan_details', function (Blueprint $table) {
            //
        });
    }
}
