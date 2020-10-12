<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';

//仮予約のメール生存確認のためのメールを送る
function phpmailer_send($data){

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        // $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'etude123pc@gmail.com';                     // SMTP username
        $mail->Password   = 'gmail123etude';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->CharSet = 'UTF-8';

        //Recipients
        // $mail->setFrom('etude123pc@gmail.com', 'etude');
        $mail->setFrom('etude123pc@gmail.com', 'etude');
        // $mail->addAddress('etude123pc@gmail.com', 'Joe User');     // Add a recipient
        // $mail->addAddress($to);               // Name is optional
        $mail->addAddress($data['pre_regist_email']);               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // //メールの暗号化する
        // $key = '長い鍵長い鍵長い鍵長い鍵長い鍵長い鍵長い鍵長い鍵長い鍵長い鍵';
        // //暗号化用データをコピー
        // $plain_address = $to;

        // $encrypt_address = openssl_encrypt($plain_address,'AES-128-ECB', $key);
        // $decrypt_address = openssl_decrypt($c_t, 'AES-128-ECB', $key);
        // var_dump($plain_address, $c_t, $p_t);

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = '受付用QRコードです';
        // $mail->Body    = '<p>以下のリンクを押すと受付用QRコードが表示されます</p><a href="http://etude.com/index.php/Reservation?encrypt_address='.$encrypt_address.'">http://etude.com/index.php/Reservation?encrypt_address='.$encrypt_address.'</a>';
        $mail->Body    = '<p>以下のリンクを押すと予約情報入力ページが表示されます</p><a href="http://etude.com/Reservation?token='.$data['token'].'">http://etude.com</a>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        //なんかログ残すか
        
        header('Location: http://etude.com/Reservation/view_error_message?errortype=3');
        exit;
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

//QRコードと予約情報確認できるリンクがあるメールを送信
function phpmailer_send_confirm($data){

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'etude123pc@gmail.com';                     // SMTP username
        $mail->Password   = 'gmail123etude';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->CharSet = 'UTF-8';

        //Recipients
        $mail->setFrom($data['email'], 'etude');
        $mail->addAddress($data['email']);               // Name is optional

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = '予約受付完了メールです。';
        // $mail->Body    = '<p>以下のリンクを押すと受付用QRコードが表示されます</p><a href="http://etude.com/index.php/Reservation?encrypt_address='.$encrypt_address.'">http://etude.com/index.php/Reservation?encrypt_address='.$encrypt_address.'</a>';
        $mail->Body    = '<p>以下のリンクを押すと受付用QRコードが表示されます</p><a href="http://etude.com/Qrcode?token='.$data['token'].'">QRコードと予約情報のリンクです</a><p>予約を削除したい場合は以下のリンクをクリックしてください</p><a href="http://etude.com/Reservation/cancel_reservation?token='.$data['token'].'">予約削除を行うためのリンクです。</a>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>