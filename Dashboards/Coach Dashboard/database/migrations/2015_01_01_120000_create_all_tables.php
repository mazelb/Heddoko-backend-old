<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coaches', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->rememberToken();
			$table->timestamps();
		});
		
		Schema::create('teams', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('coach_id')->unsigned();
			$table->foreign('coach_id')->references('id')->on('coaches');

			$table->timestamps();
		});
		
		Schema::create('athletes', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('team_id')->unsigned();
			$table->foreign('team_id')->references('id')->on('teams');
			
			$table->string('name');
			$table->integer('age')->unsigned();
			
			$table->timestamps();
		});	
		
		Schema::create('fmsforms', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('athlete_id')->unsigned();
			$table->foreign('athlete_id')->references('id')->on('athletes');

			$table->tinyInteger('deepsquat');
			$table->string('deepsquatcomments', 255);
			$table->tinyInteger('Lhurdle');
			$table->tinyInteger('Rhurdle');
			$table->string('hurdlecomments', 255);
			$table->tinyInteger('Llunge');
			$table->tinyInteger('Rlunge');
			$table->string('lungecomments', 255);
			$table->tinyInteger('Lshoulder');
			$table->tinyInteger('Rshoulder');
			$table->string('shouldercomments', 255);
			$table->tinyInteger('Limpingement');
			$table->tinyInteger('Rimpingement');
			$table->string('impingementcomments', 255);
			$table->tinyInteger('Lactive');
			$table->tinyInteger('Ractive');
			$table->string('activecomments', 255);
			$table->tinyInteger('trunk');
			$table->string('trunkcomments', 255);
			$table->tinyInteger('press');
			$table->string('presscomments', 255);
			$table->tinyInteger('Lrotary');
			$table->tinyInteger('Rrotary');
			$table->string('rotarycomments', 255);
			$table->tinyInteger('posterior');
			$table->string('posteriorcomments', 255);
			$table->tinyInteger('totalscore');
			
			$table->timestamps();
		});
		
		Schema::create('sportcategories', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('name');

			$table->timestamps();
		});
		
		Schema::create('sportmovements', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('sport_id')->unsigned();
			$table->foreign('sport_id')->references('id')->on('sportcategories');
			$table->string('name');

			$table->timestamps();
		});

		Schema::create('movements', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('athlete_id')->unsigned();
			$table->foreign('athlete_id')->references('id')->on('athletes');
			$table->integer('fmsform_id')->unsigned()->nullable();
			$table->foreign('fmsform_id')->references('id')->on('fmsforms');
			
			$table->integer('sportmovement_id')->unsigned();
			$table->foreign('sportmovement_id')->references('id')->on('sportmovements');
			$table->string('name');

			$table->timestamps();
		});
		
		Schema::create('movementrawentries', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('movement_id')->unsigned();
			$table->foreign('movement_id')->references('id')->on('movements');
			$table->string('filename')->unique();

			$table->timestamps();
		});
		
		Schema::create('frames', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('movement_id')->unsigned();
			$table->foreign('movement_id')->references('id')->on('movements');

			$table->timestamps();
		});
		
		Schema::create('nodcontainers', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('frame_id')->unsigned();
			$table->foreign('frame_id')->references('id')->on('frames');

			$table->timestamps();
		});
		
		Schema::create('nodjoints', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('nod_container_id')->unsigned();
			$table->foreign('nod_container_id')->references('id')->on('nodcontainers');
			
			$table->float('iInitRot1');
			$table->float('iInitRot2');
			$table->float('iInitRot3');
			$table->float('iInitRot4');

			$table->timestamps();
		});
		
		Schema::create('nodsensors', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('nod_joint_id')->unsigned();
			$table->foreign('nod_joint_id')->references('id')->on('nodjoints');
			
			$table->float('InitRot1');
			$table->float('InitRot2');
			$table->float('InitRot3');
			$table->float('InitRot4');
			$table->float('CurRot1');
			$table->float('CurRot2');
			$table->float('CurRot3');
			$table->float('CurRot4');
			$table->float('CurRotEuler1');
			$table->float('CurRotEuler2');
			$table->float('CurRotEuler3');
			$table->float('CurRotEuler4');

			$table->timestamps();
		});
		
		Schema::create('stretchcontainers', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('frame_id')->unsigned();
			$table->foreign('frame_id')->references('id')->on('frames');

			$table->timestamps();
		});
		
		Schema::create('stretchjoints', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('stretch_container_id')->unsigned();
			$table->foreign('stretch_container_id')->references('id')->on('stretchcontainers');
			
			$table->float('curJointRotE1');
			$table->float('curJointRotE2');
			$table->float('curJointRotE3');

			$table->timestamps();
		});
		
		Schema::create('stretchsensors', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('stretch_joint_id')->unsigned();
			$table->foreign('stretch_joint_id')->references('id')->on('stretchjoints');
			
			$table->integer('CSValue1');
			$table->integer('CSValue2');
			$table->integer('CSValue3');
			$table->integer('CSValue4');
			$table->integer('CSValue5');

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
		Schema::drop('stretchsensors');
		Schema::drop('nodsensors');
		
		Schema::drop('stretchjoints');
		Schema::drop('nodjoints');
		
		Schema::drop('stretchcontainers');
		Schema::drop('nodcontainers');
		
		Schema::drop('frames');
		
		Schema::drop('movements');
		
		Schema::drop('fmsforms');
		Schema::drop('athletes');
		Schema::drop('teams');
		Schema::drop('coaches');
		
		Schema::drop('sportmovements');
		Schema::drop('sportcategories');
	}

}
