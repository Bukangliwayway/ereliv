<?php
function studentNumberCheck($conn, $student_number) {
  $stmt = $conn->prepare("SELECT * FROM Students WHERE StudentNumber = :student_number");
  $stmt->bindParam(':student_number', $student_number);
  $stmt->execute();
  $student = $stmt->fetch();

  if ($student) return true;
  return false;
}

function staff_username_exists($conn, $username) {
  $stmt = $conn->prepare("SELECT * FROM Staff WHERE UserName = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $staff = $stmt->fetch();
  
  // Execute the query
  $stmt->execute();

  // Get the number of rows returned by the query
  $num_rows = $stmt->rowCount();

  return ($num_rows ==! 0);
}

function emailAddressCheck($conn, $email) {
  $stmt = $conn->prepare("SELECT * FROM Students WHERE EmailAddress = :email");
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $student = $stmt->fetch();
  return ($student);
}

function add_student($conn, $student_number, $section, $email, $first_name, $last_name, $password) {
  $stmt = $conn->prepare("INSERT into Students (StudentNumber, Section, EmailAddress, FirstName, LastName, Password) VALUES (:student_number, :section, :email, :first_name, :last_name, :password)");
  $stmt->bindParam(':student_number', $student_number);
  $stmt->bindParam(':section', $section);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':first_name', $first_name);
  $stmt->bindParam(':last_name', $last_name);
  $stmt->bindParam(':password', $password);
  try {
    $stmt->execute();
  }catch (PDOException $e) {
    send_message_and_redirect("Error: ".$e->getMessage(), "/ereliv/studregis.php");
  }
}


function send_message_and_redirect($message, $redirect_url) {
  echo "<script>
        setTimeout(function() {
            alert('$message');
            window.location.replace('$redirect_url');
        }, 1000);
      </script>";
  exit;
}

function student_number_exists($conn, $student_number) {
  // Prepare a statement to search for the given student number
  $stmt = $conn->prepare("SELECT * FROM Students WHERE StudentNumber = :student_number");

  // Bind the student number parameter to the prepared statement
  $stmt->bindParam(':student_number', $student_number);

  // Execute the query
  $stmt->execute();

  // Get the number of rows returned by the query
  $num_rows = $stmt->rowCount();

  return ($num_rows ==! 0);
}


function verified_student($conn, $student_number, $section, $password) {
  // Prepare the SQL statement to search for a matching student number
  $stmt = $conn->prepare("SELECT Section, Password FROM Students WHERE StudentNumber = :student_number");
  $stmt->bindParam(':student_number', $student_number);
  $stmt->execute();
  // Fetch the row from the result set
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  return ($row['Section'] === $section && password_verify($password, $row['Password']));
}

function verified_staff($conn, $username, $password) {
  // Prepare the SQL statement to search for a matching student number
  $stmt = $conn->prepare("SELECT Password FROM Staff WHERE UserName = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  // Fetch the row from the result set
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  return password_verify($password, $row['Password']);
}



?>


