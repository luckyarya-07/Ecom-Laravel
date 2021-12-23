<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoupanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupan', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('coupan_name');
            $table->string('coupan_code');
            $table->integer('coupan_amount');
            $table->date('start_date');
            $table->date('coupan_validity');
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
        Schema::dropIfExists('coupan');
    }
}
