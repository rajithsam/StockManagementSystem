<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add59df1bf516edbRelationshipsToProductDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_deliveries', function(Blueprint $table) {
            if (!Schema::hasColumn('product_deliveries', 'beleiver_id')) {
                $table->integer('beleiver_id')->unsigned()->nullable();
                $table->foreign('beleiver_id', '81091_59df1b3360c8d')->references('id')->on('believers')->onDelete('cascade');
                }
                if (!Schema::hasColumn('product_deliveries', 'product_id')) {
                $table->integer('product_id')->unsigned()->nullable();
                $table->foreign('product_id', '81091_59df1b3365fef')->references('id')->on('products')->onDelete('cascade');
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
        Schema::table('product_deliveries', function(Blueprint $table) {
            
        });
    }
}
