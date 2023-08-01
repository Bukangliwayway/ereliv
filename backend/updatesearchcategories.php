<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$output = '';
$search = isset($_POST["search"]) ? $_POST["search"] : '';
$table = $_POST["table"];


if ($table == 'Author') {

  $categories = searchAuthor($conn, $search);
  foreach ($categories as $author) {
    $output .= '  
    <button class="btn btn-outline-primary shadow-sm searchByAuthorChildren categoryfilter"
    data-id=' . $author['authorID'] . '
                    data-name="' . ucwords($author['firstname'] . ' ' . $author['lastname']) . '"
                    data-type="author" >
                    ' . ucwords(strtolower($author['firstname'])) . ' ' . ucwords(strtolower($author['lastname'])) . '
            </button>
  ';
  }
}

if ($table == 'Interest') {

  $categories = searchInterest($conn, $search);
  foreach ($categories as $interest) {
    $output .= ' 
    <button class="btn btn-outline-primary shadow-sm searchByInterestChildren categoryfilter"
    data-id=' . $interest['interestID'] . '
    data-name=' . $interest['name'] . '
    data-type="interest">
    ' . ucwords(strtolower($interest['name'])) . '
    </button>
    ';
  }
}

if ($table == 'Program') {

  $categories = searchProgram($conn, $search);
  foreach ($categories as $program) {
    $output .= ' 
                <button class="btn btn-outline-primary shadow-sm searchByProgramChildren text-uppercase categoryfilter"
                data-id=' . $program['programID'] . '
                data-name=' . $program['name'] . '
                data-type="program">
                ' . ucwords(strtolower($program['name'])) . '
                </button>
  ';
  }
}

if (count($categories) == 11) {
  $output .= '  
  <button class="btn btn-outline-primary shadow-sm" disabled>
  More...
            </button>
            ';
}

echo $output;
?>