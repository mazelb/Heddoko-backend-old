<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\AnatomicalPosition;
use App\Models\Equipment;
use App\Models\Material;
use App\Models\MaterialType;
use App\Models\Status;
use App\Models\SuitEquipment;

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

        DB::table('equipment')->delete();
        DB::table('suits_equipment')->delete();
        DB::table('materials')->delete();
        DB::table('material_types')->delete();
        DB::table('statuses')->delete();
        DB::table('anatomical_positions')->delete();

        $this->command->info('Entries successfully deleted. Beginning seed.');

        $new_status = Status::create(['name' => 'unavailable']);
        $new_status = Status::create(['name' => 'available']);
        $new_status = Status::create(['name' => 'on loan']);
        $new_status = Status::create(['name' => 'in transit']);

        $new_material_type = MaterialType::create(['identifier' => 'Sensor']);

        AnatomicalPosition::create(['name' => 'Upper spin',		 'id' => 0]);
        AnatomicalPosition::create(['name' => 'Right upper arm', 'id' => 1]);
        AnatomicalPosition::create(['name' => 'Right forearm',   'id' => 2]);
        AnatomicalPosition::create(['name' => 'Left upper arm',  'id' => 3]);
        AnatomicalPosition::create(['name' => 'Left forearm', 	 'id' => 4]);
        AnatomicalPosition::create(['name' => 'Right thigh', 	 'id' => 5]);
        AnatomicalPosition::create(['name' => 'Right tibia', 	 'id' => 6]);
        AnatomicalPosition::create(['name' => 'Left thigh',		 'id' => 7]);
        $left_tibia_pos = AnatomicalPosition::create(['name' => 'Left tibia', 	 'id' => 8]);

        $new_material = Material::create(['material_type_id' => $new_material_type->id, 'name' => 'NOD Sensor', 'part_no' => 123321]);

        $new_suit_equipment = SuitEquipment::create(['id' => 4444444, 'anatomical_position_id' => $left_tibia_pos->id]);

        for ($x = 0; $x <= rand(20, 50); $x++) {
            Equipment::create(['material_id' => $new_material->id, 'serial_no' => substr(str_shuffle(MD5(microtime())), 0, 10), 'physical_location' => 'Box2', 'status_id' => Status::getByName('available')->id]);
        }

        //$this->command->info('ddddd ' . count($new_suit_equipment->equipment));
    }

}
