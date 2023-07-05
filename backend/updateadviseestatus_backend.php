<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$adviseeID = filter_input(INPUT_POST, 'adviseeID', FILTER_SANITIZE_STRING);
$actionByName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$actionByUser = filter_input(INPUT_POST, 'ownertype', FILTER_SANITIZE_STRING);
$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

$response = array();

toggleStudentAccount($conn, $adviseeID, $status);

$emailadd = getStudentEmail($conn, $adviseeID);

if ($status == "Active") {
  $title = "PUPQC RMS Account Request Approval Accepted";
  $body = 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our ' . ucwords($actionByUser) . ' member, ' . ucwords($actionByName) . ' . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.';

} else {
  $title = "PUPQC RMS Account Deactivation";
  $body = "We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our ' . ucwords($actionByUser) . ' member, ' . ucwords($actionByName) . ' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.";
}

sendEmail($conn, $emailadd, $title, $body);

$notificationID = createNotif($conn, $title, $body);
$issuerID = $_SESSION['userID'];
$recipientID = $adviseeID;

createNotificationLink($conn, $recipientID, $issuerID, $notificationID, 'student', 'faculty');

$response['status'] = 'success';
$response['message'] = "Advisee Account has been updated successfully";

echo json_encode($response);
?>