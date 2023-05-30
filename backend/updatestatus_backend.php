<?php
require_once("../backend/session_admin.php");
include '../db/db.php';
include '../db/queries.php';

$string = filter_input(INPUT_POST, 'string', FILTER_SANITIZE_STRING);
$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
$user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);

if ($user == "Student" && toggleStudentAccount($conn, $string, $status)) {
  $emailadd = getStudentEmail($conn, $string);
  if ($status == "Active") {
    $title = "PUPQC RMS Account Request Approval Accepted";
    $body = "Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System. You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please don't hesitate to reach out to our support team.";
    sendEmail($conn, $emailadd, $title, $body, "http://localhost/ereliv/admin/?viewAccountsContainer=block");
    
    $redirect = "#";
    $notificationID = createNotif($conn, $title, $body, $redirect);
    $issuerID = $_SESSION['userID']; //admin
    $recipientID = $string;
    //Notification for Account Activation
    createNotificationLink($conn, $recipientID, $issuerID, $notificationID, 'student', 'admin');
  } else {
    $title = "PUPQC RMS Account Deactivation";
    $body = "We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated. Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.";
    sendEmail($conn, $emailadd, $title, $body, "http://localhost/ereliv/admin/?viewAccountsContainer=block");

    $redirect = "#";
    $notificationID = createNotif($conn, $title, $body, $redirect);
    $issuerID = $_SESSION['userID']; //admin
    $recipientID = $string;
    //Notification for Account Deactivation
    createNotificationLink($conn, $recipientID, $issuerID, $notificationID, 'student', 'admin');
  }
  send_message_and_redirect("Student Account was Updated successfully", "http://localhost/ereliv/admin/?viewAccountsContainer=block");
}

if ($user == "Faculty" && toggleFacultyAccount($conn, $string, $status)) {
  $emailadd = getFacultyEmail($conn, $string);
  if ($status == 'Inactive') {
    $title = "PUPQC RMS Account Deactivation";
    $body = "We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated. Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.";
    sendEmail($conn, $emailadd, $title, $body, "http://localhost/ereliv/admin/?viewAccountsContainer=block");

    $redirect = "#";
    $notificationID = createNotif($conn, $title, $body, $redirect);
    $issuerID = $_SESSION['userID']; //admin
    $recipientID = $string;
    //Notification for Account Activation
    createNotificationLink($conn, $recipientID, $issuerID, $notificationID, 'faculty', 'admin');
  }else {
    $title = "Account has been Reactivated!";
    $body = " We are pleased to inform you that your account in the PUPQC Research Paper Management System has been reactivated. You can now access our platform and resume your research activities. <br> If you have any questions or need assistance, please don't hesitate to reach out to our support team.";
    sendEmail($conn, $emailadd, $title, $body, "http://localhost/ereliv/admin/?viewAccountsContainer=block");

    $redirect = "#";
    $notificationID = createNotif($conn, $title, $body, $redirect);
    $issuerID = $_SESSION['userID']; //admin
    $recipientID = $string;
    //Notification for Account Deactivation
    createNotificationLink($conn, $recipientID, $issuerID, $notificationID, 'faculty', 'admin');
  }
  send_message_and_redirect("Faculty Account was Updated successfully", "http://localhost/ereliv/admin/?viewAccountsContainer=block");
}