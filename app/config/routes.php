<?php

use flight\Engine;
use flight\net\Router;

use app\controllers\RessourceMiniereController;
use app\controllers\AccueilController;

$ressourceMiniereController = new RessourceMiniereController();
$accueilController = new AccueilController();	

$router->get('/', [$accueilController, 'accueil']);
$router->get('/api/ressources', [$ressourceMiniereController, 'getRessources']);
