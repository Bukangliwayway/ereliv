
<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';


if (checkElasticsearchConnection()) {

  $userID = isset($_POST['userID']) ? $_POST['userID'] : '';
  $search = isset($_POST['search']) ? $_POST['search'] : '';
  $programs = $_POST['activePrograms'];
  $authors = $_POST['activeAuthors'];
  $interests = $_POST['activeInterests'];
  $categoryID = isset($_POST['categoryID']) ? $_POST['categoryID'] : '';
  $type = isset($_POST['type']) ? $_POST['type'] : '';

  // if(!empty($programs)) send_message_and_redirect(print_r($programs),'');

  $client = Elastic\Elasticsearch\ClientBuilder::create()
    ->setHosts(['https://localhost:9200'])
    ->setBasicAuthentication('elastic', 'I_1ghHrS7B6qTK6mwg_F')
    ->setSSLVerification(false)
    ->build();

  $searchParams = [
    'index' => 'research',
    'body' => [
      'query' => [
        'bool' => [
          'should' => []
        ]
      ]
    ]
  ];


  if (!empty($programs)) {
    $searchParams['body']['query']['bool']['should'][] = [
      'nested' => [
        'path' => 'program',
        'query' => [
          'terms' => ['program.programID' => $programs]
        ]
      ]
    ];
  }

  if (!empty($authors)) {
    $searchParams['body']['query']['bool']['should'][] = [
      'nested' => [
        'path' => 'author',
        'query' => [
          'terms' => ['author.authorID' => $authors]
        ]
      ]
    ];
  }

  if (!empty($interests)) {
    $searchParams['body']['query']['bool']['should'][] = [
      'nested' => [
        'path' => 'interest',
        'query' => [
          'terms' => ['interest.interestID' => $interests]
        ]
      ]
    ];
  }

  if (!empty($search)) {

    $searchParams['body']['query']['bool']['should'][] = [
      'multi_match' => [
        'query' => $search,
        'fields' => [
          'title',
          'keywords',
          'status',
          'proposer',
          'facultyProposerName',
          'advisorName',
          'researchstatus',
          'researchclassification',
          'abstract',
          'introduction',
          'methodology',
          'discussion',
          'results',
          'conclusion'
        ],
        'fuzziness' => '2'
      ]
    ];
  } 
  // else {
  //   $searchParams['body']['query'] = ['match_all' => new stdClass()];
  // }

  try {
    $result = $client->search($searchParams);
  } catch (Exception $e) {
    // Handle the exception
    $response['status'] = 'error';
    $response['message'] = 'nana: ' . $e->getMessage();

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
  }

  $researches = [];
  foreach ($result['hits']['hits'] as $hit) {
    $research = []; // Create a new research array each time
    $research['title'] = $hit['_source']['title'];
    $research['researchID'] = $hit['_source']['researchID'];
    $research['datepublished'] = $hit['_source']['datepublished'];
    $research['keywords'] = $hit['_source']['keywords'];
    $research['status'] = $hit['_source']['status'];
    $research['proposer'] = $hit['_source']['proposer'];
    $research['facultyProposerName'] = $hit['_source']['facultyProposerName'];
    $research['facultyProposerID'] = $hit['_source']['facultyProposerID'];
    $research['advisorName'] = $hit['_source']['advisorName'];
    $research['advisorID'] = $hit['_source']['advisorID'];
    $research['researchstatus'] = $hit['_source']['researchstatus'];
    $research['researchclassification'] = $hit['_source']['researchclassification'];
    $research['abstract'] = $hit['_source']['abstract'];
    $research['introduction'] = $hit['_source']['introduction'];
    $research['methodology'] = $hit['_source']['methodology'];
    $research['discussion'] = $hit['_source']['discussion'];
    $research['results'] = $hit['_source']['results'];
    $research['conclusion'] = $hit['_source']['conclusion'];
    $research['program'] = $hit['_source']['program'];
    $research['author'] = $hit['_source']['author'];
    $research['interest'] = $hit['_source']['interest'];
    $researches[] = $research; // Add each research into the researches array
  }

  $output = ''; // Initialize an empty string
  $output .= '<div class="row">';
  foreach ($researches as $research) {
    // Loop through each research item
    $authors = $research['author'];
    $programs = $research['program'];
    $interests = $research['interest'];


    // // Generate HTML for the research item
    $output .= '<div href="#displaypapermodal" class="research-point search-research-link border border-smoke rounded my-1" data-bs-toggle="modal">';
    $output .= '<div class="p-3 d-flex flex-column gap-2" style="position:relative;">';

    // // Research Title
    $output .= '<span class="search-title text-capitalize">' . $research['title'] . '</span>';

    // Research Programs and Date
    $output .= '<div class="d-flex flex-row align-items-center">';
    $output .= '<div class="italize search-programs d-flex gap-1">';
    foreach ($programs as $program) {
      $output .= '<a class="btn btn-sm btn-outline-primary program-button text-decoration-none text-uppercase" data-programID="' . $program['programID'] . '">' . $program['name'] . '</a>';
    }
    $output .= '</div>';
    $output .= '<span class="ml-1 search-publish-date">' . $research['datepublished'] . '</span>';
    $output .= '</div>';

    // AUTHORS
    $authorNames = array_map(function ($author) {
      $name = strtolower($author['lastname'] . ' ' . $author['firstname']);
      $name = ucwords($name);
      return [
        'name' => $name,
        'authorID' => $author['authorID']
      ];
    }, $authors);

    $output .= '<div class="search-authors">';
    $authorCount = count($authorNames);
    foreach ($authorNames as $index => $author) {
      $output .= '<a href="#" class="text-decoration-none text-dark" data-authorID="' . $author['authorID'] . '" class="search-author"> <i class="bi bi-person-fill"></i> ' . $author['name'] . '</a>';
      if ($index < $authorCount - 1) {
        $output .= ', ';
      }
    }


    $output .= '</div>';

    // Interest Badges
    $output .= '<div class="search-interest fixed-lower-end mb-3 mr-3 d-flex gap-1">';
    foreach ($interests as $interest) {
      $output .= '<a href="#" class="badge bg-primary text-decoration-none text-white" data-interestID="' . $interest['interestID'] . '">' . $interest['name'] . '</a>';
    }

    $output .= '</div>';

    $output .= '</div>'; // Close p-3 div


    $output .= '<input type="hidden" class="search-abstract" data-full-text="' . htmlspecialchars($research['abstract'], ENT_QUOTES) . '">';
    $output .= '<input type="hidden" class="search-introduction" data-full-text="' . htmlspecialchars($research['introduction'], ENT_QUOTES) . '">';
    $output .= '<input type="hidden" class="search-methodology" data-full-text="' . htmlspecialchars($research['methodology'], ENT_QUOTES) . '">';
    $output .= '<input type="hidden" class="search-results" data-full-text="' . htmlspecialchars($research['results'], ENT_QUOTES) . '">';
    $output .= '<input type="hidden" class="search-discussion" data-full-text="' . htmlspecialchars($research['discussion'], ENT_QUOTES) . '">';
    $output .= '<input type="hidden" class="search-conclusion" data-full-text="' . htmlspecialchars($research['conclusion'], ENT_QUOTES) . '">';
    $output .= '<input type="hidden" class="search-keywords" data-full-text="' . $research['keywords'] . '">';
    $output .= '<input type="hidden" class="search-uploader" data-full-text="' . $research['proposer'] . '">';
    $output .= '<input type="hidden" class="search-id" data-full-text="' . $research['researchID'] . '">';
    $output .= '<input type="hidden" class="search-status" data-full-text="' . $research['researchstatus'] . '">';
    $output .= '<input type="hidden" class="search-classification" data-full-text="' . $research['researchclassification'] . '">';

    $authorIDs = array_map(function ($author) {
      return $author["authorID"];
    }, $authors);
    $output .= '<input type="hidden" class="search-raw-authors" value="' . htmlentities(json_encode($authorIDs)) . '">';

    $programIDs = array_map(function ($program) {
      return $program["programID"];
    }, $programs);
    $output .= '<input type="hidden" class="search-raw-programs" value="' . htmlentities(json_encode($programIDs)) . '">';

    $interestIDs = array_map(function ($interest) {
      return $interest["interestID"];
    }, $interests);
    $output .= '<input type="hidden" class="search-raw-interests" value="' . htmlentities(json_encode($interestIDs)) . '">';

    $output .= '</div>'; // Close research-item-container div
  }
  $output .= '</div>'; // Close row

  // Send the HTML response
  echo $output;

}

?>