<?php

namespace App\Controllers;

use App\Models\Contact;
use App\Models\Requests\ContactStoreRequest;
use App\Services\BestuursledenServices;
use App\Services\ContactServices;

class ContactController extends BaseController
{
    private ContactServices $contactService;
    private BestuursledenServices $bestuursledenServices;
    public function __construct()
    {
        $this->contactService = new ContactServices();
        $this->bestuursledenServices = new BestuursledenServices();
    }
    public function create()
    {
        $bestuursleden = $this->bestuursledenServices->getAll();
        \View::View('contact.create', 'Contact', [
            'bestuursleden' => $bestuursleden
        ]);
    }

    public function store()
    {
        try {
            $validated = new ContactStoreRequest($_POST)->validate();
            $this->contactService->verstuurContactFormulier($validated);
            \View::Redirect('/contact?success=1');
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect('/contact');
            return;
        }
    }
}
