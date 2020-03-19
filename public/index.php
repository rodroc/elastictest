<?php 

require_once __DIR__ .'/../vendor/autoload.php';
require_once __DIR__ .'/../src/Setting.php';

use Silex\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Noodlehaus\Config;

$app = new Silex\Application();
$app['debug']=(bool) Setting::getConfig('debug');

//services
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/views',
));

//routes
$app->get('/hello/{name}', function ($name) use ($app) {
    return $app['twig']->render('hello.twig', array(
        'name' => $name
    ));
});

$app->get('/', function () use ($app) {
    $viewData['base_url']=Setting::baseUrl();
    return $app['twig']->render('search.twig', $viewData);
});

$app->run();
?>