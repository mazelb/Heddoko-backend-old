<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Handles http requests for equipment.
 * @author  Maxwell (max@heddoko.com) & Francis Amankrah (frank@heddoko.com)
 */
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Status;
use App\Repositories\EquipmentRepository;


class EquipmentController extends Controller {

    /**
     * The equipment repository instance.
     *
     * @var EquipmentRepository
     */
    protected $equipments;
	/**
	 * @var Request
	 */
	protected  $request;

	/**
	 * Create a new controller instance.
	 *
	 * @param  EquipmentRepository $equipments
	 */
    public function __construct(Request $request,
								EquipmentRepository $equipments)
    {
		$this->request = $request;
        $this->equipments = $equipments;
    }

	/**
	 * Display a listing of equipment.
	 *
	 * @return Response
	 */
	public function index()
	{
		$page = (int) $this->request->input('page', 1);
		$perPage = (int) $this->request->input('per_page', 100);
		$perPage = max(1, min(100, $perPage));
		$offset = ($page - 1) * $perPage;
        $statusId = (int) $this->request->input('status_id', 0);
        $searchTerm = strip_tags(trim($this->request->input('search_term')));

        $total = $this->equipments->searchCount($searchTerm, $statusId);

        $results = $this->equipments->search($searchTerm, $statusId, $perPage, $offset);

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
            'new_equipment_data.material_id' => 'int|exists:materials,id',
            'new_equipment_data.status_id' => 'int|exists:statuses,id',
            'new_equipment_data.anatomical_position_id' => 'int|exists:anatomical_positions,id',
            'new_equipment_data.complex_equipment_id' => 'int|exists:complex_equipment,id',
            'new_equipment_data.mac_address' => 'string|min:1|max:255|unique:equipment,mac_address',
            'new_equipment_data.serial_no' => 'string|min:1|max:255|unique:equipment,serial_no',
            'new_equipment_data.physical_location' => 'string|min:1|max:255'
        ]);

        $data = $this->request->input('new_equipment_data', array());

		$this->equipments->create(array_only($data, [
            'material_id',
            'status_id',
            'anatomical_position_id',
            'complex_equipment_id',
            'mac_address',
            'serial_no',
            'physical_location'
        ]));

		return $this->index();
	}

	/**
	 * Update the specified equipment in storage.
	 *
	 * @param  int  $id
	 * @return Response: The updated list of suits
	 */
	public function update($id)
	{
        $this->validate($this->request, [
            'updated_equipment.id' => 'int|exists:equipment,id',
            'updated_equipment.material_id' => 'int|exists:materials,id',
            'updated_equipment.status_id' => 'int|exists:statuses,id',
            'updated_equipment.anatomical_position_id' => 'int|exists:anatomical_positions,id',
            'updated_equipment.complex_equipment_id' => 'int|exists:complex_equipment,id',
            'updated_equipment.mac_address' => 'string|min:1|max:255|unique:equipment,mac_address,' . $id . ',id',
            'updated_equipment.serial_no' => 'string|min:1|max:255|unique:equipment,serial_no,' . $id . ',id',
            'updated_equipment.physical_location' => 'string|min:1|max:255'
        ]);


		$data = $this->request->input('updated_equipment', []);
        
		// Update the model.
		$this->equipments->update(
            array_only($data, [
                'material_id',
                'status_id',
                'anatomical_position_id',
                'complex_equipment_id',
                'mac_address',
                'serial_no',
                'physical_location'
            ])
        , $id);

		return $this->index();
	}

	/**
	 * Remove the specified equipment from storage.
	 *
	 * @param  int  $id
	 * @return Response: The updated list of equipment.
	 */
	public function destroy($id)
	{
        $this->equipments->delete($id);

        return $this->index();
	}
}
