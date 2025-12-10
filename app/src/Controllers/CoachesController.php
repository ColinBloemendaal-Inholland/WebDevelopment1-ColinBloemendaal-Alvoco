<?php

namespace App\Controllers;

use App\Models\Requests\CoachesStoreRequest;
use App\Models\Requests\CoachesUpdateRequest;
use App\Services\CoachesServices;

class CoachesController extends BaseController implements IController {
    private CoachesServices $service;
    public function __construct(?CoachesServices $ledenService = null)
    {
        $this->service = $ledenService ?? new CoachesServices();
    }

    public function index() {
        $data = $this->service->getAll();
        return \View::View("coaches.index", 'Coaches', ['coaches' => $data]);
    }

    public function show(array $params) {
        $data = $this->service->get(intval($params['id']));
        return \View::View('coaches.post', $data['Title'], $data);
    }

    public function Create() {
        return \View::View('admin.coaches.create', 'Coach aanmaken');
    }

    public function store()
    {
        try {
            $validated = new CoachesStoreRequest($_POST)->validate();
            $post = $this->service->create($validated);
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            return \View::Redirect("/admin/coaches/create");
        }
        return \View::Redirect("/admin/coaches/{$post['id']}");
    }

    public function edit(array $params) {
        $post = $this->service->get(intval($params["id"]));
        return \View::View("admin.coaches.edit", 'Wijzig bestuurslid', $post);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new CoachesUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            return \View::Redirect("/admin/coaches/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            return \View::Redirect("/admin/coaches/{$id}");
        }
    }

    public function delete(array $params) {
        $post = $this->service->delete(intval($params["id"]));
        return \View::Redirect("/admin/coaches");
    }

    public function destroy(array $params) {
        $post = $this->service->destroy(intval($params["id"]));
        return \View::Redirect("/admin/coaches");
    }
}