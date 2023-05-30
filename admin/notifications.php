<?php require_once("../backend/session_check.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PUPQC Research Management Sytem</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="../styles/main.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <div class="container p-5">
    <a href="#" class="redirect text-decoration-none text-reset">
      <div class="row  mb-3">
        <div class="col-8  m-auto p-3 border border-smoke rounded">

          <div class="notif-head d-flex justify-content-around align-items-center">
            <span class="text-center title">
              <h2>Title</h2>
            </span>
            <div class="d-flex gap-5">
              <span class="text-center sender">
                <h5>sender</h5>
              </span>
              <span class="text-center date">
                <h5>date</h5>
              </span>
            </div>
          </div>
          <p class="truncate content ms-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus
            laudantium
            voluptatibus architecto ipsa nulla explicabo atque consequatur vel aliquid non nemo, eligendi culpa
            laboriosam
            accusantium suscipit asperiores ducimus harum temporibus labore ratione, quia pariatur sed. Quibusdam alias,
            nulla maxime nemo laudantium repellendus repudiandae, quas dicta, odit incidunt ex facilis hic!</p>
        </div>
      </div>
    </a>
  </div>

  <script>
    $(document).ready(function () {
      $('.truncate').each(function () {
        var words = $(this).text().trim().split(' ');
        if (words.length > 50) {
          $(this).text(words.slice(0, 50).join(' ') + '...');
        }
      });
    });
  </script>
</body>

</html>