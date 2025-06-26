<?php
namespace app\controllers;

use app\models\AccueilModel;
use Flight;

class AccueilController {
    public function accueil() {
        $db = Flight::db();
        $model = new AccueilModel($db);

        $regions = $model->getRegions();
        $types = $model->getTypes();
        $statuts = $model->getStatuts();

        Flight::render('accueil.php', [
            'regions' => $regions,
            'types' => $types,
            'statuts' => $statuts
        ]);
    }
}
