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
use App\Services\WedstrijdenServices;
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
    private WedstrijdenServices $wedstrijdenServices;
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
        $this->wedstrijdenServices = new WedstrijdenServices();
    }

    public function index()
    {
        $stats = [
            'totalLeden' => count($this->ledenServices->getAll()),
            'totalTeams' => count($this->teamsServices->getAll()),
            'totalWedstrijden' => count($this->wedstrijdenServices->getAll()),
            'totalNieuwsberichten' => count($this->nieuwsberichtenServices->getAll()),
            'totalSpelers' => count($this->spelersServices->getAll()),
            'totalTrainers' => count($this->trainersServices->getAll()),
            'totalCoaches' => count($this->coachesServices->getAll()),
        ];
        \View::View("admin.index", 'Admin Dashboard', ['stats' => $stats]);
    }

    public function leden()
    {
        $roles = $this->rolenServices->getAll();
        \View::View("admin.leden.index", 'Manage leden', ['rolen' => $roles]);
    }

    public function getLid(array $params) {
        $lid = $this->ledenServices->get(intval($params['id']));
        //TODO: fix the passing of the name
        \View::View('admin.leden.post', 'Lid', ['lid'=> $lid]);
    }

    public function nieuwsberichten()
    {
        \View::View("admin.nieuwsberichten.index", 'Nieuwsberichten');
    }
    public function getNieuwsbericht(array $params) {
    $nieuwsbericht = $this->nieuwsberichtenServices->get(intval($params['id']));
        \View::View('admin.nieuwsberichten.post', 'Nieuwsbericht', ['nieuwsbericht'=> $nieuwsbericht]);
    }

    public function teams()
    {
        \View::View("admin.teams.index", 'Teams');
    }

    public function getTeam(array $params) {
        $team = $this->teamsServices->get(intval($params['id']));
        \View::View('admin.teams.post', 'Team', ['team'=> $team]);
    }

    public function coaches()
    {
        \View::View("admin.coaches.index", 'Coaches');
    }

    public function getCoach(array $params) {
        $coach = $this->coachesServices->getWithTeam(intval($params['id']));
        \View::View('admin.coaches.post', 'Coach', ['coach'=> $coach]);
    }

    public function trainers()
    {
        \View::View("admin.trainers.index", 'Trainers');
    }
    public function getTrainer(array $params) {
        $trainer = $this->trainersServices->get(intval($params['id']));
        \View::View('admin.trainers.post', 'Trainer', ['trainer'=> $trainer]);
    }

    public function wedstrijden()
    {
        $teams = $this->teamsServices->getAll();
        \View::View("admin.wedstrijden.index", 'Wedstrijden', ['teams' => $teams]);
    }

    public function getWedstrijd(array $params) {
        $wedstrijd = $this->wedstrijdenServices->get(intval($params['id']));
        \View::View('admin.wedstrijden.post', 'Wedstrijd', ['wedstrijd'=> $wedstrijd]);
    }

    public function bestuursleden()
    {
        \View::View("admin.bestuursleden.index", 'Bestuursleden');
    }
    
    public function getBestuurslid(array $params) {
        $bestuurslid = $this->bestuursledenServices->get(intval($params['id']));
        \View::View('admin.bestuursleden.post', 'Bestuurslid', ['bestuurslid'=> $bestuurslid]);
    }

    public function spelers()
    {
        $teams = $this->teamsServices->getAll();
        \View::View("admin.spelers.index", 'Spelers', ['teams' => $teams]);
    }

    public function getSpeler(array $params) {
        $speler = $this->spelersServices->get(intval($params['id']));
        \View::View('admin.spelers.post', 'Speler', ['speler'=> $speler]);
    }
}
