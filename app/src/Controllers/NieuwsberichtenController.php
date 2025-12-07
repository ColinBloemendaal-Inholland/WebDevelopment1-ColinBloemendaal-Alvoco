<?php 

namespace App\Controllers;

use App\Services\NieuwsberichtenServices;

class NieuwsberichtenController extends BaseController implements IController {
    private NieuwsberichtenServices $service;
    public function __construct(?NieuwsberichtenServices $nieuwsberichtenService = null) {
        $this->service = $nieuwsberichtenService ?? new NieuwsberichtenServices();
    }

    public function index(): void {
        $nieuwsberichten = $this->service->();
    }
    public function show(array $params): void {

    }
    public function Create(): void {

    }
    public function store(): void {

    }

    public function edit(array $params): void {

    }

    public function update(): void {

    }

    public function delete(array $params): void {
        
    }

    public function destroy(array $params): void {

    }


    public function GetNieuwsberichten() {
        $filter = [
            'authur'=> $_POST['authur'] ?? '',
            'title'=> $_POST['title'] ??'',
            'message'=> $_POST['message'] ??'',
            'dateFrom'=> $_POST['dateFrom'] ??'',
            'dateTill'=> $_POST['dateTill'] ??'',
            'orderby' => $_POST['order'][0]['column'] ?? 0,
            'orderDir' => $_POST['order'][0]['dir'] ?? 'asc',
        ];

        $draw = $_POST['draw'] ?? 1;
        $start = $_POST['start'] ?? 0;
        $length = $_POST['length'] ?? 25;

        $result = $this->service->getNieuwsberichtenForDatatable($filter, $start, $length, $draw);

        header('Content-Type: application/json');
        echo json_encode($result);
        return;
    }
}