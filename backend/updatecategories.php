<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$output = '';
$search = isset($_POST["search"]) ? $_POST["search"] : '';
$table = $_POST["table"];

$output .= '<div class="d-inline-flex flex-wrap gap-3 p-5 align-items-center" style="max-height: 70vh;">';

if ($table == 'Author') {
  $categories = getCategoriesAuthor($conn, $search);
  foreach ($categories as $author) {

    $output .= '  
      
            <div class="d-flex align-items-stretch gap-1 p-1 smoke-border rounded " data-bs-target="#editauthormodal" data-bs-toggle="modal">
            <button class="btn btn-outline-primary shadow-sm editauthorbutton"
                    data-authorID=' . $author['authorID'] . '
                    data-firstname=' . $author['firstname'] . '
                    data-lastname=' . $author['lastname'] . '
            >
              ' . ucwords(strtolower($author['firstname'])) . ' ' . ucwords(strtolower($author['lastname'])) . '
            </button>
              <button class="btn btn-outline-danger shadow-sm deleteauthorbutton"
                      data-bs-target="#deleteauthormodal"
                      data-bs-toggle="modal"
                      data-authorID=' . $author['authorID'] . '
                      data-firstname=' . $author['firstname'] . '
                      data-lastname=' . $author['lastname'] . '
                      data-user = "author">
                <i class="bi bi-x"></i>
              </button>
            </div>

  ';
  }
}

if ($table == 'Interest') {
  $categories = getCategoriesInterest($conn, $search);
  foreach ($categories as $interest) {
    $output .= ' 
            <div class="d-flex align-items-stretch gap-1 p-1 smoke-border rounded "
            data-bs-target="#editinterestmodal" data-bs-toggle="modal">
              <button class="btn btn-outline-primary shadow-sm editinterestbutton"
                      data-interestID=' . $interest['interestID'] . '
                      data-name=' . $interest['name'] . '
              >
                ' . ucwords(strtolower($interest['name'])) . '
              </button>
              <button class="btn btn-outline-danger shadow-sm deleteinterestbutton"
                      data-bs-target="#deleteinterestmodal"
                      data-bs-toggle="modal"
                      data-interestID=' . $interest['interestID'] . '
                      data-name=' . $interest['name'] . '
              >
                <i class="bi bi-x"></i>
              </button>
            </div>
  ';
  }
}

$output .= '</div>';
echo $output;
?>