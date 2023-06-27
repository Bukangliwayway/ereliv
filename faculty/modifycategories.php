<?php require_once("../backend/session_faculty.php"); ?>

<div class="row m-0 mx-auto d-flex flex-column justify-content-center  align-items-center ">
  <div class="d-flex flex-row gap-3 sticky-top p-5 bg-light">
    <button id="author-cat" class="btn btn-primary d-flex align-items-center gap-2">
      <i class="bi bi-people-fill"></i> Authors
    </button>
    <button id="interest-cat" class="btn btn-primary d-flex align-items-center gap-2">
      <i class="bi bi-tag-fill"></i> Interests
    </button>
    <div class="input-group">
      <span class="input-group-text"><i class="bi bi-search"></i></span>
      <input type="text" id="search" name="search" class="form-control form-control-sm align-middle"
        placeholder="Search" required style="padding: 1.17rem 0.75rem;">
    </div>

  </div>
  <div id="categorylist"></div>

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

