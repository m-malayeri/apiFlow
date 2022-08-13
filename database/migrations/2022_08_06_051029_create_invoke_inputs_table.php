<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvokeInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoke_inputs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('invoke_id');
            $table->text('input_name');
            $table->text('input_type');
            $table->text('literal_value');
            $table->text('api_input_name');
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
        Schema::dropIfExists('invoke_inputs');
    }
}
