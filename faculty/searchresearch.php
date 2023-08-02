<?php require_once("../backend/session_faculty.php"); ?>

<div class="row mx-auto d-flex flex-column justify-content-center  align-items-center">

  <div
    class="d-flex flex-column gap-3 sticky-top col-lg-12 col-sm-auto justify-content-center align-items-stretch mx-auto mt-1 p-5 pb-3 bg-white">

    <div class="d-flex flex-row gap-3">
      <div class="buttons d-flex flex-row gap-1">
        <button id="searchByAuthor" class="btn btn-outline-primary d-flex align-items-center gap-2 maincategorybtn">
          <i class="bi bi-people-fill"></i> Authors
        </button>
        <button id="searchByInterest" class="btn btn-outline-primary d-flex align-items-center gap-2 maincategorybtn">
          <i class="bi bi-tag-fill"></i> Interests
        </button>
        <button id="searchByProgram" class="btn btn-outline-primary d-flex align-items-center gap-2 maincategorybtn">
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
      <div id="searchCategoriesResult" class="d-inline-flex flex-wrap gap-3 p-3 align-items-center"></div>
    </div>

    <div id="categoryPaperToggle" class="round shadow-sm d-none">
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input type="text" id="searchCategoriesPaper" name="search" class="form-control form-control-sm align-middle"
          placeholder="Search" required style="padding: 1.17rem 0.75rem;">
      </div>
      <div class="d-flex flex-column p-2">
        <span class="text-muted text-muted text-capitalize"> <i class="bi bi-filter"></i>
          Filters</span>
        <div class="d-flex flex-wrap p-2 gap-1" id="activecategories"></div>
      </div>
    </div>
  </div>
  <div id="searchResearchesResult" class="d-flex flex-column gap-3 px-5"></div>
</div>
<script>

  var activePrograms = [];
  var activeAuthors = [];
  var activeInterests = [];

  updateSearchResult('');

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
    var categoryFilters = document.querySelectorAll('.categoryfilter');

    links.forEach(function (link) {
      link.addEventListener('click', function (event) {
        event.preventDefault();
        var researchTitle = this.querySelector('.search-title').textContent;
        var researchAbstract = this.querySelector('.search-abstract').getAttribute('data-full-text');
       var researchIntroduction = this.querySelector('.search-introduction').getAttribute('data-full-text');
        var researchMethodology = this.querySelector('.search-methodology').getAttribute('data-full-text');
        var researchResults = this.querySelector('.search-results').getAttribute('data-full-text');
        var researchDiscussion = this.querySelector('.search-discussion').getAttribute('data-full-text');
        var researchConclusion = this.querySelector('.search-conclusion').getAttribute('data-full-text');
        var researchKeywords = this.querySelector('.search-keywords').getAttribute('data-full-text');
        var researchPublishDate = this.querySelector('.search-publish-date').textContent;
        var researchProgram = this.querySelector('.search-programs').innerHTML;
        var researchAuthor = this.querySelector('.search-authors').innerHTML;
        var researchInterest = this.querySelector('.search-interest').innerHTML;
        var researchUploader = this.querySelector('.search-uploader').getAttribute('data-full-text');

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

        // updateSearchByCategories(activeCategoryID, activeType, '%');
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


        // updateSearchByCategories(activeCategoryID, activeType, '%');
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

        // updateSearchByCategories(activeCategoryID, activeType, '%');
      });
    });

    categoryFilters.forEach(function (categoryFilter) {
      categoryFilter.addEventListener('click', function (event) {
        event.preventDefault();

        var btn = document.createElement("button");
        btn.classList.add("btn", "btn-outline-primary", "shadow-sm", "active");
        var icon = document.createElement("i");
        var xbutton = document.createElement("i");
        xbutton.classList.add("bi", "bi-x-circle", "mr-2", "red-icon", "rounded-circle", "removecategory");
        xbutton.setAttribute('data-id', this.getAttribute('data-id'));
        xbutton.setAttribute('data-name', this.getAttribute('data-name'));
        xbutton.setAttribute('data-type', this.getAttribute('data-type'));
        btn.id = this.getAttribute('data-id') + "btn";
        var text = document.createTextNode(this.getAttribute('data-name'));

        switch (this.getAttribute('data-type')) {
          case 'interest':
            if (activeInterests.includes(this.getAttribute('data-id'))) break;
            btn.appendChild(xbutton);
            icon.classList.add("bi", "bi-tag-fill", "mr-1");
            btn.appendChild(icon);
            btn.appendChild(text);
            activeInterests.push(this.getAttribute('data-id'));
            $('#activecategories').append(btn);
            break;
          case 'program':
            if (activePrograms.includes(this.getAttribute('data-id'))) break;
            btn.appendChild(xbutton);
            icon.classList.add("bi", "bi-journal-bookmark", "mr-1");
            btn.appendChild(icon);
            btn.appendChild(text);
            activePrograms.push(this.getAttribute('data-id'));
            $('#activecategories').append(btn);
            break;
          case 'author':
            if (activeAuthors.includes(this.getAttribute('data-id'))) break;
            btn.appendChild(xbutton);
            icon.classList.add("bi", "bi-person-fill", "mr-1");
            btn.appendChild(icon);
            btn.appendChild(text);
            activeAuthors.push(this.getAttribute('data-id'));
            $('#activecategories').append(btn);
            break;
        }
      });
    });

    //   var maincategories = document.querySelectorAll('.maincategorybtn');
    //   maincategories.forEach(function (maincategory) {
    //     maincategory.addEventListener('click', function (event) {
    //       var parentElement = document.querySelector("#searchCategoriesResult");
    //       var children = Array.from(parentElement.children);
    //       children.forEach(function (child) {
    //         console.log('i rannn ' + child.getAttribute('data-name'));
    //         switch (child.getAttribute('data-type')) {
    //           case 'interest':
    //         activeInterests.forEach(function (interest) {
    //           if (child.getAttribute('data-id') == interest) {
    //             child.classList.add("active");
    //           } else {
    //             child.classList.remove("active");
    //           }
    //         });
    //         break;
    //           case 'author':
    //         activeAuthors.forEach(function (author) {
    //           if (child.getAttribute('data-id') == author) {
    //             child.classList.add("active");
    //           } else {
    //             child.classList.remove("active");
    //           }
    //         });
    //         break;
    //           case 'program':
    //         activePrograms.forEach(function (program) {
    //           if (child.getAttribute('data-id') == program) {
    //             child.classList.add("active");
    //           } else {
    //             child.classList.remove("active");
    //           }
    //         });
    //         break;
    //           default:
    //         break;
    //       }
    //       });
    //   });
    // });

    document.querySelectorAll('.removecategory').forEach(removecategory => {
      removecategory.addEventListener('click', function (event) {
        switch (removecategory.getAttribute('data-type')) {
          case 'interest':
            activeInterests = activeInterests.filter(item => item !== removecategory.getAttribute('data-id'));
            break;
          case 'program':
            activePrograms = activePrograms.filter(item => item !== removecategory.getAttribute('data-id'));
            break;
          case 'author':
            activeAuthors = activeAuthors.filter(item => item !== removecategory.getAttribute('data-id'));
            break;
        }
        this.parentNode.remove();
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
          activePrograms: activePrograms,
          activeAuthors: activeAuthors,
          activeInterests: activeInterests,
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
          console.log(response);
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
    // updateSearchByCategories(activeCategoryID, activeType, search);
  });

</script>