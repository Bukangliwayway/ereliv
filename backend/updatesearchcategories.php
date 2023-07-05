<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$output = '';
$search = isset($_POST["search"]) ? $_POST["search"] : '';
$table = $_POST["table"];

$output .= '<div class="d-inline-flex flex-wrap gap-3 p-3 align-items-center">';

if ($table == 'Author') {
  $categories = searchAuthor($conn, $search);
  foreach ($categories as $author) {

    $output .= '  
            <button class="btn btn-outline-primary shadow-sm searchByAuthorChildren"
                    data-authorID=' . $author['authorID'] . '
                    data-firstname=' . $author['firstname'] . '
                    data-lastname=' . $author['lastname'] . '>
              ' . ucwords(strtolower($author['firstname'])) . ' ' . ucwords(strtolower($author['lastname'])) . '
            </button>

  ';
  }
}

if ($table == 'Interest') {
  $categories = searchInterest($conn, $search);
  foreach ($categories as $interest) {
    $output .= ' 
              <button class="btn btn-outline-primary shadow-sm searchByInterestChildren"
                      data-interestID=' . $interest['interestID'] . '
                      data-name=' . $interest['name'] . '>
                ' . ucwords(strtolower($interest['name'])) . '
              </button>
  ';
  }
}

if ($table == 'Program') {
  $categories = searchProgram($conn, $search);
  foreach ($categories as $program) {
    $output .= ' 
              <button class="btn btn-outline-primary shadow-sm searchByProgramChildren text-uppercase"
                      data-programID=' . $program['programID'] . '
                      data-name=' . $program['name'] . '>
                ' . ucwords(strtolower($program['name'])) . '
              </button>
  ';
  }
}

$output .= '</div>';
echo $output;
?>