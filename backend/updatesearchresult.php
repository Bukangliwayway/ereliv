<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$userID = $_POST['userID'];
if (!empty($_POST['search']))
  $search = $_POST['search'];

$researches = getActiveResearchPapers($conn, $search);

$output = ''; // Initialize an empty string
$output .= '<div class="row">';
foreach ($researches as $research) {
  // Loop through each research item
  $authors = getAuthors($conn, $research['researchID']);
  $programs = getPrograms($conn, $research['researchID']);
  $interests = getInterests($conn, $research['researchID']);


  // // Generate HTML for the research item
  $output .= '<div href="#displaypapermodal" class="research-point search-research-link border border-smoke rounded my-1" data-bs-toggle="modal">';
  $output .= '<div class="p-3 d-flex flex-column gap-2" style="position:relative;">';

  // // Research Title
  $output .= '<span class="search-research-title text-capitalize">' . $research['title'] . '</span>';

  // Research Programs and Date
  $output .= '<div class="d-flex flex-row align-items-center">';
  $output .= '<div class="italize search-research-programs d-flex gap-1">';
  foreach ($programs as $program) {
    $output .= '<a class="btn btn-sm btn-outline-primary program-button text-decoration-none text-uppercase" data-programID="' . $program['programID'] . '">' . $program['name'] . '</a>';
  }
  $output .= '</div>';
  $output .= '<span class="ml-1 search-research-publish-date">' . $research['datepublished'] . '</span>';
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

  $output .= '<div class="search-research-authors">';
  $authorCount = count($authorNames);
  foreach ($authorNames as $index => $author) {
    $output .= '<a href="#" class="text-decoration-none text-dark" data-authorID="' . $author['authorID'] . '" class="search-research-author"> <i class="bi bi-person-fill"></i> ' . $author['name'] . '</a>';
    if ($index < $authorCount - 1) {
      $output .= ', ';
    }
  }

  $output .= '</div>';

  // Interest Badges
  $output .= '<div class="search-research-interest fixed-lower-end mb-3 mr-3 d-flex gap-1">';
  foreach ($interests as $interest) {
    $output .= '<a href="#" class="badge bg-primary text-decoration-none text-white" data-interestID="' . $interest['interestID'] . '">' . $interest['name'] . '</a>';
  }

  $output .= '</div>';

  $output .= '</div>'; // Close p-3 div

  $output .= '<input type="hidden" class="search-research-abstract" data-full-text="' . htmlspecialchars($research['abstract'], ENT_QUOTES) . '">';
  $output .= '<input type="hidden" class="search-research-keywords" data-full-text="' . $research['keywords'] . '">';
  $output .= '<input type="hidden" class="search-research-uploader" data-full-text="' . $research['proposer'] . '">';
  $output .= '<input type="hidden" class="search-research-id" data-full-text="' . $research['researchID'] . '">';

  $authorIDs = array_map(function ($author) {
    return $author["authorID"];
  }, $authors);
  $output .= '<input type="hidden" class="search-research-raw-authors" value="' . htmlentities(json_encode($authorIDs)) . '">';

  $programIDs = array_map(function ($program) {
    return $program["programID"];
  }, $programs);
  $output .= '<input type="hidden" class="search-research-raw-programs" value="' . htmlentities(json_encode($programIDs)) . '">';

  $interestIDs = array_map(function ($interest) {
    return $interest["interestID"];
  }, $interests);
  $output .= '<input type="hidden" class="search-research-raw-interests" value="' . htmlentities(json_encode($interestIDs)) . '">';

  $output .= '</div>'; // Close search-research-item-container div
}
$output .= '</div>'; // Close row

// Send the HTML response
echo $output;

?>