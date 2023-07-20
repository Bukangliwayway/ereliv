<?php require_once("../backend/session_faculty.php"); ?>

<style>
  :root {
    /* Define the --highcharts-background-color variable */
    --highcharts-background-color: #ffffff;
    /* Set your desired background color here */
  }
</style>


<div class="row mx-auto d-flex flex-wrap justify-content-center  align-items-center gap-3 mt-3">
  <div id="programBarChart" class="custom-chart-container col-11 shadow-sm p-3"></div>
  <div id="statusesPieChart" class="custom-chart-container col-5 shadow-sm p-3"></div>
  <div id="classificationsPieChart" class="custom-chart-container col-5 shadow-sm p-3"></div>
</div>

<script>
  // initially start it
  updateProgramBarChart();
  updateStatusesPieChart();
  updateClassificationsPieChart();

  document
    .querySelector("#homeBtn")
    .addEventListener("click", function (event) {
      if (event.isTrusted) {
        updateProgramBarChart();
        updateStatusesPieChart();
        updateClassificationsPieChart();
      }
    });
  // Update research list function
  async function updateProgramBarChart() {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          userID: '<?php echo $_SESSION['userID']; ?>',
          type: "faculty",
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/updateprogrambarchart.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          const programNames = [];
          const programCardinalities = [];

          // Iterate through the data and extract program names and cardinalities
          response.forEach((item) => {
            programNames.push(item.programName);
            programCardinalities.push(item.programCardinality);
          });


          const customColors = ['#ff6347', '#ffa500', '#32cd32', '#4169e1', '#8a2be2'];


          // Create the Highcharts bar chart
          Highcharts.chart('programBarChart', {
            chart: {
              type: 'bar',
              backgroundColor: '#ffffff',

            },
            title: {
              text: 'Researches per Programs',
              style: {
                color: '#333333', // Set the font color to dark gray (you can change it to any color you prefer)
                fontWeight: 'bold' // You can also customize other font styles here if needed
              }
            },
            xAxis: {
              categories: programNames,
              title: {
                text: 'Programs',
                style: {
                  color: '#333333', // Set the font color to dark gray (you can change it to any color you prefer)
                  fontWeight: 'bold' // You can also customize other font styles here if needed
                }
              }
            },
            yAxis: {
              title: {
                text: 'Researches Count',
                style: {
                  color: '#333333', // Set the font color to dark gray (you can change it to any color you prefer)
                  fontWeight: 'bold' // You can also customize other font styles here if needed
                }
              },
              tickInterval: 1,
              labels: {
                // Use the formatter function to display only integers on the y-axis
                formatter: function () {
                  return this.value.toFixed(0);
                }
              },
            },
            plotOptions: {
              bar: {
                pointPadding: 0.0, // Adjust the pointPadding to minimize the space between bars
                groupPadding: 0.1, // Adjust the groupPadding to minimize the space between groups
              }
            },
            series: [{
              name: 'Research',
              data: programCardinalities
            }]
          });
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

  // Update research list function
  async function updateStatusesPieChart() {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          userID: '<?php echo $_SESSION['userID']; ?>',
          type: "faculty",
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/updatestatusespiechart.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          console.log(response);

          const pieChartData = response.map((data) => {
            return {
              name: data.researchstatus,
              y: data.num_of_research,
            };
          });

          const customColors = ['#ff6347', '#ffa500', '#32cd32', '#4169e1', '#8a2be2'];
          // Create the pie chart
          Highcharts.chart('statusesPieChart', {
            chart: {
              type: 'pie'
            },
            title: {
              text: 'Research Status Distribution'
            },
            plotOptions: {
              pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: customColors,
                dataLabels: {
                  enabled: true,
                  format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
              }
            },
            series: [
              {
                name: 'Research Status',
                data: pieChartData
              }
            ]
          });
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

  // Update research list function
  async function updateClassificationsPieChart() {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          userID: '<?php echo $_SESSION['userID']; ?>',
          type: "faculty",
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/updateclassificationspiechart.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          console.log(response);

          const pieChartData = response.map((data) => {
            return {
              name: data.researchclassification,
              y: data.num_of_research,
            };
          });

          const customColors = ['#ff6347', '#ffa500', '#32cd32', '#4169e1', '#8a2be2'];
          // Create the pie chart
          Highcharts.chart('classificationsPieChart', {
            chart: {
              type: 'pie'
            },
            title: {
              text: 'Research Classification Distribution'
            },
            plotOptions: {
              pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: customColors,
                dataLabels: {
                  enabled: true,
                  format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
              }
            },
            series: [
              {
                name: 'Research Classification',
                data: pieChartData
              }
            ]
          });
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


</script>