<?php

namespace App\Controllers;

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

    public function store() {
        //TODO: Implement some validation
        $post = $this->service->create($_POST);
        return \View::Redirect("/admin/coaches/{$post['id']}");
    }

    public function edit(array $params) {
        $post = $this->service->get(intval($params["id"]));
        return \View::View("admin.coaches.edit", 'Wijzig coach', $post);
    }

    public function update() {
        //TODO: Implement some validation
        $post = $this->service->update(intval($_POST['id']), $_POST);
        return \View::Redirect("/admin/coaches/{$post['id']}");
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