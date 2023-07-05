<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$search = $_POST['search'];
$userID = $_POST['userID'];

$advisees = getAdvisees($conn, $userID, $search);


$output .= '<div class="d-inline-flex flex-wrap gap-3 p-5 align-items-center" style="max-height: 70vh;">';

foreach ($advisees as $advisee) {
  // Loop through each advisee item

  // Generate HTML for the advisee item  
  switch ($advisee['priority']) {
    case 'Low':
      $outline = 'btn-outline-success';
      $bgStatus = 'bg-success';
      $btnStatus = 'btn-danger';
      $textContent = 'activate';
      $action = 'deactivate advisee';
      break;
    case 'Medium':
      $outline = 'btn-outline-warning text-dark';
      $bgStatus = 'bg-warning';
      $btnStatus = 'btn-success';
      $action = 'activate advisee';
      break;
    case 'High':
      $outline = 'btn-outline-danger';
      $bgStatus = 'bg-danger';
      $btnStatus = 'bg-success';
      $action = 'activate advisee';
      break;
  }

  $output .= '  
            <div class="d-flex align-items-stretch gap-1 p-1 smoke-border rounded ">
              <button class="btn ' . $outline . ' shadow-sm advisee-view"
                data-bs-target="#displayadviseemodal" 
                data-bs-toggle="modal" 
                data-advisee-studentID ="' . $advisee['studentID'] . '"
                data-advisee-name = "' . ucwords(strtolower($advisee['firstname'] . ' ' . $advisee['lastname'])) . '"
                data-advisee-studentnumber ="' . $advisee['studentnumber'] . '"
                data-advisee-program ="' . $advisee['program'] . '"
                data-advisee-sectionname ="' . $advisee['sectionname'] . '"
                data-advisee-status ="' . $advisee['status'] . '"
                data-advisee-date ="' . $advisee['date'] . '"
                data-advisee-computedate ="' . $advisee['dateregistered'] . '"
                data-advisee-priority ="' . $advisee['priority'] . '"
                data-advisee-bgStatus ="' . $bgStatus . '"
                data-advisee-btnStatus ="' . $btnStatus . '"
                data-advisee-action-title ="' . $action . '"
              >
              ' . ucwords(strtolower($advisee['firstname'])) . ' ' . ucwords(strtolower($advisee['lastname'])) . '
              </button>
            </div>
  ';
}
$output .= '</div>';
// Send the HTML response
echo $output;

?>