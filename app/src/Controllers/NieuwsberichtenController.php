<?php

namespace App\Controllers;

use App\Models\Requests\NieuwsberichtenStoreRequest;
use App\Models\Requests\NieuwsberichtenUpdateRequest;
use App\Services\BestuursledenServices;
use App\Services\NieuwsberichtenServices;

class NieuwsberichtenController extends BaseController implements IController {
    private NieuwsberichtenServices $service;
    private BestuursledenServices $bestuursledenServices;
    public function __construct() {
        $this->service =  new NieuwsberichtenServices();
        $this->bestuursledenServices = new BestuursledenServices();
    }

    public function index() {
        $data = $this->service->getAll();
        \View::View("nieuwsberichten.index", 'Nieuwsberichten', ['nieuwsberichten' => $data]);
    }
    public function show(array $params) {
        $data = $this->service->get(intval($params['id']));
        \View::View('nieuwsberichten.post', $data['Titl'], $data);
    }
    public function create() {
        $bestuursleden = $this->bestuursledenServices->getAll();
        \View::View('admin.nieuwsberichten.create', 'Niewsbericht aanmaken', ['bestuursleden' => $bestuursleden]);
    }
    public function store()
    {
        try {
            $validated = new NieuwsberichtenStoreRequest($_POST)->validate();
            $post = $this->service->create($validated);
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect("/admin/nieuwsberichten/create");
        }
        \View::Redirect("/admin/nieuwsberichten/{$post['id']}");
    }

    public function edit(array $params) {
        $nieuwsbericht = $this->service->get(intval($params["id"]));
        $bestuursleden = $this->bestuursledenServices->getAll();
        \View::View("admin.nieuwsberichten.edit", 'Wijzig bestuurslid', [
            'nieuwsbericht' => $nieuwsbericht,
            'bestuursleden' => $bestuursleden
        ]);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new NieuwsberichtenUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            \View::Redirect("/admin/nieuwsberichten/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect("/admin/nieuwsberichten/{$id}");
        }
    }

    public function delete(array $params) {
        $post = $this->service->delete(intval($params["id"]));
        if(!$post) {
            \View::Redirect("/admin/nieuwsberichten/{$params["id"]}");
            return;
        }
        \View::Redirect("/admin/nieuwsberichten");
    }

    public function destroy(array $params) {
        $post = $this->service->destroy(intval($params["id"]));
        if(!$post) {
            \View::Redirect("/admin/nieuwsberichten/{$params["id"]}");
            return;
        }
        \View::Redirect("/admin/nieuwsberichten");
    }

    //TODO: Place in a API Controller?
    public function GetNieuwsberichten() {
        $filter = [
            'authur'=> $_POST['authur'] ?? '',
            'title'=> $_POST['title'] ??'',
            'message'=> $_POST['message'] ??'',
            'dateFrom'=> $_POST['dateFrom'] ??'',
            'dateTill'=> $_POST['dateTill'] ??'',
            'orderby' => $_POST['order'][0]['column'] ?? 0,
            'orderDir' => $_POST['order'][0]['dir'] ?? 'asc',
        ];

        $draw = $_POST['draw'] ?? 1;
        $start = $_POST['start'] ?? 0;
        $length = $_POST['length'] ?? 25;

        $result = $this->service->datatable($filter, $start, $length, $draw);

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
