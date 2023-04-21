<?php

$apiKey = '64f45dc28ea8598654acca2390e9f3c3';
$query = 'heart disease';
$url = 'https://api.elsevier.com/content/search/scopus?apiKey=' . $apiKey . '&query=' . urlencode($query);

$response = file_get_contents($url);

$data = json_decode($response, true);

$articles = $data['search-results']['entry'];


foreach ($articles as $article) {
    $title = $article['dc:title'];
    $authors = $article['dc:creator'];
    $publication = $article['prism:publicationName'];
    $date = $article['prism:coverDate'];
    $doi = $article['prism:doi'];

    echo '<div>';
    echo '<h3>' . $title . '</h3>';
    echo '<p>' . $authors . '</p>';
    foreach ($article['link'] as $link) {
      if ($link['@attributes']['type'] === 'text/html') {
        $paperLink = $link['@attributes']['href'];
        break;
      }
    echo 'nani';
}
    echo '</div>';
}

?>