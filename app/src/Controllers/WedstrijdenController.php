<?php

namespace App\Controllers;

use App\Models\Requests\WedstrijdenStoreRequest;
use App\Models\Requests\WedstrijdenUpdateRequest;
use App\Services\WedstrijdenServices;

class WedstrijdenController extends BaseController implements IController
{
    private WedstrijdenServices $service;
    public function __construct(?WedstrijdenServices $ledenService = null)
    {
        $this->service = $ledenService ?? new WedstrijdenServices();
    }

    public function index()
    {
        $data = $this->service->getAll();
        \View::View("wedstrijden.index", 'Wedstrijden', ['wedstrijden' => $data]);
    }

    public function show(array $params)
    {
        $data = $this->service->get(intval($params['id']));
        \View::View('wedstrijden.post', $data['Title'], $data);
    }

    public function Create()
    {
        \View::View('admin.wedstrijden.create', 'Wedstrijden aanmaken');
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
            \View::Redirect("/admin/wedstrijden/create");
        }
        \View::Redirect("/admin/wedstrijden/{$post['id']}");
    }

    public function edit(array $params)
    {
        $post = $this->service->get(intval($params["id"]));
        \View::View("admin.wedstrijden.edit", 'Wijzig bestuurslid', $post);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new WedstrijdenUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            \View::Redirect("/admin/wedstrijden/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect("/admin/wedstrijden/{$id}");
        }
    }

    public function delete(array $params)
    {
        $post = $this->service->delete(intval($params["id"]));
        if(!$post) {
            \View::Redirect("/admin/wedstrijden/{$params["id"]}");
            return;
        }
        \View::Redirect("/admin/wedstrijden");
    }

    public function destroy(array $params)
    {
        $post = $this->service->destroy(intval($params["id"]));
        if(!$post) {
            \View::Redirect("/admin/wedstrijden/{$params["id"]}");
            return;
        }
        \View::Redirect("/admin/wedstrijden");
    }

    public function getWedstrijden()
    {
        $filters = [
            'homeTeam' => $_POST['homeTeam'] ?? '',
            'awayTeam' => $_POST['awayTeam'] ?? '',
            'score' => $_POST['score'] ?? '',
        ];
        $draw = intval($_POST['draw'] ?? 1);
        $start = intval($_POST['start'] ?? 0);
        $length = intval($_POST['length'] ?? 25);
        
        $result = $this->service->datatable($filters, $start, $length, $draw);
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
