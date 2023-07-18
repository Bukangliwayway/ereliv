<?php require_once("../backend/session_admin.php"); ?>
<div class="container p-1">
  <?php
  $notifications = getAdminNotifications($conn, $_SESSION['userID']);
  foreach ($notifications as $notification) {
    $title = $notification['title'];
    $content = $notification['content'];
    $dateissued = $notification['dateissued'];
    $issuername = $notification['issuername'];
    $issuertype = $notification['issuertype'];

    echo '<a class="redirect text-decoration-none text-reset">
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