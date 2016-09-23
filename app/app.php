<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Barber.php";
    require_once __DIR__."/../src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=barbershop';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use($app){
        return $app['twig']->render('index.html.twig', array('barbers' => Barber::getAll()));
    });
    $app->post("/", function() use($app){
        $barber = new Barber($_POST['barber_name']);
        $barber->save();
        return $app['twig']->render('index.html.twig', array('barbers' => Barber::getAll()));
    });

    $app->get("/add_barber", function() use ($app){
        return $app['twig']->render('add_barber.html.twig', array('barbers' => Barber::getAll()));
    });

    $app->get("/{id}/edit", function($id) use ($app)
    {
        $barber = Barber::find($id);
        return $app['twig']->render('barber_edit.html.twig', array('barber' => $barber));
    });

    $app->get("/remove_barbers", function() use ($app) {
        Barber::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/{id}/delete", function($id) use ($app) {
        $barber = Barber::find($id);
        $barber->delete();
        return $app['twig']->render('index.html.twig', array('barbers' => Barber::getAll()));
    });

    $app->patch("/{id}", function($id) use ($app) {
        $new_barber_name = $_POST['new_barber_name'];
        $barber = Barber::find($id);
        $barber->update($new_barber_name);
        return $app['twig']->render('index.html.twig', array('barber' => $barber, 'barbers' => Barber::getAll()));
    });

    $app->get("/{id}/clients", function($id) use ($app) {
        $barber = Barber::find($id);
        return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll(), 'barber' => $barber, 'barbers' => Barber::getAll()));
    });

    //CLIENT PAGES

    $app->get("{id}/clients/add_client", function($id) use ($app){
        $barber = Barber::find($id);
        return $app['twig']->render('add_client.html.twig', array('clients' => Client::getAll(), 'barber' => $barber, 'barbers' => Barber::getAll()));
    });

    $app->post("{id}/clients", function($id) use($app){
        $barber = Barber::find($id);
        $client = new Client($_POST['client_name'], $barber->getId());
        $client->save();
        return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll(), 'barber' => $barber, 'barbers' => Barber::getAll()));
    });

    $app->get("{id}/clients/remove_clients", function($id) use ($app) {
        $barber = Barber::find($id);
        Client::deleteAll();
        return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll(), 'barber' => $barber, 'barbers' => Barber::getAll()));
    });

    $app->get("/{id}/clients/{id2}/delete", function($id,$id2) use ($app) {
        $barber = Barber::find($id);
        $client = Client::find($id2);
        $client->delete();
        return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll(), 'barber' => $barber, 'barbers' => Barber::getAll()));
    });

    $app->get("/{id}/clients/{id2}/edit", function($id,$id2) use ($app) {
        $barber = Barber::find($id);
        $client = Client::find($id2);
        return $app['twig']->render('client_edit.html.twig', array('clients' => Client::getAll(), 'client' => $client, 'barber' => $barber, 'barbers' => Barber::getAll()));
    });

    $app->patch("/{id}/clients/{id2}", function($id,$id2) use ($app) {
        $new_client_name = $_POST['new_client_name'];
        $barber = Barber::find($id);
        $client = Client::find($id2);
        $client->update($new_client_name, $barber->getId());
        return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll(), 'barber' => $barber, 'barbers' => Barber::getAll()));
    });

    return $app;
?>
