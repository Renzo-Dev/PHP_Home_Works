<?php

class User
{
    private string $name;
    private string $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function GetUser(): string
    {
        return $this->name . " — " . $this->email;
    }

    public function GetName(): string
    {
        return $this->name;
    }

    public function GetEmail(): string
    {
        return $this->email;
    }
}