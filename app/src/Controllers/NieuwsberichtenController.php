<?php 

namespace App\Controllers;

use App\Services\NieuwsberichtenServices;

class NieuwsberichtenController extends BaseController {
    private NieuwsberichtenServices $service;
    public function __construct(?NieuwsberichtenServices $nieuwsberichtenService = null) {
        $this->service = $nieuwsberichtenService ?? new NieuwsberichtenServices();
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