<?php

include_once __DIR__ .'/client.php';

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id',
    'body' => ['testField' => 'abc']
];

$response = $client->index($params);
print_r($response);

/*
Array ( [_index] => my_index [_type] => my_type [_id] => my_id [_version] => 1 [result] => created [_shards] => Array ( [total] => 2 [successful] => 1 [failed] => 0 ) [created] => 1 )
*/
?>