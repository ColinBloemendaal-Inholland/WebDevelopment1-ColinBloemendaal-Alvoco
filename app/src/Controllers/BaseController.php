<?php

namespace App\Controllers;

use App\Services\LedenServices;
class BaseController {

    private LedenServices $ledenServices;

    public function __construct(?LedenServices $ledenServices = null) {
        $this->ledenServices = $ledenServices ?? new LedenServices();
    }

    public function user() {
        $user = null;
        if(\Auth::isLoggedIn() && \Auth::user()) {
            $id = \Auth::id();
            $user = $this->ledenServices->get($id);
        }
        return $user;
    }
}
