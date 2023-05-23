<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PUPQC Research Management Sytem</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css" />

  <link rel="stylesheet" href="../styles/main.css" />
</head>

<body>
  <?php
  include '../db/db.php';
  include '../db/queries.php';
  ?>
  <div class="container d-flex flex-column gap-3 text-center justify-content-center">
    <?php
    $program = getList($conn, '*', 'Program');
    foreach ($program as $programData) {
      $section = getSectionList($conn, $programData['programID']);
      echo '
            <div class="row">
            <div
              class="col-6 d-flex flex-column justify-content-center border border-primary rounded p-2"
            >
              <div class="row ">
                <h1 class="text-uppercase ">' . $programData['name'] . '</h1>
              </div>
            </div>
            <div
              class="col-1 d-flex flex-column justify-content-center align-items-stretch gap-2"
            >
              <div class="row">
                <h1>  
                <a href="#editprogrammodal" class="editprogrambutton icon-link border border-primary rounded p-2" data-bs-toggle="modal" data-string ="' . $programData['name'] . '">
                    <i class="bi bi-pencil-square"></i>
                  </a>  
                </h1>
              </div>
              <div class="row">
                <h1>  
                  <a href="#deleteprogrammodal" class="deleteprogrambutton icon-link border border-primary rounded p-2" data-bs-toggle="modal" data-string ="' . $programData['name'] . '">
                    <i class="bi bi-trash"></i>
                  </a>
                </h1>
              </div>
            </div>
            <div
              class="col-5 d-flex flex-column justify-content-center align-items-stretch gap-2"
            >
          ';

      foreach ($section as $row) {
        echo '<div class="row">
                      <div class="col-8">
                        <h1 class="text-uppercase border border-primary rounded p-1 text-truncate">' . $row['name'] . '</h1>
                      </div>
                      <div class="col-4 d-flex flex-row gap-1">
                          <h1>
                            <a href="#editsectionmodal" class="editsectionbutton icon-link border border-primary rounded p-2" data-string ="' . $row['name'] . '" data-bs-toggle="modal">
                              <i class="bi bi-pencil-square"></i>
                            </a>
                          </h1>
                          <h1>
                            <a href="#deletesectionmodal" class="deletesectionbutton icon-link border border-primary rounded p-2" data-string ="' . $row['name'] . '" data-bs-toggle="modal">
                              <i class="bi bi-trash"></i>
                            </a>
                          </h1>
                      </div>
                    </div>
              ';
      }
      echo ' 
            <a
              href="#addsectionmodal"
              class="addsectionbutton link-primary link-offset-2 link-underline-opacity-0 text-capitalize"
              data-bs-toggle="modal"
              data-string =' . $programData['programID'] . '
            >
            <div class="row border border-primary rounded">
              <h1>Add Section 
                <i class="bi bi-plus-circle fs-2"></i>
              </h1>
            </div>
          </a>  
              </div>
            </div>
            ';
    }
    ;
    echo '
          <a
            href="#addprogrammodal"
            class="link-primary link-offset-2 link-underline-opacity-0 text-capitalize"
            data-bs-toggle="modal"
          >
            <div class="row p-3 border border-primary rounded p-2">
              <div
                class="col d-flex flex-column justify-content-center align-items-center p-3"
              >
                <h1>Add Program 
                  <i class="bi bi-plus-circle fs-2"></i>
                </h1>
              </div>
            </div>
          </a>
        ';
    ?>
  </div>

  <!-- Modals -->
  <div class="modal fade" id="addsectionmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addsectionmodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-capitalize">
            Add Section
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="container modal-body">
          <form method="POST" action="../backend/addsection_backend.php" class="container d-flex flex-row gap-3">
            <div class="form-floating">
              <input type="text" id="section" name="section" class="form-control" placeholder="section" required />
              <label for="section" class="form-label">Section</label>
            </div>
            <input type="hidden" name="string" id="getprogramid_target">
            <button type="submit" class="btn btn-primary">Add</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editsectionmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editsectionmodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-capitalize">
            Edit Section
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="container modal-body">
          <form method="POST" action="../backend/editsection_backend.php" class="container d-flex flex-row gap-3">
            <div class="form-floating">
              <input type="text" id="original_target" name="original" class="form-control" readonly />
              <label for="section" class="form-label">Previous Name: </label>
            </div>
            <div class="form-floating">
              <input type="text" id="section" name="section" class="form-control" placeholder="section" required />
              <label for="section" class="form-label">Section</label>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deletesectionmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="deletesectionmodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-capitalize">
            Delete Section
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="container modal-body">
          <h5 class="text-capitalize text-center"> You Sure You want to Delete this Section? </h5>
          <form method="POST" action="../backend/deletesection_backend.php" class="container d-flex flex-row gap-3">
            <div class="form-floating">
              <input type="text" id="delete_target" name="section" class="form-control" readonly />
              <label for="section" class="form-label">To Be Deleted</label>
            </div>
            <button type="submit" class="btn btn-primary">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addprogrammodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addprogrammodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-capitalize">
            Add Program
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="container modal-body">
          <form method="POST" action="../backend/addprogram_backend.php" class="container d-flex flex-row gap-3">
            <div class="form-floating">
              <input type="text" name="program" class="form-control" placeholder="program" required />
              <label for="program" class="form-label">Program Name: </label>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editprogrammodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editprogrammodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text  -capitalize">
            Edit Program
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="container modal-body">
          <form method="POST" action="../backend/editprogram_backend.php" class="container d-flex flex-row gap-3">
            <div class="form-floating">
              <input type="text" id="original_program_target" name="original" class="form-control" readonly />
              <label for="program" class="form-label">Previous Name: </label>
            </div>
            <div class="form-floating">
              <input type="text" id="program" name="program" class="form-control" placeholder="program" required />
              <label for="program" class="form-label">Program</label>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteprogrammodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="deleteprogrammodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-capitalize">
            delete Program
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="container modal-body">
          <form method="POST" action="../backend/deleteprogram_backend.php" class="container d-flex flex-row gap-3">
            <div class="form-floating">
              <input type="text" id="delete_program_target" name="program" class="form-control" readonly />
              <label for="section" class="form-label">To Be Deleted</label>
            </div>
            <button type="submit" class="btn btn-primary">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>

<script>
  const addSectionButtons = document.querySelectorAll('.addsectionbutton');
  addSectionButtons.forEach(button => {
    button.addEventListener('click', function () {
      const string = button.getAttribute('data-string');
      document.querySelector('#getprogramid_target').value = string;
    });
  });

  const editSectionButtons = document.querySelectorAll('.editsectionbutton');

  editSectionButtons.forEach(button => {
    button.addEventListener('click', function () {
      const string = this.getAttribute('data-string');
      document.querySelector('#original_target').value = string;
    });
  });

  const deleteSectionButtons = document.querySelectorAll('.deletesectionbutton');

  deleteSectionButtons.forEach(button => {
    button.addEventListener('click', function () {
      const string = this.getAttribute('data-string');
      document.querySelector('#delete_target').value = string;
    });
  });


  const editProgramButtons = document.querySelectorAll('.editprogrambutton');

  editProgramButtons.forEach(button => {
    button.addEventListener('click', function () {
      const string = this.getAttribute('data-string');
      document.querySelector('#original_program_target').value = string;
    });
  });

  const deleteProgramButtons = document.querySelectorAll('.deleteprogrambutton');

  deleteProgramButtons.forEach(button => {
    button.addEventListener('click', function () {
      const string = this.getAttribute('data-string');
      document.querySelector('#delete_program_target').value = string;
      console.log(string);
    });
  });


</script>