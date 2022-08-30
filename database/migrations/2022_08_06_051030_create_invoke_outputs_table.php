<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvokeOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoke_outputs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('flow_id');
            $table->integer('invoke_id');
            $table->text('output_name');
            $table->text('save_as_prop_name');
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
        Schema::dropIfExists('invoke_outputs');
    }
}
