<?php 

if(isset($_FILES['file-915'])){
    $errors= array();
    $file_name = $_FILES['file-915']['name'];
    $file_size =$_FILES['file-915']['size'];
    $file_tmp =$_FILES['file-915']['tmp_name'];
    $file_type=$_FILES['file-915']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['file-915']['name'])));
    $extensions= array("txt","pdf","doc","docx","jpeg");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 15000000) {
         $errors[]='File size must be excately 15 MB';
      }
      
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"./var/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }


require_once('./phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

$name = $_POST['your-name'];
$phone = $_POST['your-tel'];
$email = $_POST['your-email'];

//$mail->SMTPDebug = 0;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.hostinger.pl';  																							// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'forbes@forbes.columbuselite.pl'; // Ваш логин от почты с которой будут отправляться письма
$mail->Password = '|Q8kUweVK3/+'; // Ваш пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; // TCP port to connect to / этот порт может отличаться у других провайдеров

$mail->setFrom('forbes@forbes.columbuselite.pl'); // от кого будет уходить письмо?
$mail->addAddress('roman.hredil@columbuselite.pl');     // Кому будет уходить письмо 
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
$mail->addAttachment("./var/".$file_name);         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML


$mail->Subject = 'Pracuj z CElite CV';
$mail->Body    = '' .$name . ' Aplikuje.<br>Numer telefonu: ' .$phone. ' <br>Email: ' .$email;
$mail->AltBody = '';

if(!$mail->send()) {
    echo 'Error';
} else {
    header('location: thank-you.html');
}
?>