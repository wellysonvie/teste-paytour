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

            $resume = (new Resume())->add($name, $email, $phone, $role, $education, $observation, $uploadPath);

            if (isset($resume)) {
                alert('Seu currículo foi enviado com sucesso!', 'success');
                $this->sendEmail($resume);
            }
        }

        $this->router->redirect("/");
    }

    private function uploadFile($filename): string
    {
        $uploadPath = '';

        $file = new File(__DIR__ . "/../../uploads", "files");

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

    private function sendEmail($resume)
    {
        $email = new EmailController();

        $email->add(
            "Confirmação de envio do seu currículo",
            '<b>Seu currículo foi enviado com sucesso!</b>
            <br><br>
            <b>Nome:</b> ' . $resume->name . '<br>
            <b>Email:</b> ' . $resume->email . '<br>
            <b>Telefone:</b> ' . $resume->phone . '<br>
            <b>Cargo desejado:</b> ' . $resume->role . '<br>
            <b>Nível de escolaridade:</b> ' . $this->getEducationById($resume->education) . '<br>
            <b>Observações:</b> ' . $resume->observation . '<br>',
            $resume->name,
            $resume->email
        )->send();
    }

    private function getEducationById($id)
    {
        $educations = [
            1 => 'Educação infantil',
            2 => 'Ensino fundamental',
            3 => 'Ensino médio',
            4 => 'Graduação',
            5 => 'Pós-graduação',
            6 => 'Mestrado',
            7 => 'Doutorado',
        ];

        return $educations[$id];
    }
}
