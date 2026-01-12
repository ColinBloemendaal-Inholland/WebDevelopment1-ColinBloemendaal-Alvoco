<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Models\Coaches;
use App\Models\Leden;
use App\Services\LedenServices;
use App\Models\Requests\LedenStoreRequest;
use App\Models\Requests\LedenUpdateRequest;
use App\Services\RolesServices;

class LedenController extends BaseController implements IController
{

    private RolesServices $rolenServices;
    private LedenServices $service;
    public function __construct(?LedenServices $ledenService = null, ?RolesServices $rolesServices = null)
    {
        $this->service = $ledenService ?? new LedenServices();
        $this->rolenServices = $rolesServices ?? new RolesServices();
    }

    public function index()
    {
        $data = $this->service->getAll();
        \View::view("leden.index", 'Leden', ['leden' => $data]);
    }
    public function show(array $params)
    {
        $data = $this->service->get(intval($params['id']));
        \View::view('leden.post', $data['Title'], $data);
    }
    public function Create()
    {
        $data = $this->rolenServices->getAll();
        \View::view('admin.leden.create', 'Lid aanmaken', ['rolen' => $data]);
    }
    public function store()
    {
        try {
            $validated = new LedenStoreRequest($_POST)->validate();
            $post = $this->service->create($validated);
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect("/admin/leden/create");
        }
        \View::Redirect("/admin/leden/{$post['id']}");
    }

    public function edit(array $params)
    {
        $post = $this->service->get(intval($params["id"]));
        $roles = $this->rolenServices->getAll();
        $roleIds = array_column($post->roles->toArray(), 'id') ?? [];

        \View::view("admin.leden.edit", 'Wijzig lid', [
            'lid' => $post,
            'rolen' => $roles,
            'roleIds' => $roleIds
        ]);
    }

    public function update(array $params)
    {
        $id = intval($params['id']);
        try {
            $validated = new LedenUpdateRequest($_POST)->validate();
            $this->service->update($id, $validated);
            \View::Redirect("/admin/leden/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect("/admin/leden/{$id}/edit");
        }
    }

    public function delete(array $params)
    {
        $id = intval($params["id"]);
        $post = $this->service->delete($id);
        if (!$post) {
            \View::Redirect("/admin/leden/{$id}");
        }
        \View::Redirect("/admin/leden");
    }

    public function destroy(array $params)
    {
        $id = intval($params["id"]);
        $post = $this->service->destroy($id);
        if (!$post) {
            \View::Redirect("/admin/leden/{$id}");
        }
        \View::Redirect("/admin/leden");
    }

    public function getLeden()
    {
        $filter = [
            'name' => $_POST['name'] ?? '',
            'adress' => $_POST['adress'] ?? '',
            'role' => isset($_POST['role']) ? (array) $_POST['role'] : [],
            'phone' => $_POST['phone'] ?? '',
            'trashed' => $_POST['trashed'] ?? 0,
        ];

        $draw = intval($_POST['draw'] ?? 1);
        $start = intval($_POST['start'] ?? 0);
        $length = intval($_POST['length'] ?? 25);

        $result = $this->service->datatable($filter, $start, $length, $draw);

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function loginView()
    {
        if (\Auth::isLoggedIn()) {
            \View::Redirect("/");
        }
        \View::view("leden.login", 'Inloggen');
    }

    public function login()
    {
        if (!isset($_POST["email"]) || !isset($_POST["password"])) {
            $_SESSION['form_errors'] = ['login' => 'Email en wachtwoord zijn verplicht.'];
            \View::Redirect("/login");
        }

        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['form_errors'] = ['email' => 'Ongeldig e-mailadres.'];
            \View::Redirect("/login");
        }

        $user = $this->service->getByEmail($email);
        if (!$user) {
            $_SESSION['form_errors'] = ['credentials' => 'E-mail of wachtwoord is onjuist.'];
            \View::Redirect("/login");
        }

        if (!\Auth::verifyPassword($password, $user->password)) {
            $_SESSION['form_errors'] = ['credentials' => 'E-mail of wachtwoord is onjuist.'];
            \View::Redirect("/login");
        }

        unset($_SESSION['form_errors']);
        \Auth::login($user->email, $user->id);
        \View::Redirect("/");
    }

    public function logout()
    {
        \Auth::logout();
        \View::Redirect("/");
    }

    public function dashboard()
    {
        $user = \Auth::user();
        $teamsCoached = [];
        if ($user?->hasRole('coach')) {
            $teamsCoached = $this->service->getTeamsCoachedWithDetails($user->id);
        }
        $teamsTrained = [];
        if($user?->hasRole('trainer')) {
            $teamsTrained = $this->service->getTeamsTrainedWithDetails($user->id);
        }
        $newsArticles = [];
        if($user?->hasRole('bestuurslid')) {
            $newsArticles = $this->service->getRecentNewsForBestuurslid($user->id);
        }
        \View::view('Dashboard.index', 'Dashboard', [
            'user' => $user,
            'teamsCoached' => $teamsCoached,
            'teamsTrained' => $teamsTrained,
            'recentNews' => $newsArticles
        ]);
    }

    public function editProfile() {

        $userId = \Auth::id();
        $user = $this->service->get($userId);
        if( !$user) {
            http_response_code(404);
            \View::view('Errors.404', '404');
            return;
        }
        \View::view('Dashboard.edit', 'Profiel bewerken', [ 'user' => $user ]);
    }

    public function updateProfile() {
        $userId = \Auth::id();
        $user = $this->service->get($userId);
        if (!$user) {
            http_response_code(404);
            \View::view('Errors.404', '404');
            return;
        }

        try {
            $validated = new LedenUpdateRequest($_POST)->validate();
            $this->service->updateProfile($userId, $validated);
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::Redirect('/profile/edit');
            return;
        }

        \View::Redirect('/profile');
    }
}
