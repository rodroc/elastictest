<?php

include_once __DIR__ .'/client.php';

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'body' => [
        'query' => [
            'match' => [
                'testField' => 'abc'
            ]
        ]
    ]
];

$response = $client->search($params);
print_r($response);

/*
Array ( [took] => 878 [timed_out] => [_shards] => Array ( [total] => 5 [successful] => 5 [failed] => 0 ) [hits] => Array ( [total] => 1 [max_score] => 0.2876821 [hits] => Array ( [0] => Array ( [_index] => my_index [_type] => my_type [_id] => my_id [_score] => 0.2876821 [_source] => Array ( [testField] => abc ) ) ) ) )
*/

?>