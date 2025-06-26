<?php

namespace app\controllers;

use app\models\RessourceMiniereModel;
use app\models\AccueilModel;

use Exception;
use Flight;

class StatistiqueController
{

    public function __construct() {}
    public function afficherStatistiques()
    {
        $db = Flight::db();
        $model = new RessourceMiniereModel($db);

        $statRegionType = $model->getStatpar_ressource_par_region();
        $statParType = $model->get_repartition_type_resource();
        $statParStatut = $model->get_repartition_par_statut();
        $model = new AccueilModel($db);

        $regions = $model->getRegions();
        $types = $model->getTypes();
        $statuts = $model->getStatuts();

       Flight::render('statistiques.php', [
            'regions' => $regions,
            'types' => $types,
            'statuts' => $statuts,
            'regionType' => $statRegionType,
            'typeRessource' => $statParType,
            'statutRessource' => $statParStatut
        ]);
    }
    
}
