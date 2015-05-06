<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Movement;
use App\Models\Frame;
use App\Models\StretchContainer;
use App\Models\StretchSensor;
use App\Models\StretchJoint;
use App\Models\NodContainer;
use App\Models\NodJoint;
use App\Models\NodSensor;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->command->info('Movement seeds started.');
		$this->call('MovementSeeder');
		$this->command->info('Movement seeds finished.');
	}

}

class MovementSeeder extends Seeder {

	public function run(){

		DB::table('nodsensors')->delete();
		DB::table('stretchsensors')->delete();
		DB::table('nodjoints')->delete();
		DB::table('stretchjoints')->delete();
		DB::table('stretchcontainers')->delete();
		DB::table('nodcontainers')->delete();		
		DB::table('frames')->delete();
		DB::table('movements')->delete();
		DB::table('migrations')->delete();
		
		$this->command->info('stage1');
		
		$movementElbow = Movement::create(['name' => 'Elbow Flex']);
		
		$frame1 = Frame::create(['movement_id' => $movementElbow->id]);
		
		$stretchContainer1 = StretchContainer::create(['frame_id' => $frame1->id]);
		
		$stretchJoint1a = StretchJoint::create(['curJointRotE1' => 34, 'curJointRotE2' => 43, 'curJointRotE3' => 66, 'stretch_container_id' => $stretchContainer1->id]);
		$this->command->info('stage1a');
		$stretchSensor1aa = StretchSensor::create(['CSValue1' => 32, 'CSValue2' => 44, 'CSValue3' => 65, 'CSValue4' => 76, 'CSValue5' => 1, 'stretch_joint_id' => $stretchJoint1a->id]);
		$stretchSensor1ab = StretchSensor::create(['CSValue1' => 32, 'CSValue2' => 44, 'CSValue3' => 65, 'CSValue4' => 76, 'CSValue5' => 1, 'stretch_joint_id' => $stretchJoint1a->id]);
		$stretchSensor1ac = StretchSensor::create(['CSValue1' => 32, 'CSValue2' => 44, 'CSValue3' => 65, 'CSValue4' => 76, 'CSValue5' => 1, 'stretch_joint_id' => $stretchJoint1a->id]);
		$stretchSensor1ad = StretchSensor::create(['CSValue1' => 32, 'CSValue2' => 44, 'CSValue3' => 65, 'CSValue4' => 76, 'CSValue5' => 1, 'stretch_joint_id' => $stretchJoint1a->id]);
		$stretchSensor1ae = StretchSensor::create(['CSValue1' => 32, 'CSValue2' => 44, 'CSValue3' => 65, 'CSValue4' => 76, 'CSValue5' => 1, 'stretch_joint_id' => $stretchJoint1a->id]);
		$this->command->info('stage1b');
		$stretchJoint1b = StretchJoint::create(['curJointRotE1' => 34, 'curJointRotE2' => 43, 'curJointRotE3' => 66, 'stretch_container_id' => $stretchContainer1->id]);
		$this->command->info('stage1c');
		$stretchSensor1ba = StretchSensor::create(['CSValue1' => 32, 'CSValue2' => 44, 'CSValue3' => 65, 'CSValue4' => 76, 'CSValue5' => 1, 'stretch_joint_id' => $stretchJoint1b->id]);
		$stretchSensor1bb = StretchSensor::create(['CSValue1' => 32, 'CSValue2' => 44, 'CSValue3' => 65, 'CSValue4' => 76, 'CSValue5' => 1, 'stretch_joint_id' => $stretchJoint1b->id]);
		$stretchSensor1bc = StretchSensor::create(['CSValue1' => 32, 'CSValue2' => 44, 'CSValue3' => 65, 'CSValue4' => 76, 'CSValue5' => 1, 'stretch_joint_id' => $stretchJoint1b->id]);
		$stretchSensor1bd = StretchSensor::create(['CSValue1' => 32, 'CSValue2' => 44, 'CSValue3' => 65, 'CSValue4' => 76, 'CSValue5' => 1, 'stretch_joint_id' => $stretchJoint1b->id]);
		$stretchSensor1be = StretchSensor::create(['CSValue1' => 32, 'CSValue2' => 44, 'CSValue3' => 65, 'CSValue4' => 76, 'CSValue5' => 1, 'stretch_joint_id' => $stretchJoint1b->id]);
		$this->command->info('stage1d');
		$stretchJoint1c = StretchJoint::create(['curJointRotE1' => 34, 'curJointRotE2' => 43, 'curJointRotE3' => 66, 'stretch_container_id' => $stretchContainer1->id]);
		$this->command->info('stage1e');
		$stretchSensor1ca = StretchSensor::create(['CSValue1' => 32, 'CSValue2' => 44, 'CSValue3' => 65, 'CSValue4' => 76, 'CSValue5' => 1, 'stretch_joint_id' => $stretchJoint1c->id]);
		$stretchSensor1cb = StretchSensor::create(['CSValue1' => 32, 'CSValue2' => 44, 'CSValue3' => 65, 'CSValue4' => 76, 'CSValue5' => 1, 'stretch_joint_id' => $stretchJoint1c->id]);
		$stretchSensor1cc = StretchSensor::create(['CSValue1' => 32, 'CSValue2' => 44, 'CSValue3' => 65, 'CSValue4' => 76, 'CSValue5' => 1, 'stretch_joint_id' => $stretchJoint1c->id]);
		$stretchSensor1cd = StretchSensor::create(['CSValue1' => 32, 'CSValue2' => 44, 'CSValue3' => 65, 'CSValue4' => 76, 'CSValue5' => 1, 'stretch_joint_id' => $stretchJoint1c->id]);
		$stretchSensor1ce = StretchSensor::create(['CSValue1' => 32, 'CSValue2' => 44, 'CSValue3' => 65, 'CSValue4' => 76, 'CSValue5' => 1, 'stretch_joint_id' => $stretchJoint1c->id]);
		
		$this->command->info('stage2');
		
		$NodContainer1 = NodContainer::create(['frame_id' => $frame1->id]);
		
		$nodJoint1a = NodJoint::create(['iInitRot1' => 34, 'iInitRot2' => 43, 'iInitRot3' => 66, 'iInitRot4' => 77, 'nod_container_id' => $NodContainer1->id]);
		
		$nodSensor1aa = NodSensor::create(['InitRot1' => 34, 'InitRot2' => 34, 'InitRot3' => 34, 'InitRot4' => 34, 'CurRot1' => 34, 'CurRot2' => 34, 'CurRot3' => 34, 'CurRot4' => 34, 'CurRotEuler1' => 34, 'CurRotEuler2' => 34, 'CurRotEuler3' => 34, 'CurRotEuler4' => 34, 'nod_joint_id' => $nodJoint1a->id]);
		$nodSensor1ab = NodSensor::create(['InitRot1' => 34, 'InitRot2' => 34, 'InitRot3' => 34, 'InitRot4' => 34, 'CurRot1' => 34, 'CurRot2' => 34, 'CurRot3' => 34, 'CurRot4' => 34, 'CurRotEuler1' => 34, 'CurRotEuler2' => 34, 'CurRotEuler3' => 34, 'CurRotEuler4' => 34, 'nod_joint_id' => $nodJoint1a->id]);
		$nodSensor1ac = NodSensor::create(['InitRot1' => 34, 'InitRot2' => 34, 'InitRot3' => 34, 'InitRot4' => 34, 'CurRot1' => 34, 'CurRot2' => 34, 'CurRot3' => 34, 'CurRot4' => 34, 'CurRotEuler1' => 34, 'CurRotEuler2' => 34, 'CurRotEuler3' => 34, 'CurRotEuler4' => 34, 'nod_joint_id' => $nodJoint1a->id]);
		$nodSensor1ad = NodSensor::create(['InitRot1' => 34, 'InitRot2' => 34, 'InitRot3' => 34, 'InitRot4' => 34, 'CurRot1' => 34, 'CurRot2' => 34, 'CurRot3' => 34, 'CurRot4' => 34, 'CurRotEuler1' => 34, 'CurRotEuler2' => 34, 'CurRotEuler3' => 34, 'CurRotEuler4' => 34, 'nod_joint_id' => $nodJoint1a->id]);
		$nodSensor1ae = NodSensor::create(['InitRot1' => 34, 'InitRot2' => 34, 'InitRot3' => 34, 'InitRot4' => 34, 'CurRot1' => 34, 'CurRot2' => 34, 'CurRot3' => 34, 'CurRot4' => 34, 'CurRotEuler1' => 34, 'CurRotEuler2' => 34, 'CurRotEuler3' => 34, 'CurRotEuler4' => 34, 'nod_joint_id' => $nodJoint1a->id]);
		
		$nodJoint1b = NodJoint::create(['iInitRot1' => 34, 'iInitRot2' => 43, 'iInitRot3' => 66, 'iInitRot4' => 77, 'nod_container_id' => $NodContainer1->id]);
		
		$nodSensor1ba = NodSensor::create(['InitRot1' => 34, 'InitRot2' => 34, 'InitRot3' => 34, 'InitRot4' => 34, 'CurRot1' => 34, 'CurRot2' => 34, 'CurRot3' => 34, 'CurRot4' => 34, 'CurRotEuler1' => 34, 'CurRotEuler2' => 34, 'CurRotEuler3' => 34, 'CurRotEuler4' => 34, 'nod_joint_id' => $nodJoint1b->id]);
		$nodSensor1bb = NodSensor::create(['InitRot1' => 34, 'InitRot2' => 34, 'InitRot3' => 34, 'InitRot4' => 34, 'CurRot1' => 34, 'CurRot2' => 34, 'CurRot3' => 34, 'CurRot4' => 34, 'CurRotEuler1' => 34, 'CurRotEuler2' => 34, 'CurRotEuler3' => 34, 'CurRotEuler4' => 34, 'nod_joint_id' => $nodJoint1b->id]);
		$nodSensor1bc = NodSensor::create(['InitRot1' => 34, 'InitRot2' => 34, 'InitRot3' => 34, 'InitRot4' => 34, 'CurRot1' => 34, 'CurRot2' => 34, 'CurRot3' => 34, 'CurRot4' => 34, 'CurRotEuler1' => 34, 'CurRotEuler2' => 34, 'CurRotEuler3' => 34, 'CurRotEuler4' => 34, 'nod_joint_id' => $nodJoint1b->id]);
		$nodSensor1bd = NodSensor::create(['InitRot1' => 34, 'InitRot2' => 34, 'InitRot3' => 34, 'InitRot4' => 34, 'CurRot1' => 34, 'CurRot2' => 34, 'CurRot3' => 34, 'CurRot4' => 34, 'CurRotEuler1' => 34, 'CurRotEuler2' => 34, 'CurRotEuler3' => 34, 'CurRotEuler4' => 34, 'nod_joint_id' => $nodJoint1b->id]);
		$nodSensor1be = NodSensor::create(['InitRot1' => 34, 'InitRot2' => 34, 'InitRot3' => 34, 'InitRot4' => 34, 'CurRot1' => 34, 'CurRot2' => 34, 'CurRot3' => 34, 'CurRot4' => 34, 'CurRotEuler1' => 34, 'CurRotEuler2' => 34, 'CurRotEuler3' => 34, 'CurRotEuler4' => 34, 'nod_joint_id' => $nodJoint1b->id]);
		
		$nodJoint1c = NodJoint::create(['iInitRot1' => 34, 'iInitRot2' => 43, 'iInitRot3' => 66, 'iInitRot4' => 77, 'nod_container_id' => $NodContainer1->id]);
		
		$nodSensor1ca = NodSensor::create(['InitRot1' => 34, 'InitRot2' => 34, 'InitRot3' => 34, 'InitRot4' => 34, 'CurRot1' => 34, 'CurRot2' => 34, 'CurRot3' => 34, 'CurRot4' => 34, 'CurRotEuler1' => 34, 'CurRotEuler2' => 34, 'CurRotEuler3' => 34, 'CurRotEuler4' => 34, 'nod_joint_id' => $nodJoint1c->id]);
		$nodSensor1cb = NodSensor::create(['InitRot1' => 34, 'InitRot2' => 34, 'InitRot3' => 34, 'InitRot4' => 34, 'CurRot1' => 34, 'CurRot2' => 34, 'CurRot3' => 34, 'CurRot4' => 34, 'CurRotEuler1' => 34, 'CurRotEuler2' => 34, 'CurRotEuler3' => 34, 'CurRotEuler4' => 34, 'nod_joint_id' => $nodJoint1c->id]);
		$nodSensor1cc = NodSensor::create(['InitRot1' => 34, 'InitRot2' => 34, 'InitRot3' => 34, 'InitRot4' => 34, 'CurRot1' => 34, 'CurRot2' => 34, 'CurRot3' => 34, 'CurRot4' => 34, 'CurRotEuler1' => 34, 'CurRotEuler2' => 34, 'CurRotEuler3' => 34, 'CurRotEuler4' => 34, 'nod_joint_id' => $nodJoint1c->id]);
		$nodSensor1cd = NodSensor::create(['InitRot1' => 34, 'InitRot2' => 34, 'InitRot3' => 34, 'InitRot4' => 34, 'CurRot1' => 34, 'CurRot2' => 34, 'CurRot3' => 34, 'CurRot4' => 34, 'CurRotEuler1' => 34, 'CurRotEuler2' => 34, 'CurRotEuler3' => 34, 'CurRotEuler4' => 34, 'nod_joint_id' => $nodJoint1c->id]);
		$nodSensor1ce = NodSensor::create(['InitRot1' => 34, 'InitRot2' => 34, 'InitRot3' => 34, 'InitRot4' => 34, 'CurRot1' => 34, 'CurRot2' => 34, 'CurRot3' => 34, 'CurRot4' => 34, 'CurRotEuler1' => 34, 'CurRotEuler2' => 34, 'CurRotEuler3' => 34, 'CurRotEuler4' => 34, 'nod_joint_id' => $nodJoint1c->id]);

	}
	
}
