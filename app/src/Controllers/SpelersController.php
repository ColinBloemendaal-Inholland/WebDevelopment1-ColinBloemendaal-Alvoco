<?php

namespace App\Controllers;

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

    public function store() {
        //TODO: Implement some validation
        $post = $this->service->create($_POST);
        return \View::Redirect("/admin/spelers/{$post['id']}");
    }

    public function edit(array $params) {
        $post = $this->service->get(intval($params["id"]));
        return \View::View("admin.spelers.edit", 'Wijzig speler', $post);
    }

    public function update() {
        //TODO: Implement some validation
        $post = $this->service->update(intval($_POST['id']), $_POST);
        return \View::Redirect("/admin/spelers/{$post['id']}");
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