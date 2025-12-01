<?php 

namespace App\Helers;

use App\Models\Leden;
use App\src\Repositories\LedenRepository;

class Auth  {
    public static function requireRole(array $roles) {
        if (!isset($_SESSION['user_id'])) {
            http_response_code(403);
            exit('Forbidden: not logged in');
        }

        $user = (new LedenRepository(new Leden()))->getByEmail($_SESSION['email']);
        if (!$user || !$user->hasAnyRole($roles)) {
            http_response_code(403);
            exit('Forbidden: insufficient permissions');
        }
    }
}