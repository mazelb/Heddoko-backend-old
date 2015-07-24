<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Suit;
use App\Models\Sensor;
use App\Models\AnatomicalPosition;
use App\Models\SensorType;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
        Model::unguard();

		$this->command->info('Seeding started.');
		$this->call(SuitDBSeeder::class);
		$this->command->info('Seeding finished.');

		Model::reguard();
	}
}

class SuitDBSeeder extends Seeder
{
	public function run()
	{
		
		$this->command->info('Deleting entries from the Suits database before beginning a new seed.');

		DB::table('sensors')->delete();
		DB::table('anatomical_positions')->delete();
		DB::table('sensor_types')->delete();
		DB::table('suits')->delete();
		
		$this->command->info('Entries successfully deleted. Beginning seed.');
		
		AnatomicalPosition::create(['name' => 'Upper spin',		 'id' => 0]);
		AnatomicalPosition::create(['name' => 'Right upper arm', 'id' => 1]);
		AnatomicalPosition::create(['name' => 'Right forearm',   'id' => 2]);
		AnatomicalPosition::create(['name' => 'Left upper arm',  'id' => 3]);
		AnatomicalPosition::create(['name' => 'Left forearm', 	 'id' => 4]);
		AnatomicalPosition::create(['name' => 'Right thigh', 	 'id' => 5]);
		AnatomicalPosition::create(['name' => 'Right tibia', 	 'id' => 6]);
		AnatomicalPosition::create(['name' => 'Left thigh',		 'id' => 7]);
		$left_tibia_pos = AnatomicalPosition::create(['name' => 'Left tibia', 	 'id' => 8]);
		
		SensorType::create(['name' => 'Nod Ring', 'id' => 0]);
		$stretch_sensor_type = SensorType::create(['name' => 'Stretch Sensor', 'id' => 1]);
		
		for ($x = 0; $x <= rand(5, 10); $x++)
		{
			$heddoko_suit = Suit::create();

			for ($y = 0; $y <= rand(3, 9); $y++)
			{
				$sensor_type = rand(0, 1);
				$sensor_name = $sensor_type == 0 ? 'nod-' : 'stretchsense-';
				$sensor_name .= rand(0, 9999);
				
				$sensor = Sensor::create(['suit_id'				  => $heddoko_suit->id,
										 'sensor_type_id'		  => $sensor_type, //$stretch_sensor_type->id,
										 'anatomical_position_id' => rand(0, 8), //$left_tibia_pos->id,
										 'part_no'				  => 'ABC123',
										 'serial_no'			  => substr(str_shuffle(MD5(microtime())), 0, 10), //'XYZ321',
										 'physical_location' 	  => 'AB12CD34',
										 'name' 	 			  => $sensor_name]);
			}
		}

	}
	
}
