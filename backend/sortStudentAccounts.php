<?php
include '../db/db.php';
include '../db/queries.php';

$output = '';
$order = $_POST["order"];
if ($order == 'desc')
  $order = 'asc';
else
  $order = 'desc';


$students = getAccountsByOrder($conn, 'Student', $_POST["column_name"], $_POST["order"]);
$output .= '  
     <h3 class="text-center">Student Accounts</h3>
      <table class="table table-bordered">
        <tr>
          <th><a class="sortStudent" data-student="studentID" data-order="' . $order . '" href="#">ID</a></th>
          <th><a class="sortStudent" data-student="firstname" data-order="' . $order . '" href="#">First Name</a></th>
          <th><a class="sortStudent" data-student="lastname" data-order="' . $order . '" href="#">Last Name</a></th>
          <th><a class="sortStudent" data-student="program" data-order="' . $order . '" href="#">Program</a></th>
          <th><a class="sortStudent" data-student="section" data-order="' . $order . '" href="#">Section</a></th>
          <th><a class="sortStudent" data-student="advisor" data-order="' . $order . '" href="#">Advisor</a></th>
          <th><a class="sortStudent" data-student="status" data-order="' . $order . '" href="#">Status</a></th>
          <th><a class="sortStudent" data-student="priority" data-order="' . $order . '" href="#">Priority</a></th>
          <th><a class="sortStudent">Toggle Status</a></th>
        </tr>
 ';
foreach ($students as $student) {

  if ($student["status"] == "Active") {
    $button = '<a
              href="#deactivatemodal"
              class="deactivatebutton text-capitalize btn btn-danger"
              data-bs-toggle="modal"
              data-string =' . $student['studentID'] . '
            >
              Deactivate
            </a>';
  } else {
    $button = '<a
              href="#activatemodal"
              class="activatebutton text-capitalize btn btn-primary"
              data-bs-toggle="modal"
              data-string =' . $student['studentID'] . '
            >
              Activate
            </a>';
  }
  $output .= '  
      <tr>
        <td class="text-capitalize">
            ' . $student["studentID"] . '
        </td>
        <td class="text-capitalize">
          ' . $student["firstname"] . '
        </td>
        <td class="text-capitalize">
          ' . $student["lastname"] . '
        </td>
        <td class="text-capitalize">
          ' . $student["program"] . '
        </td>
        <td class="text-capitalize">
          ' . $student["section"] . '
        </td>
        <td class="text-capitalize">
          ' . getAdvisorName($conn, $student["advisor"]) . '
        </td>
        <td class="text-capitalize">
          ' . $student["status"] . '
        </td>
        <td class="text-capitalize">
          ' . $student["priority"] . '
        </td>
        <td class="text-capitalize">
          ' . $button . '
        </td>
  ';

}
$output .= '
      </tr>
    </table>';
echo $output;
?>