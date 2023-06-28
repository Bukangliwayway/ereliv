<?php require_once("../backend/session_faculty.php"); ?>

<div class="row m-0 mx-auto d-flex flex-column justify-content-center  align-items-center p-5">
  <div
    class="col-lg-12 col-sm-auto d-flex flex-column justify-content-center align-items-stretch text-center gap-3 mx-auto border border-smoke mt-1 py-5">
    <h1 class="fs-2 fw-bold text-uppercase">
      Publish research
    </h1>
    <form id="uploadResearchForm" class="d-flex flex-column gap-1 px-3">
      <div class="form-floating mb-3">
        <input type="text" name="title" class="form-control upload-title" placeholder="title" required />
        <label for="title" class="form-label upload-title-label">Research Title</label>
      </div>

      <div class="form-floating mb-3">
        <textarea id="content-input" class="upload-abstract" name="content-input"
          placeholder="Research Abstract"></textarea>
      </div>

      <div class="input-group mb-3">
        <div class="form-floating">
          <input type="text" id="date" name="date" class="upload-date form-control bg-white" id="datepicker-output"
            data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true"
            value="<?php echo date('Y-m-d'); ?>" pattern="\d{4}-\d{2}-\d{2}"
            title="Please enter a valid date in the format YYYY-MM-DD" required>
          <label for="datepicker-output">Publish Date</label>
        </div>
        <span class="input-group-append">
          <span class="input-group-text bg-white">
            <i class="bi bi-calendar-date" id="datepicker-icon"></i>
          </span>
        </span>
      </div>

      <div class="example author-select">
        <select id="author-select" class="upload-author" multiple="multiple"></select>
      </div>

      <div class="example program-select">
        <select id="program-select" class="upload-program" multiple="multiple"></select>
      </div>

      <div class="example interest-select">
        <select id="interest-select" class="upload-interest" multiple="multiple"> </select>
      </div>

      <div class="form-floating mb-3">
        <input type="keywords" id="keywords" name="keywords" class="form-control upload-keywords" placeholder="keywords"
          required />
        <label for="keywords" class="form-label upload-keywords-label">Keywords (Separate Each by Commas)</label>
      </div>

      <input type="hidden" name="content" id="content">
      <input type="hidden" name="authors" id="authors">
      <input type="hidden" name="interests" id="interests">
      <input type="hidden" name="programs" id="programs">
      <input type="hidden" name="researchID" id="researchID">
      <input type="hidden" name="type" id="type" value="faculty">
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

      <button type="submit" class="btn btn-primary">Upload Research</button>
    </form>
  </div>
  <div id="fixed-addcat" class="position-fixed bottom-0 start-0 d-flex justify-content-end gap-2 p-3">
    <a href="#addauthormodal" class="btn btn-primary" data-bs-toggle="modal">
      <i class="bi bi-plus-lg"></i>
      Author
    </a>
    <a href="#addinterestmodal" class="btn btn-danger" data-bs-toggle="modal">
      <i class="bi bi-plus-lg"></i>
      Interest
    </a>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>