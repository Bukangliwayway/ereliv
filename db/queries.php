<?php
// function studentNumberCheck($conn, $studentnumber) {
//   $stmt = $conn->prepare("SELECT * FROM Student WHERE studentnumber = :studentnumber");
//   $stmt->bindParam(':studentnumber', $studentnumber);
//   $stmt->execute();
//   $student = $stmt->fetch();

//   if ($student) return true;
//   return false;
// }

function emailAddressCheck($conn, $emailadd, $type)
{
  $stmt = $conn->prepare("SELECT * FROM $type WHERE emailadd = :emailadd");
  $stmt->bindParam(':emailadd', $emailadd);
  $stmt->execute();
  $result = $stmt->fetch();
  return ($result);
}

function addStudent($conn, $studentnumber, $program, $section, $emailadd, $firstname, $lastname, $password, $advisor)
{
  $stmt = $conn->prepare("INSERT into Student (studentnumber, program, section, emailadd, firstname, lastname, password, advisor) VALUES (:studentnumber, :program, :section, :emailadd, :firstname, :lastname, :password, :advisor)");
  $stmt->bindParam(':studentnumber', $studentnumber);
  $stmt->bindParam(':program', $program);
  $stmt->bindParam(':section', $section);
  $stmt->bindParam(':emailadd', $emailadd);
  $stmt->bindParam(':firstname', $firstname);
  $stmt->bindParam(':lastname', $lastname);
  $stmt->bindParam(':password', $password);
  $stmt->bindParam(':advisor', $advisor);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    send_message_and_redirect("Error: " . $e->getMessage(), "http://localhost/ereliv/studregis.php");
  }
}

function add_faculty($conn, $firstname, $lastname, $emailadd, $password, $category)
{
  $stmt = $conn->prepare("INSERT into Faculty (firstname, lastname, emailadd, password, category) VALUES (:firstname, :lastname, :emailadd, :password, :category)");
  $stmt->bindParam(':firstname', $firstname);
  $stmt->bindParam(':lastname', $lastname);
  $stmt->bindParam(':emailadd', $emailadd);
  $stmt->bindParam(':password', $password);
  $stmt->bindParam(':category', $category);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    send_message_and_redirect("Error: " . $e->getMessage(), "http://localhost/ereliv/admin/facultyregis.php");
  }
}

function send_message_and_redirect($message, $redirect_url)
{
  echo "<script>
        setTimeout(function() {
            alert('$message');
            window.location.replace('$redirect_url');
        }, 1000);
      </script>";
  exit;
}

function studentNumberExists($conn, $studentnumber)
{
  // Prepare a statement to search for the given student number
  $stmt = $conn->prepare("SELECT * FROM Student WHERE studentnumber = :studentnumber");

  // Bind the student number parameter to the prepared statement
  $stmt->bindParam(':studentnumber', $studentnumber);

  // Execute the query
  $stmt->execute();

  // Get the number of rows returned by the query
  $num_rows = $stmt->rowCount();

  return ($num_rows == !0);
}


function verifyStudent($conn, $studentnumber, $section, $password)
{
  // Prepare the SQL statement to search for a matching student number
  $stmt = $conn->prepare("SELECT section, password FROM Student WHERE studentnumber = :studentnumber");
  $stmt->bindParam(':studentnumber', $studentnumber);
  $stmt->execute();
  // Fetch the row from the result set
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  echo password_verify($password, $row['password']) . ' N saved:' . $row['section'] . " choice:" . $section;
  return $row['section'] === $section && password_verify($password, $row['password']);
}

function verifyFaculty($conn, $emailadd, $password)
{
  // Prepare the SQL statement to search for a matching student number
  $stmt = $conn->prepare("SELECT Password FROM Faculty WHERE emailadd = :emailadd");
  $stmt->bindParam(':emailadd', $emailadd);
  $stmt->execute();

  //Return if wrong Email
  if ($stmt->rowCount() === 0)
    return false;

  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  return password_verify($password, $row['Password']);
}

function generateCode()
{
  return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($conn, $email, $title, $body, $redirect)
{
  //Load Composer's autoloader
  require '../mail/Exception.php';
  require '../mail/SMTP.php';
  require '../mail/PHPMailer.php';

  $mail = new PHPMailer(true);
  try {
    //Server settings
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'erelivsmtpmailer@gmail.com'; //SMTP username
    $mail->Password = 'rizzsvztalpdbwjq'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable implicit TLS encryption
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('erelivsmtpmailer@gmail.com', 'Admin');
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = $title;
    $mail->Body = $body;
    $mail->send();
  } catch (Exception $e) {
    send_message_and_redirect("Message could not be sent. Mailer Error: " . $e->getMessage(), $redirect);
  }
}

function updateCode($conn, $code, $type, $emailadd, $redirect)
{
  $stmt = $conn->prepare("UPDATE $type SET code = :code WHERE emailadd = :emailadd");
  $stmt->bindParam(':code', $code);
  $stmt->bindParam(':emailadd', $emailadd);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    send_message_and_redirect("Error: " . $e->getMessage(), $redirect);
  }
}

function updatePassword($conn, $password, $type, $emailadd, $redirect)
{
  $stmt = $conn->prepare("UPDATE $type SET password = :password WHERE emailadd = :emailadd");
  $stmt->bindParam(':password', $password);
  $stmt->bindParam(':emailadd', $emailadd);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    send_message_and_redirect("Error: " . $e->getMessage(), $redirect);
  }
}

function checkCode($conn, $type, $code, $emailadd)
{
  $stmt = $conn->prepare("SELECT * FROM $type WHERE code = :code AND emailadd = :emailadd");
  $stmt->bindParam(':code', $code);
  $stmt->bindParam(':emailadd', $emailadd);
  $stmt->execute();
  $result = $stmt->fetch();

  if ($result)
    return true;
  return false;
}

function getList($conn, $column, $table)
{
  $stmt = $conn->prepare("SELECT $column FROM $table");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSectionList($conn, $programID)
{
  $stmt = $conn->prepare("SELECT s.name
                          FROM Programsections ps
                          JOIN Section s ON ps.sectionID = s.SectionID
                          WHERE ps.programID = :programID");
  $stmt->bindParam(':programID', $programID);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}

function addSection($conn, $name, $programID)
{
  $stmt = $conn->prepare("INSERT INTO Section (name) Values (:name)");
  $stmt->bindParam(':name', $name);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    $e->getMessage();
    return false;
  }
  if (!linkSectionAndProgram($conn, $name, $programID))
    return false;
  return true;
}

function linkSectionAndProgram($conn, $name, $programID)
{
  echo $programID;
  $sectionID = getSectionID($conn, $name);
  $stmt = $conn->prepare("INSERT INTO Programsections (programID, sectionID) Values (:programID, :sectionID)");
  $stmt->bindParam(':programID', $programID);
  $stmt->bindParam(':sectionID', $sectionID);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}

function getSectionID($conn, $name)
{
  $stmt = $conn->prepare("SELECT sectionID FROM Section WHERE name = :name");
  $stmt->bindParam(':name', $name);
  $stmt->execute();
  $result = $stmt->fetch();
  $id = $result['sectionID'];
  return strval($id);
}

function sectionDuplicateCheck($conn, $name)
{
  $stmt = $conn->prepare("SELECT * FROM Section WHERE LOWER(name) = LOWER(:name)");
  $stmt->bindParam(':name', $name);
  $stmt->execute();
  $section = $stmt->fetch();
  if ($section)
    return true;
  return false;
}
function editSection($conn, $name, $original)
{
  $stmt = $conn->prepare("UPDATE Section SET name = :name WHERE name = :original");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':original', $original);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}

function deleteSection($conn, $name)
{
  $stmt = $conn->prepare("DELETE FROM Section WHERE name = :name");
  $stmt->bindParam(':name', $name);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}


function addProgram($conn, $name)
{
  $stmt = $conn->prepare("INSERT INTO Program (name) Values (:name)");
  $stmt->bindParam(':name', $name);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    $e->getMessage();
    return false;
  }
  return true;
}

function programDuplicateCheck($conn, $name)
{
  $stmt = $conn->prepare("SELECT * FROM Program WHERE LOWER(name) = LOWER(:name)");
  $stmt->bindParam(':name', $name);
  $stmt->execute();
  $section = $stmt->fetch();
  if ($section)
    return true;
  return false;
}

function editProgram($conn, $name, $original)
{
  $stmt = $conn->prepare("UPDATE Program SET name = :name WHERE name = :original");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':original', $original);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}


function deleteProgram($conn, $name)
{
  $stmt = $conn->prepare("DELETE FROM Program WHERE name = :name");
  $stmt->bindParam(':name', $name);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}

function getLinkedSection($conn, $programID)
{
  $stmt = $conn->prepare("
    SELECT s.*
    FROM Section s
    INNER JOIN Programsections ps ON s.sectionID = ps.sectionID
    WHERE ps.programID = :programID;
  ");
  $stmt->bindParam(':programID', $programID);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}


function linkStudentAndAdvisor($conn, $emailadd, $facultyID)
{
  $studentID = getStudentID($conn, $emailadd);
  echo $facultyID . " nani " . $studentID;
  $stmt = $conn->prepare("INSERT INTO Adviserteam (facultyID, studentID) Values (:facultyID, :studentID)");
  $stmt->bindParam(':facultyID', $facultyID);
  $stmt->bindParam(':studentID', $studentID);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}

function getStudentID($conn, $emailadd)
{
  $stmt = $conn->prepare("SELECT studentID FROM Student WHERE emailadd = :emailadd");
  $stmt->bindParam(':emailadd', $emailadd);
  $stmt->execute();
  $result = $stmt->fetch();
  return $result["studentID"];
}

?>