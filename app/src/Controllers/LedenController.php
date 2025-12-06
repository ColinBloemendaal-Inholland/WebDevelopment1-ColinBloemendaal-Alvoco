<?php 

namespace App\Controllers;

use App\Helpers\View;
use App\Helpers\Auth;
use App\Services\LedenServices;


class LedenController {

    private LedenServices $service;
    public function __construct(?LedenServices $ledenService = null) {
        $this->service = $ledenService ?? new LedenServices();
    }

    public function index() {
        $leden = $this->service->getAll();
        return View::View("leden.index", "Leden Overzicht", ['leden' => $leden]);
    }

    public function GetLeden( ) {
        header('Content-Type: application/json');
        $leden = $this->service->getAll();

        //TODO: place this logic in the right class > service > repo etc.
        $data = [];
        foreach ($leden as $l) {
            $data[] = [
                'id'=> $l->id,
                'fullname'=> $l->fullname,
                'email'=> $l->email,
                'phone'=> $l->phone,
                'adres'=> $l->adres,
                'postal' => $l->postalcode,
                'city'=> $l->city,
                'emergencyFullname'=> $l->Emergencycontactfullname,
                'emergencyNumber'=> $l->emergency_contact_phone,
            ];
        }
        echo json_encode(['data' => $data]);
        return;
    }

    public function loginView() {
        return View::View("leden.login");
    }

    public function login() {
        if(!isset($_POST["email"]) && !isset($_POST["password"])) 
            return View::Redirect("/login");
        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $this->service->getByEmail($email);
        if(!$user){
            return false;
        }

        //TODO: implement hasing
        if($password != $user->password) {
            return false;
        }

        Auth::login($user->email, $user->id);
        View::Redirect("/");
    }
}