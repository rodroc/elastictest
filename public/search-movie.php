<?php

include_once __DIR__ .'/../client.php';//localhost
//include_once __DIR__ .'/../cloud-client.php';

$keywords=$_GET['keywords'];

$params = [
    'index' => 'movies',
    'type' => 'film',
    'body' => [
        'query' => [
            'match' => [
                'keywords' => $keywords
            ]
        ]
    ]
];

$response = $client->search($params);
echo '<pre>';print_r($response);echo '</pre>';

?>