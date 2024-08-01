<?php
# scraping books to scrape: https://books.toscrape.com/
require __DIR__ . '/./vendor/autoload.php';
$httpClient = new \Goutte\Client();
$response = $httpClient->request('GET', 'https://www.scrapethissite.com/pages/');
$titles = $response->evaluate('//div[@class="page"]//h3[@class="page-title"]//a');
$descriptions = $response->evaluate('//div[@class="page"]//p[@class="lead session-desc"]');

// we can store the prices into an array
$descriptionsArray = [];
foreach ($descriptions as $key => $descrip) {
    $descriptionsArray[] = $descrip->textContent;
}

foreach ($titles as $index => $title) {
?>
    <h2><?php echo $title->textContent; ?></h2>
    <p><?php echo $descriptionsArray[$index]; ?></p>
<?php }
