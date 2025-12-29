<?php 

class Session {
    public static function Start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function End() {
        if (session_status() == PHP_SESSION_NONE) {
            session_destroy();
        }
    }
}
