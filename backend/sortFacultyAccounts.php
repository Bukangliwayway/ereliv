<?php
include '../db/db.php';
include '../db/queries.php';

$output = '';
$order = $_POST["order"];
if ($order == 'desc')
     $order = 'asc';
else
     $order = 'desc';


$faculties = getAccountsByOrder($conn, 'Faculty', $_POST["column_name"], $_POST["order"]);
$output .= '  
     <h3 class="text-center">Faculty Accounts</h3>
      <table class="table table-bordered">
        <tr>
          <th><a class="sortFaculty" data-faculty="facultyID" data-order="' . $order . '" href="#">ID</a></th>
          <th><a class="sortFaculty" data-faculty="firstname" data-order="' . $order . '" href="#">First Name</a></th>
          <th><a class="sortFaculty" data-faculty="lastname" data-order="' . $order . '" href="#">Last Name</a></th>
          <th><a class="sortFaculty" data-faculty="status" data-order="' . $order . '" href="#">Status</a></th>
          <th><a class="sortFaculty" data-faculty="priority" data-order="' . $order . '" href="#">Priority</a></th>
          <th><a class="sortFaculty">Toggle Status</a></th>
        </tr>
 ';
foreach ($faculties as $faculty) {
     if ($faculty["status"] == "Active") {
          $button = '<a
              href="#deactivatemodal"
              class="deactivatebutton text-capitalize btn btn-danger"
              data-bs-toggle="modal"
              data-string =' . $faculty['facultyID'] . '
            >
              Deactivate
            </a>';
     } else {
          $button = '<a
              href="#activatemodal"
              class="activatebutton text-capitalize btn btn-primary"
              data-bs-toggle="modal"
              data-string =' . $faculty['facultyID'] . '
            >
              Activate
            </a>';
     }
     $output .= '  
      <tr>
          <td class="text-capitalize">
               ' . $faculty["facultyID"] . '
          </td>
          <td class="text-capitalize">
               ' . $faculty["firstname"] . '
          </td>
          <td class="text-capitalize">
               ' . $faculty["lastname"] . '
          </td>
          <td class="text-capitalize">
               ' . $faculty["status"] . '
          </td>
          <td class="text-capitalize">
               ' . $faculty["priority"] . '
          </td>
          <td class="text-capitalize">
               '. $button .'
          </td>
     </tr>
     ';
}
$output .= '</table>';
echo $output;
?>