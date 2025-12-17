<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Services\NieuwsberichtenServices;
use App\Services\RolesServices;
use App\Services\LedenServices;
use App\Services\TeamsServices;
use Exception;

class AdminController
{

    private RolesServices $rolenServices;
    private LedenServices $ledenServices;
    private NieuwsberichtenServices $nieuwsberichtenServices;
    private TeamsServices $teamsServices;
    public function __construct(?RolesServices $rolenServices = null, ?LedenServices $ledenServices = null, ?NieuwsberichtenServices $nieuwsberichtenServices = null)
    {
        $this->rolenServices = $rolenServices ?? new RolesServices();
        $this->ledenServices = $ledenServices ?? new LedenServices();
        $this->nieuwsberichtenServices = $nieuwsberichtenServices ?? new NieuwsberichtenServices();
        $this->teamsServices = $teamsServices ?? new TeamsServices();
    }

    public function index()
    {
        return \View::View("admin.index");
    }

    public function leden()
    {
        $roles = $this->rolenServices->getAll();
        return \View::View("admin.leden.index", 'Manage leden', ['rolen' => $roles]);
    }

    public function getLid(array $params) {
        $lid = $this->ledenServices->get(intval($params['id']));
        //TODO: fix the passing of the name
        return \View::View('admin.leden.post', 'Lid', ['lid'=> $lid]);
    }

    public function nieuwsberichten()
    {
        return \View::View("admin.nieuwsberichten.index");
    }

    public function teams()
    {
        return \View::View("admin.teams.index");
    }

    public function getTeam(array $params) {
        $team = $this->teamsServices->get(intval($params['id']));
        return \View::View('admin.teams.post', 'Team', ['team'=> $team]);
    }

    public function coaches()
    {
        return \View::View("admin.coaches.index");
    }

    public function trainers()
    {
        return \View::View("admin.trainers.index");
    }

    public function wedstrijden()
    {
        return \View::View("admin.wedstrijden.index");
    }

    public function bestuursleden()
    {
        return \View::View("admin.bestuursleden.index");
    }
}