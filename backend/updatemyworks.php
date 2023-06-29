<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$userID = $_POST['userID'];
if (!empty($_POST['search']))
  $search = $_POST['search'];

switch ($_POST['type']) {
  case 'faculty':
    $researches = empty($search) ? getFacultyWorks($conn, $userID) : searchFacultyWorks($conn, $userID, $search);
    break;
  case 'student':
    $researches = empty($search) ? getStudentWorks($conn, $userID) : searchStudentWorks($conn, $userID, $search);
    break;
  default:
    $researches = array(); // or handle the case accordingly
    break;
}
if (!empty($researches)) {
  $output = ''; // Initialize an empty string
  $output .= '<div class="row">';
  foreach ($researches as $research) {
    // Loop through each research item
    $authors = getAuthors($conn, $research['researchID']);
    $programs = getPrograms($conn, $research['researchID']);
    $interests = getInterests($conn, $research['researchID']);

    // Generate HTML for the research item
    $output .= '<div class="research-link border border-smoke rounded my-1">';
    $output .= '<div class="p-3 d-flex flex-column gap-2" style="position:relative;">';

    // Button Pages 
    $output .= '<div class="research-buttons d-flex justify-content-end fixed-upper-end gap-1 mt-3 mr-1">';
    $output .= '<a class="editpaperswitch btn btn-sm btn-outline-primary edit-button text-decoration-none" data-researchID="' . $research['researchID'] . '">Edit Paper</a>';
    $output .= '<a href="#deletepapermodal" class="btn btn-sm btn-outline-danger delete-button text-decoration-none" data-researchID="' . $research['researchID'] . '" data-bs-toggle="modal">Delete Paper</a>';
    $output .= '</div>';

    // Research Title
    $output .= '<a href="#displaypapermodal" class="d-flex text-dark research-title research-point text-decoration-none text-capitalize" data-bs-toggle="modal">';
    $output .= '<span class="research-title">' . $research['title'] . '</span>';
    $output .= '</a>';

    // Research Programs and Date
    $output .= '<div class="d-flex flex-row align-items-center">';
    $output .= '<div class="italize research-programs d-flex gap-1">';
    foreach ($programs as $program) {
      $output .= '<a class="btn btn-sm btn-outline-primary program-button text-decoration-none" data-programID="' . $program['programID'] . '">' . $program['name'] . '</a>';
    }
    $output .= '</div>';
    $output .= '<span class="ml-1 research-publish-date">' . $research['datepublished'] . '</span>';
    $output .= '</div>';

    // AUTHORS
    $authorNames = array_map(function ($author) {
      $name = strtolower($author['lastname'] . ' ' . $author['firstname']);
      $name = ucwords($name);
      return [
        'name' => $name,
        'authorID' => $author['authorID']
      ];
    }, $authors);

    $output .= '<div class="research-authors">';
    $authorCount = count($authorNames);
    foreach ($authorNames as $index => $author) {
      $output .= '<a href="#" class="text-decoration-none text-dark research-point" data-authorID="' . $author['authorID'] . '" class="research-author"> <i class="bi bi-person-fill"></i> ' . $author['name'] . '</a>';
      if ($index < $authorCount - 1) {
        $output .= ', ';
      }
    }

    $output .= '</div>';

    // Interest Badges
    $output .= '<div class="research-interest fixed-lower-end mb-3 mr-3 d-flex gap-1">';
    foreach ($interests as $interest) {
      $output .= '<a href="#" class="badge bg-primary text-decoration-none text-white" data-interestID="' . $interest['interestID'] . '">' . $interest['name'] . '</a>';
    }

    $output .= '</div>';

    $output .= '</div>'; // Close p-3 div

    $output .= '<input type="hidden" class="research-abstract" data-full-text="' . htmlspecialchars($research['abstract'], ENT_QUOTES) . '">';
    $output .= '<input type="hidden" class="research-keywords" data-full-text="' . $research['keywords'] . '">';
    $output .= '<input type="hidden" class="research-uploader" data-full-text="' . $research['proposer'] . '">';
    $output .= '<input type="hidden" class="research-id" data-full-text="' . $research['researchID'] . '">';

    $authorIDs = array_map(function ($author) {
      return $author["authorID"];
    }, $authors);
    $output .= '<input type="hidden" class="research-raw-authors" value="' . htmlentities(json_encode($authorIDs)) . '">';

    $programIDs = array_map(function ($program) {
      return $program["programID"];
    }, $programs);
    $output .= '<input type="hidden" class="research-raw-programs" value="' . htmlentities(json_encode($programIDs)) . '">';

    $interestIDs = array_map(function ($interest) {
      return $interest["interestID"];
    }, $interests);
    $output .= '<input type="hidden" class="research-raw-interests" value="' . htmlentities(json_encode($interestIDs)) . '">';

    $output .= '</div>'; // Close research-item-container div
  }
  $output .= '</div>'; // Close row

  // Send the HTML response
  echo $output;
}
?>