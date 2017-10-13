<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add59df1bd1d3b57RelationshipsToProductOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_orders', function(Blueprint $table) {
            if (!Schema::hasColumn('product_orders', 'product_id')) {
                $table->integer('product_id')->unsigned()->nullable();
                $table->foreign('product_id', '81092_59df1bd0f19a7')->references('id')->on('products')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_orders', function(Blueprint $table) {
            
        });
    }
}
