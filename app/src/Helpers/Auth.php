<?php

use App\Models\Leden;
use App\Repositories\LedenRepository;
use App\Services\LedenServices;

class Auth {

    /**
     * Lets the user login with email and password
     */
    public static function login(string $email, int $id) {
        Session::start();
        $_SESSION['user_id'] = $id;
        $_SESSION['email'] = $email;
        $_SESSION['logged_in_at'] = time();
        return true;
    }

    /**
     * Lets the user logout
     */
    public static function logout() {
        Session::start();
        unset($_SESSION['user_id']);
        unset($_SESSION['email']);
        unset($_SESSION['logged_in_at']);
        Session::end();
    }

    /**
     * Check if user is logged in
     */
    public static function isLoggedIn() {
        Session::start();
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }

    /**
     * Retrieve the user which is logged in
     */
    public static function user() {
        Session::start();
        if(!self::isLoggedIn()) {
            return null;
        }
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
     * Get user email
     */
    public static function email() {
        Session::start();
        return $_SESSION['email'] ?? null;
    }

    /**
     * Hash a password using bcrypt
     */
    public static function hashPassword(string $password): string {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    /**
     * Verify a password against a hash
     */
    public static function verifyPassword(string $password, string $hash): bool {
        return password_verify($password, $hash);
    }

}
