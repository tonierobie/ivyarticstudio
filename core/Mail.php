<?php
namespace Core;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Core\H;

class Mail {
  /**
   * Creates an input block to be used in a form
   * @method inputBlock
   * @param  string     $type       type of input ie text, password, phone ...
   * @param  string     $label      The label that will be displayed for the input
   * @param  string     $name       The id and name of the input will be set to this value
   * @param  string     $value      (optional) The value of the input
   * @param  array      $inputAttrs (optional) attributes of input
   * @param  array      $divAttrs   (optional) attributes of surrounding div
   * @param  array      $errors     (optional) array of all form errors
   * @return string                 returns an html string for input block
   */
  public static function sendemail($toAddress, $toName, $subject, $htmlBody, $nonHtmlBody){
    $mail = new PHPMailer(true);
    //Server settings
    //$mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    //$mail->Host       = 'mail.ivyarticstudio.com';  // Specify main and backup SMTP servers
    $mail->Host       = 'sbg102.truehost.cloud';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'studioonly11@ivyarticstudio.com';                     // SMTP username
    $mail->Password   = 'Wm.I$Nqo-nJs';                               // SMTP password
    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
    //$mail->Port       = 587;                                    // TCP port to connect to
    $mail->Port       = 465;                                    // TCP port to connect to
    //$mail->Port       = 26;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('noreply@ivyarticstudio.com', 'IvyArtic Studio');
    $mail->addAddress($toAddress, $toName);     // Add a recipient
    //$mail->addAddress('info@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    $mail->addBCC('info@ivyarticstudio.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $htmlBody;
    $mail->AltBody = $nonHtmlBody;

    $mail->send();
  }
}