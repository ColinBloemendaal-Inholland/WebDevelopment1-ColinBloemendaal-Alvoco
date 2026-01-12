<?php

namespace App\Controllers;

use App\Models\Requests\WedstrijdenStoreRequest;
use App\Models\Requests\WedstrijdenUpdateRequest;
use App\Services\TeamsServices;
use App\Services\WedstrijdenServices;

class WedstrijdenController extends BaseController implements IController
{
    private WedstrijdenServices $service;
    private TeamsServices $teamsServices;
    public function __construct(?WedstrijdenServices $ledenService = null)
    {
        $this->service = $ledenService ?? new WedstrijdenServices();
        $this->teamsServices = new TeamsServices();
    }

    public function index()
    {
        $wedstrijden = $this->service->getUpComingByDay(365, 50) ?? [];
        \View::view("wedstrijden.index", 'Wedstrijden', ['wedstrijdenByDate' => $wedstrijden]);
    }

    public function show(array $params)
    {
        $wedstrijd = $this->service->getWithTeamsAndDetails((int) $params['id']);
        if (!$wedstrijd) {
            // Optionally handle not found
            \View::redirect('/wedstrijden');
            return;
        }
        $title = $wedstrijd->hometeam->name . ' vs ' . $wedstrijd->awayTeam->name;
        \View::view('wedstrijden.post', $title, ['wedstrijd' => $wedstrijd]);
    }

    public function Create()
    {
        //TODO: Make an actual view for this - still empty
        $teams = $this->teamsServices->getAll();
        \View::view('admin.wedstrijden.create', 'Wedstrijden aanmaken', ['teams' => $teams]);
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
            \View::redirect("/admin/wedstrijden/create");
        }
        \View::redirect("/admin/wedstrijden/{$post['id']}");
    }

    public function edit(array $params)
    {
        $post = $this->service->getWithTeamsAndDetails(intval($params["id"]));
        $teams = $this->teamsServices->getAll();
        \View::view("admin.wedstrijden.edit", 'Wijzig bestuurslid', ['wedstrijd' => $post, 'teams' => $teams]);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new WedstrijdenUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            \View::redirect("/admin/wedstrijden/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::redirect("/admin/wedstrijden/{$id}/edit");
        }
    }

    public function delete(array $params)
    {
        $post = $this->service->delete(intval($params["id"]));
        if (!$post) {
            \View::redirect("/admin/wedstrijden/{$params["id"]}");
            return;
        }
        \View::redirect("/admin/wedstrijden");
    }

    public function destroy(array $params)
    {
        $post = $this->service->destroy(intval($params["id"]));
        if (!$post) {
            \View::redirect("/admin/wedstrijden/{$params["id"]}");
            return;
        }
        \View::redirect("/admin/wedstrijden");
    }

    public function getWedstrijden()
    {
        $filters = [
            'homeTeam' => $_POST['homeTeam'] ?? '',
            'awayTeam' => $_POST['awayTeam'] ?? '',
            'score' => $_POST['score'] ?? '',
            'trashed' => $_POST['trashed'] ?? '',
        ];
        $draw = intval($_POST['draw'] ?? 1);
        $start = intval($_POST['start'] ?? 0);
        $length = intval($_POST['length'] ?? 25);

        $result = $this->service->datatable($filters, $start, $length, $draw);
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
