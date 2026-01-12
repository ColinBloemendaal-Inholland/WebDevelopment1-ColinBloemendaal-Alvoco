<?php

class Session {
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function end() {
        if (session_status() == PHP_SESSION_NONE) {
            session_destroy();
        }
    }
}
