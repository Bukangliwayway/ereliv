<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';
$program = getList($conn, '*', 'Program');

foreach ($program as $programData) {
    $section = getSectionList($conn, $programData['programID']);

    echo '<div class="row bg-light">
        <div class="col-6 d-flex flex-column justify-content-center border border-smoke rounded p-2">
            <div class="row">
                <h1 class="text-uppercase">' . $programData['name'] . '</h1>
            </div>
        </div>
        <div class="col-1 d-flex flex-column justify-content-center align-items-stretch gap-2">
            <div class="row">
                <h1>
                    <a href="#editprogrammodal" class="editprogrambutton icon-link border border-smoke rounded p-2 text-reset" data-bs-toggle="modal" data-string="' . $programData['name'] . '">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </h1>
            </div>
            <div class="row">
                <h1>
                    <a href="#deleteprogrammodal" class="deleteprogrambutton icon-link border border-smoke rounded p-2 text-reset" data-bs-toggle="modal" data-string="' . $programData['name'] . '">
                        <i class="bi bi-trash"></i>
                    </a>
                </h1>
            </div>
        </div>
        <div class="col-5 d-flex flex-column justify-content-center align-items-stretch gap-2">';

    foreach ($section as $row) {
        echo '<div class="row">
                <div class="col-8">
                    <h1 class="text-uppercase border border-smoke rounded p-1 text-truncate" value="' . $row['sectionID'] . '">' . $row['name'] . '</h1>
                </div>
                <div class="col-4 d-flex flex-row gap-1">
                    <h1>
                        <a href="#editsectionmodal" class="editsectionbutton icon-link border border-smoke rounded p-2 text-reset" data-string="' . $row['sectionID'] . '" data-bs-toggle="modal">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </h1>
                    <h1>
                        <a href="#deletesectionmodal" class="deletesectionbutton icon-link border border-smoke rounded p-2 text-reset" data-string="' . $row['name'] . '" data-id="' . $row['sectionID'] . '" data-bs-toggle="modal">
                            <i class="bi bi-trash"></i>
                        </a>
                    </h1>
                </div>
            </div>';
    }

    echo '<a href="#addsectionmodal" class="addsectionbutton link-primary link-offset-2 link-underline-opacity-0 text-capitalize text-reset" data-bs-toggle="modal" data-string="' . $programData['programID'] . '">
            <div class="row border border-smoke rounded">
                <h1>Add Section <i class="bi bi-plus-circle fs-2"></i></h1>
            </div>
        </a>
    </div>
    </div>';
}

echo '<a href="#addprogrammodal" class="link-primary link-offset-2 link-underline-opacity-0 text-capitalize text-reset" data-bs-toggle="modal">
        <div class="row p-3 border border-smoke rounded p-2 bg-light">
            <div class="col d-flex flex-column justify-content-center align-items-center p-3">
                <h1>Add Program <i class="bi bi-plus-circle fs-2"></i></h1>
            </div>
        </div>
    </a>';
?>