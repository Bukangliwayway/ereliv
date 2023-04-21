<!DOCTYPE html>
<html>
  <head>
    <title>PUPQC e-ReLiv Student Login</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css"
    />
    <link rel="stylesheet" href="styles/student-login.css" />
    <link rel="stylesheet" href="styles/main.css" />
  </head>
  <body>
    <div class="container-login-form">
      <fieldset class="black-box">
        <div class="container-logo">
          <img class="pupqc-logo" src="assets/pupqc-logo.webp" />
        </div>
        <h1 class="title">
          PUPQC Student <br />
          Login Form
        </h1>
        <form
          method="POST"
          action="backend/studlogin_backend.php"
          class="grid-container"
        >
          <label for="student_number">Student Number:</label>
          <input
            type="text"
            id="student_number"
            name="student_number"
            required
            pattern="\d{4}-\d{5}-[A-Z]{2}-\d"
            title="Please enter a valid student number in the format 2020-00001-CM-0"
          />
          <label for="section">Section:</label>
          <select id="section" name="section" style="width:36ch" required>
            <option value="">Select Section</option>
            <option value="BSIT 3-1">BSIT 3-1</option>
            <option value="BSIT 3-2">BSIT 3-2</option>
            <option value="BSIT 4-1">BSIT 4-1</option>
          </select>
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required />
          <button type="submit" class="submit-button">Submit</button>
        </form>
      </fieldset>
    </div>
  </body>
</html>
