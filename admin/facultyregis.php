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
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css"
    />

    <link rel="stylesheet" href="../styles/main.css" />
  </head>
  <body>

    <?php
      include_once 'opt/lampp/htdocs/ereliv/backend/randbg_generate.php';
    ?>
    
    <div class="container vh-100 m-0 mx-auto d-flex flex-column justify-content-center  align-items-center">
      <div
        class="col-sm-auto d-flex flex-column justify-content-center align-items-stretch text-center gap-3 contain-professional mx-auto p-5"
      >
        <h1 class="fs-2 fw-bold text-uppercase">
          PUPQC ADD FACULTY FORM
        </h1>
        <form
          method="POST"
          action="../backend/facultyregis_backend.php"
          class="d-flex flex-column gap-1 px-3"
        >
          <div class="form-floating mb-3">
            <input
              type="text"
              id="first_name"
              name="firstname"
              class="form-control"
              placeholder="first_name"
              required
            />
            <label for="first_name" class="form-label">First Name</label>
          </div>
          <div class="form-floating mb-3">
            <input
              type="text"
              id="last_name"
              name="lastname"
              class="form-control"
              placeholder="last_name"
              required
            />
            <label for="last_name" class="form-label">Last Name</label>
          </div>
          <div class="form-floating mb-3">
            <input
              type="email"
              id="email"
              name="emailadd"
              class="form-control"
              placeholder="email"
              required
            />
            <label for="email" class="form-label">Email</label>
          </div>
          <div class="input-group mb-3">
            <div class="form-floating">
              <input type="password" minlength="8" maxlength="20"
              class="form-control" id="password" name="password"
              placeholder="Must be 8-20 long" required">
              <label for="password" class="form-label">Password</label>
            </div>
            <button
              class="btn btn-outline-secondary"
              type="button"
              id="toggle-password"
              onclick="togglePasswordVisibility()"
            >
              <i class="bi bi-eye" id="icon-password"></i>
            </button>
          </div>
          <div class="form-group mt-2 mb-3">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="category" id="supervisorcat" value="Advisor" checked>
              <label class="form-check-label" for="supervisorcat">Advisor</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="category" id="facultycat" value="Supervisor">
              <label class="form-check-label" for="facultycat">Supervisor</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Add Faculty</button>
        </form>
      </div>
    </div>
  </body>
</html>

<script src="../scripts/main.js"></script>