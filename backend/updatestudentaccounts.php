<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$output = '';
$order = isset($_POST["order"]) ? $_POST["order"] : '';
$column = $_POST["column_name"];

if ($order == 'desc')
  $order = 'asc';
else
  $order = 'desc';

$students = getAccountsByOrder($conn, 'Student', $column, $order);
$output .= '  
     <h3 class="text-center">Student Accounts</h3>
      <table class="table table-bordered">
        <tr>
          <th class="col-2 text-capitalize text-center align-middle bg-light"><a class="sortStudent" data-student="studentID" data-order="' . $order . '" href="#">ID</a></th>
          <th class="col-3 text-capitalize text-center align-middle bg-light"><a class="sortStudent" data-student="firstname" data-order="' . $order . '" href="#"> Name</a></th>
          <th class="col-4 text-capitalize text-center align-middle bg-light"><a class="sortStudent" data-student="advisor" data-order="' . $order . '" href="#">Advisor</a></th>
          <th class="col-1 text-capitalize text-center align-middle bg-light"><a class="sortStudent" data-student="status" data-order="' . $order . '" href="#">Status</a></th>
          <th class="col-1 text-capitalize text-center align-middle bg-light"><a class="sortStudent" data-student="priority" data-order="' . $order . '" href="#">Priority</a></th>
          <th class="col-1 text-capitalize text-center align-middle bg-light">Action</th>
        </tr>
 ';

foreach ($students as $student) {
  if ($student["status"] == "Active") {
    $button = '<a
              href="#deactivatemodal"
              class="deactivatebutton text-capitalize text-center btn btn-danger"
              data-bs-toggle="modal"
              data-string=' . $student['studentID'] . '
              data-user = "Student"
            >
              Deactivate
            </a>';
  } else {
    $button = '<a
              href="#activatemodal"
              class="activatebutton text-capitalize text-center btn btn-primary"
              data-bs-toggle="modal"
              data-string=' . $student['studentID'] . '
              data-user ="Student"
            >
              Activate
            </a>';
  }

  $output .= '  
      <tr>
        <td class="col-2 text-capitalize text-center align-middle">
            ' . $student["studentID"] . '
        </td>
        <td class="col-3 text-capitalize text-center align-middle">
          ' . $student["firstname"] . " " . $student["lastname"] . '
        </td>
        <td class="col-4 text-capitalize text-center align-middle">
          ' . getAdvisorName($conn, $student["advisor"]) . '
        </td>
        <td class="col-1 text-capitalize text-center align-middle">
          ' . $student["status"] . '
        </td>
        <td class="col-1 text-capitalize text-center align-middle">
          ' . $student["priority"] . '
        </td>
        <td class="col-1 text-capitalize text-center align-middle">
          ' . $button . '
        </td>
      </tr>
  ';

}

$output .= '
    </table>';
echo $output;
?>