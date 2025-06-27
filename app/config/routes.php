<?php

use flight\Engine;
use flight\net\Router;

use app\controllers\RessourceMiniereController;
use app\controllers\AccueilController;
use app\controllers\StatistiqueController;

$ressourceMiniereController = new RessourceMiniereController();
$accueilController = new AccueilController();	
$statistiqueController = new StatistiqueController();

$router->get('/', [$accueilController, 'accueil']);
$router->get('/api/ressources', [$ressourceMiniereController, 'getRessources']);
$router->get('/statistiques', [$statistiqueController, 'afficherStatistiques']);
$router->get('/ressources', [$ressourceMiniereController, 'index']);
$router->get('/ressources/create', [$ressourceMiniereController, 'createForm']);
$router->post('/ressources/create', [$ressourceMiniereController, 'create']);
$router->get('/ressources/edit/@id:\d+', [$ressourceMiniereController, 'editForm']);
$router->post('/ressources/edit/@id:\d+', [$ressourceMiniereController, 'update']);
$router->get('/ressources/delete/@id:\d+', [$ressourceMiniereController, 'delete']);
$router->get('/ressources/historique/@id:\d+', [$ressourceMiniereController, 'historique']);
