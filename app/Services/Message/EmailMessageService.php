<?php

namespace App\Services\Message;

use App\Services\EmailServiceInterface;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailMessageService implements EmailServiceInterface
{
    public function sendMail(Request $request) : bool
    {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->Port = env('MAIL_PORT');

            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($request->input('email'));

            $mail->isHTML(true);
            $mail->Subject = $request->input('title');
            $mail->Body = $request->input('msg');

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
