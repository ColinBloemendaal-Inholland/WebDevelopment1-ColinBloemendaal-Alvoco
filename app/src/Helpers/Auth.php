<?php 

use App\Models\Leden;
use App\Repositories\LedenRepository;
use App\Services\LedenServices;

class Auth {

    /**
     * Lets the user login
     */
    public static function login(string $email, int $id) {
        Session::start();
        $_SESSION['user_id'] = $id;
        $_SESSION['email'] = $email;
        return true;
    }

    /**
     * Lets the user logout
     */
    public function logout() {
        Session::end();
    }

    /**
     * Check if user is logged in
     */
    public static function isLoggedIn() {
        Session::start();
        return isset($_SESSION['user_id']);
    }

    /**
     * Retrieve the user which is logged in
     */
    public static function user() {
        Session::start();
        if(!self::isLoggedIn())
            return 0;
        return (int) self::id();
    }

    /**
     * get the users id
     */
    public static function id() {
        Session::start();
        return $_SESSION['user_id'] ?? null;
    }

    /**
     * Get roles of logged in user
     */
    // public function roles() {
    //     $user = $this->user();
    //     if (!$user) {
    //         return [];
    //     }
    //     return $user->getRoles();
    // }

    // public function hasRole($role) {
    //     $user = $this->user();
    //     if (!$user) {
    //         return false;
    //     }
    //     return $user->hasRole($role);
    // }

    // public function hasRoles(array $roles): bool {
    //     $user = $this->user();
    //     if (!$user) {
    //         return false;
    //     }
    //     return $user->hasAnyRole($roles);
    // }

    // public static function requireRole(array $roles) {
    //     if (!isset($_SESSION['user_id'])) {
    //         http_response_code(403);
    //         exit('Forbidden: not logged in');
    //     }

    //     $user = new LedenRepository(new Leden())->getByEmail($_SESSION['email']);
    //     if (!$user || !$user->hasAnyRole($roles)) {
    //         http_response_code(403);
    //         exit('Forbidden: insufficient permissions');
    //     }
    // }
}
