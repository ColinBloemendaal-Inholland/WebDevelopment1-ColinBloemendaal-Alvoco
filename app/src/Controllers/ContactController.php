<?php

namespace App\Controllers;

use App\Models\Requests\ContactStoreRequest;
use App\Models\Requests\ContactUpdateRequest;
use App\Services\BestuursledenServices;
use App\Services\ContactServices;

class ContactController extends BaseController implements IController
{
    private ContactServices $service;
    private BestuursledenServices $bestuursledenServices;
    public function __construct()
    {
        $this->service = new ContactServices();
        $this->bestuursledenServices = new BestuursledenServices();
    }

    public function index()
    {
        $contacts = $this->service->getAll();
        \View::View('admin.contact.index', 'Contacten', ['contacts' => $contacts]);
    }

    public function show(array $params)
    {
        $contact = $this->service->get(intval($params['id']));
        \View::View('admin.contact.post', 'Contact', ['contact' => $contact]);
    }

    public function create()
    {
        $bestuursleden = $this->bestuursledenServices->getAll();
        \View::View('admin.contact.create', 'Contact toevoegen', [
            'bestuursleden' => $bestuursleden
        ]);
    }

    public function store()
    {
        try {
            $validated = (new ContactStoreRequest($_POST))->validate();
            $contact = $this->service->create($validated);
            \View::Redirect("/admin/contact/{$contact['id']}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect("/admin/contact/create");
        }
    }

    public function edit(array $params)
    {
        $contact = $this->service->get(intval($params['id']));
        $bestuursleden = $this->bestuursledenServices->getAll();
        \View::View('admin.contact.edit', 'Contact bewerken', [
            'contact' => $contact,
            'bestuursleden' => $bestuursleden
        ]);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new ContactUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            \View::Redirect("/admin/contact/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect("/admin/contact/{$id}/edit");
        }
    }

    public function delete(array $params)
    {
        $deleted = $this->service->delete(intval($params['id']));
        if (!$deleted) {
            \View::Redirect("/admin/contact/{$params['id']}");
            return;
        }
        \View::Redirect("/admin/contact");
    }

    public function destroy(array $params)
    {
        $destroyed = $this->service->destroy(intval($params['id']));
        if (!$destroyed) {
            \View::Redirect("/admin/contact/{$params['id']}");
            return;
        }
        \View::Redirect("/admin/contact");
    }

    public function getContacts()
    {
        $filter = [
            'naam' => $_POST['naam'] ?? '',
            'email' => $_POST['email'] ?? '',
            'bestuurslid_id' => $_POST['bestuurslid_id'] ?? '',
            'trashed' => $_POST['trashed'] ?? '',
        ];
        $draw = intval($_POST['draw'] ?? 1);
        $start = intval($_POST['start'] ?? 0);
        $length = intval($_POST['length'] ?? 25);
        $result = $this->service->datatable($filter, $start, $length, $draw);
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
