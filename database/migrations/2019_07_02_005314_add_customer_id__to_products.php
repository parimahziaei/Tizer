<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerIdToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn('customer_id');

//            $table->integer('customer_id')->unsigned();

//            $table->dropColumn('view_count');
//            $table->foreign('customer_id')
//                ->references('customers')
//                ->on('id')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {

//            $table->integer('user_id');//
            $table->integer('customer_id');
//            $table->dropColumn('customer_id');

//            $table->dropForeign(['customer_id']);

            // 2. Drop the column
//            $table->dropColumn('user_id');
        });
    }
}
