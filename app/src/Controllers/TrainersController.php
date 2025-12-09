<?php

namespace App\Controllers;

use App\Services\TrainersServices;

class TrainersController extends BaseController implements IController {
    private TrainersServices $service;
    public function __construct(?TrainersServices $ledenService = null)
    {
        $this->service = $ledenService ?? new TrainersServices();
    }

    public function index(): void {
        $data = $this->service->getAll();
        return \View::View("trainers.index", 'Trainers', ['trainers' => $data]);
    }

    public function show(array $params): void {
        $data = $this->service->get(intval($params['id']));
        return \View::View('trainers.post', $data['Title'], $data);
    }

    public function Create(): void {
        return \View::View('admin.trainers.create', 'Trainer aanmaken');
    }

    public function store(): void {
        //TODO: Implement some validation
        $post = $this->service->create($_POST);
        return \View::Redirect("/admin/trainers/{$post['id']}");
    }

    public function edit(array $params): void {
        $post = $this->service->get(intval($params["id"]));
        return \View::View("admin.trainers.edit", 'Wijzig trainer', $post);
    }

    public function update(): void {
        //TODO: Implement some validation
        $post = $this->service->update(intval($_POST['id']), $_POST);
        return \View::Redirect("/admin/trainers/{$post['id']}");
    }

    public function delete(array $params): void {
        $post = $this->service->delete(intval($params["id"]));
        return \View::Redirect("/admin/trainers");
    }

    public function destroy(array $params): void {
        $post = $this->service->destroy(intval($params["id"]));
        return \View::Redirect("/admin/trainers");
    }
}