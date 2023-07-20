<?php

function emailAddressCheck($conn, $emailadd, $type)
{
  $stmt = $conn->prepare("SELECT * FROM $type WHERE emailadd = :emailadd");
  $stmt->bindParam(':emailadd', $emailadd);
  $stmt->execute();
  $result = $stmt->fetch();
  return !empty($result);
}


function addStudent($conn, $studentnumber, $program, $section, $emailadd, $firstname, $lastname, $password, $advisor)
{
  $stmt = $conn->prepare("INSERT into Student (studentnumber, program, sectionID, emailadd, firstname, lastname, password, advisor) VALUES (:studentnumber, :program, :sectionID, :emailadd, :firstname, :lastname, :password, :advisor)");
  $stmt->bindParam(':studentnumber', $studentnumber);
  $stmt->bindParam(':program', $program);
  $stmt->bindParam(':sectionID', $section);
  $stmt->bindParam(':emailadd', $emailadd);
  $stmt->bindParam(':firstname', $firstname);
  $stmt->bindParam(':lastname', $lastname);
  $stmt->bindParam(':password', $password);
  $stmt->bindParam(':advisor', $advisor);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    return $e->getMessage();
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
    return "Faculty Creation Failed: " . $e->getMessage();
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
  $stmt = $conn->prepare("SELECT sectionID, password FROM Student WHERE studentnumber = :studentnumber");
  $stmt->bindParam(':studentnumber', $studentnumber);
  $stmt->execute();
  // Fetch the row from the result set
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  return $row['sectionID'] == $section && password_verify($password, $row['password']);
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

function sendEmail($conn, $email, $title, $body)
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
    return "Message could not be sent. Mailer Error: " . $e->getMessage();
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

function getFacultyWorks($conn, $facultyCreatorID)
{
  $stmt = $conn->prepare("SELECT
                            r.*,
                            DATE_FORMAT(r.datepublished, '%d %M %Y') AS datepublished
                          FROM
                            ActivePaper ap
                            JOIN Research r ON ap.researchPaper = r.researchID
                          WHERE
                            ap.status = 'active'
                            AND ap.facultyCreatorID = :facultyCreatorID;
                        ");
  $stmt->bindParam(':facultyCreatorID', $facultyCreatorID);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getStudentWorks($conn, $studentCreatorID)
{
  $stmt = $conn->prepare("SELECT
                            r.*,
                            DATE_FORMAT(r.datepublished, '%d %M %Y') AS datepublished,
                          FROM
                            ActivePaper ap
                              JOIN Research r ON ap.researchPaper = r.researchID
                          WHERE
                            ap.status = 'active'
                            AND ap.studentCreatorID = :studentCreatorID
                        ");
  $stmt->bindParam(':studentCreatorID', $studentCreatorID);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function searchFacultyWorks($conn, $facultyCreatorID, $search)
{
  $stmt = $conn->prepare("SELECT
                              r.*,
                              DATE_FORMAT(r.datepublished, '%d %M %Y') AS datepublished,
                              (
                                  (CASE WHEN r.title LIKE CONCAT('%', :search, '%') THEN 1 ELSE 0 END) +
                                  (CASE WHEN r.abstract LIKE CONCAT('%', :search, '%') THEN 1 ELSE 0 END) +
                                  (CASE WHEN r.keywords LIKE CONCAT('%', :search, '%') THEN 1 ELSE 0 END) +
                                  (CASE WHEN r.proposer LIKE CONCAT('%', :search, '%') THEN 1 ELSE 0 END)
                              ) AS hitCount
                          FROM
                              ActivePaper ap
                              JOIN Research r ON ap.researchPaper = r.researchID
                          WHERE
                              ap.status = 'active'
                              AND ap.facultyCreatorID = :facultyCreatorID
                              AND (
                                  r.title LIKE CONCAT('%', :search, '%')
                                  OR r.abstract LIKE CONCAT('%', :search, '%')
                                  OR r.keywords LIKE CONCAT('%', :search, '%')
                                  OR r.proposer LIKE CONCAT('%', :search, '%')
                              )
                          ORDER BY hitCount DESC;
");

  $stmt->bindParam(':facultyCreatorID', $facultyCreatorID);
  $stmt->bindParam(':search', $search);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function searchStudentWorks($conn, $studentCreatorID, $search)
{
  $stmt = $conn->prepare("SELECT
                              r.researchID,
                              r.title,
                              r.abstract,
                              DATE_FORMAT(r.datepublished, '%d %M %Y') AS datepublished,
                              r.keywords,
                              r.status,
                              r.proposer,
                              r.studentProposerID,
                              r.facultyProposerID,
                              r.advisorID,
                              (
                                  (CASE WHEN r.title LIKE CONCAT('%', :search, '%') THEN 1 ELSE 0 END) +
                                  (CASE WHEN r.abstract LIKE CONCAT('%', :search, '%') THEN 1 ELSE 0 END) +
                                  (CASE WHEN r.keywords LIKE CONCAT('%', :search, '%') THEN 1 ELSE 0 END) +
                                  (CASE WHEN r.proposer LIKE CONCAT('%', :search, '%') THEN 1 ELSE 0 END)
                              ) AS hitCount
                          FROM
                              ActivePaper ap
                              JOIN Research r ON ap.researchPaper = r.researchID
                          WHERE
                              ap.status = 'active'
                              AND ap.studentCreatorID = :studentCreatorID
                              AND (
                                  r.title LIKE CONCAT('%', :search, '%')
                                  OR r.abstract LIKE CONCAT('%', :search, '%')
                                  OR r.keywords LIKE CONCAT('%', :search, '%')
                                  OR r.proposer LIKE CONCAT('%', :search, '%')
                              )
                          ORDER BY hitCount DESC;
");

  $stmt->bindParam(':studentCreatorID', $studentCreatorID);
  $stmt->bindParam(':search', $search);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getSectionList($conn, $programID)
{
  $stmt = $conn->prepare("SELECT s.sectionID, s.name
                            FROM Programsections ps
                            JOIN Section s ON ps.sectionID = s.sectionID
                            WHERE ps.programID = :programID
                        ");
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

function deleteSection($conn, $sectionID)
{
  $stmt = $conn->prepare("DELETE FROM Section WHERE sectionID = :sectionID");
  $stmt->bindParam(':sectionID', $sectionID);
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
function createNotif($conn, $title, $content)
{
  // Prepare the SQL statement
  $stmt = $conn->prepare("INSERT INTO Notification (title, content) VALUES (:title, :content)");

  // Bind the parameters to the prepared statement
  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':content', $content);
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
    SELECT n.notificationID, n.title, n.content, n.dateissued,
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
    SELECT n.title, n.content, n.dateissued, n.status,
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
  SELECT n.title, n.content, n.dateissued, n.status,
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

function addAuthorExists($conn, $firstname, $lastname)
{
  $stmt = $conn->prepare("SELECT * FROM Author WHERE LOWER(firstname) = LOWER(:firstname) AND LOWER(lastname) = LOWER(:lastname)");
  $stmt->bindParam(':firstname', $firstname);
  $stmt->bindParam(':lastname', $lastname);
  $stmt->execute();
  $result = $stmt->fetch();
  return !empty($result);
}
function addInterestExists($conn, $name)
{
  $stmt = $conn->prepare("SELECT * FROM Interest WHERE LOWER(name) = LOWER(:name)");
  $stmt->bindParam(':name', $name);
  $stmt->execute();
  $result = $stmt->fetch();
  return !empty($result);
}

function getFullNameByID($conn, $table, $userColumn, $userID)
{
  $stmt = $conn->prepare("SELECT firstname, lastname FROM $table WHERE $userColumn = :userID");
  $stmt->bindParam(':userID', $userID);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return ucwords(strtolower($result['firstname'])) . ' ' . ucwords(strtolower($result['lastname']));

}

function createResearchFaculty($conn, $title, $abstract, $introduction, $methodology, $results, $discussion, $conclusion, $datepublished, $keywords, $status, $proposer, $facultyProposerID, $advisorID, $researchstatus, $researchclassification)
{
  $status = "Active";
  $stmt = $conn->prepare("INSERT into Research (title, abstract, introduction, methodology, results, discussion, conclusion, datepublished, keywords, status, proposer, facultyProposerID, advisorID, researchstatus, researchclassification) VALUES (:title, :abstract, :introduction, :methodology, :results, :discussion, :conclusion, :datepublished, :keywords, :status, :proposer, :facultyProposerID, :advisorID, :researchstatus, :researchclassification)");
  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':abstract', $abstract);
  $stmt->bindParam(':introduction', $introduction);
  $stmt->bindParam(':methodology', $methodology);
  $stmt->bindParam(':results', $results);
  $stmt->bindParam(':discussion', $discussion);
  $stmt->bindParam(':conclusion', $conclusion);
  $stmt->bindParam(':datepublished', $datepublished);
  $stmt->bindParam(':keywords', $keywords);
  $stmt->bindParam(':status', $status);
  $stmt->bindParam(':proposer', $proposer);
  $stmt->bindParam(':facultyProposerID', $facultyProposerID);
  $stmt->bindParam(':advisorID', $advisorID);
  $stmt->bindParam(':researchstatus', $researchstatus);
  $stmt->bindParam(':researchclassification', $researchclassification);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    send_message_and_redirect("Error: " . $e->getMessage(), "http://localhost/ereliv/student/");
  }
  return $conn->lastInsertId();
}

function getAuthors($conn, $researchID)
{
  $query = "SELECT Author.*
              FROM ResearchAuthorList
              INNER JOIN Author ON ResearchAuthorList.authorID = Author.authorID
              WHERE ResearchAuthorList.researchID = :researchID";

  $stmt = $conn->prepare($query);
  $stmt->bindParam(':researchID', $researchID);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProgramsAnalytics($conn)
{
  $query = "SELECT
                p.name AS programName,
                COUNT(rp.researchID) AS programCardinality
            FROM
                Program p
            LEFT JOIN
                ResearchProgramList prl ON p.programID = prl.programID
            LEFT JOIN
                ActivePaper ap ON prl.researchID = ap.researchPaper AND ap.status = 'active'
            LEFT JOIN
                Research rp ON ap.researchPaper = rp.researchID
            GROUP BY
                p.name
            ORDER BY
                programCardinality DESC;";

  $stmt = $conn->prepare($query);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getStatusesAnalytics($conn)
{
  $query = "SELECT r.researchstatus, COUNT(*) AS num_of_research
            FROM Research r
            INNER JOIN ActivePaper ap ON r.researchID = ap.researchPaper
            WHERE ap.status = 'active'
            GROUP BY r.researchstatus;";

  $stmt = $conn->prepare($query);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getClassificationsAnalytics($conn)
{
  $query = "SELECT r.researchclassification, COUNT(*) AS num_of_research
            FROM Research r
            INNER JOIN ActivePaper ap ON r.researchID = ap.researchPaper
            WHERE ap.status = 'active'
            GROUP BY r.researchclassification;";

  $stmt = $conn->prepare($query);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPrograms($conn, $researchID)
{
  $query = "SELECT Program.*
              FROM ResearchProgramList
              INNER JOIN Program ON ResearchProgramList.programID = Program.programID
              WHERE ResearchProgramList.researchID = :researchID";

  $stmt = $conn->prepare($query);
  $stmt->bindParam(':researchID', $researchID);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getInterests($conn, $researchID)
{
  $query = "SELECT Interest.*
              FROM ResearchInterestList
              INNER JOIN Interest ON ResearchInterestList.InterestID = Interest.InterestID
              WHERE ResearchInterestList.researchID = :researchID";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':researchID', $researchID);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addInterest($conn, $name)
{
  $stmt = $conn->prepare("INSERT into Interest (name) VALUES (:name)");
  $stmt->bindParam(':name', $name);
  $stmt->execute();
}

function editInterest($conn, $name, $interestID)
{
  $stmt = $conn->prepare("UPDATE Interest SET name = :name WHERE interestID = :interestID");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':interestID', $interestID);
  $stmt->execute();
}
function deleteInterest($conn, $interestID)
{
  $stmt = $conn->prepare("DELETE FROM Interest WHERE interestID = :interestID");
  $stmt->bindParam(':interestID', $interestID);
  $stmt->execute();
}

function searchInterest($conn, $searchQuery)
{
  // Prepare the SQL query to fetch the related authors
  $stmt = $conn->prepare("SELECT * FROM Interest WHERE name LIKE :searchQuery");
  $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function searchProgram($conn, $searchQuery)
{
  // Prepare the SQL query to fetch the related authors
  $stmt = $conn->prepare("SELECT * FROM Program WHERE name LIKE :searchQuery");
  $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addAuthor($conn, $firstname, $lastname)
{
  $stmt = $conn->prepare("INSERT into Author (firstname, lastname) VALUES (:firstname, :lastname)");
  $stmt->bindParam(':firstname', $firstname);
  $stmt->bindParam(':lastname', $lastname);
  $stmt->execute();
}

function deleteAuthor($conn, $authorID)
{
  $stmt = $conn->prepare("DELETE FROM Author WHERE authorID = :authorID");
  $stmt->bindParam(':authorID', $authorID);
  $stmt->execute();
}

function editAuthor($conn, $firstname, $lastname, $authorID)
{
  $stmt = $conn->prepare("UPDATE Author SET firstname = :firstname, lastname = :lastname WHERE authorID = :authorID");
  $stmt->bindParam(':lastname', $lastname);
  $stmt->bindParam(':firstname', $firstname);
  $stmt->bindParam(':authorID', $authorID);
  $stmt->execute();
}

function searchAuthor($conn, $searchQuery)
{
  // Prepare the SQL query to fetch the related authors
  $stmt = $conn->prepare("SELECT * FROM Author WHERE firstname LIKE :searchQuery OR lastname LIKE :searchQuery");
  $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');
  $stmt->execute();

  // Fetch the results
  return $stmt->fetchAll(PDO::FETCH_ASSOC);

}



function linkAuthorAndResearch($conn, $authorID, $researchID)
{
  $stmt = $conn->prepare("INSERT INTO ResearchAuthorList (authorID, researchID) Values (:authorID, :researchID)");
  $stmt->bindParam(':authorID', $authorID);
  $stmt->bindParam(':researchID', $researchID);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}

function linkProgramAndResearch($conn, $programID, $researchID)
{
  $stmt = $conn->prepare("INSERT INTO ResearchProgramList (programID, researchID) Values (:programID, :researchID)");
  $stmt->bindParam(':programID', $programID);
  $stmt->bindParam(':researchID', $researchID);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}
function linkInterestAndResearch($conn, $interestID, $researchID)
{
  $stmt = $conn->prepare("INSERT INTO ResearchInterestList (interestID, researchID) Values (:interestID, :researchID)");
  $stmt->bindParam(':interestID', $interestID);
  $stmt->bindParam(':researchID', $researchID);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
    return false;
  }
  return true;
}

function createEditHistory($conn, $activePaperID, $paperUpdate, $approver)
{
  $stmt = $conn->prepare("INSERT INTO EditHistory (activePaperID, paperUpdate, approver) Values (:activePaperID, :paperUpdate, :approver)");
  $stmt->bindParam(':activePaperID', $activePaperID);
  $stmt->bindParam(':paperUpdate', $paperUpdate);
  $stmt->bindParam(':approver', $approver);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    send_message_and_redirect("Error: " . $e->getMessage() . ' ' . $activePaperID . ' ' . $paperUpdate . ' ' . $approver, "http://localhost/ereliv/student/");
    return false;
  }
  return true;
}
function createActivePaper($conn, $facultyCreatorID, $researchPaper)
{
  $stmt = $conn->prepare("INSERT INTO ActivePaper (facultyCreatorID, researchPaper) Values (:facultyCreatorID, :researchPaper)");
  $stmt->bindParam(':facultyCreatorID', $facultyCreatorID);
  $stmt->bindParam(':researchPaper', $researchPaper);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    return false;
  }
  return $conn->lastInsertId();
}

function updateActivePaper($conn, $updatedResearchPaper, $oldResearchPaper)
{
  $stmt = $conn->prepare("UPDATE ActivePaper SET researchPaper = :updatedResearchPaper WHERE researchPaper = :oldResearchPaper");
  $stmt->bindParam(':updatedResearchPaper', $updatedResearchPaper);
  $stmt->bindParam(':oldResearchPaper', $oldResearchPaper);

  try {
    $stmt->execute();
  } catch (PDOException $e) {
    return false;
  }

  $selectStmt = $conn->prepare("SELECT activePaperID FROM ActivePaper WHERE researchPaper = :researchPaper");
  $selectStmt->bindParam(':researchPaper', $updatedResearchPaper);

  try {
    $selectStmt->execute();
    $result = $selectStmt->fetch(PDO::FETCH_ASSOC);
    $activePaperID = $result['activePaperID'];
    return $activePaperID;
  } catch (PDOException $e) {
    return false;
  }
}


function deleteActivePaper($conn, $researchPaper)
{
  $stmt = $conn->prepare("UPDATE ActivePaper SET status = 'inactive' WHERE researchPaper = :researchPaper;");
  $stmt->bindParam(':researchPaper', $researchPaper);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    return false;
  }
  return true;
}

function getStudentsBySection($conn, $sectionID)
{
  // Prepare the query to retrieve students by section
  $stmt = $conn->prepare("SELECT * FROM Student WHERE sectionID = :section");

  // Bind the section parameter
  $stmt->bindParam(':section', $sectionID);

  // Execute the query
  $stmt->execute();

  // Fetch the results as an associative array
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateStudentsProgram($conn, $oldProgram, $newProgram)
{
  // Prepare the query to update students' Program
  $stmt = $conn->prepare("UPDATE Student SET program = :newProgram WHERE LOWER(program) = LOWER(:oldProgram)");

  // Bind the parameters
  $stmt->bindParam(':newProgram', $newProgram);
  $stmt->bindParam(':oldProgram', $oldProgram);

  // Execute the query
  $stmt->execute();
}

function getCategoriesAuthor($conn, $search)
{
  $stmt = $conn->prepare("SELECT * FROM Author ORDER by firstname ASC");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getCategoriesInterest($conn, $search)
{
  $stmt = $conn->prepare("SELECT * FROM Interest ORDER by name ASC");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function isValidDate($date)
{
  $format = 'Y-m-d';
  $dateTime = DateTime::createFromFormat($format, $date);
  return $dateTime && $dateTime->format($format) === $date;
}

function getActiveResearchPapers($conn, $searchTerm)
{
  $searchTerm = '%' . $searchTerm . '%';
  $stmt = $conn->prepare("SELECT Research.*, DATE_FORMAT(Research.datepublished, '%d %M %Y') AS datepublished
                          FROM ActivePaper
                          JOIN Research ON ActivePaper.researchPaper = Research.researchID
                          WHERE ActivePaper.status = 'active'
                            AND (Research.abstract LIKE :searchTerm
                                 OR Research.title LIKE :searchTerm
                                 OR Research.keywords LIKE :searchTerm);");
  $stmt->bindParam(':searchTerm', $searchTerm);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function searchResearchByAuthorID($conn, $authorID, $search)
{
  $stmt = $conn->prepare("SELECT DISTINCT r.*, DATE_FORMAT(r.datepublished, '%d %M %Y') AS datepublished
                          FROM ResearchAuthorList ral
                          JOIN ActivePaper ap ON ral.researchID = ap.researchPaper
                          JOIN Research r ON ral.researchID = r.researchID
                          WHERE ral.authorID = :authorID
                          AND ap.status = 'active'
                          AND (r.abstract LIKE :search OR r.title LIKE :search OR r.keywords LIKE :search);");
  $stmt->bindParam(':authorID', $authorID);
  $stmt->bindValue(':search', "%$search%");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function searchResearchByInterestID($conn, $interestID, $search)
{
  $stmt = $conn->prepare("SELECT DISTINCT r.*, DATE_FORMAT(r.datepublished, '%d %M %Y') AS datepublished
                          FROM ResearchInterestList ral
                          JOIN ActivePaper ap ON ral.researchID = ap.researchPaper
                          JOIN Research r ON ral.researchID = r.researchID
                          WHERE ral.interestID = :interestID
                          AND ap.status = 'active'
                          AND (r.abstract LIKE :search OR r.title LIKE :search OR r.keywords LIKE :search);");
  $stmt->bindParam(':interestID', $interestID);
  $stmt->bindValue(':search', "%$search%");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function searchResearchByProgramID($conn, $programID, $search)
{
  $stmt = $conn->prepare("SELECT DISTINCT r.*, DATE_FORMAT(r.datepublished, '%d %M %Y') AS datepublished
                          FROM ResearchProgramList ral
                          JOIN ActivePaper ap ON ral.researchID = ap.researchPaper
                          JOIN Research r ON ral.researchID = r.researchID
                          WHERE ral.programID = :programID
                          AND ap.status = 'active'
                          AND (r.abstract LIKE :search OR r.title LIKE :search OR r.keywords LIKE :search);");
  $stmt->bindParam(':programID', $programID);
  $stmt->bindValue(':search', "%$search%");
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getAdvisees($conn, $facultyID, $search)
{
  $stmt = $conn->prepare("SELECT Student.*, Section.name AS sectionname, DATE_FORMAT(Student.
                            dateregistered, '%d %M %Y') AS date
                          FROM Adviserteam
                          JOIN Student ON Adviserteam.studentID = Student.studentID
                          LEFT JOIN Section ON Student.sectionID = Section.sectionID
                          WHERE Adviserteam.facultyID = :facultyID
                          AND (Student.lastname LIKE CONCAT('%', :search, '%') OR Student.firstname LIKE CONCAT('%', :search, '%'))
                          ORDER BY CASE Student.priority
                              WHEN 'High' THEN 1
                              WHEN 'Medium' THEN 2
                              WHEN 'Low' THEN 3
                              ELSE 4 -- For any other priority values (optional)
                          END, Student.dateregistered ASC;
                          ");
  $stmt->bindParam(':facultyID', $facultyID);
  $stmt->bindParam(':search', $search);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>