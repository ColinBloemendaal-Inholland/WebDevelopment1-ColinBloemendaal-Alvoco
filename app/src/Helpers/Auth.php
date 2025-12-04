<?php 

namespace App\Helpers;

use App\Models\Leden;
use App\Repositories\LedenRepository;

class Auth {
    private $repository;

    public function __construct(LedenRepository $repository) {
        $this->repository = $repository;
    }

    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Lets the user login
     */
    public static function login(string $email, string $password) {
        self::start();

        $user = self::$repository->getByEmail($email);
        if(!$user){
            return false;
        }

        if (!password_verify($password, $user->password)) {
            return false;
        }
        $_SESSION['user_id'] = $user->id;
        $_SESSION['email'] = $user->email;
        return true;
    }

    /**
     * Lets the user logout
     */
    public static function logout() {
        self::start();
        session_destroy();
    }

    /**
     * Check if user is logged in
     */
    public static function isLoggedIn() {
        self::start();
        return isset($_SESSION['user_id']);
    }

    /**
     * Retrieve the user which is logged in
     */
    public static function user() {
        self::start();
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        return self::$repository->getById($_SESSION['user_id']);
    }

    /**
     * get the users id
     */
    public static function id() {
        self::start();
        return $_SESSION['user_id'] ?? null;
    }

    /**
     * Get roles of logged in user
     */
    public static function roles() {
        $user = self::user();
        if (!$user) {
            return [];
        }
        return $user->getRoles();
    }

    public static function hasRole($role) {
        $user = self::user();
        if (!$user) {
            return false;
        }
        return $user->hasRole($role);
    }

    public static function hasRoles(array $roles): bool {
        $user = self::user();
        if (!$user) {
            return false;
        }
        return $user->hasAnyRole($roles);
    }




    public static function requireRole(array $roles) {
        if (!isset($_SESSION['user_id'])) {
            http_response_code(403);
            exit('Forbidden: not logged in');
        }

        $user = new LedenRepository(new Leden())->getByEmail($_SESSION['email']);
        if (!$user || !$user->hasAnyRole($roles)) {
            http_response_code(403);
            exit('Forbidden: insufficient permissions');
        }
    }
}