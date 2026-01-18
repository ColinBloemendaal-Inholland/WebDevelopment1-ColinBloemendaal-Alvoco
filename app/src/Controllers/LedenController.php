<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Models\Requests\LedenSelfUpdateRequest;
use App\Services\LedenServices;
use App\Models\Requests\LedenStoreRequest;
use App\Models\Requests\LedenUpdateRequest;
use App\Services\RolesServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        \View::view('leden.post', $data->fullname, $data);
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
            $validated['password'] = password_hash($validated['password'], PASSWORD_BCRYPT);
            unset($validated['password_confirm']);
            $post = $this->service->create($validated);
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::redirect("/admin/leden/create");
        }
        \View::redirect("/admin/leden/{$post['id']}");
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
            \View::redirect("/admin/leden/{$id}");
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::redirect("/admin/leden/{$id}/edit");
        }
    }

    public function delete(array $params)
    {
        $id = intval($params["id"]);
        $post = $this->service->delete($id);
        if (!$post) {
            \View::redirect("/admin/leden/{$id}");
        }
        \View::redirect("/admin/leden");
    }

    public function destroy(array $params)
    {
        $id = intval($params["id"]);
        $post = $this->service->destroy($id);
        if (!$post) {
            \View::redirect("/admin/leden/{$id}");
        }
        \View::redirect("/admin/leden");
    }

    public function destroyAll()
    {
        $result = $this->service->destroyAll();
        if($result) {
            \View::redirect('/admin/leden');
        }
        \View::redirect('/admin/leden/avg');
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
            \View::redirect("/");
        }
        \View::view("leden.login", 'Inloggen');
    }

    public function login()
    {
        if (!isset($_POST["email"]) || !isset($_POST["password"])) {
            $_SESSION['form_errors'] = ['login' => 'Email en wachtwoord zijn verplicht.'];
            \View::redirect("/login");
        }

        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['form_errors'] = ['email' => 'Ongeldig e-mailadres.'];
            \View::redirect("/login");
        }

        $user = $this->service->getByEmail($email);
        if (!$user) {
            $_SESSION['form_errors'] = ['credentials' => 'E-mail of wachtwoord is onjuist.'];
            \View::redirect("/login");
        }

        if (!\Auth::verifyPassword($password, $user->password)) {
            $_SESSION['form_errors'] = ['credentials' => 'E-mail of wachtwoord is onjuist.'];
            \View::redirect("/login");
        }

        unset($_SESSION['form_errors']);
        \Auth::login($user->email, $user->id);
        \View::redirect("/");
    }

    public function logout()
    {
        \Auth::logout();
        \View::redirect("/");
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
            throw new ModelNotFoundException("Lid niet gevonden.");
        }
        \View::view('dashboard.edit', 'Profiel bewerken', [ 'user' => $user ]);
    }

    public function updateProfile() {
        $userId = \Auth::id();
        $user = $this->service->get($userId);
        if (!$user) {
            throw new ModelNotFoundException("Lid niet gevonden.");
        }

        try {
            $validated = new LedenSelfUpdateRequest($_POST)->validate();
            $this->service->updateProfile($userId, $validated);
        } catch (\Exception $e) {
            $errors = json_decode($e->getMessage(), true);
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $_POST;
            \View::redirect('/profile/edit');
            return;
        }
        \View::redirect('/profile');
    }

    public function avg()
    {
        $result = $this->service->performAvgCheck();
        \View::view('admin.leden.avg', 'AVG Check Resultaten', ['results' => $result]);
    }

    public function deleteProfile() {
        $userId = \Auth::id();
        $user = $this->service->get($userId);
        if (!$user) {
            throw new ModelNotFoundException("Lid niet gevonden.");
        }

        $this->service->delete($userId);
        \Auth::logout();
        \View::redirect('/');
    }
}
