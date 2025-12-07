<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Services\RolenServices;
use App\Services\LedenServices;
use Exception;

class AdminController
{

    private RolenServices $rolenServices;
    private LedenServices $ledenServices;
    public function __construct(?RolenServices $rolenServices = null, ?LedenServices $ledenServices = null)
    {
        $this->rolenServices = $rolenServices ?? new RolenServices();
        $this->ledenServices = $ledenServices ?? new LedenServices();
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

    public function createLeden()
    {
        $roles = $this->rolenServices->getAll();
        return \View::View("admin.leden.create", 'Lid toevoegen', ['rolen' => $roles]);
    }

    function storeLeden()
    {
        $errors = [];
        $data = [];
        foreach($_POST as $key => $value) {
            $data[$key] = $value;
        }
        $data = array_map('trim', $data);

        $requiredFields = [ 'firstname', 'lastname','gender', 'date_of_birth', 'email', 'password', 'password_confirm', 'emergency_contact_firstname', 'emergency_contact_lastname', 'emergency_contact_phone', 'streetname', 'streetnumber', 'postalcode', 'city', 'country'];

        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $errors[$field] = 'Dit veld is verplicht.';
            }
        }

        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Ongeldig e-mailadres.';
        }

        if (
            !empty($data['password']) && !empty($data['password_confirm']) &&
            $data['password'] !== $data['password_confirm']
        ) {
            $errors['password_confirm'] = 'Wachtwoord en bevestiging komen niet overeen.';
        }

        if (!empty($data['gender']) && !in_array($data['gender'], ['M', 'F', 'O'])) {
            $errors['gender'] = 'Ongeldige waarde voor geslacht.';
        }
        
        if (!empty($errors)) {
            $_SESSION["form_erros"] = $errors;
            $_SESSION["form_old"] = $data;
            \View::Redirect("/admin/leden/create");
        }

        $lidData = [
            'firstname' => htmlspecialchars($data['firstname']),
            'middlename' => htmlspecialchars($data['middlename'] ?? ''),
            'lastname' => htmlspecialchars($data['lastname']),
            'gender' => htmlspecialchars($data['gender']),
            'date_of_birth' => $data['date_of_birth'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT), // Hash password
            'streetname' => htmlspecialchars($data['streetname']),
            'streetnumber' => htmlspecialchars($data['streetnumber']),
            'postalcode' => htmlspecialchars($data['postalcode']),
            'city' => htmlspecialchars($data['city']),
            'country' => htmlspecialchars($data['country']),
            'emergency_contact_firstname' => htmlspecialchars($data['emergency_contact_firstname']),
            'emergency_contact_middlename' => htmlspecialchars($data['emergency_contact_middlename'] ?? ''),
            'emergency_contact_lastname' => htmlspecialchars($data['emergency_contact_lastname']),
            'emergency_contact_phone' => htmlspecialchars($data['emergency_contact_phone']),
            'roles' => $data['role'] ?? [],
        ];

        try {
            $lid = $this->ledenServices->create($lidData);
            \View::Redirect("/admin/leden/{$lid->id}");
        } catch (Exception $e) {
            $_SESSION["form_erros"] = $errors;
            $_SESSION["form_old"] = $data;
            \View::Redirect("/admin/leden/create");
        }
    }


    public function nieuwsberichten()
    {
        return \View::View("admin.nieuwsberichten.index");
    }

    public function teams()
    {
        return \View::View("admin.teams.index");
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