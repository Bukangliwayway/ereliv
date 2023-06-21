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
            <button class="btn btn-outline-primary shadow-sm edit-author">
              ' . ucfirst(strtolower($author['firstname'])) . ' ' . ucfirst(strtolower($author['lastname'])) . '
            </button>
              <button class="btn btn-outline-danger shadow-sm remove-author"
                      data-bs-target="#deleteauthormodal"
                      data-bs-toggle="modal"
                      data-id=' . $author['authorID'] . '
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
              <button class="btn btn-outline-primary shadow-sm edit-interest">
                ' . ucfirst(strtolower($interest['name'])) . '
              </button>
              <button class="btn btn-outline-danger shadow-sm remove-interest"
                      data-bs-target="#deleteinterestmodal"
                      data-bs-toggle="modal"
                      data-id=' . $interest['interestID'] . '
                      data-user = "interest">
                <i class="bi bi-x"></i>
              </button>
            </div>
  ';
  }
}

$output .= '</div>';
echo $output;
?>