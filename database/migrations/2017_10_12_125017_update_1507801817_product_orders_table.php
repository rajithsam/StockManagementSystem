<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1507801817ProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_orders', function (Blueprint $table) {
            if(Schema::hasColumn('product_orders', 'product_id')) {
                $table->dropForeign('81092_59df1bd0f19a7');
                $table->dropIndex('81092_59df1bd0f19a7');
                $table->dropColumn('product_id');
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
        Schema::table('product_orders', function (Blueprint $table) {
                        
        });

    }
}
