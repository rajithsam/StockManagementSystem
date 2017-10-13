<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add59df1a0e608f4RelationshipsToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function(Blueprint $table) {
            if (!Schema::hasColumn('products', 'product_category_id')) {
                $table->integer('product_category_id')->unsigned()->nullable();
                $table->foreign('product_category_id', '81088_59df1a0d736ad')->references('id')->on('product_categories')->onDelete('cascade');
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
        Schema::table('products', function(Blueprint $table) {
            
        });
    }
}
