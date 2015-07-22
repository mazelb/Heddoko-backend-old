<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuitsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suits', function(Blueprint $table)
		{
			$table->increments('id');

			$table->timestamps();
		});
		
		Schema::create('anatomical_positions', function(Blueprint $table)
		{
			$table->integer('id')->unsigned();
			$table->primary('id');
			
			$table->string('name');
		});	
		
		Schema::create('sensor_types', function(Blueprint $table)
		{
			$table->integer('id')->unsigned();
			$table->primary('id');
			
			$table->string('name');
		});
		
		Schema::create('sensors', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('suit_id')->unsigned();
			$table->foreign('suit_id')->references('id')->on('suits')
			->onDelete('cascade');
			
			$table->integer('anatomical_position_id')->unsigned();
			$table->foreign('anatomical_position_id')->references('id')->on('anatomical_positions');
			
			$table->integer('sensor_type_id')->unsigned();
			$table->foreign('sensor_type_id')->references('id')->on('sensor_types');
			
			$table->string('part_no');
			$table->string('serial_no');
			$table->string('physical_location');

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
        Schema::drop('sensors');
        Schema::drop('anatomical_positions');
        Schema::drop('sensor_types');
        Schema::drop('suits');
    }
}
