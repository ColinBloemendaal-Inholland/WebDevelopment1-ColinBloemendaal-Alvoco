<?php

namespace App\Controllers;

use App\Models\Requests\SpelersStoreRequest;
use App\Models\Requests\SpelersUpdateRequest;
use App\Services\LedenServices;
use App\Services\SpelersServices;
use App\Services\TeamsServices;

class SpelersController extends BaseController implements IController {
    private SpelersServices $service;
    private LedenServices $ledenServices;
    private TeamsServices $teamsServices;
    public function __construct()
    {
        $this->service = new SpelersServices();
        $this->ledenServices = new LedenServices();
        $this->teamsServices = new TeamsServices();
    }

    public function index() {
        $data = $this->service->getAll();
        \View::View("spelers.index", 'Spelers', data: ['spelers' => $data]);
    }

    public function show(array $params) {
        $data = $this->service->get(intval($params['id']));
        \View::View('spelers.post', $data['Title'], $data);
    }

    public function Create() {
        $leden = $this->ledenServices->getAllWithNoSpeler();
        $teams = $this->teamsServices->getAll();
        \View::View('admin.spelers.create', 'Speler aanmaken', data: ['leden' => $leden, 'teams' => $teams]);
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
            \View::Redirect("/admin/spelers/create");
        }
        \View::Redirect("/admin/spelers/{$post['id']}");
    }

    public function edit(array $params) {
        $speler = $this->service->get(intval($params["id"]));
        $leden = $this->ledenServices->getAllWithNoSpeler([$speler['Leden_id']]);
        $teams = $this->teamsServices->getAll();
        \View::View("admin.spelers.edit", 'Wijzig bestuurslid', ['speler'=> $speler, 'leden' => $leden, 'teams' => $teams]);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new SpelersUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            \View::Redirect("/admin/spelers/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect("/admin/spelers/{$id}");
        }
    }

    public function delete(array $params) {
        $post = $this->service->delete(intval($params["id"]));
        if(!$post) {
            \View::Redirect("/admin/spelers/{$params["id"]}");
            return;
        }
        \View::Redirect("/admin/spelers");
    }

    public function destroy(array $params) {
        $post = $this->service->destroy(intval($params["id"]));
        if(!$post) {
            \View::Redirect("/admin/spelers/{$params["id"]}");
            return;
        }
        \View::Redirect("/admin/spelers");
    }

    public function getSpelers() {
        $filter = [
            'name' => $_POST['name'] ?? '',
            'team' => $_POST['team'] ?? ''
        ];

        $draw = intval($_POST['draw'] ?? 1);
        $start = intval($_POST['start'] ?? 0);
        $length = intval($_POST['length'] ?? 25);

        $result = $this->service->datatable($filter, $start, $length, $draw);
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
