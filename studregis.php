<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://meyerweb.com/eric/tools/css/reset/reset.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <link rel="stylesheet" href="styles/main.css">
  <title>Student Registration Page</title>
</head>
<body>
  <div class="black-box">
    <div class="container-logo">
      <img class="pupqc-logo" src="assets/pupqc-logo.webp" />
      <h1 class="title">
        PUPQC Student <br />
        Registration Form
      </h1>
    </div>
    <form method="POST" action="backend/studregis_backend.php" class="grid-container">
      <label for="student_number">Student Number:</label>
      <input type="text" id="student_number" name="student_number" required pattern="\d{4}-\d{5}-[A-Z]{2}-\d" title="Please enter a valid student number in the format 2020-00001-CM-0">
      <label for="section">Section:</label>
      <select id="section" name="section" required>
        <option value="">Select Section</option>
        <option value="BSIT 3-1">BSIT 3-1</option>
        <option value="BSIT 3-2">BSIT 3-2</option>
        <option value="BSIT 4-1">BSIT 4-1</option>
      </select>
      <label for="email">Email Address:</label>
      <input type="email" id="email" name="email" required>
      <label for="first_name">First Name:</label>
      <input type="text" id="first_name" name="first_name" required>
      <label for="last_name">Last Name:</label>
      <input type="text" id="last_name" name="last_name" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <button type="submit" class="submit-button">Submit</button>
  </form>
</div>
</body>
</html>