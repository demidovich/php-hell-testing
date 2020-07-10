<?php

namespace App;

class User
{
    private static $instance;

    private $id;
    private $name;

    private function __construct()
    {
        $this->setFields();
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function setFields()
    {
        // Eeehhhaaaaa

        if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
            $this->id   = $_SESSION['user_id'];
            $this->name = $_SESSION['user_name'];
        }
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function isAuth(): bool
    {
        return ($this->id);
    }
}