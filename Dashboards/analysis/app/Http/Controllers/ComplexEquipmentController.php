<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Handles http requests for complex equipment.
 * @author  Maxwell (max@heddoko.com) & Francis Amankrah (frank@heddoko.com)
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\ComplexEquipment;
use App\Models\Status;
use App\Repositories\ComplexEquipmentRepository;
use App\Repositories\EquipmentRepository;


use DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ComplexEquipmentController extends Controller {

	/**
	 * The complex equipment repository instance.
	 *
	 * @var ComplexEquipmentRepository
	 */
	protected $complexEquipment;

	/**
	 * The equipment repository instance.
	 *
	 * @var EquipmentRepository
	 */
	protected $equipment;
    /**
     * @var Request
     */
    protected  $request;


    /**
     * Create a new controller instance.
     *
     * @param Request $request
     * @param  ComplexEquipmentRepository $complexEquipment
     * @param  EquipmentRepository $equipment
     */
	public function __construct(Request $request,
                                ComplexEquipmentRepository $complexEquipment,
                                EquipmentRepository $equipment)
	{
        $this->request = $request;
        $this->complexEquipment = $complexEquipment;
		$this->equipment = $equipment;
	}

	/**
	 * Display a listing of the suit-equipments.
	 *
	 * @return Response: The updated list of suits
	 */
	public function index()
	{
        // Retrieve search parameters.
		$searchTerm = strip_tags(trim($this->request->input('search_term')));
		$page = (int) $this->request->input('page', 1);
        $perPage = (int) $this->request->input('per_page', 5);
        $perPage = max(1, min(100, $perPage));
		$offset = ($page - 1) * $perPage;


        $total = $this->complexEquipment->searchCount($searchTerm);
        $results = $this->complexEquipment->search($searchTerm, $perPage, $offset);
        return [
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'results' => $results
        ];
	}

	/**
	 * Store a newly created suit-equipment in storage.
	 *
	 * @return Response: The updated list of suit-equipments
	 */
	public function store()
	{
        $this->validate($this->request, [
            'new_equipment_data.status_id' => 'int|exists:statuses,id',
            'new_equipment_data.mac_address' => 'string|min:1|max:255|unique:complex_equipment,mac_address',
            'new_equipment_data.serial_no' => 'string|min:1|max:255|unique:complex_equipment,serial_no',
            'new_equipment_data.physical_location' => 'string|min:1|max:255'
        ]);

        $data = $this->request->input('new_suit_equipment');

		$new_suit_equipment = $this->complexEquipment->create(array_only($data, [
            'serial_no',
            'mac_address',
            'physical_location',
            'status_id'
        ]));

		$new_suit_equipment_list = $data['equipment'];

		foreach ($new_suit_equipment_list as $new_suit_equipment_item)
		{
			$this->equipment->setUnavailableStatus($new_suit_equipment_item['id'], $new_suit_equipment->id);
		}

		return $this->index();
	}

    /**
     * Update the specified suit in storage.
     *
     * @param $suit_equipment_id
     * @return Response : The updated list of suits
     */
	public function update($suit_equipment_id)
	{
        $this->validate($this->request, [
            'updated_suit.id' => 'int|exists:complex_equipment,id',
            'updated_suit.status_id' => 'int|exists:statuses,id',
            'updated_suit.mac_address' => 'string|min:1|max:255|unique:complex_equipment,mac_address,' . $suit_equipment_id . ',id',
            'updated_suit.serial_no' => 'string|min:1|max:255|unique:complex_equipment,serial_no,' . $suit_equipment_id . ',id',
            'updated_suit.physical_location' => 'string|min:1|max:255'
        ]);

        // Retrieve data sent with the request.
        $data = $this->request->input('updated_suit');

		$this->complexEquipment->update(array_only($data, [
            'serial_no',
            'mac_address',
            'physical_location',
            'status_id']), $suit_equipment_id);
        $suit_equipment_of_interest = $this->complexEquipment->findOrFail($suit_equipment_id);
        
        // Unlink each piece of equipment from the suit.
		foreach ($suit_equipment_of_interest->equipment as $existing_equipment)
		{
			$existing_equipment->status_id = Status::getByName('available')->id;
			$existing_equipment->complex_equipment_id = null;
			$existing_equipment->save();
		}

        // Retrieve the updated list of equipment that belongs to the suit.
        $new_equipment = $data['equipment'];

        // Attach each updated piece of equipment to the suit.
		foreach ($new_equipment as $new_equipment_unit)
		{
            $this->equipment->setUnavailableStatus($new_equipment_unit['id'], $suit_equipment_of_interest->id);
		}

		return $this->index();
	}

    /**
     * Remove the specified suit from storage.
     *
     * @param $suit_equipment_id
     * @return Response : The updated list of suits
     */
	public function destroy($suit_equipment_id)
	{
		$suit_equipment_of_interest = $this->complexEquipment->find($suit_equipment_id);

		foreach ($suit_equipment_of_interest->equipment as $suit_equipment)
		{
			$suit_equipment->complex_equipment_id = null;
			$suit_equipment->status_id = Status::getByName('available')->id;
			$suit_equipment->save();
		}

		$this->complexEquipment->delete($suit_equipment_id);

        return $this->index();
	}
}
