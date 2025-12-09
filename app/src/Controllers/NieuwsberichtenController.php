<?php 

namespace App\Controllers;

use App\Services\NieuwsberichtenServices;

class NieuwsberichtenController extends BaseController implements IController {
    private NieuwsberichtenServices $service;
    public function __construct(?NieuwsberichtenServices $service = null) {
        $this->service = $service ?? new NieuwsberichtenServices();
    }

    public function index(): void {
        $data = $this->service->getAll();
        return \View::View("nieuwsberichten.index", 'Nieuwsberichten', ['nieuwsberichten' => $data]);
    }
    public function show(array $params): void {
        $data = $this->service->get(intval($params['id']));
        return \View::View('nieuwsberichten.post', $data['Titl'], $data);
    }
    public function Create(): void {
        return \View::View('admin.nieuwsberichten.create', 'Niewsbericht aanmaken');
    }
    public function store(): void {
        //TODO: Implement some validation
        $post = $this->service->create($_POST);
        return \View::Redirect("/admin/nieuwsberichten/{$post['id']}");
    }

    public function edit(array $params): void {
        $post = $this->service->get(intval($params["id"]));
        return \View::View("admin.nieuwsberichten.edit",'Wijzig nieuwsbericht', $post);
    }

    public function update(): void {
        //TODO: Implement some validation
        $post = $this->service->update(intval($_POST['id']), $_POST);
        return \View::Redirect("/admin/nieuwsberichten/{$post['id']}");
    }

    public function delete(array $params): void {
        $post = $this->service->delete(intval($params["id"]));
        return \View::Redirect("/admin/nieuwsberichten");
    }

    public function destroy(array $params): void {
        $post = $this->service->destroy(intval($params["id"]));
        return \View::Redirect("/admin/nieuwsberichten");
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

        $result = $this->service->getNieuwsberichtenForDatatable($filter, $start, $length, $draw);

        header('Content-Type: application/json');
        echo json_encode($result);
        return;
    }
}