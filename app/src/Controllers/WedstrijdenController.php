<?php

namespace App\Controllers;

use App\Models\Requests\WedstrijdenStoreRequest;
use App\Models\Requests\WedstrijdenUpdateRequest;
use App\Services\WedstrijdenServices;

class WedstrijdenController extends BaseController implements IController {
    private WedstrijdenServices $service;
    public function __construct(?WedstrijdenServices $ledenService = null)
    {
        $this->service = $ledenService ?? new WedstrijdenServices();
    }

    public function index() {
        $data = $this->service->getAll();
        return \View::View("wedstrijden.index", 'wedstrijden', ['wedstrijden' => $data]);
    }

    public function show(array $params) {
        $data = $this->service->get(intval($params['id']));
        return \View::View('wedstrijden.post', $data['Title'], $data);
    }

    public function Create() {
        return \View::View('admin.wedstrijden.create', 'wedstrijden aanmaken');
    }

    public function store()
    {
        try {
            $validated = new WedstrijdenStoreRequest($_POST)->validate();
            $post = $this->service->create($validated);
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            return \View::Redirect("/admin/wedstrijden/create");
        }
        return \View::Redirect("/admin/wedstrijden/{$post['id']}");
    }

    public function edit(array $params) {
        $post = $this->service->get(intval($params["id"]));
        return \View::View("admin.wedstrijden.edit", 'Wijzig bestuurslid', $post);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new WedstrijdenUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            return \View::Redirect("/admin/wedstrijden/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            return \View::Redirect("/admin/wedstrijden/{$id}");
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