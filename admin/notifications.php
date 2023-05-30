<?php require_once("../backend/session_admin.php"); ?>
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
</head>

<body>
  <div class="container p-5">
    <?php
    $notifications = getAdminNotifications($conn, $_SESSION['userID']);
    foreach ($notifications as $notification) {
      $title = $notification['title'];
      $content = $notification['content'];
      $dateissued = $notification['dateissued'];
      $redirect = $notification['redirect'];
      $issuername = $notification['issuername'];
      $issuertype = $notification['issuertype'];

      echo '<a href="' . $redirect . '" class="redirect text-decoration-none text-reset">
        <div class="row  mb-3">
          <div class="col-8  m-auto p-3 border border-smoke rounded">
            <div class="notif-head d-flex justify-content-around align-items-center">
              <span class="text-center title">' . $title . '</span>
              <div class="d-flex flex-column">
                <div class="d-flex gap-5">
                  <span class="text-center issuername">' . $issuername . '</span>
                  <span> — </span>
                  <span class="text-center issuertype">' . $issuertype . '</span>
                </div>
                <div class="d-flex justify-content-end">
                  <span class="text-center dateissued">' . $dateissued . '</span>
                </div>
              </div>
            </div>
            <p class="truncate content ms-3" data-full-text="' . $content . '">' . $content . '</p>
          </div>
        </div>
      </a>';
    }
    ?>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      // Truncate text initially
      $('.truncate').each(function () {
        var words = $(this).text().trim().split(' ');
        if (words.length > 30) {
          var truncatedText = words.slice(0, 30).join(' ') + '...';
          $(this).data('truncated-text', truncatedText)
            .data('full-text', $(this).text())
            .text(truncatedText)
            .addClass('truncated');
        }
      });

      // Toggle truncation on click
      $('.redirect').click(function (e) {
        e.preventDefault();
        var content = $(this).find('.content');

        if (content.hasClass('truncated')) {
          // Expand the text
          content.text(content.data('full-text')).removeClass('truncated');
        } else {
          // Truncate the text
          content.text(content.data('truncated-text')).addClass('truncated');
        }
      });
    });



  </script>
</body>

</html>