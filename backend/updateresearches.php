<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$criteria = $_POST['criteria'];

$researches = getList($conn, "*", "Research");

if (!empty($researches)) {
  foreach ($researches as $research) {
    $authors = getAuthorNames($conn, $research['researchID']);
    $programs = getProgramNames($conn, $research['researchID']);

    // Echo the research item
    echo '<a href="#displaypage" id="' . $research['researchID'] . '" class="text-decoration-none text-dark research-link" data-bs-toggle="modal">';
    echo '<div class="row d-flex border border-smoke p-3 rounded">';
    echo '<div class="col">';
    echo '<h4 class="text-capitalize research-title">' . strtolower($research['title']) . '</h4>';
    echo '<div class="col d-flex justify-content-start">';
    echo '<div class="research-authors fw-bold">';
    echo '<span class="fw-normal">Authors: </span>';

    foreach ($authors as $author) {
      echo '<span class="text-capitalize">' . $author . '</span> ';
    }

    echo '</div>';
    echo '<span class="ml-auto mr-4 research-publish-date">Date Published: <strong>' . $research['datepublished'] . '</strong></span>';
    echo '<span class="text-capitalize research-uploader">Uploader: <strong>' . $research['proposer'] . '</strong></span>';
    echo '</div>';
    echo '<div class="truncate content ms-3 research-abstract" data-full-text="' . htmlspecialchars($research['abstract'], ENT_QUOTES) . '">' . strip_tags($research['abstract']) . '</div>';
    echo '<div class="mt-3 mb-1 research-programs">';

    foreach ($programs as $program) {
      echo '<span class="btn-sm btn-primary">' . $program . '</span> ';
    }

    echo '</div>';
    echo '<span class="fw-bold mt-2">Keywords: </span>';
    echo '<div class="truncate content ms-3 text-capitalize research-keywords" data-full-text="' . $research['keywords'] . '">';
    echo '<p>' . $research['keywords'] . '</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</a>';
  }
}
?>