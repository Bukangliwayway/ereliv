<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$output = '';
$order = $_POST["order"];
if ($order == 'desc') {
     $order = 'asc';
} else {
     $order = 'desc';
}

$faculties = getAccountsByOrder($conn, 'Faculty', $_POST["column_name"], $_POST["order"]);

$output .= '  
     <h3 class="text-center">Faculty Accounts</h3>
      <table class="table table-bordered">
        <tr>
          <th class="text-center"><a class="sortFaculty" data-faculty="facultyID" data-order="' . $order . '" href="#">ID</a></th>
          <th class="text-center"><a class="sortFaculty" data-faculty="firstname" data-order="' . $order . '" href="#">First Name</a></th>
          <th class="text-center"><a class="sortFaculty" data-faculty="lastname" data-order="' . $order . '" href="#">Last Name</a></th>
          <th class="text-center"><a class="sortFaculty" data-faculty="status" data-order="' . $order . '" href="#">Status</a></th>
          <th class="text-center"><a class="sortFaculty" data-faculty="priority" data-order="' . $order . '" href="#">Priority</a></th>
          <th class="text-center">Toggle Status</th>
        </tr>
 ';

foreach ($faculties as $faculty) {
     if ($faculty["status"] == "Active") {
          $button = '<a href="#deactivatemodal" class="deactivatebutton text-capitalize text-center btn btn-danger" data-bs-toggle="modal" data-string="' . $faculty['facultyID'] . '" data-user ="Faculty">Deactivate</a>';
     } else {
          $button = '<a href="#activatemodal" class="activatebutton text-capitalize text-center btn btn-primary" data-bs-toggle="modal" data-string="' . $faculty['facultyID'] . '" data-user ="Faculty" >Activate</a>';
     }
     $output .= '  
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
     </tr>';
}

$output .= '</table>';
echo $output;
?>