<?php

class SessionManager {
    public bool $debugMode;
    private const LOG_FILE = 'session_logs.log';

    public function auto_require() {
        require_once "SessionManagerClass.php";
    }

    public function __construct(bool $debugMode = true) {
        session_start();
        $this->auto_require();
        $this->debugMode = $debugMode;
    }
    
    public function addItemToSession($key, $value) {
        if (isset($_SESSION[$key])) {
            if ($this->debugMode) {
                $log = "[INFO]: Key {$key} already exists in session, changing it to given value: $value";
                file_put_contents(SessionManager::LOG_FILE, $log, FILE_APPEND);
            }
        }
        $_SESSION[$key] = $value;
    }

    public function getValueFromKey($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        if ($this->debugMode) {
            $log = "[INFO]: Key {$key} not found";
            file_put_contents(SessionManager::LOG_FILE, $log, FILE_APPEND);
        }
        return null;
    }

    public function resetSession() {
        session_unset();
    }

    public function __destruct() {
        session_destroy();
    }
}

?>