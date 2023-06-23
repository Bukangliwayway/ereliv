const displayToastr = (type, message) => {
  toastr[type](message);
};

$(document).ready(function () {
  // UPLOADRESEARCH.PHP
  reloadMultiselects();

  var selectedOptionsAuthors = [];
  var selectedOptionsPrograms = [];

  // Make datepicker icon clickable
  $("#datepicker").on("changeDate", function (e) {
    var selectedDate = e.format();
  });

  var dataInputAuthors = document.getElementById("authors");
  $("#author-select").on("change", function () {
    selectedOptionsAuthors = $(this).val();
    dataInputAuthors.value = JSON.stringify(selectedOptionsAuthors);
  });

  var dataInputPrograms = document.getElementById("programs");
  $("#program-select").on("change", function () {
    selectedOptionsPrograms = $(this).val();
    dataInputPrograms.value = JSON.stringify(selectedOptionsPrograms);
  });

  var dataInputInterests = document.getElementById("interests");
  $("#interest-select").on("change", function () {
    selectedOptionsInterests = $(this).val();
    dataInputInterests.value = JSON.stringify(selectedOptionsInterests);
  });

  $("#uploadResearchForm").submit(function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Serialize form data
    var formData = $(this).serialize();

    // Perform AJAX request
    $.ajax({
      url: "../backend/uploadresearch_backend.php",
      method: "POST",
      data: formData,
      dataType: "json",
      beforeSend: function () {
        // Show loading animation or do any pre-request tasks
        // showLoadingAnimation();
      },
      success: function (response) {
        // Handle the response and display Toastr notification
        displayToastr(response.status, response.message);

        if (response.status === "success") {
          // Reset the form after successful upload
          $("#uploadResearchForm")[0].reset();
        }
      },
      error: function () {
        // Handle error response here
        displayToastr("error", "An error occurred. Please try again.");
      },
      complete: function () {
        // Hide loading animation or do any post-request tasks
        // hideLoadingAnimation();
      },
    });
  });

  function reloadMultiselects() {
    require(["bootstrap-multiselect"], function () {
      $("#interest-select").multiselect({
        includeSelectAllOption: true,
        buttonWidth: 250,
        enableFiltering: true,
      });
    });

    require(["bootstrap-multiselect"], function () {
      $("#program-select").multiselect({
        includeSelectAllOption: true,
        buttonWidth: 250,
        enableFiltering: true,
      });
    });

    require(["bootstrap-multiselect"], function () {
      $("#author-select").multiselect({
        includeSelectAllOption: true,
        buttonWidth: 250,
        enableFiltering: true,
      });
    });
    loadAuthorSelect();
    loadProgramSelect();
    loadInterestSelect();
  }

  async function loadAuthorSelect() {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          table: "Author",
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/getCategories.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          var authorSelect = $("#author-select");

          // Clear existing options
          authorSelect.empty();

          // Add newauthorSelect options
          $.each(response, function (index, authorData) {
            var fullName =
              authorData.lastname.charAt(0).toUpperCase() +
              authorData.lastname.slice(1) +
              ", " +
              authorData.firstname.charAt(0).toUpperCase() +
              authorData.firstname.slice(1);
            var option = $("<option>", {
              value: authorData.authorID,
              text: fullName,
            });
            authorSelect.append(option);
          });

          // rebuild the Multiselect dropdown
          authorSelect.multiselect("rebuild");
          attachEventListeners();
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

  async function loadProgramSelect() {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          table: "Program",
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/getCategories.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          var programSelect = $("#program-select");

          // Clear existing options
          programSelect.empty();

          // Add newprogramSelect options
          $.each(response, function (index, programData) {
            var option = $("<option>", {
              value: programData.programID,
              text: programData.name.toUpperCase(),
            });
            programSelect.append(option);
          });

          // rebuild the Multiselect dropdown
          programSelect.multiselect("rebuild");
          attachEventListeners();
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

  async function loadInterestSelect() {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          table: "Interest",
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/getCategories.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          var interestSelect = $("#interest-select");

          // Clear existing options
          interestSelect.empty();

          // Add new options
          $.each(response, function (index, interestData) {
            var option = $("<option>", {
              value: interestData.interestID,
              text:
                interestData.name.charAt(0).toUpperCase() +
                interestData.name.slice(1).toLowerCase(),
            });
            interestSelect.append(option);
          });

          // rebuild the Multiselect dropdown
          interestSelect.multiselect("rebuild");
          attachEventListeners();
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

  tinymce.init({
    selector: "textarea",
    plugins: "",
    toolbar:
      "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough",
    height: 250,
    menubar: false,
    setup: function (editor) {
      editor.on("change", function () {
        document.getElementById("content").value = tinymce
          .get("content-input")
          .getContent();
      });
    },
  });

  // INDEX.PHP

  // Get the Containers
  var uploadresearchContainer = document.querySelector(
    "#uploadresearchContainer"
  );
  var notificationsContainer = document.querySelector(
    "#notificationsContainer"
  );
  var searchresearchContainer = document.querySelector(
    "#searchresearchContainer"
  );
  var modifycategoriesContainer = document.querySelector(
    "#modifycategoriesContainer"
  );

  // Get the button elements
  var uploadresearchBtn = document.getElementById("uploadresearchBtn");
  var notificationsBtn = document.getElementById("notificationsBtn");
  var searchresearchBtn = document.getElementById("searchresearchBtn");
  var modifycategoriesBtn = document.getElementById("modifycategoriesBtn");

  // Get the buttons and div containers
  const buttons = document.querySelectorAll(".toggle-btn");
  const containers = document.querySelectorAll(".toggle-visibility");

  // Function to toggle visibility of div containers
  const toggleView = (containerToShow) => {
    // Hide all div containers
    containers.forEach((container) => {
      container.classList.add("d-none");
    });

    // Show the selected container
    containerToShow.classList.remove("d-none");
  };

  // Add click event listener to the button container
  document.addEventListener("click", (event) => {
    const target = event.target;

    // Check if the clicked element is a button
    if (target.classList.contains("toggle-btn")) {
      const containerId = target.dataset.container;
      const containerToShow = document.getElementById(containerId);

      // Toggle the visibility of div containers
      toggleView(containerToShow);

      // Toggle the active class on buttons
      buttons.forEach((button) => {
        button.classList.toggle("active", button === target);
      });
    }
  });

  //MODIFY CATEGORIES

  // Start with Authors
  loadCategories("Author");

  async function loadCategories(table) {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          table: table,
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/updatecategories.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          // Update the table content
          $("#categorylist").html(response);
          attachEventListeners();
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

  async function loadCategoriesSearch(table, search) {
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
          url: "../backend/updatecategoriessearch.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          // Update the table content
          $("#categorylist").html(response);
          attachEventListeners();
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

  function attachEventListeners() {
    const editinterestButtons = document.querySelectorAll(
      ".editinterestbutton"
    );
    editinterestButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const interestID = this.getAttribute("data-interestID");
        const name = this.getAttribute("data-name");
        document.querySelector("#editInterestName").value = name;
        document.querySelector("#editInterestID").value = interestID;
      });
    });

    const deleteinterestButtons = document.querySelectorAll(
      ".deleteinterestbutton"
    );
    deleteinterestButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const interestID = this.getAttribute("data-interestID");
        const name = this.getAttribute("data-name");
        document.querySelector("#deleteInterestName").value = name;
        document.querySelector("#deleteInterestID").value = interestID;
      });
    });

    const editauthorButtons = document.querySelectorAll(".editauthorbutton");
    editauthorButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const authorID = this.getAttribute("data-authorID");
        const firstname = this.getAttribute("data-firstname");
        const lastname = this.getAttribute("data-lastname");
        document.querySelector("#editAuthorLastName").value = lastname;
        document.querySelector("#editAuthorFirstName").value = firstname;
        document.querySelector("#editAuthorID").value = authorID;
      });
    });

    const deleteauthorButtons = document.querySelectorAll(
      ".deleteauthorbutton"
    );
    deleteauthorButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const authorID = this.getAttribute("data-authorID");
        const firstname = this.getAttribute("data-firstname");
        const lastname = this.getAttribute("data-lastname");
        document.querySelector("#deleteAuthorLastName").value = lastname;
        document.querySelector("#deleteAuthorFirstName").value = firstname;
        document.querySelector("#deleteAuthorID").value = authorID;
      });
    });
  }

  $("#author-cat").addClass("active");

  $(document).on("click", "#interest-cat", function (e) {
    e.preventDefault();
    // Remove active class from all buttons
    $("#interest-cat, #author-cat").removeClass("active");
    // Add active class to clicked button
    $(this).addClass("active");
    // Load Interests
    loadCategories("Interest");
  });

  $(document).on("click", "#author-cat", function (e) {
    e.preventDefault();
    // Remove active class from all buttons
    $("#interest-cat, #author-cat").removeClass("active");
    // Add active class to clicked button
    $(this).addClass("active");
    // Load Authors
    loadCategories("Author");
  });

  $(document).on("input", "#search", function (e) {
    // Get the search query
    const query = $(this).val();
    e.preventDefault();
    loadCategoriesSearch(getActiveCategory(), query);
  });

  function getActiveCategory() {
    var activeButton = $("#author-cat, #interest-cat").filter(".active");

    if (activeButton.attr("id") === "author-cat") {
      return "Author";
    } else if (activeButton.attr("id") === "interest-cat") {
      return "Interest";
    } else {
      // Handle the case when no button is active
      return null;
    }
  }

  $("#addAuthorForm").submit(function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Serialize form data
    var formData = $(this).serialize();

    $.ajax({
      url: "../backend/addauthor_backend.php",
      method: "POST",
      data: formData,
      dataType: "json",
      beforeSend: function () {
        // Show loading animation or do any pre-request tasks
        $("#loadingSpinner").removeClass("d-none");
        $("#loadingSpinner").addClass("d-flex");
        $("#addAuthorForm").css({ "pointer-events": "none" });
      },
      success: function (data) {
        // Hide loading animation
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#addAuthorForm").css("pointer-events", "auto");

        displayToastr(data.status, data.message);
        $("#addAuthorForm")[0].reset();
        //Loads the Multiselects Options
        reloadMultiselects();
      },
      error: function () {
        // Hide loading animation
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#addAuthorForm").css("pointer-events", "auto");

        // Handle error response here
        displayToastr("error", "An error occurred. Please try again.");
      },
      complete: function () {
        // Hide loading animation or do any post-request tasks
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#addAuthorForm").css("pointer-events", "auto");

        //Reload the Author List
        $("#author-cat").trigger("click");
      },
    });
  });

  $("#addInterestForm").submit(function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Serialize form data
    var formData = $(this).serialize();

    $.ajax({
      url: "../backend/addinterest_backend.php",
      method: "POST",
      data: formData,
      dataType: "json",
      beforeSend: function () {
        // Show loading animation or do any pre-request tasks
        $("#loadingSpinner").removeClass("d-none");
        $("#loadingSpinner").addClass("d-flex");
        $("#addInterestForm").css({ "pointer-events": "none" });
      },
      success: function (data) {
        // Hide loading animation
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#addInterestForm").css("pointer-events", "auto");

        displayToastr(data.status, data.message);
        $("#addInterestForm")[0].reset();
        //Reloads the Multiselects Options
        reloadMultiselects();
      },
      error: function () {
        // Hide loading animation
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#addInterestForm").css("pointer-events", "auto");

        // Handle error response here
        displayToastr("error", "An error occurred. Please try again.");
      },
      complete: function () {
        // Hide loading animation or do any post-request tasks
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#addInterestForm").css("pointer-events", "auto");

        //Reload the Interest List
        $("#interest-cat").trigger("click");
      },
    });
  });

  $("#editInterestForm").submit(function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Serialize form data
    var formData = $(this).serialize();

    $.ajax({
      url: "../backend/editinterest_backend.php",
      method: "POST",
      data: formData,
      dataType: "json",
      beforeSend: function () {
        // Show loading animation or do any pre-request tasks
        $("#loadingSpinner").removeClass("d-none");
        $("#loadingSpinner").addClass("d-flex");
        $("#editInterestForm").css("pointer-events", "auto");
      },
      success: function (data) {
        // Hide loading animation
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#editInterestForm").css("pointer-events", "auto");

        // Close the active modal section
        $("#editinterestmodal").modal("hide");

        displayToastr(data.status, data.message);
        $("#editInterestForm")[0].reset();
      },
      error: function () {
        // Hide loading animation
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#editInterestForm").css("pointer-events", "auto");

        // Handle error response here
        displayToastr("error", "An error occurred. Please try again.");
      },
      complete: function () {
        // Hide loading animation or do any post-request tasks
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#editInterestForm").css("pointer-events", "auto");
        //Reload the Interest List
        loadCategories("Interest");
      },
    });
  });

  $("#deleteInterestForm").submit(function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Serialize form data
    var formData = $(this).serialize();

    $.ajax({
      url: "../backend/deleteinterest_backend.php",
      method: "POST",
      data: formData,
      dataType: "json",
      beforeSend: function () {
        // Show loading animation or do any pre-request tasks
        $("#loadingSpinner").removeClass("d-none");
        $("#loadingSpinner").addClass("d-flex");
        $("#deleteInterestForm").css("pointer-events", "auto");
      },
      success: function (data) {
        // Hide loading animation
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#deleteInterestForm").css("pointer-events", "auto");

        // Close the active modal section
        $("#deleteinterestmodal").modal("hide");

        displayToastr(data.status, data.message);
        $("#deleteInterestForm")[0].reset();
      },
      error: function () {
        // Hide loading animation
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#deleteInterestForm").css("pointer-events", "auto");

        // Handle error response here
        displayToastr("error", "An error occurred. Please try again.");
      },
      complete: function () {
        // Hide loading animation or do any post-request tasks
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#deleteInterestForm").css("pointer-events", "auto");
        //Reload the Interest List
        loadCategories("Interest");
      },
    });
  });

  $("#editAuthorForm").submit(function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Serialize form data
    var formData = $(this).serialize();

    $.ajax({
      url: "../backend/editauthor_backend.php",
      method: "POST",
      data: formData,
      dataType: "json",
      beforeSend: function () {
        // Show loading animation or do any pre-request tasks
        $("#loadingSpinner").removeClass("d-none");
        $("#loadingSpinner").addClass("d-flex");
        $("#editAuthorForm").css("pointer-events", "auto");
      },
      success: function (data) {
        // Hide loading animation
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#editAuthorForm").css("pointer-events", "auto");

        // Close the active modal section
        $("#editauthormodal").modal("hide");

        displayToastr(data.status, data.message);
        $("#editAuthorForm")[0].reset();
      },
      error: function () {
        // Hide loading animation
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#editAuthorForm").css("pointer-events", "auto");

        // Handle error response here
        displayToastr("error", "An error occurred. Please try again.");
      },
      complete: function () {
        // Hide loading animation or do any post-request tasks
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#editAuthorForm").css("pointer-events", "auto");
        //Reload the Author List
        loadCategories("Author");
      },
    });
  });

  $("#deleteAuthorForm").submit(function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Serialize form data
    var formData = $(this).serialize();

    $.ajax({
      url: "../backend/deleteauthor_backend.php",
      method: "POST",
      data: formData,
      dataType: "json",
      beforeSend: function () {
        // Show loading animation or do any pre-request tasks
        $("#loadingSpinner").removeClass("d-none");
        $("#loadingSpinner").addClass("d-flex");
        $("#deleteAuthorForm").css("pointer-events", "auto");
      },
      success: function (data) {
        // Hide loading animation
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#deleteAuthorForm").css("pointer-events", "auto");

        // Close the active modal section
        $("#deleteauthormodal").modal("hide");

        displayToastr(data.status, data.message);
        $("#deleteAuthorForm")[0].reset();
      },
      error: function () {
        // Hide loading animation
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#deleteAuthorForm").css("pointer-events", "auto");

        // Handle error response here
        displayToastr("error", "An error occurred. Please try again.");
      },
      complete: function () {
        // Hide loading animation or do any post-request tasks
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#deleteAuthorForm").css("pointer-events", "auto");
        //Reload the Author List
        loadCategories("Author");
      },
    });
  });
});
