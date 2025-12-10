<?php

namespace App\Controllers;

use App\Services\BestuursledenServices;

class BestuursledenController extends BaseController implements IController {
    private BestuursledenServices $service;
    public function __construct(?BestuursledenServices $service = null)
    {
        $this->service = $service ?? new BestuursledenServices();
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
        return \View::View('admin.bestuursleden.create', 'Bestuursleden aanmaken');
    }

    public function store() {
        //TODO: Implement some validation
        $post = $this->service->create($_POST);
        return \View::Redirect("/admin/bestuursleden/{$post['id']}");
    }

    public function edit(array $params) {
        $post = $this->service->get(intval($params["id"]));
        return \View::View("admin.bestuursleden.edit", 'Wijzig bestuurslid', $post);
    }

    public function update(array $params) {
        //TODO: Implement some validation
        $post = $this->service->update(intval($_POST['id']), $_POST);
        return \View::Redirect("/admin/bestuursleden/{$post['id']}");
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