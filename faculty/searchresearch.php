<?php require_once("../backend/session_faculty.php"); ?>

<div class="row mx-auto d-flex flex-column justify-content-center  align-items-center">

  <div
    class="d-flex flex-column gap-3 sticky-top col-lg-12 col-sm-auto justify-content-center align-items-stretch mx-auto mt-1 p-5 pb-3 bg-white">

    <div class="d-flex flex-row gap-3">
      <div class="buttons d-flex flex-row gap-1">
        <button id="searchByAuthor" class="btn btn-outline-primary d-flex align-items-center gap-2">
          <i class="bi bi-people-fill"></i> Authors
        </button>
        <button id="searchByInterest" class="btn btn-outline-primary d-flex align-items-center gap-2">
          <i class="bi bi-tag-fill"></i> Interests
        </button>
        <button id="searchByProgram" class="btn btn-outline-primary d-flex align-items-center gap-2">
          <i class="bi bi-journal-bookmark"></i> Program
        </button>
      </div>
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input type="text" id="searchResearches" name="search" class="form-control form-control-sm align-middle"
          placeholder="Search" required style="padding: 1.17rem 0.75rem;">
      </div>
    </div>

    <div id="categoryToggle" class="round shadow d-none mb-3">
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input type="text" id="searchCategories" name="search" class="form-control form-control-sm align-middle"
          placeholder="Search" required style="padding: 1.17rem 0.75rem;">
      </div>
      <div id="searchCategoriesResult" class="d-flex flex-column gap-3"></div>
    </div>

    <div id="categoryPaperToggle" class="round shadow-sm d-none">
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input type="text" id="searchCategoriesPaper" name="search" class="form-control form-control-sm align-middle"
          placeholder="Search" required style="padding: 1.17rem 0.75rem;">
      </div>
      <div class="d-flex flex-column p-2">
        <span class="text-muted text-lowercase">Search results for:</span>
        <h4 id="displayCategoryType" class="p-2 text-capitalize">sample lang bih</h4>
      </div>
    </div>
  </div>
  <div id="searchResearchesResult" class="d-flex flex-column gap-3 px-5"></div>
</div>
<script>

  var activeCategoryID = ''; // Represents the Active ID in Search with Category Modal
  var activeType = ''; // Represents the Active ID in Search with Category Modal
  updateSearchResult('%');

  $(document).on("click", function (event) {
    var target = $(event.target);
    var searchResult = $("#categoryToggle");

    // Check if the clicked element is outside the search result div
    if (!target.closest("#categoryToggle, #searchByAuthor, #searchByInterest, #searchByProgram").length && !target.is("#categoryToggle, #searchByAuthor, #searchByInterest, #searchByProgram")) {
      // Hide the search result div
      searchResult.addClass("d-none");
    }
  });

  async function loadCategoriesResult(table, search) {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          table: table,
          search: search,
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/updatesearchcategories.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          // Update the table content
          $("#searchCategoriesResult").html(response);
          researchEventListeners();
        });

        ajaxRequest.fail(function (xhr, status, error) {
          console.log(error);
        });
      } else {
        // Unable to fetch CSRF token, handle the error
        console.error("Error fetching CSRF token:", response.status);
        displayToastr("error", "An error occurred. Please try again.");
      }
    } catch (error) {
      // General error occurred, handle it
      console.error("Error:", error);
      displayToastr("error", "An error occurred. Please try again.");
    }
  }

  const searchByInterests = document.querySelector("#searchByInterest");
  searchByInterests.addEventListener("click", function () {
    const interestID = this.getAttribute("data-interestID");
    const name = this.getAttribute("data-name");
    $("#searchByAuthor, #searchByInterest, #searchByProgram").removeClass("active");
    $(this).addClass("active");
    loadCategoriesResult('Interest', '%');
    $("#categoryToggle").removeClass('d-none');
    $("#categoryPaperToggle").toggleClass("d-none", true);


  });

  const searchByAuthors = document.querySelector("#searchByAuthor");
  searchByAuthors.addEventListener("click", function () {
    const authorID = this.getAttribute("data-interestID");
    const name = this.getAttribute("data-name");
    $("#searchByAuthor, #searchByInterest, #searchByProgram").removeClass("active");
    $(this).addClass("active");
    loadCategoriesResult('Author', '%');
    $("#categoryToggle").removeClass('d-none');
    $("#categoryPaperToggle").toggleClass("d-none", true);
  });

  const searchByPrograms = document.querySelector("#searchByProgram");
  searchByPrograms.addEventListener("click", function () {
    const programID = this.getAttribute("data-interestID");
    const name = this.getAttribute("data-name");
    $("#searchByAuthor, #searchByInterest, #searchByProgram").removeClass("active");
    $(this).addClass("active");
    loadCategoriesResult('Program', '%');
    $("#categoryToggle").removeClass('d-none');
    $("#categoryPaperToggle").toggleClass("d-none", true);
  });


  function getActiveCategory() {
    var categoryMap = {
      "searchByAuthor": "Author",
      "searchByInterest": "Interest",
      "searchByProgram": "Program"
    };

    var activeButton = $("#searchByAuthor, #searchByInterest, #searchByProgram").filter(".active");
    return categoryMap[activeButton.attr("id")] || null;
  }

  $(document).on("input", "#searchCategories", function (e) {
    const query = $(this).val();
    e.preventDefault();
    loadCategoriesResult(getActiveCategory(), query);
  });

  function researchEventListeners() {
    var links = document.querySelectorAll('.search-research-link');
    var searchByAuthorsChildren = document.querySelectorAll('.searchByAuthorChildren');
    var searchByProgramsChildren = document.querySelectorAll('.searchByProgramChildren');
    var searchByInterestsChildren = document.querySelectorAll('.searchByInterestChildren');

    links.forEach(function (link) {
      link.addEventListener('click', function (event) {
        event.preventDefault();
        var researchTitle = this.querySelector('.search-research-title').textContent;
        var researchAbstract = this.querySelector('.search-research-abstract').getAttribute('data-full-text');
        var researchKeywords = this.querySelector('.search-research-keywords').getAttribute('data-full-text');
        var researchPublishDate = this.querySelector('.search-research-publish-date').textContent;
        var researchProgram = this.querySelector('.search-research-programs').innerHTML;
        var researchAuthor = this.querySelector('.search-research-authors').innerHTML;
        var researchInterest = this.querySelector('.search-research-interest').innerHTML;
        var researchUploader = this.querySelector('.search-research-uploader').getAttribute('data-full-text');

        // displaypapermodal
        document.getElementById('display-title-modal').textContent = researchTitle;
        document.getElementById('display-abstract-modal').innerHTML = researchAbstract;
        document.getElementById('display-keywords-modal').textContent = researchKeywords;
        document.getElementById('display-publish-date-modal').textContent = researchPublishDate;
        document.getElementById('display-programs-modal').innerHTML = researchProgram;
        document.getElementById('display-authors-modal').innerHTML = researchAuthor;
        document.getElementById('display-interests-modal').innerHTML = researchInterest;
        document.getElementById('display-uploader-modal').textContent = "Uploaded By: " + researchUploader;
      });
    });

    searchByAuthorsChildren.forEach(function (searchByAuthorChildren) {
      searchByAuthorChildren.addEventListener('click', function (event) {
        event.preventDefault();
        $("#categoryToggle").addClass("d-none"); // Hide the categories
        $("#categoryPaperToggle").removeClass('d-none'); // Show categories paper search

        activeType = 'Author'
        activeCategoryID = this.getAttribute('data-authorID');
        authorFirstName = this.getAttribute('data-firstname');
        authorLastName = this.getAttribute('data-lastname');

        document.getElementById('displayCategoryType').innerHTML = '<i class="bi bi-person-fill mr-1"></i>' + authorFirstName + ' ' + authorLastName;


        updateSearchByCategories(activeCategoryID, activeType, '%');
      });
    });

    searchByProgramsChildren.forEach(function (searchByProgramChildren) {
      searchByProgramChildren.addEventListener('click', function (event) {
        event.preventDefault();
        $("#categoryToggle").addClass("d-none"); // Hide the categories
        $("#categoryPaperToggle").removeClass('d-none'); // Show categories paper search
        activeType = 'Program';

        activeCategoryID = this.getAttribute('data-programID');
        programName = this.getAttribute('data-name');

        document.getElementById('displayCategoryType').innerHTML = '<i class="bi bi-journal-bookmark mr-1"></i>' + programName;

        updateSearchByCategories(activeCategoryID, activeType, '%');
      });
    });

    searchByInterestsChildren.forEach(function (searchByInterestChildren) {
      searchByInterestChildren.addEventListener('click', function (event) {
        event.preventDefault();
        $("#categoryToggle").addClass("d-none"); // Hide the categories
        $("#categoryPaperToggle").removeClass('d-none'); // Show categories paper search
        activeType = 'Interest';

        activeCategoryID = this.getAttribute('data-interestID');
        interestName = this.getAttribute('data-name');

        document.getElementById('displayCategoryType').innerHTML = '<i class="bi bi-tag-fill mr-1"></i>' + interestName;

        updateSearchByCategories(activeCategoryID, activeType, '%');
      });
    });
  }

  async function updateSearchResult(search) {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          userID: '<?php echo $_SESSION['userID']; ?>',
          search: search,
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/updatesearchresult.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          // Update the table content
          $("#searchResearchesResult").html(response);
          researchEventListeners();
        });

        ajaxRequest.fail(function (xhr, status, error) {
          console.log(error);
        });
      } else {
        // Unable to fetch CSRF token, handle the error
        console.error("Error fetching CSRF token:", response.status);
        displayToastr("error", "An error occurred. Please try again.");
      }
    } catch (error) {
      // General error occurred, handle it
      console.error("Error:", error);
      displayToastr("error", "An error occurred. Please try again.");
    }
  }

  async function updateSearchByCategories(categoryID, type, search) {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          categoryID: categoryID,
          type: type,
          search: search,
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/updatesearchresult.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          $("#searchResearchesResult").html(response);  // Update the table content
          researchEventListeners();
        });

        ajaxRequest.fail(function (xhr, status, error) {
          displayToastr("error", console.log(error));
        });
      } else {
        // Unable to fetch CSRF token, handle the error
        displayToastr("error", console.error("Error fetching CSRF token:", response.status));
      }
    } catch (error) {
      // General error occurred, handle it
      console.error("Error:", error);
      displayToastr("error", "An error occurred. Please try again.");
    }
  }

  $(document).on("input", "#searchResearches", function (e) {
    // Get the search query
    $("#categoryPaperToggle").toggleClass("d-none", true); // Hides the search by category option 
    const search = $(this).val();
    e.preventDefault();
    updateSearchResult(search);

  });

  $(document).on("input", "#searchCategoriesPaper", function (e) {
    // Get the search query
    const search = $(this).val();
    e.preventDefault();
    updateSearchByCategories(activeCategoryID, activeType, search);
  });

</script>