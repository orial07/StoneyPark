<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToCampersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campers', function (Blueprint $table) {
            $table->bigInteger('reservation_id')->unsigned()->index()->change();
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campers', function (Blueprint $table) {
            //
        });
    }
}
