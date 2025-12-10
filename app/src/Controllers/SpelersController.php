<?php

namespace App\Controllers;

use App\Models\Requests\SpelersStoreRequest;
use App\Models\Requests\SpelersUpdateRequest;
use App\Services\SpelersServices;

class SpelersController extends BaseController implements IController {
    private SpelersServices $service;
    public function __construct(?SpelersServices $service = null)
    {
        $this->service = $service ?? new SpelersServices();
    }

    public function index() {
        $data = $this->service->getAll();
        return \View::View("spelers.index", 'Spelers', data: ['spelers' => $data]);
    }

    public function show(array $params) {
        $data = $this->service->get(intval($params['id']));
        return \View::View('spelers.post', $data['Title'], $data);
    }

    public function Create() {
        return \View::View('admin.spelers.create', 'Speler aanmaken');
    }

    public function store()
    {
        try {
            $validated = new SpelersStoreRequest($_POST)->validate();
            $post = $this->service->create($validated);
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            return \View::Redirect("/admin/spelers/create");
        }
        return \View::Redirect("/admin/spelers/{$post['id']}");
    }

    public function edit(array $params) {
        $post = $this->service->get(intval($params["id"]));
        return \View::View("admin.spelers.edit", 'Wijzig bestuurslid', $post);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new SpelersUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            return \View::Redirect("/admin/spelers/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            return \View::Redirect("/admin/spelers/{$id}");
        }
    }

    public function delete(array $params) {
        $post = $this->service->delete(intval($params["id"]));
        return \View::Redirect("/admin/spelers");
    }

    public function destroy(array $params) {
        $post = $this->service->destroy(intval($params["id"]));
        return \View::Redirect("/admin/spelers");
    }
}