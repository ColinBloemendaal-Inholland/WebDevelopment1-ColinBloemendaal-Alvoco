<?php

namespace App\Controllers;

use App\Models\Requests\SeizoenenStoreRequest;
use App\Models\Requests\SeizoenenUpdateRequest;
use App\Services\SeizoenenServices;


class SeizoenenController extends BaseController implements IController
{
    private SeizoenenServices $service;

    public function __construct()
    {
        $this->service = new SeizoenenServices();
    }

    public function index()
    {
        $seizoenen = $this->service->getAll();
        \View::view("seizoenen.index", 'Seizoenen', ['seizoenen' => $seizoenen]);
    }
    public function show(array $params)
    {
        $seizoen = $this->service->get(intval($params['id']));
        \View::view('seizoenen.post', $seizoen->title, ['seizoen' => $seizoen]);
    }

    public function create()
    {
        \View::view('admin.seizoenen.create', 'Nieuw Seizoen');
    }

    public function store()
    {
        try {
            $_POST['is_current'] = isset($_POST['is_current']) ? 1 : 0;
            $validated = new SeizoenenStoreRequest($_POST)->validate();
            $post = $this->service->create($validated);
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::redirect("/admin/seizoenen/create");
        }
        \View::redirect("/admin/seizoenen/{$post['id']}");
    }

    public function edit(array $params)
    {
        $seizoen = $this->service->get(intval($params['id']));
        \View::view('admin.seizoenen.edit', 'Seizoen bewerken', ['seizoen' => $seizoen]);
    }

    public function update(array $params)
    {
        try {
            $_POST['is_current'] = isset($_POST['is_current']) ? 1 : 0;
            $validated = new SeizoenenUpdateRequest($_POST)->validate();
            $post = $this->service->update(intval($params['id']), $validated);
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::redirect("/admin/seizoenen/{$params['id']}/edit");
        }
        \View::redirect("/admin/seizoenen/{$post->id}");
    }

    public function delete(array $params)
    {
        $post = $this->service->delete(intval($params["id"]));
        if (!$post) {
            \View::redirect("/admin/seizoenen/{$params["id"]}");
            return;
        }
        \View::redirect("/admin/seizoenen");
    }

    public function destroy(array $params)
    {
        $post = $this->service->destroy(intval($params["id"]));
        if (!$post) {
            \View::redirect("/admin/seizoenen/{$params["id"]}");
            return;
        }
        \View::redirect("/admin/seizoenen");
    }

    public function getSeizoenen()
    {
        $filter = [
            'title' => $_POST['title'] ?? null,
            'trashed' => $_POST['trashed'] ?? null
        ];

        $draw = intval($_POST['draw'] ?? 1);
        $start = intval($_POST['start'] ?? 0);
        $length = intval($_POST['length'] ?? 25);

        $result = $this->service->datatable($filter, $start, $length, $draw);

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
