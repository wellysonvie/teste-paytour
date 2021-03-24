<?php

namespace Source\App;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use stdClass;

class EmailController
{
    private $mail;

    private $data;
    private $error;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->data = new stdClass();

        $this->mail->isSMTP();
        $this->mail->isHTML();
        $this->mail->setLanguage("br");

        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = "tls";
        $this->mail->CharSet = "utf-8";

        $this->mail->Host = CONF_MAIL_SMTP["host"];
        $this->mail->Port = CONF_MAIL_SMTP["port"];
        $this->mail->Username = CONF_MAIL_SMTP["user"];
        $this->mail->Password = CONF_MAIL_SMTP["passwd"];
    }

    public function add(string $subject, string $body, string $recipient_name, string $recipient_email): EmailController
    {
        $this->data->subject = $subject;
        $this->data->body = $body;
        $this->data->recipient_name = $recipient_name;
        $this->data->recipient_email = $recipient_email;
        return $this;
    }

    public function attach(string $data, string $fileName): EmailController
    {
        $this->data->attach[$fileName] = $data;
        return $this;
    }

    public function send(string $from_name = CONF_MAIL_SMTP["from_name"], string $from_email = CONF_MAIL_SMTP["from_email"]): bool
    {
        try {
            $this->mail->Subject = $this->data->subject;
            $this->mail->msgHTML($this->data->body);
            $this->mail->addAddress($this->data->recipient_email, $this->data->recipient_name);
            $this->mail->setFrom($from_email, $from_name);

            if (!empty($this->data->attach)) {
                foreach ($this->data->attach as $name => $data) {
                    $this->mail->addStringAttachment($data, $name);
                }
            }

            $this->mail->send();
            return true;
        } catch (Exception $exception) {
            $this->error = $exception;
            return false;
        }
    }

    public function error(): ?Exception
    {
        return $this->error;
    }
}
