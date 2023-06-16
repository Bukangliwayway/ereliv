<?php require_once("../backend/session_faculty.php"); ?>

<div class="container p-1">
  <?php
  $notifications = getFacultyNotifications($conn, $_SESSION['userID']);
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
                  <span class="text-center issuername text-capitalize">' . $issuername . '</span>
                  <span> — </span>
                  <span class="text-center issuertype text-capitalize">' . $issuertype . '</span>
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
      var content = $(this);
      var words = content.text().trim().split(' ');
      if (words.length > 30) {
        var truncatedText = words.slice(0, 30).join(' ') + '...';
        content.data('truncated-text', truncatedText)
          .data('full-text', content.html()) // Use .html() instead of .text()
          .html(truncatedText) // Use .html() instead of .text()
          .addClass('truncated');
      }
    });

    // Toggle truncation on click
    $(document).on('click', '.redirect', function (e) {
      e.preventDefault();
      var content = $(this).find('.content');

      if (content.hasClass('truncated')) {
        // Expand the text
        content.html(content.data('full-text')).removeClass('truncated'); // Use .html() instead of .text()
      } else {
        // Truncate the text
        content.html(content.data('truncated-text')).addClass('truncated'); // Use .html() instead of .text()
      }
    });
  });


</script>