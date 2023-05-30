<?php require_once("../backend/session_admin.php"); ?>
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

  <div class="container col-8 m-auto">
    <div class="table-responsive" id="studentList">
      <h3 class="text-center">Student Accounts</h3>
      <table class="table table-bordered">
        <tr>
          <th class="text-center"><a class="sortStudent" data-student="studentID" data-order="desc" href="#">ID</a></th>
          <th class="text-center"><a class="sortStudent" data-student="firstname" data-order="desc" href="#">First
              Name</a></th>
          <th class="text-center"><a class="sortStudent" data-student="lastname" data-order="desc" href="#">Last
              Name</a></th>
          <th class="text-center"><a class="sortStudent" data-student="program" data-order="desc" href="#">Program</a>
          </th>
          <th class="text-center"><a class="sortStudent" data-student="section" data-order="desc" href="#">Section</a>
          </th>
          <th class="text-center"><a class="sortStudent" data-student="advisor" data-order="desc" href="#">Advisor</a>
          </th>
          <th class="text-center"><a class="sortStudent" data-student="status" data-order="desc" href="#">Status</a>
          </th>
          <th class="text-center"><a class="sortStudent" data-student="priority" data-order="desc" href="#">Priority</a>
          </th>
          <th class="text-center"> Toggle Status</th>
        </tr>
        <?php
        $students = getStudentAccounts($conn);
        foreach ($students as $student) {
          if ($student["status"] == "Active") {
            $button = '<a
              href="#deactivatemodal"
              class="deactivatebutton text-capitalize text-center btn btn-danger"
              data-bs-toggle="modal"
              data-string =' . $student['studentID'] . '
              data-user ="Student"
            >
              Deactivate
            </a>';
          } else {
            $button = '<a
              href="#activatemodal"
              class="activatebutton text-capitalize text-center btn btn-primary"
              data-bs-toggle="modal"
              data-string =' . $student['studentID'] . '
              data-user ="Student"
            >
              Activate
            </a>';
          }
          echo '
            <tr>
              <td class="text-capitalize text-center">
                ' . $student["studentID"] . '
              </td>
              <td class="text-capitalize text-center">
                ' . $student["firstname"] . '
              </td>
              <td class="text-capitalize text-center">
                ' . $student["lastname"] . '
              </td>
              <td class="text-capitalize text-center">
                ' . $student["program"] . '
              </td>
              <td class="text-capitalize text-center">
                ' . $student["section"] . '
              </td>
              <td class="text-capitalize text-center">
                ' . getAdvisorName($conn, $student["advisor"]) . '
              </td>
              <td class="text-capitalize text-center">
                ' . $student["status"] . '
              </td>
              <td class="text-capitalize text-center">
                ' . $student["priority"] . '
              </td>
              <td class="text-capitalize text-center">
                ' . $button . '
              </td>
            </tr>
          ';
        }
        ;
        ?>
      </table>
    </div>

    <div class="table-responsive" id="facultyList">
      <h3 class="text-center">Faculty Accounts</h3>
      <table class="table table-bordered">
        <tr>
          <th class="text-center"><a class="sortFaculty" data-faculty="facultyID" data-order="desc" href="#">ID</a></th>
          <th class="text-center"><a class="sortFaculty" data-faculty="firstname" data-order="desc" href="#">First
              Name</a></th>
          <th class="text-center"><a class="sortFaculty" data-faculty="lastname" data-order="desc" href="#">Last
              Name</a></th>
          <th class="text-center"><a class="sortFaculty" data-faculty="status" data-order="desc" href="#">Status</a>
          </th>
          <th class="text-center"><a class="sortFaculty" data-faculty="priority" data-order="desc" href="#">Priority</a>
          </th>
          <th class="text-center">Toggle Status </th>
        </tr>
        <?php
        $faculties = getFacultyAccounts($conn);
        foreach ($faculties as $faculty) {
          if ($faculty["status"] == "Active") {
            $button = '<a
              href="#deactivatemodal"
              class="deactivatebutton text-capitalize text-center btn btn-danger"
              data-bs-toggle="modal"
              data-string =' . $faculty['facultyID'] . '
              data-user ="Faculty"
            >
              Deactivate
            </a>';
          } else {
            $button = '<a
              href="#activatemodal"
              class="activatebutton text-capitalize text-center btn btn-primary"
              data-bs-toggle="modal"
              data-string =' . $faculty['facultyID'] . '
              data-user ="Faculty"
            >
              Activate
            </a>';
          }
          echo '
            <tr>
              <td class="text-capitalize text-center">
                ' . $faculty["facultyID"] . '
              </td>
              <td class="text-capitalize text-center">
                ' . $faculty["firstname"] . '
              </td>
              <td class="text-capitalize text-center">
                ' . $faculty["lastname"] . '
              </td>
              <td class="text-capitalize text-center">
                ' . $faculty["status"] . '
              </td>
              <td class="text-capitalize text-center">
                ' . $faculty["priority"] . '
              </td>
               <td class="text-capitalize text-center">
                ' . $button . '
              </td>
            </tr>
          ';
        }
        ;
        ?>

      </table>
    </div>
  </div>

  <!-- Modals -->
  <div class="modal fade" id="activatemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="activatemodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-capitalize text-center">
            Activate Account
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="container modal-body">
          <form method="POST" action="../backend/updatestatus_backend.php" class="container d-flex flex-row gap-3">
            <input type="hidden" name="string" id="activateAccountID">
            <input type="hidden" name="status" value="Active">
            <input type="hidden" name="user" id="activateUserType">
            <button type="submit" class="btn btn-primary">Yes</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">No</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deactivatemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="activatemodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-capitalize text-center">
            Deactivate Account
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="container modal-body">
          <form method="POST" action="../backend/updatestatus_backend.php" class="container d-flex flex-row gap-3">
            <input type="hidden" name="string" id="deactivateAccountID">
            <input type="hidden" name="status" value="Inactive">
            <input type="hidden" name="user" id="deactivateUserType">
            <button type="submit" class="btn btn-primary">Yes</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">No</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>

    $(document).ready(function () {
      $(document).on('click', '.sortStudent', function () {

        var column_name = $(this).data("student");
        var order = $(this).data("order");
        var arrow = '';
        if (order == 'desc') {
          arrow = '&nbsp;<span class="bi bi-arrow-down"></span>';
        }
        else {
          arrow = '&nbsp;<span class="bi bi-arrow-up"></span>';
        }
        $.ajax({
          url: "../backend/sortStudentAccounts.php",
          method: "POST",
          data: { column_name: column_name, order: order },
          success: function (data) {
            $('#studentList').html(data);
            $('[data-student="' + column_name + '"]').append(arrow);
          }
        })
      });

      $(document).on('click', '.sortFaculty', function () {
        var column_name = $(this).data("faculty");
        var order = $(this).data("order");
        var arrow = '';
        if (order == 'desc') {
          arrow = '&nbsp;<span class="bi bi-arrow-down"></span>';
        }
        else {
          arrow = '&nbsp;<span class="bi bi-arrow-up"></span>';
        }
        $.ajax({
          url: "../backend/sortFacultyAccounts.php",
          method: "POST",
          data: { column_name: column_name, order: order },
          success: function (data) {
            $('#facultyList').html(data);
            $('[data-faculty="' + column_name + '"]').append(arrow);
          }
        })
      });
    });

    const activateButton = document.querySelectorAll('.activatebutton');
    activateButton.forEach(button => {
      button.addEventListener('click', function () {
        const accountID = button.getAttribute('data-string');
        const user = button.getAttribute('data-user');
        document.querySelector('#activateAccountID').value = accountID;
        document.querySelector('#activateUserType').value = user;
      });
    });

    const deactivateButton = document.querySelectorAll('.deactivatebutton');
    deactivateButton.forEach(button => {
      button.addEventListener('click', function () {
        const accountID = button.getAttribute('data-string');
        const user = button.getAttribute('data-user');
        document.querySelector('#deactivateAccountID').value = accountID;
        document.querySelector('#deactivateUserType').value = user;
      });
    });
  </script>

</body>

</html>