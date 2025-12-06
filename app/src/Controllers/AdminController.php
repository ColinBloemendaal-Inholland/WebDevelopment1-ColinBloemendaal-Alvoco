<?php 

namespace App\Controllers;

use App\Helpers\View;

class AdminController {
    public function index() {
        return View::View("admin.leden.index");
    }
}