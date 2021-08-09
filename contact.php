<div id="contact">
    <h1>Contact Us</h1>
    <form method="POST" class="col">
        <label for="email">Email for response</label>
        <input type="text" name="email" placeholder="Email">
        <label for="subject">Subject</label>
        <input type="text" name="subject" placeholder="Subject">
        <label for="message">Message</label>
        <textarea name="message" placeholder="Message"></textarea>
        <button name="send">Send</button>
    </form>
</div>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['send'])) 
{
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $msg = $_POST['message'];
    $meuemail = 'rodrigues.elian@yahoo.com';
    $meunome = 'Elian Rodrigues';
    require "PHPMailer/src/PHPMailer.php";
    require "PHPMailer/src/SMTP.php";

    $mail = new PHPMailer();
    $mail->isSMTP(); 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ]
    ];
    $mail->Username = 'dawexemplo2014@gmail.com';
    $mail->Password = 'senha52014';
    $mail->setFrom('dawexemplo2014@gmail.com','Adm Site');
    $mail->addAddress($meuemail, $meunome);
    $mail->CharSet = "utf-8";
    $mail->addReplyTo($email);
    $mail->Subject = $subject;
    $mail->Body = $msg;
    if (!$mail->send()) {
        echo 'Mailer Error: '.$mail->ErrorInfo;
    } else {
        echo $mensagem." E-mail SMTP enviado com sucesso para ".$meuemail." Enviado por: ".$email;
    }
}
?>