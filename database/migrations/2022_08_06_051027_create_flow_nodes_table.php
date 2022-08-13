<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_nodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('flow_id');
            $table->text('node_type');
            $table->integer('node_seq');
            $table->integer('node_spec_id');
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
        Schema::dropIfExists('flow_nodes');
    }
}
