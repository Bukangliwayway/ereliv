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
    <link rel="stylesheet" href="styles/main.css" />
  </head>
  <?php
      include_once '/opt/lampp/htdocs/ereliv/backend/randbg_generate.php';
      $code = $_GET['code'];
      $type = $_GET['type'];
    ?>
  <body>
    <div
      class="container-fluid rounded d-flex flex-column align-items-center justify-content-center vh-100 vw-100 rand-bg"
      style="background-image: url('<?php echo $img_src ?>')"
    >
      <div class="p-5 bg-light">
        <h1 class="mb-3 text-uppercase">Change Password</h1>
        <form
          method="POST"
          action="backend/changepass_backend.php"
          class="d-flex flex-column gap-3"
        >
          <input
            type="hidden"
            name="redirect"
            value="/ereliv/rbac.php"
          />
          <input type="hidden" name="code" value="<?php echo $code ?>" />
          <input type="hidden" name="type" value="<?php echo $type ?>" />
          <div class="form-floating">
            <input
            type="email"
            id="email"
            name="email"
            class="form-control"
            placeholder="email"
            required
            />
            <label for="email" class="form-label">Email</label>
          </div>
          <div class="input-group">
            <div class="form-floating">
              <input type="password" minlength="8" maxlength="20"
              class="form-control" id="password" name="password"
              placeholder="Must be 8-20 long" required">
              <label for="password" class="form-label">New Password</label>
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
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </body>
</html>

<script src="scripts/main.js"></script>
