<?php

class User {
    protected $id;
    protected $username;
    protected $password;
    protected $email;
    protected $role;

    public function __construct($id, $username, $password, $email, $role) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
    }
}

?>