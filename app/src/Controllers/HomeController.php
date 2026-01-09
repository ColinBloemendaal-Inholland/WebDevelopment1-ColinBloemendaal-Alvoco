<?php

namespace App\Controllers;

use App\Services\BestuursledenServices;
use App\Services\NieuwsberichtenServices;
use App\Services\WedstrijdenServices;
use App\Services\ContactServices;
use App\Models\Bestuursleden;
class HomeController extends BaseController
{
    private NieuwsberichtenServices $nieuwsberichtenServices;
    private WedstrijdenServices $wedstrijdenServices;
    private ContactServices $contactService;
    private BestuursledenServices $bestuursledenServices;

    public function __construct()
    {
        parent::__construct();
        $this->nieuwsberichtenServices = new NieuwsberichtenServices();
        $this->wedstrijdenServices = new WedstrijdenServices();
        $this->contactService = new ContactServices();
        $this->bestuursledenServices = new BestuursledenServices();
    }

    public function index()
    {
        $wedstrijden = $this->wedstrijdenServices->getUpComingByDay(4, 10);
        $nieuwsberichten = $this->nieuwsberichtenServices->getRecent(5);

        $data = [
            'user' => $this->user(),
            'nieuwsberichten' => $nieuwsberichten,
            'wedstrijdenByDate' => $wedstrijden
        ];

        \View::View('Dashboard.Home', 'Home', $data);
    }

    public function contactForm()
    {
        $bestuursleden = $this->bestuursledenServices->getAll();
        \View::View('Home.contact', 'Contact', [
            'bestuursleden' => $bestuursleden
        ]);
    }

    public function storeContact()
    {
        $data = [
            'naam' => $_POST['naam'] ?? null,
            'email' => $_POST['email'] ?? null,
            'bericht' => $_POST['bericht'] ?? null,
            'bestuurslid_id' => $_POST['bestuurslid_id'] ?? null,
        ];
        $this->contactService->verstuurContactFormulier($data);
        // Optioneel: flash message of redirect
        header('Location: /contact?success=1');
        exit;
    }
}
