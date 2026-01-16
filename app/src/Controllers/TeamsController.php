<?php

namespace App\Controllers;

use App\Models\Requests\TeamsStoreRequest;
use App\Models\Requests\TeamsUpdateRequest;
use App\Models\Requests\TeamUpdateByCoachRequest;
use App\Services\CoachesServices;
use App\Services\SeizoenenServices;
use App\Services\SpelersServices;
use App\Services\TeamsServices;
use App\Services\TrainersServices;
use Exception;
use App\Helpers\UploadHelper;

class TeamsController extends BaseController implements IController
{
    private TeamsServices $service;
    private SpelersServices $spelersServices;
    private CoachesServices $coachesServices;
    private TrainersServices $trainersServices;
    private SeizoenenServices $seizoenenServices;
    private array $categories = ['Heren', 'Dames', 'Jongens', 'Meisjes', 'Gemengd'];
    private array $classes = [ 'Eredivisie', 'Topdivisie', '1e divisie', '2e divisie', '3e divisie', '1e klasse', '2e klasse', '3e klasse'];
    public function __construct()
    {
        $this->service = new TeamsServices();
        $this->spelersServices = new SpelersServices();
        $this->coachesServices = new CoachesServices();
        $this->trainersServices = new TrainersServices();
        $this->seizoenenServices = new SeizoenenServices();
    }

    public function index()
    {
        $seizoenen = $this->seizoenenServices->getAll();
        $season = null;
        if (!empty($_GET['seizoen_id'])) {
            $season = $_GET['seizoen_id'] ?? null;
        }
        $teams = $this->service->getAllByCategory($season);
        \View::view("teams.index", 'Teams', ['teams' => $teams, 'seizoenen' => $seizoenen]);
    }

    public function show(array $params)
    {
        $team = $this->service->getTeamWithRelations(intval($params['id']));
        \View::view('teams.post', $team->name, ['team' => $team]);
    }

    public function Create()
    {
        $seizoenen = $this->seizoenenServices->getAll();
        $spelers = $this->spelersServices->getAll();
        $coaches = $this->coachesServices->getAvailableCoaches();
        $trainers = $this->trainersServices->getAll();
        \View::view('admin.teams.create', 'Team aanmaken', [
            'spelers' => $spelers,
            'coaches' => $coaches,
            'trainers' => $trainers,
            'seizoenen' => $seizoenen,
            'categories' => $this->categories,
            'classes' => $this->classes
        ]);
    }

    public function store()
    {
        try {
            $validated = new TeamsStoreRequest($_POST)->validate();
            if (isset($_FILES['picture'])) {
                $imagePath = UploadHelper::uploadImage($_FILES['picture']);
                if ($imagePath) {
                    $validated['picture'] = $imagePath;
                }
            }
            $post = $this->service->create($validated);
        } catch (Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::redirect("/admin/teams/create");
        }
        \View::redirect("/admin/teams/{$post['id']}");
    }

    public function edit(array $params)
    {
        $seizoenen = $this->seizoenenServices->getAll();
        $team = $this->service->getWithCoach(intval($params["id"]));
        $coaches = $this->coachesServices->getAvailableCoaches($team->coaches->pluck('id')->toArray());
        $spelers = $this->spelersServices->getAll();
        $trainers = $this->trainersServices->getAll();
        \View::view("admin.teams.edit", 'Wijzig team', [
            'team' => $team,
            'coaches' => $coaches,
            'spelers' => $spelers,
            'trainers' => $trainers,
            'seizoenen' => $seizoenen,
            'categories' => $this->categories,
            'classes' => $this->classes
        ]);
    }

    public function update(array $params)
    {
        $validated = [];
        $id = intval($params['id']);
        try {
            $validated = new TeamsUpdateRequest($_POST)->validate();
            if (isset($_FILES['picture'])) {
                $imagePath = UploadHelper::uploadImage($_FILES['picture']);
                if ($imagePath) {
                    $validated['picture'] = $imagePath;
                }
            }
            $this->service->update($id, $validated);
            \View::redirect("/admin/teams/{$id}");
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $errors = json_decode($msg, true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::redirect("/admin/teams/{$id}/edit");
        }
    }

    public function delete(array $params)
    {
        $post = $this->service->delete(intval($params["id"]));
        if (!$post) {
            \View::redirect("/admin/teams/{$params["id"]}");
        }
        \View::redirect("/admin/teams");
    }

    public function destroy(array $params)
    {
        $post = $this->service->destroy(intval($params["id"]));
        if (!$post) {
            \View::redirect("/admin/teams/{$params["id"]}");
        }
        \View::redirect("/admin/teams");
    }

    public function getTeams()
    {
        $filter = [
            'name' => $_POST['name'] ?? '',
            'trashed' => $_POST['trashed'] ?? '',
            'seizoen_id' => $_POST['seizoen_id'] ?? ''
        ];

        $draw = intval($_POST['draw'] ?? 1);
        $start = intval($_POST['start'] ?? 0);
        $length = intval($_POST['length'] ?? 25);

        $result = $this->service->datatable($filter, $start, $length, $draw);

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function editByCoach()
    {
        $user = \Auth::user();
        $team = $this->service->getByCoach($user->id);
        $spelers = $this->spelersServices->getAll();
        $trainers = $this->trainersServices->getAll();
        \View::view('coach.team.edit', 'Team bewerken', [
            'team' => $team,
            'spelers' => $spelers,
            'trainers' => $trainers
        ]);
    }

    public function updateByCoach(array $params)
    {
        $teamId = intval($params['id']);
        $team = $this->service->getTeamWithRelations($teamId);
        if (!$team) {
            \View::redirect("/profile");
        }
        try {
            $validated = new TeamUpdateByCoachRequest($_POST)->validate();
            $this->service->updateTrainersAndSpelers($teamId, $validated['spelers'], $validated['trainers']);
            \View::redirect("/profile");
        } catch (Exception $e) {
            $_SESSION['form_errors'] = $e->getMessage();
            \View::redirect("/profile/teams/{$teamId}/edit");
        }
    }
}

