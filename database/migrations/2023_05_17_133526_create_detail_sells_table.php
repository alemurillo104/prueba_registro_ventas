<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_sells', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sell')->nullable();
            $table->unsignedBigInteger('id_product')->nullable();
            $table->float('unit_price');
            $table->integer('amount');
            $table->float('subtotal',5,2);
            $table->boolean('state')->default(true);
            $table->timestamps();

            $table->foreign('id_sell')->references('id')
            ->on('sells')->onDelete('cascade');
            
            $table->foreign('id_product')->references('id')
            ->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_sells');
    }
}