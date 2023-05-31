<?php

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
function verifyAdmin($conn, $username, $password)
{
  // Prepare the SQL statement to search for a matching student number
  $stmt = $conn->prepare("SELECT Password FROM Admin WHERE username = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();

  //Return if wrong Email
  if ($stmt->rowCount() === 0)
    return false;

  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  echo $password;
  return password_verify($password, $row['Password']);
}

function returnAdminID($conn, $username)
{
  $stmt = $conn->prepare("SELECT adminID FROM Admin WHERE username = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  return $row['adminID'];
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

function noSectionBeforeProgramDeletion($conn, $name)
{
  $stmt = $conn->prepare("SELECT * FROM Programsections ps
                          INNER JOIN Program p ON ps.programID = p.programID
                          WHERE p.name = :name");
  $stmt->bindParam(':name', $name);
  $stmt->execute();
  return ($stmt->rowCount() == 0);
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




function getStudentAccounts($conn)
{
  $stmt = $conn->prepare("SELECT * FROM Student");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFacultyAccounts($conn)
{
  $stmt = $conn->prepare("SELECT * FROM Faculty");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAccountsByOrder($conn, $table, $column, $order)
{
  if ($column == 'priority' && $order == 'asc') {
    $sql = "SELECT * FROM " . $table . " ORDER BY CASE priority WHEN 'low' THEN 1 WHEN 'medium' THEN 2 WHEN 'high' THEN 3 END ASC";
  } elseif ($column == 'priority' && $order == 'desc') {
    $sql = "SELECT * FROM " . $table . " ORDER BY CASE priority WHEN 'low' THEN 1 WHEN 'medium' THEN 2 WHEN 'high' THEN 3 END DESC";
  } else {
    $sql = "SELECT * FROM " . $table . " ORDER BY " . $column . " " . $order;
  }
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAdvisorName($conn, $advisorID)
{
  $stmt = $conn->prepare("SELECT * FROM Faculty WHERE facultyID = :advisorID");
  $stmt->bindParam(':advisorID', $advisorID);
  $stmt->execute();
  $result = $stmt->fetch();
  return "Prof. " . $result["firstname"] . " " . $result["lastname"];

}

function toggleFacultyAccount($conn, $facultyID, $status)
{
  $stmt = $conn->prepare("UPDATE Faculty SET status = :status WHERE facultyID = :facultyID");
  $stmt->bindParam(':status', $status);
  $stmt->bindParam(':facultyID', $facultyID);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}

function toggleStudentAccount($conn, $studentID, $status)
{
  $stmt = $conn->prepare("UPDATE Student SET status = :status WHERE studentID = :studentID");
  $stmt->bindParam(':status', $status);
  $stmt->bindParam(':studentID', $studentID);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}
function getStudentEmail($conn, $userID)
{
  $stmt = $conn->prepare("SELECT * FROM Student WHERE studentID = :userID");
  $stmt->bindParam(':userID', $userID);
  $stmt->execute();
  $result = $stmt->fetch();
  return $result['emailadd'];
}
function getStudentEmail2($conn, $studentnumber)
{
  $stmt = $conn->prepare("SELECT * FROM Student WHERE studentnumber = :studentnumber");
  $stmt->bindParam(':studentnumber', $studentnumber);
  $stmt->execute();
  $result = $stmt->fetch();
  return $result['emailadd'];
}
function getFacultyEmail($conn, $userID)
{
  $stmt = $conn->prepare("SELECT * FROM Faculty WHERE facultyID = :userID");
  $stmt->bindParam(':userID', $userID);
  $stmt->execute();
  $result = $stmt->fetch();
  return $result['emailadd'];
}
function getFacultyStatus($conn, $emailadd)
{
  $stmt = $conn->prepare("SELECT * FROM Faculty WHERE emailadd = :emailadd");
  $stmt->bindParam(':emailadd', $emailadd);
  $stmt->execute();
  $result = $stmt->fetch();
  return $result['status'];
}

function getStudentStatus($conn, $studentnumber)
{
  $stmt = $conn->prepare("SELECT * FROM Student WHERE studentnumber = :studentnumber");
  $stmt->bindParam(':studentnumber', $studentnumber);
  $stmt->execute();
  $result = $stmt->fetch();
  return $result['status'];
}
function createNotif($conn, $title, $content, $redirect)
{
  // Prepare the SQL statement
  $stmt = $conn->prepare("INSERT INTO Notification (title, content, redirect) VALUES (:title, :content, :redirect)");

  // Bind the parameters to the prepared statement
  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':content', $content);
  $stmt->bindParam(':redirect', $redirect);
  $stmt->execute();
  return $conn->lastInsertId();
}

function createNotificationLink($conn, $recipientID, $issuerID, $notificationID, $recipienttype, $issuertype)
{
  $query = "INSERT INTO NotificationLink (issuerAdminID, issuerFacultyID, issuerStudentID, recipientAdminID, recipientFacultyID, recipientStudentID, notificationID)
            VALUES (:issuerAdminID, :issuerFacultyID, :issuerStudentID, :recipientAdminID, :recipientFacultyID, :recipientStudentID, :notificationID)";

  $stmt = $conn->prepare($query);

  switch ($recipienttype) {
    case 'admin':
      $recipientAdminID = $recipientID;
      break;
    case 'faculty':
      $recipientFacultyID = $recipientID;
      break;
    case 'student':
      $recipientStudentID = $recipientID;
      break;
    default:
      // Handle invalid recipient type
      return false;
  }

  switch ($issuertype) {
    case 'admin':
      $issuerAdminID = $issuerID;
      break;
    case 'faculty':
      $issuerFacultyID = $issuerID;
      break;
    case 'student':
      $issuerStudentID = $issuerID;
      break;
    default:
      // Handle invalid issuer type
      return false;
  }

  // Bind parameters
  $stmt->bindParam(':issuerAdminID', $issuerAdminID);
  $stmt->bindParam(':issuerFacultyID', $issuerFacultyID);
  $stmt->bindParam(':issuerStudentID', $issuerStudentID);
  $stmt->bindParam(':recipientAdminID', $recipientAdminID);
  $stmt->bindParam(':recipientFacultyID', $recipientFacultyID);
  $stmt->bindParam(':recipientStudentID', $recipientStudentID);
  $stmt->bindParam(':notificationID', $notificationID);

  try {
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}


function getFacultyID($conn, $emailadd)
{
  $stmt = $conn->prepare("SELECT * FROM Faculty WHERE emailadd = :emailadd");
  $stmt->bindParam(':emailadd', $emailadd);
  $stmt->execute();
  $result = $stmt->fetch();
  return $result["facultyID"];
}

function getAdminID($conn, $username)
{
  $stmt = $conn->prepare("SELECT * FROM Admin WHERE username = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result["adminID"];
}

function getStudentID($conn, $emailadd)
{
  $stmt = $conn->prepare("SELECT * FROM Student WHERE emailadd = :emailadd");
  $stmt->bindParam(':emailadd', $emailadd);
  $stmt->execute();
  $result = $stmt->fetch();
  return $result["studentID"];
}

function getFacultyNotifications($conn, $recipientFacultyID)
{
  $stmt = $conn->prepare("
    SELECT n.title, n.content, n.dateissued, n.redirect,
       CONCAT_WS(' ', COALESCE(a.firstname, f.firstname, s.firstname), COALESCE(a.lastname, f.lastname, s.lastname)) AS issuername,
       CASE WHEN a.adminID IS NOT NULL THEN 'admin'
            WHEN f.facultyID IS NOT NULL THEN 'faculty'
            WHEN s.studentID IS NOT NULL THEN 'student'
            ELSE NULL
          END AS issuertype
    FROM NotificationLink nl
    JOIN Notification n ON nl.notificationID = n.notificationID
    LEFT JOIN Admin a ON nl.issuerAdminID = a.adminID
    LEFT JOIN Faculty f ON nl.issuerFacultyID = f.facultyID
    LEFT JOIN Student s ON nl.issuerStudentID = s.studentID
    WHERE nl.recipientFacultyID = :recipientFacultyID;
  ");
  $stmt->bindParam(':recipientFacultyID', $recipientFacultyID);

  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getStudentNotifications($conn, $recipientStudentID)
{
  $stmt = $conn->prepare("
    SELECT n.title, n.content, n.dateissued, n.redirect, n.status,
       CONCAT_WS(' ', COALESCE(a.firstname, f.firstname, s.firstname), COALESCE(a.lastname, f.lastname, s.lastname)) AS issuername,
       CASE WHEN a.adminID IS NOT NULL THEN 'admin'
            WHEN f.facultyID IS NOT NULL THEN 'faculty'
            WHEN s.studentID IS NOT NULL THEN 'student'
            ELSE NULL
          END AS issuertype
    FROM NotificationLink nl
    JOIN Notification n ON nl.notificationID = n.notificationID
    LEFT JOIN Admin a ON nl.issuerAdminID = a.adminID
    LEFT JOIN Faculty f ON nl.issuerStudentID = f.facultyID
    LEFT JOIN Student s ON nl.issuerStudentID = s.studentID
    WHERE nl.recipientStudentID = :recipientStudentID;
  ");
  $stmt->bindParam(':recipientStudentID', $recipientStudentID);

  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getAdminNotifications($conn, $recipientAdminID)
{
  $stmt = $conn->prepare("
  SELECT n.title, n.content, n.dateissued, n.redirect, n.status,
  CONCAT_WS(' ', COALESCE(a.firstname, f.firstname, s.firstname), COALESCE(a.lastname, f.lastname, s.lastname)) AS issuername,
  CASE WHEN a.adminID IS NOT NULL THEN 'admin'
  WHEN f.facultyID IS NOT NULL THEN 'faculty'
  WHEN s.studentID IS NOT NULL THEN 'student'
  ELSE NULL
  END AS issuertype
  FROM NotificationLink nl
  JOIN Notification n ON nl.notificationID = n.notificationID
  LEFT JOIN Admin a ON nl.issuerAdminID = a.adminID
  LEFT JOIN Faculty f ON nl.issuerFacultyID = f.facultyID
  LEFT JOIN Student s ON nl.issuerStudentID = s.studentID
  WHERE nl.recipientAdminID = :recipientAdminID;
  ");
  $stmt->bindParam(':recipientAdminID', $recipientAdminID);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    echo "PDOException: " . $e->getMessage();
  }
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFullNameByID($conn, $table, $userID)
{
  $stmt = $conn->prepare("SELECT firstname, lastname FROM $table WHERE $userID = :userID");
  $stmt->bindParam(':userID', $userID);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $firstName = $result['firstname'];
  $lastName = $result['lastname'];
  return "$firstName $lastName";
}
?>