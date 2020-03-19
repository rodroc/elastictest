<?php

include_once __DIR__ .'/client.php';

$params = [
    'index' => 'movies',
    'type' => 'film',
    'id' => '_query',
    'body' => [
        'query' => [
            'match_all' => [
            ]
        ]
    ]
];

$response = $client->delete($params);
print_r($response);

?>