<?php
function studentNumberCheck($conn, $student_number) {
  $stmt = $conn->prepare("SELECT * FROM Students WHERE StudentNumber = :student_number");
  $stmt->bindParam(':student_number', $student_number);
  $stmt->execute();
  $student = $stmt->fetch();

  if ($student) return true;
  return false;
}

function staff_username_exists($conn, $username) {
  $stmt = $conn->prepare("SELECT * FROM Staff WHERE UserName = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $staff = $stmt->fetch();
  
  // Execute the query
  $stmt->execute();

  // Get the number of rows returned by the query
  $num_rows = $stmt->rowCount();

  return ($num_rows ==! 0);
}

function emailAddressCheck($conn, $emailadd, $type) {
  $stmt = $conn->prepare("SELECT * FROM $type WHERE emailadd = :emailadd");
  $stmt->bindParam(':emailadd', $emailadd);
  $stmt->execute();
  $result = $stmt->fetch();
  return ($result);
}

function add_student($conn, $student_number, $section, $email, $first_name, $last_name, $password) {
  $stmt = $conn->prepare("INSERT into Students (StudentNumber, Section, EmailAddress, FirstName, LastName, Password) VALUES (:student_number, :section, :email, :first_name, :last_name, :password)");
  $stmt->bindParam(':student_number', $student_number);
  $stmt->bindParam(':section', $section);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':first_name', $first_name);
  $stmt->bindParam(':last_name', $last_name);
  $stmt->bindParam(':password', $password);
  try {
    $stmt->execute();
  }catch (PDOException $e) {
    send_message_and_redirect("Error: ".$e->getMessage(), "/ereliv/studregis.php");
  }
}
function add_faculty($conn, $firstname, $lastname, $emailadd, $password, $category) {
  $stmt = $conn->prepare("INSERT into Faculty (firstname, lastname, emailadd, password, category) VALUES (:firstname, :lastname, :emailadd, :password, :category)");
  $stmt->bindParam(':firstname', $firstname);
  $stmt->bindParam(':lastname', $lastname);
  $stmt->bindParam(':emailadd', $emailadd);
  $stmt->bindParam(':password', $password);
  $stmt->bindParam(':category', $category);
  try {
    $stmt->execute();
  }catch (PDOException $e) {
    send_message_and_redirect("Error: ".$e->getMessage(), "/ereliv/admin/facultyregis.php");
  }
}

function send_message_and_redirect($message, $redirect_url) {
  echo "<script>
        setTimeout(function() {
            alert('$message');
            window.location.replace('$redirect_url');
        }, 1000);
      </script>";
  exit;
}

function student_number_exists($conn, $student_number) {
  // Prepare a statement to search for the given student number
  $stmt = $conn->prepare("SELECT * FROM Students WHERE StudentNumber = :student_number");

  // Bind the student number parameter to the prepared statement
  $stmt->bindParam(':student_number', $student_number);

  // Execute the query
  $stmt->execute();

  // Get the number of rows returned by the query
  $num_rows = $stmt->rowCount();

  return ($num_rows ==! 0);
}


function verified_student($conn, $student_number, $section, $password) {
  // Prepare the SQL statement to search for a matching student number
  $stmt = $conn->prepare("SELECT Section, Password FROM Students WHERE StudentNumber = :student_number");
  $stmt->bindParam(':student_number', $student_number);
  $stmt->execute();
  // Fetch the row from the result set
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  return ($row['Section'] === $section && password_verify($password, $row['Password']));
}

function verified_staff($conn, $username, $password) {
  // Prepare the SQL statement to search for a matching student number
  $stmt = $conn->prepare("SELECT Password FROM Staff WHERE UserName = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  // Fetch the row from the result set
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  return password_verify($password, $row['Password']);
}

function generateCode(){
  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($conn, $email, $title, $body, $redirect) {
  //Load Composer's autoloader
  require '../mail/Exception.php';
  require '../mail/SMTP.php';
  require '../mail/PHPMailer.php';

  $mail = new PHPMailer(true);
  try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'erelivsmtpmailer@gmail.com';                     //SMTP username
    $mail->Password   = 'rizzsvztalpdbwjq';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    

    //Recipients
    $mail->setFrom('erelivsmtpmailer@gmail.com', 'Admin');
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $title;
    $mail->Body    = $body;
    $mail->send();
  }catch (Exception $e) {
    send_message_and_redirect("Message could not be sent. Mailer Error: ".$e->getMessage(), $redirect);
  }
}

function updateCode($conn, $code, $type, $emailadd, $redirect){
  $stmt = $conn->prepare("UPDATE $type SET code = :code WHERE emailadd = :emailadd");
  $stmt->bindParam(':code', $code);
  $stmt->bindParam(':emailadd', $emailadd);
  try {
    $stmt->execute();
  }catch (PDOException $e) {
    send_message_and_redirect("Error: ".$e->getMessage(), $redirect);
  }
}

function updatePassword($conn, $password, $type, $emailadd, $redirect){
  $stmt = $conn->prepare("UPDATE $type SET password = :password WHERE emailadd = :emailadd");
  $stmt->bindParam(':password', $password);
  $stmt->bindParam(':emailadd', $emailadd);
  try {
    $stmt->execute();
  }catch (PDOException $e) {
    send_message_and_redirect("Error: ".$e->getMessage(), $redirect);
  }
}

function checkCode($conn, $type, $code, $emailadd){
  $stmt = $conn->prepare("SELECT * FROM $type WHERE code = :code AND emailadd = :emailadd");
  $stmt->bindParam(':code', $code);
  $stmt->bindParam(':emailadd', $emailadd);
  $stmt->execute();
  $result = $stmt->fetch();

  if ($result) return true;
  return false; 
}

?>


