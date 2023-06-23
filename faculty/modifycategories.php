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

<!-- modal -->

<div class="modal fade" id="editinterestmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Edit Interest
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="editInterestForm" class="container d-flex flex-row gap-3">
          <div class="form-floating">
            <input type="text" id="editInterestName" name="name" class="form-control" required />
            <label for="name" class="form-label">Interest Name</label>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <input id="editInterestID" type="hidden" name="interestID">
          <button type="submit" class="btn btn-primary">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteinterestmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Delete Interest
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="deleteInterestForm" class="container d-flex flex-row gap-3">
          <div class="form-floating">
            <input type="text" id="deleteInterestName" name="name" class="form-control bg-white" readonly />
            <label for="name" class="form-label">To Be Deleted</label>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <input id="deleteInterestID" type="hidden" name="interestID">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editauthormodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Edit Author
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="editAuthorForm" class="container d-flex flex-column gap-3">
          <div class="d-flex gap-3">
            <div class="form-floating">
              <input type="text" id="editAuthorFirstName" name="firstname" class="form-control" required />
              <label for="firstname" class="form-label">First Name</label>
            </div>
            <div class="form-floating">
              <input type="text" id="editAuthorLastName" name="lastname" class="form-control" required />
              <label for="lastname" class="form-label">Last Name</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Edit</button>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <input id="editAuthorID" type="hidden" name="authorID">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteauthormodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Delete Author
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="deleteAuthorForm" class="container d-flex flex-row gap-3">
          <div class="d-flex gap-3">
            <div class="form-floating">
              <input type="text" id="deleteAuthorFirstName" name="firstname" class="form-control bg-white" readonly />
              <label for="section" class="form-label">First Name:</label>
            </div>
            <div class="form-floating">
              <input type="text" id="deleteAuthorLastName" name="lastname" class="form-control bg-white" readonly />
              <label for="section" class="form-label">Last Name:</label>
            </div>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <input id="deleteAuthorID" type="hidden" name="authorID">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

