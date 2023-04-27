<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PUPQC Research Management Sytem</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="styles/main.css" />
  </head>
  <body>
    <?php
      include_once '/opt/lampp/htdocs/ereliv/backend/randbg_generate.php';
    ?>
    <div class="row vh-100 m-0">
      <div
        class="col-md-8 rand-bg d-none d-sm-block"
        style="background-image: url('<?php echo $img_src ?>')"
      ></div>
      <div
        class="col-md-4 col-sm-auto d-flex flex-column just justify-content-center align-items-stretch text-center gap-3 contain-form"
      >
        <img
          src="assets/puplogo.png"
          alt="logohehe"
          width="60%"
          class="align-self-center"
        />
        <h1 class="fs-2 fw-bold text-uppercase">PUPQC student login form</h1>
        <form
          method="POST"
          action="backend/studlogin_backend.php"
          class="d-flex flex-column gap-1 px-3"
        >
          <div class="form-floating mb-3">
            <input
              type="text"
              id="student_number"
              class="form-control"
              name="student_number"
              required
              pattern="\d{4}-\d{5}-[A-Z]{2}-\d"
              title="Please enter a valid student number in the format 2020-00001-CM-0"
              placeholder="Example format 2020-00001-CM-0"
            />
            <label for="student_number" class="form-label"
              >Student Number</label
            >
          </div>
          <div class="form-floating mb-3">
            <select
              id="section"
              name="section"
              class="form-select"
              placeholder="Select Section"
              required
            >
              <option value="BSIT 3-1"></option>
              <option value="BSIT 3-1">BSIT 3-1</option>
              <option value="BSIT 3-2">BSIT 3-2</option>
              <option value="BSIT 4-1">BSIT 4-1</option>
            </select>
            <label for="section" class="form-label">Section</label>
          </div>
          <div class="form-floating mb-3">
            <input
              type="password"
              minlength="8"
              maxlength="20"
              class="form-control"
              id="password"
              name="password"
              placeholder="Must be 8-20 long"
              required
            />
            <label for="password" class="form-label">Password</label>
          </div>
          <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
        <a
          href="#"
          id="forgot-pass"
          class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
        >
          <b>🗝️ I forgot my password</b>
        </a>
        <p class="fw-light">
          By using this service, you understood and agree to the PUP Online
          Services
          <a href="https://www.pup.edu.ph/terms/" target="_blank">
            Terms of Use
          </a>
          and
          <a href="https://www.pup.edu.ph/privacy" target="_blank">
            Privacy Statement
          </a>
        </p>
      </div>
    </div>
  </body>
</html>
