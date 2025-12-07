<?php 

namespace App\Controllers;

use App\Helpers\View;
use App\Services\RolenServices;

class AdminController {

    private RolenServices $rolenServices;
    public function __construct(?RolenServices $rolenServices = null) {
        $this->rolenServices = $rolenServices ?? new RolenServices();
    }
    public function index() {
        return \View::View("admin.index");
    }

    public function leden() {
        $roles = $this->rolenServices->getAll();
        return \View::View("admin.leden.index", 'Manage leden', ['rolen'=> $roles]);
    }
    public function createLeden() {
        $roles = $this->rolenServices->getAll();
        return \View::View("admin.leden.create", 'Lid toevoegen', ['rolen'=> $roles]);
    }

    public function nieuwsberichten() {
        return \View::View("admin.nieuwsberichten.index");
    }

    public function teams() {
        return \View::View("admin.teams.index");
    }

    public function coaches() {
        return \View::View("admin.coaches.index");
    }

    public function trainers() {
        return \View::View("admin.trainers.index");
    }

    public function wedstrijden() {
        return \View::View("admin.wedstrijden.index");
    }

    public function bestuursleden() {
        return \View::View("admin.bestuursleden.index");
    }
}