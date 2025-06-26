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
