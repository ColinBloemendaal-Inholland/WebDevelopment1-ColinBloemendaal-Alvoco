<?php

namespace App\Controllers;

use App\Services\NieuwsberichtenServices;
use App\Services\WedstrijdenServices;

class HomeController extends BaseController
{
    private NieuwsberichtenServices $nieuwsberichtenServices;
    private WedstrijdenServices $wedstrijdenServices;

    public function __construct()
    {
        parent::__construct();
        $this->nieuwsberichtenServices = new NieuwsberichtenServices();
        $this->wedstrijdenServices = new WedstrijdenServices();
    }

    public function index()
    {
        $wedstrijden = $this->wedstrijdenServices->getUpComingByDay(4, 10);
        $nieuwsberichten = $this->nieuwsberichtenServices->getRecent(5);

        $data = [
            'user' => $this->User(),
            'nieuwsberichten' => $nieuwsberichten,
            'wedstrijdenByDate' => $wedstrijden
        ];

        \View::View('Dashboard.Home', 'Home', $data);
    }
}
