<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$facultyID = $_POST['facultyID'];

$researches = getFacultyWorks($conn, $facultyID);

if (!empty($researches)) {
  $output = ''; // Initialize an empty string
  $output .= '<div class="row">';
  foreach ($researches as $research) {
    // Loop through each research item
    $authors = getAuthors($conn, $research['researchID']);
    $programs = getPrograms($conn, $research['researchID']);
    $interests = getInterests($conn, $research['researchID']);

    // Generate HTML for the research item
    $output .= '<div class="research-item-container border border-smoke rounded my-1">';
    $output .= '<div class="p-3" style="position:relative;">';

    // Button Pages 
    $output .= '<div class="research-buttons d-flex justify-content-end fixed-upper-end gap-1 mt-3 mr-3">';
    $output .= '<a href="#editpage" class="btn btn-sm btn-primary edit-button text-decoration-none">Edit Paper</a>';
    $output .= '<a href="#deletepage" class="btn btn-sm btn-danger delete-button text-decoration-none">Delete Paper</a>';
    $output .= '</div>';

    // Interest Badges
    $output .= '<div class="research-interests fixed-lower-end mb-3 mr-3 d-flex gap-1">';
    foreach ($interests as $interest) {
      $output .= '<a href="#" class="badge bg-primary text-decoration-none text-white" id="' . $interest['interestID'] . '">' . $interest['name'] . '</a>';
    }
    $output .= '</div>';

    // Research Title
    $output .= '<a href="#displaypage" id="' . $research['researchID'] . '" class="d-flex text-dark research-link" data-bs-toggle="modal">';
    $output .= '<span class="research-title">' . $research['title'] . '</span>';
    $output .= '</a>';

    // Research Programs and Date
    $output .= '<div class="italize">';
    foreach ($programs as $program) {
      $output .= '<a class="btn btn-sm btn-outline-primary program-button text-decoration-none" id="' . $program['programID'] . '">' . $program['name'] . '</a>';
    }
    $output .= '<span class="ml-1">' . $research['datepublished'] . '</span>';
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
      $output .= '<a href="#" class="text-decoration-none text-dark" data-authorID="' . $author['authorID'] . '" class="research-author">' . $author['name'] . '</a>';
      if ($index < $authorCount - 1) {
        $output .= ', ';
      }
    }
    $output .= '</div>';

    $output .= '</div>'; // Close p-3 div
    $output .= '</div>'; // Close research-item-container div
  }
  $output .= '</div>'; // Close row

  // Send the HTML response
  echo $output;
}
?>