<?php

namespace App\Controllers;

use App\Models\Requests\BestuursledenStoreRequest;
use App\Models\Requests\BestuursledenUpdateRequest;
use App\Services\BestuursledenServices;
use App\Services\LedenServices;

class BestuursledenController extends BaseController implements IController {
    private BestuursledenServices $service;
    private LedenServices $ledenServices;
    public function __construct(?BestuursledenServices $service = null)
    {
        $this->service = new BestuursledenServices();
        $this->ledenServices = new LedenServices();
    }

    public function index() {
        $data = $this->service->getAll();
        return \View::View("bestuursleden.index", 'Bestuursleden', ['bestuursleden' => $data]);
    }

    public function show(array $params) {
        $data = $this->service->get(intval($params['id']));
        return \View::View('bestuursleden.post', $data['Title'], $data);
    }

    public function Create() {
        $leden = $this->service->getAllWithNoCurrentBestuursleden();
        return \View::View('admin.bestuursleden.create', 'Bestuursleden aanmaken', ['leden' => $leden]);
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
            return \View::Redirect("/admin/bestuursleden/create");
        }
        return \View::Redirect("/admin/bestuursleden/{$post['id']}");
    }

    public function edit(array $params) {
        $post = $this->service->get(intval($params["id"]));
        $leden = $this->ledenServices->getAll();
        return \View::View("admin.bestuursleden.edit", 'Wijzig bestuurslid', ['post'=> $post, 'leden' => $leden]);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new BestuursledenUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            return \View::Redirect("/admin/bestuursleden/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            return \View::Redirect("/admin/bestuursleden/{$id}");
        }
    }

    public function delete(array $params) {
        $post = $this->service->delete(intval($params["id"]));
        return \View::Redirect("/admin/bestuursleden");
    }

    public function destroy(array $params) {
        $post = $this->service->destroy(intval($params["id"]));
        return \View::Redirect("/admin/bestuursleden");
    }
}