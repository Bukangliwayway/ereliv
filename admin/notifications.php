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
  <a href="#notificationIDmodal" class="activatebutton text-capitalize btn btn-primary" data-bs-toggle="modal"
    data-user="Student">
    Activate
  </a>

  <div class="modal fade" id="notificationIDmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="activatemodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-capitalize">Activate Account</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
          <div class="container mb-3">
            <div class="row">
              <div class="col-sm-4">
                <h6>Title:</h6>
              </div>
              <div class="col-sm-8">
                <p id="notificationTitle"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <h6>Content:</h6>
              </div>
              <div class="col-sm-8">
                <p id="notificationContent"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <h6>Sender:</h6>
              </div>
              <div class="col-sm-8">
                <p id="notificationSender"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <h6>Date Issued:</h6>
              </div>
              <div class="col-sm-8">
                <p id="notificationDate"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <h6>Deadline:</h6>
              </div>
              <div class="col-sm-8">
                <p id="notificationDeadline"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <h6>Comments:</h6>
              </div>
              <div class="col-sm-8">
                <p id="notificationComments"></p>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-sm-4">
                <h6>Title:</h6>
              </div>
              <div class="col-sm-8">
                <p id="notificationTitle"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <h6>Content:</h6>
              </div>
              <div class="col-sm-8">
                <p id="notificationContent"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <h6>Sender:</h6>
              </div>
              <div class="col-sm-8">
                <p id="notificationSender"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <h6>Date Issued:</h6>
              </div>
              <div class="col-sm-8">
                <p id="notificationDate"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <h6>Deadline:</h6>
              </div>
              <div class="col-sm-8">
                <p id="notificationDeadline"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <h6>Comments:</h6>
              </div>
              <div class="col-sm-8">
                <p id="notificationComments"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>