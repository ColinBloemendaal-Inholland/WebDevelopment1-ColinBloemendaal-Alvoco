<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Services\NieuwsberichtenServices;
use App\Services\RolesServices;
use App\Services\LedenServices;
use App\Services\SpelersServices;
use App\Services\TeamsServices;
use App\Services\BestuursledenServices;
use App\Services\CoachesServices;
use App\Services\TrainersServices;
use Exception;

class AdminController
{

    private RolesServices $rolenServices;
    private LedenServices $ledenServices;
    private NieuwsberichtenServices $nieuwsberichtenServices;
    private TeamsServices $teamsServices;
    private BestuursledenServices $bestuursledenServices;
    private CoachesServices $coachesServices;
    private SpelersServices $spelersServices;
    private TrainersServices $trainersServices;
    public function __construct()
    {
        $this->rolenServices =  new RolesServices();
        $this->ledenServices = new LedenServices();
        $this->nieuwsberichtenServices = new NieuwsberichtenServices();
        $this->teamsServices = new TeamsServices();
        $this->bestuursledenServices = new BestuursledenServices();
        $this->coachesServices = new CoachesServices();
        $this->spelersServices = new SpelersServices();
        $this->trainersServices = new TrainersServices();
    }

    public function index()
    {
        return \View::View("admin.index", 'Admin Dashboard');
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
        return \View::View("admin.nieuwsberichten.index", 'Nieuwsberichten');
    }
    public function getNieuwsbericht(array $params) {
    $nieuwsbericht = $this->nieuwsberichtenServices->get(intval($params['id']));
        return \View::View('admin.nieuwsberichten.post', 'Nieuwsbericht', ['nieuwsbericht'=> $nieuwsbericht]);
    }

    public function teams()
    {
        return \View::View("admin.teams.index", 'Teams');
    }

    public function getTeam(array $params) {
        $team = $this->teamsServices->get(intval($params['id']));
        return \View::View('admin.teams.post', 'Team', ['team'=> $team]);
    }

    public function coaches()
    {
        return \View::View("admin.coaches.index", 'Coaches');
    }

    public function getCoach(array $params) {
        $coach = $this->coachesServices->getWithTeam(intval($params['id']));
        return \View::View('admin.coaches.post', 'Coach', ['coach'=> $coach]);
    }

    public function trainers()
    {
        return \View::View("admin.trainers.index", 'Trainers');
    }
    public function getTrainer(array $params) {
        $trainer = $this->trainersServices->get(intval($params['id']));
        return \View::View('admin.trainers.post', 'Trainer', ['trainer'=> $trainer]);
    }

    public function wedstrijden()
    {
        $teams = $this->teamsServices->getAll();
        return \View::View("admin.wedstrijden.index", 'Wedstrijden', ['teams' => $teams]);
    }

    public function bestuursleden()
    {
        return \View::View("admin.bestuursleden.index", 'Bestuursleden');
    }
    
    public function getBestuurslid(array $params) {
        $bestuurslid = $this->bestuursledenServices->get(intval($params['id']));
        return \View::View('admin.bestuursleden.post', 'Bestuurslid', ['bestuurslid'=> $bestuurslid]);
    }

    public function spelers()
    {
        return \View::View("admin.spelers.index", 'Spelers');
    }

    public function getSpeler(array $params) {
        $speler = $this->spelersServices->get(intval($params['id']));
        return \View::View('admin.spelers.post', 'Speler', ['speler'=> $speler]);
    }
}