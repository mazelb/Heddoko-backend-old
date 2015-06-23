<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Athlete;
use App\Models\Coach;
use App\Models\Frame;
use App\Models\Movement;
use App\Models\NodContainer;
use App\Models\NodJoint;
use App\Models\NodSensor;
use App\Models\SportCategory;
use App\Models\SportMovement;
use App\Models\StretchContainer;
use App\Models\StretchSensor;
use App\Models\StretchJoint;
use App\Models\Team;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->command->info('Seeding started.');
		$this->call('DBSeeder');
		$this->command->info('Seeding finished.');
	}

}

class DBSeeder extends Seeder {

	public function run(){

		DB::table('nodsensors')->delete();
		DB::table('stretchsensors')->delete();
		DB::table('nodjoints')->delete();
		DB::table('stretchjoints')->delete();
		DB::table('stretchcontainers')->delete();
		DB::table('nodcontainers')->delete();		
		DB::table('frames')->delete();
		DB::table('movements')->delete();
		DB::table('sportmovements')->delete();
		DB::table('sportcategories')->delete();
		DB::table('fmsforms')->delete();
		DB::table('athletes')->delete();
		DB::table('teams')->delete();
		DB::table('coaches')->delete();		
		
		DB::table('migrations')->delete();
		
		$dummyCoach = Coach::create(['name' => 'Dummy Coach']);
		
		$dummyTeam = Team::create(['name' => 'Dummy Team', 'coach_id' => $dummyCoach->id]);		
		$dummyTeam = Team::create(['name' => 'Chargers', 'coach_id' => $dummyCoach->id]);
		$dummyTeam = Team::create(['name' => 'Falcons', 'coach_id' => $dummyCoach->id]);
		$dummyTeam = Team::create(['name' => 'Stampeders', 'coach_id' => $dummyCoach->id]);
		$dummyTeam = Team::create(['name' => 'Vikings', 'coach_id' => $dummyCoach->id]);	
		
		$dummyAthlete = Athlete::create(['name' => 'Dummy Athlete', 'team_id' => $dummyTeam->id]);
		$dummyAthlete = Athlete::create(['name' => 'Dummy Athlete2', 'team_id' => $dummyTeam->id]);
		$dummyAthlete = Athlete::create(['name' => 'Dummy Athlete3', 'team_id' => $dummyTeam->id]);
		$dummyAthlete = Athlete::create(['name' => 'Dummy Athlete4', 'team_id' => $dummyTeam->id]);
		$dummyAthlete = Athlete::create(['name' => 'Dummy Athlete5', 'team_id' => $dummyTeam->id]);
		
		$sportcategory = SportCategory::create(['name' => 'Hockey']);
		$sportcategory = SportCategory::create(['name' => 'Soccer']);
		$sportcategory = SportCategory::create(['name' => 'Football']);
		$sportcategory = SportCategory::create(['name' => 'Volleyball']);
		$sportcategory = SportCategory::create(['name' => 'Basketball']);
		$sportcategory = SportCategory::create(['name' => 'Tennis']);
		$sportcategory = SportCategory::create(['name' => 'Golf']);
		$sportcategory = SportCategory::create(['name' => 'Spinning']);
		$sportcategory = SportCategory::create(['name' => 'Crossfit']);
	
		$sportcategory = SportCategory::create(['name' => 'Strength and Conditioning']);
		
		$sportmovement = SportMovement::create(['name' => 'Back Squat', 'sport_id' => $sportcategory->id]);
		$sportmovement = SportMovement::create(['name' => 'Deadlift', 'sport_id' => $sportcategory->id]);
		$sportmovement = SportMovement::create(['name' => 'Bench Press', 'sport_id' => $sportcategory->id]);
		$sportmovement = SportMovement::create(['name' => 'Push-up', 'sport_id' => $sportcategory->id]);
		$sportmovement = SportMovement::create(['name' => 'Pull-up', 'sport_id' => $sportcategory->id]);
		$sportmovement = SportMovement::create(['name' => 'Horizontal Jump', 'sport_id' => $sportcategory->id]);
		$sportmovement = SportMovement::create(['name' => 'Vertical Jump', 'sport_id' => $sportcategory->id]);
		$sportmovement = SportMovement::create(['name' => 'Plank', 'sport_id' => $sportcategory->id]);
		$sportmovement = SportMovement::create(['name' => 'Lunge', 'sport_id' => $sportcategory->id]);
		$sportmovement = SportMovement::create(['name' => 'Treadmill', 'sport_id' => $sportcategory->id]);
		
		$sportcategory = SportCategory::create(['name' => 'Yoga']);
		
		$sportmovement = SportMovement::create(['name' => 'YogaFakeMvmnt', 'sport_id' => $sportcategory->id]);
		$sportmovement = SportMovement::create(['name' => 'YogaFakeMvmnt1', 'sport_id' => $sportcategory->id]);
		$sportmovement = SportMovement::create(['name' => 'YogaFakeMvmnt3', 'sport_id' => $sportcategory->id]);

		$movementElbow = Movement::create(['name' => 'Elbow Flex', 'athlete_id' => $dummyAthlete->id, 'sportmovement_id' => $sportmovement->id, 'fmsform_id' => null]);
		
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
