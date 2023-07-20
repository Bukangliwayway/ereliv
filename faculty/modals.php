<!-- modals -->
<div class="modal fade" id="signoutmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="signout" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Sign Out
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <p class="text-muted">Are you sure you want to sign out? Logging out will end your current session and any unsaved changes will be lost. Please ensure you have saved your work before proceeding with the sign-out process.</p>
        <form method="POST" action="../backend/session_out.php" class="container d-flex flex-row gap-3 align-items-center">
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
        <h4 class="text-center text-capitalize" id="display-title-modal"></h4>
        <div class="text-reset d-flex flex-wrap justify-content-center gap-1 mb-2" id="display-authors-modal"></div>
        <div class="d-flex justify-content-center align-items-center gap-2">
          <div id="display-programs-modal" class="d-flex gap-1"></div>
          <span>|</span>
          <span id="display-publish-date-modal"></span>
          <span>|</span>
          <span class="text-capitalize" id="display-uploader-modal"></span>
        </div>
        <hr>
        <div id="abstract-section" class="research-section d-none">
          <h4 class="text-muted text-capitalize">Abstract:</h4>
          <div id="display-abstract-modal"></div>
          <hr>
        </div>
        <div id="introduction-section" class="research-section d-none">
          <h4 class="text-muted text-capitalize">introduction:</h4>
          <div id="display-introduction-modal"></div>
          <hr>
        </div>
        <div id="methodology-section" class="research-section d-none">
          <h4 class="text-muted text-capitalize">methodology:</h4>
          <div id="display-methodology-modal"></div>
          <hr>
        </div>
        <div id="results-section" class="research-section d-none">
          <h4 class="text-muted text-capitalize">results:</h4>
          <div id="display-results-modal"></div>
          <hr>
        </div>
        <div id="discussion-section" class="research-section d-none">
          <h4 class="text-muted text-capitalize">discussion:</h4>
          <div id="display-discussion-modal"></div>
          <hr>
        </div>
        <div id="conclusion-section" class="research-section d-none">
          <h4 class="text-muted text-capitalize">conclusion:</h4>
          <div id="display-conclusion-modal"></div>
          <hr>
        </div>
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
        <form id="deletePaperForm" class="container d-flex flex-column gap-3">
          <span>Research Title:</span>
          <h4 id="delete-title-modal"></h4>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <input id="delete-id-modal" type="hidden" name="researchID">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="displayadviseemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Student Details
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body d-flex flex-column align-items-center justify-content-center">
        <div class="d-flex justify-content-end gap-1 ml-auto d-flex gap-1">
          <span id="display-advisee-priority-modal"></span>
          <span id="display-advisee-status-modal"></span>
        </div>
        <div class="d-flex flex-column align-items-center justify-content-center">
          <h4 class=" text-center text-capitalize" id="display-advisee-name-modal">
          </h4>
          <span class="text-uppercase text-muted" id="display-advisee-studentnumber-modal"></span>
        </div>
        <hr>
        <div class="d-flex flex-column align-items-center justify-content-center">
          <span class="text-muted">Program and Section </span>
          <div class="d-flex justify-content-center align-items-center gap-2">
            <span class="text-uppercase" id="display-advisee-program-modal"></span>
            <span>|</span>
            <span class="text-capitalize" id="display-advisee-section-modal"></span>
          </div>
        </div>
        <hr>
        <div class="d-flex gap-1 flex-column align-items-center justify-content-center">
          <span class="text-capitalize text-muted">Date Registered </span>
          <span id="display-advisee-date-modal"></span>
        </div>
        <hr>
        <button type="submit" id="display-advisee-action-modal" class="adviseeSwitch"></button>
      </div>
    </div>
  </div>
</div>