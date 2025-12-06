<?php 

namespace App\Controllers;

use App\Helpers\View;

class AdminController {
    public function index() {
        return \View::View("admin.index");
    }

    public function leden() {
        return \View::View("admin.leden");
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