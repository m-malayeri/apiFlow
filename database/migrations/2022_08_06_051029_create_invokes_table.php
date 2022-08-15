<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvokesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invokes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('url');
            $table->text('method');
            $table->text('content_type');
            $table->text('auth_type');
            $table->text('user');
            $table->text('password');
            $table->text('req_parent_object');
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
        Schema::dropIfExists('invokes');
    }
}
