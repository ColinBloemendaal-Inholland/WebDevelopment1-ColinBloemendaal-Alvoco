<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Services\ContactServices;
use App\Services\NieuwsberichtenServices;
use App\Services\RolesServices;
use App\Services\LedenServices;
use App\Services\SeizoenenServices;
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
    private ContactServices $contactServices;
    private SeizoenenServices $seizoenenServices;
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
        $this->contactServices = new ContactServices();
        $this->seizoenenServices = new SeizoenenServices();
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
            'totalContactForms' => count($this->contactServices->getAll()),
        ];
        \View::view("admin.index", 'Admin Dashboard', ['stats' => $stats]);
    }

    public function leden()
    {
        $roles = $this->rolenServices->getAll();
        \View::view("admin.leden.index", 'Manage leden', ['rolen' => $roles]);
    }

    public function getLid(array $params) {
        $lid = $this->ledenServices->get(intval($params['id']));
        \View::view('admin.leden.post', $lid->fullname, ['lid'=> $lid]);
    }

    public function nieuwsberichten()
    {
        \View::view("admin.nieuwsberichten.index", 'Nieuwsberichten');
    }
    public function getNieuwsbericht(array $params) {
        $nieuwsbericht = $this->nieuwsberichtenServices->get(intval($params['id']));
        \View::view('admin.nieuwsberichten.post', $nieuwsbericht->Title, ['nieuwsbericht'=> $nieuwsbericht]);
    }

    public function teams()
    {
        $seizoenen = $this->seizoenenServices->getAll();
        \View::view("admin.teams.index", 'Teams', ['seizoenen' => $seizoenen]);
    }

    public function getTeam(array $params) {
        $team = $this->teamsServices->getTeamWithRelations(intval($params['id']));
        \View::view('admin.teams.post', $team->name, ['team'=> $team]);
    }

    public function coaches()
    {
        \View::view("admin.coaches.index", 'Coaches');
    }

    public function getCoach(array $params) {
        $coach = $this->coachesServices->getWithTeam(intval($params['id']));
        \View::view('admin.coaches.post', $coach->lid->fullname, ['coach'=> $coach]);
    }

    public function trainers()
    {
        \View::view("admin.trainers.index", 'Trainers');
    }
    public function getTrainer(array $params) {
        $trainer = $this->trainersServices->get(intval($params['id']));
        \View::view('admin.trainers.post', $trainer->lid->fullname, ['trainer'=> $trainer]);
    }

    public function wedstrijden()
    {
        $teams = $this->teamsServices->getAll();
        \View::view("admin.wedstrijden.index", 'Wedstrijden', ['teams' => $teams]);
    }

    public function getWedstrijd(array $params) {
        $wedstrijd = $this->wedstrijdenServices->get(intval($params['id']));
        var_dump($wedstrijd->hometeam->spelers->toArray()[9]);
        $title = $wedstrijd->hometeam->name . " vs " . $wedstrijd->awayteam->name;
        \View::view('admin.wedstrijden.post', $title, ['wedstrijd'=> $wedstrijd]);
    }

    public function bestuursleden()
    {
        \View::view("admin.bestuursleden.index", 'Bestuursleden');
    }
    
    public function getBestuurslid(array $params) {
        $bestuurslid = $this->bestuursledenServices->get(intval($params['id']));
        \View::view('admin.bestuursleden.post', $bestuurslid->lid->fullname, ['bestuurslid'=> $bestuurslid]);
    }

    public function spelers()
    {
        $teams = $this->teamsServices->getAll();
        \View::view("admin.spelers.index", 'Spelers', ['teams' => $teams]);
    }

    public function getSpeler(array $params) {
        $speler = $this->spelersServices->get(intval($params['id']));
        \View::view('admin.spelers.post', $speler->lid->fullname, ['speler'=> $speler]);
    }

    public function contact()
    {
        $bestuursleden = $this->bestuursledenServices->getAll();
        \View::view("admin.contact.index", 'Contactformulieren' , ['bestuursleden' => $bestuursleden]);
    }
    
    public function getContact(array $params) {
        $contact = $this->contactServices->get(intval($params['id']));
        \View::view('admin.contact.post', 'Contactformulier', ['contact'=> $contact]);
    }

    public function seizoenen()
    {
        \View::view("admin.seizoenen.index", 'Seizoenen' );
    }
    
    public function getSeizoen(array $params) {
        $seizoen = $this->seizoenenServices->get(intval($params['id']));
        \View::view('admin.seizoenen.post', 'Seizoen', ['seizoen'=> $seizoen]);
    }
}
