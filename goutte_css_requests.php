<?php
# scraping books to scrape: https://books.toscrape.com/
require 'vendor/autoload.php';
$httpClient = new \Goutte\Client();
$response = $httpClient->request('GET', 'https://www.scrapethissite.com/pages/');
// get prices into an array
$descrips = [];
$response->filter('.page .lead.session-desc')->each(function ($node) use (&$descrips) {
    $descrips[] = $node->text();
});
// echo titles and prices
$descripIndex = 0;
$response->filter('.page .page-title a')->each(function ($node) use ($descrips, &$descripIndex) {
    echo $node->text() . ' @ ' . $descrips[$descripIndex] . '<br>';
    $descripIndex++;
});
