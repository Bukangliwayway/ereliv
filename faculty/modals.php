<!-- modals -->
<div class="modal fade" id="signoutmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="signout" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Sign Out?
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form method="POST" action="../backend/session_out.php" class="container d-flex flex-row gap-3">
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <button type="submit" class="btn btn-danger">Yes</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">No</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addauthormodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Add Author
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="addAuthorForm" class="container d-flex flex-row gap-3">
          <div class="form-floating">
            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="firstname" required />
            <label for="firstname" class="form-label">First Name</label>
          </div>
          <div class="form-floating">
            <input type="text" id="lastname" name="lastname" class="form-control" placeholder="lastname" required />
            <label for="lastname" class="form-label">Last Name</label>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addinterestmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Add Interest
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="addInterestForm" class="container d-flex flex-row gap-3">
          <div class="form-floating">
            <input type="text" id="name" name="name" class="form-control" required />
            <label for="name" class="form-label">Interest Name</label>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

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

<div class="modal fade" id="displaypapermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="min-width: 80vw;">
    <div class="modal-content" style="min-height: 80vh;">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Overview of Research
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body p-5 " style="position:relative;">
        <div class=" d-flex justify-content-end gap-1 fixed-upper-end mt-3 mr-3 d-flex gap-1"
          id="display-interests-modal"></div>
          <h4 class="text-center" id="display-title-modal"></h4>
          <div class="text-reset d-flex justify-content-center gap-1 mb-2" id="display-authors-modal"></div>
          <div class="d-flex justify-content-center align-items-center gap-2">
            <div id="display-programs-modal"></div>
            <span>|</span>
            <span id="display-publish-date-modal"></span>
            <span>|</span>
            <span class="text-capitalize" id="display-uploader-modal"></span>
        </div>
        <hr>
        <div id="display-abstract-modal"></div>
        <hr>
        <h5 class="mt-3"><strong>Keywords:</strong></h5>
        <p id="display-keywords-modal"></p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deletepapermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Delete Paper
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="deletePaperForm" class="container d-flex flex-row gap-3">
          <div class="d-flex gap-3">
            <div class="form-floating">
              <input type="text" id="delete-title-modal" name="title" class="form-control bg-white" readonly>
              <label for="section" class="form-label">Research Title:</label>
            </div>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <input id="delete-id-modal" type="hidden" name="researchID">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>


</script>