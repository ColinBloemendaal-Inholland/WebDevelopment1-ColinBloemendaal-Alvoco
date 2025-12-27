<?php

namespace App\Controllers;

use App\Models\Requests\BestuursledenStoreRequest;
use App\Models\Requests\BestuursledenUpdateRequest;
use App\Services\BestuursledenServices;
use App\Services\LedenServices;

class BestuursledenController extends BaseController implements IController {
    private BestuursledenServices $service;
    private LedenServices $ledenServices;
    public function __construct()
    {
        $this->service = new BestuursledenServices();
        $this->ledenServices = new LedenServices();
    }

    public function index() {
        $data = $this->service->getAll();
        \View::View("bestuursleden.index", 'Bestuursleden', ['bestuursleden' => $data]);
    }

    public function show(array $params) {
        $data = $this->service->get(intval($params['id']));
        \View::View('bestuursleden.post', $data['Title'], $data);
    }

    public function Create() {
        $leden = $this->service->getAllWithNoCurrentBestuursleden();
        \View::View('admin.bestuursleden.create', 'Bestuursleden aanmaken', ['leden' => $leden]);
    }

    public function store()
    {
        try {
            $validated = new BestuursledenStoreRequest($_POST)->validate();
            $post = $this->service->create($validated);
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect("/admin/bestuursleden/create");
        }
        \View::Redirect("/admin/bestuursleden/{$post['id']}");
    }

    public function edit(array $params) {
        $post = $this->service->get(intval($params["id"]));
        $leden = $this->ledenServices->getAll();
        \View::View("admin.bestuursleden.edit", 'Wijzig bestuurslid', ['bestuurslid'=> $post, 'leden' => $leden]);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new BestuursledenUpdateRequest($_POST)->validate();
            $bestuurslid = $this->service->update($id, $validated);
            \View::Redirect("/admin/bestuursleden/{$bestuurslid->id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect("/admin/bestuursleden/{$id}");
        }
    }

    public function delete(array $params) {
        $post = $this->service->delete(intval($params["id"]));
        if(!$post) {
            \View::Redirect("/admin/bestuursleden/{$params["id"]}");
            return;
        }
        \View::Redirect("/admin/bestuursleden");
    }

    public function destroy(array $params) {
        $post = $this->service->destroy(intval($params["id"]));
        if(!$post) {
            \View::Redirect("/admin/bestuursleden/{$params["id"]}");
            return;
        }
        \View::Redirect("/admin/bestuursleden");
    }
}
