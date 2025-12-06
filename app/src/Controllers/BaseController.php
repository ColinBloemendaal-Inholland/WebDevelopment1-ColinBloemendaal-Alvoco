<?php

namespace App\Controllers;

use App\Services\LedenServices;
class BaseController {

    private LedenServices $ledenServices;

    public function __construct(?LedenServices $ledenServices = null) {
        $this->ledenServices = $ledenServices ?? new LedenServices();
    }

    public function User() {
        $user = null;
        if(\Auth::isLoggedIn() && \Auth::user()) {
            $id = \Auth::id();
            $user = $this->ledenServices->getById($id);
        }
        return $user;
    }
}