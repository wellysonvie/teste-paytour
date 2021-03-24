<?php

namespace Source\Controllers;

use CoffeeCode\Uploader\File;
use Exception;
use Source\Models\Resume;

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

    public function store($data)
    {
        $name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRIPPED));
        $email = trim(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL));
        $phone = trim(filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRIPPED));
        $role = trim(filter_input(INPUT_POST, "role", FILTER_SANITIZE_STRIPPED));
        $education = trim(filter_input(INPUT_POST, "education", FILTER_VALIDATE_INT));
        $observation = trim(filter_input(INPUT_POST, "observation", FILTER_SANITIZE_STRIPPED));

        $uploadPath = $this->uploadFile('resumeFile');

        if (!empty($uploadPath)) {
            if ((new Resume())->add($name, $email, $phone, $role, $education, $observation, $uploadPath)) {
                alert('Seu currículo foi enviado com sucesso!', 'success');
            } else {
                alert('Erro ao enviar seus dados!', 'danger');
            }
        }

        $this->router->redirect("/");
    }

    private function uploadFile($filename): string
    {
        $uploadPath = '';

        $file = new File(__DIR__ . "/../../uploads", "files");

        //dd($_FILES[$filename]['size']);

        if ($_FILES) {
            try {
                $newFilename = time() . '_' . $_FILES[$filename]['name'];
                $uploadPath = $file->upload($_FILES[$filename], $newFilename);
            } catch (Exception $e) {
                alert('Erro ao enviar arquivo! ' . $e->getMessage(), 'danger');
            }
        }

        return $uploadPath;
    }
}
