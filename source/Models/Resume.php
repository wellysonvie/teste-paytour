<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Resume extends DataLayer
{
    public function __construct()
    {
        parent::__construct("resumes", []);
    }

    public function add($name, $email, $phone, $role, $education, $observation, $file): Resume
    {
        if (!$email) {
            alert('E-mail inválido!', 'danger');
            return null;
        }

        if (!$education || $education <= 0 || $education > 7) {
            alert('Nível de escolaridade inválido!', 'danger');
            return null;
        }

        if (empty($name) || empty($phone) || empty($role)) {
            alert('Os campos: nome, telefone e cargo devem ser preenchidos!', 'danger');
            return null;
        }

        $this->name = trim($name);
        $this->email = trim($email);
        $this->phone = trim($phone);
        $this->role = trim($role);
        $this->education = trim($education);
        $this->observation = trim($observation);
        $this->file = $file;
        $this->ip = $_SERVER["REMOTE_ADDR"];
        $this->save();

        return $this;
    }
}
