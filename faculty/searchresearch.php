<?php
require_once("../backend/session_faculty.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PUPQC Research Management Sytem</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css" />
  <script src="https://cdn.tiny.cloud/1/o7w7sdre55xscvrprwcvde6nwnv4n2in1tg6taczesi9jmh2/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
  <link rel="stylesheet" href="../styles/main.css" />
</head>

<body class="vh-100">
  <div class="row mx-auto d-flex flex-column justify-content-center  align-items-center ">
    <div class="col-lg-12 col-sm-auto d-flex flex-column justify-content-center align-items-stretch gap-3 mx-auto mt-1">
      <form method="POST" action="../backend/searchresearch_backend.php" class="d-flex justify-content-between gap-3">
        <div class="form-floating  w-100">
          <input type="text" id="search" name="search" class="form-control" placeholder="search" required />
          <label for="search" class="form-label">Search</label>
        </div>
        <button class="btn btn-primary w-25" type="submit">
          <i class="bi bi-search"></i> Search
        </button>
      </form>

      <?php
      $researches = getList($conn, "*", "Research");
      foreach ($researches as $research) {
        $authors = getAuthorNames($conn, $research['researchID']);
        $programs = getProgramNames($conn, $research['researchID']);
        echo '
            <a href="#displaypage" id=' . $research['researchID'] . ' class="text-decoration-none text-dark research-link"  data-bs-toggle="modal">
              <div class="row d-flex border border-smoke p-3 rounded">
                <div class="col">
                    <h3 class="text-capitalize research-title">' . strtolower($research['title']) . '</h3>
                    <div class="col d-flex justify-content-start">
                      <div class="research-authors fw-bold"> 
                        <span class="fw-normal"> Authors:  </span>
                    ';

        foreach ($authors as $author)
          echo '<span class="text-capitalize">' . $author . '</span> ';

        echo '
                    </div>  
                    <span class="ml-auto mr-5 research-publish-date">Date Published: <strong>' . $research['datepublished'] . '</strong></span>
                    <span class="text-capitalize research-uploader">Uploader : <strong>' . $research['proposer'] . '</strong> </span>
                    </div>
                    <div class="truncate content ms-3 research-abstract" data-full-text="' . $research['abstract'] . '">' . $research['abstract'] . ' </div>
                    <div class="mt-3 mb-1 research-programs">
                    '; foreach ($programs as $program)
          echo '<span class="btn-sm btn-primary">' . $program . '</span> ';

        echo '
                  </div>
                  <span>Keywords: </span>
                  <div class="truncate content ms-3 text-capitalize research-keywords"  data-full-text="' . $research['keywords'] . '">
                    <p> 
                    ' . $research['keywords'] . '
                    </p>  
                </div>
              </div>
            </a>

        ';


      }
      ;
      ?>
    </div>
  </div>

  <!-- modal -->
  <div class="modal fade" id="displaypage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 80vw;">
      <div class="modal-content" style="min-height: 80vh;">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-capitalize text-center">
            Overview of Research
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="container modal-body">

          <h2 class="text-capitalize text-center mb-4" id="research-title-modal"></h2>
          <h5 class="mb-2"><strong>Abstract:</strong></h5>
          <div id="research-abstract-modal"></div>
          <span id="research-publish-date-modal"></span>
          <div class="text-reset" id="research-authors-modal"></div>
          <span class="text-capitalize" id="research-uploader-modal"></span>
          <h5 class="mt-3"><strong>Keywords:</strong></h5>
          <p id="research-keywords-modal"></p>
          <div id="research-programs-modal"></div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.truncate').each(function () {
        var words = $(this).text().trim().split(' ');
        if (words.length > 20) {
          var truncatedText = words.slice(0, 20).join(' ') + '...';
          $(this).data('truncated-text', truncatedText)
            .data('full-text', $(this).text())
            .text(truncatedText)
            .addClass('truncated');
        }
      });
    });

    // Select all the links with the specified class
    var links = document.querySelectorAll('.research-link');

    links.forEach(function (link) {
      // Assign a click event handler to the link
      link.addEventListener('click', function (event) {
        event.preventDefault();
        var researchID = this.id;
        var researchTitle = this.querySelector('.research-title').textContent;
        var researchAbstract = this.querySelector('.research-abstract').getAttribute('data-full-text');
        var researchKeywords = this.querySelector('.research-keywords').getAttribute('data-full-text');
        var researchPublishDate = this.querySelector('.research-publish-date').textContent;
        var researchUploader = this.querySelector('.research-uploader').textContent;
        var researchProgram = this.querySelector('.research-programs').innerHTML;
        var researchAuthor = this.querySelector('.research-authors').innerHTML;

        document.getElementById('research-title-modal').textContent = researchTitle;
        document.getElementById('research-abstract-modal').innerHTML = researchAbstract;
        document.getElementById('research-keywords-modal').textContent = researchKeywords;
        document.getElementById('research-publish-date-modal').textContent = researchPublishDate;
        document.getElementById('research-programs-modal').innerHTML = researchProgram;
        document.getElementById('research-authors-modal').innerHTML = researchAuthor;
        document.getElementById('research-uploader-modal').innerHTML = researchUploader;
      });
    });
  </script>

</body>

</html>