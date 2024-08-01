<?php
# scraping data to scrape: https://www.scrapethissite.com/pages/
require __DIR__ . '/./vendor/autoload.php';
$httpClient = new \GuzzleHttp\Client();
$response = $httpClient->get('https://www.scrapethissite.com/pages/');
$htmlString = (string) $response->getBody();
//add this line to suppress any warnings
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);
$xpath = new DOMXPath($doc);

$titles = $xpath->evaluate('//div[@class="page"]//h3[@class="page-title"]//a');
$descriptions = $xpath->evaluate('//div[@class="page"]//p[@class="lead session-desc"]');
foreach ($titles as $index => $title) {
?>
    <h2><?php echo $title->textContent; ?></h2>
    <p><?php echo $descriptions[$index]->textContent; ?></p>
<?php }
