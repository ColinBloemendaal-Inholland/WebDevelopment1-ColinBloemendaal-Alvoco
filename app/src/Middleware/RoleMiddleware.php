<?php

namespace App\Middleware;

use App\Models\Leden;

class RoleMiddleware {
    /**
     * Check if the current user has the required role(s)
     * @param array|string $roles
     * @return bool
     */
    public static function handle($roles): bool {
        $result = false;
        if (\Auth::isLoggedIn()) {
            $userId = \Auth::id();
            $user = Leden::find($userId);
            if ($user) {
                if (is_array($roles)) {
                    $result = $user->hasAnyRole($roles);
                } else {
                    $result = $user->hasRole($roles);
                }
            }
        }
        return $result;
    }
}
