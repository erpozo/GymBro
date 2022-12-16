<?php

namespace Gymbro\Classes;

class User {
    private int $id;
    private string $username;
    private string $email;
    private string $pw;

    public function __construct(int $id, string $username, string $email, string $pw) {
        $this -> id = $id;
        $this -> username = $username;
        $this -> email = $email;
        $this -> pw = $pw;
    }

    public function getId(): int {
        return $this -> id;
    }

    public function getUsername(): string {
        return $this -> username;
    }

    public function getEmail(): string {
        return $this -> email;
    }

    public function getPw(): string {
        return $this -> pw;
    }
}

?>