<?php

namespace app\models;

use Exception;

class RessourceMiniereModel {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getFilteredRessources($region, $type, $statut, $search) {
        $sql = "SELECT rm.nom_site, rm.description, r.nom_region, tr.nom_type AS nom_type,
                       sr.nom_statut AS nom_statut,
                       ST_Y(rm.geom) AS latitude, ST_X(rm.geom) AS longitude
                FROM ressource_miniere rm
                JOIN region r ON rm.id_region = r.id_region
                JOIN type_ressource tr ON rm.id_type_ressource = tr.id_type
                JOIN statut_ressource sr ON rm.id_statut_ressource = sr.id_statut
                WHERE 1=1";
    
        $params = [];
    
        if ($region) {
            $sql .= " AND rm.id_region = ?";
            $params[] = $region;
        }
        if ($type) {
            $sql .= " AND rm.id_type_ressource = ?";
            $params[] = $type;
        }
        if ($statut) {
            $sql .= " AND rm.id_statut_ressource = ?";
            $params[] = $statut;
        }
        if ($search) {
            $sql .= " AND LOWER(rm.nom_site) LIKE LOWER(?)";
            $params[] = "%" . $search . "%";
        }
    
        return $this->db->fetchAll($sql, $params);
    }
    
    public function getStatpar_ressource_par_region(){
        $sql ="SELECT 
                    r.nom_region,
                    t.nom_type,
                    COUNT(*) AS nombre_sites
                FROM 
                    ressource_miniere rm
                JOIN 
                    region r ON rm.id_region = r.id_region
                JOIN 
                    type_ressource t ON rm.id_type_ressource = t.id_type
                GROUP BY 
                    r.nom_region, t.nom_type
                ORDER BY 
                    r.nom_region, t.nom_type
                ";
        $stat = $this->db->fetchAll($sql);
        return $stat;
    }
   public function get_repartition_type_resource(){
    $sql =" SELECT 
                t.nom_type AS type_ressource,
                COUNT(*) AS nombre_sites
            FROM 
                ressource_miniere rm
            JOIN 
                type_ressource t ON rm.id_type_ressource = t.id_type
            GROUP BY 
                t.nom_type
            ORDER BY 
                nombre_sites DESC
            ";
    $stat = $this->db->fetchAll($sql);
    return $stat;
   }

   public function get_repartition_par_statut(){
    $sql =" SELECT 
                s.nom_statut AS statut,
                COUNT(*) AS nombre_sites
            FROM 
                ressource_miniere rm
            JOIN 
                statut_ressource s ON rm.id_statut_ressource = s.id_statut
            GROUP BY 
                s.nom_statut
            ORDER BY 
                nombre_sites DESC
            ";
    $stat = $this->db->fetchAll($sql);
    return $stat;
   }
    
    
}