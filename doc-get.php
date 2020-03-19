<?php

include_once __DIR__ .'/client.php';

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id'
];

$response = $client->get($params);
print_r($response);

/*
Array ( [_index] => my_index [_type] => my_type [_id] => my_id [_version] => 1 [found] => 1 [_source] => Array ( [testField] => abc ) )
*/
?>
