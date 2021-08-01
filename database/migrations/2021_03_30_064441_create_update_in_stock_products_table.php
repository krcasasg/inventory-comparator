<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateInStockProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_in_stock_products', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->integer('quantity_on_hand_before')->nullable();
            $table->integer('quantity_on_hand')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('update_in_stock_products');
    }
}
