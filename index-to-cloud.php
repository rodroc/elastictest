<?php

require_once __DIR__ .'/vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$hosts = array (
	/*
    '192.168.1.1:9200',                 // IP + Port
    '192.168.1.2',                      // Just IP
    'mydomain.server.com:9201',         // Domain + Port
    'mydomain2.server.com',             // Just Domain
    'https://localhost',                // SSL to localhost
    'https://192.168.1.3:9200',         // SSL to IP + Port
    'http://user:pass@localhost:9200',  // HTTP Basic Auth
    'https://user:pass@localhost:9200',  // SSL + HTTP Basic Auth
    */
    'https://elastic:8hVb8Bv4uTdx7jmr19enlcjQ@45c3c04e8aabb804bf0a1d973cbf9db1.ap-southeast-1.aws.found.io:9243'
);

$caBundle=Composer\CaBundle\CaBundle::getBundledCaBundlePath();

$client = ClientBuilder::create()// Instantiate a new ClientBuilder
                    ->setHosts($hosts) // Set the hosts
                    ->setSSLVerification($caBundle)
                    ->setConnectionPool('\Elasticsearch\ConnectionPool\SimpleConnectionPool', [])
                    ->build();// Build the client object

try
{

    $params = [
        'index' => 'my_index',
        'type' => 'my_type',
        'id' => 'my_id'
    ];

    $response = $client->get($params);
    print_r($response);

}catch(\Exception $x){
	//print_r($x);
	throw $x;
}



?>