<?php

namespace Source\Controllers;

class ResumeController
{
    public function __construct($router)
    {
        $this->router = $router;
    }

    public function create()
    {
        view('resume/create.php', ['action' => 'store']);
    }
}
