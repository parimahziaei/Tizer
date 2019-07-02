<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //
//            $table->integer('user_id')->unsigned();
//            //and so on ...
//
//            $table->foreign('user_id')
//                ->references('customers')
//                ->on('id')
//                ->onDelete('cascade');
        });
//        Schema::table('users', function($table) {
//            $table->integer('paid');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
//            $table->dropColumn('user_id');
        });
    }
}
