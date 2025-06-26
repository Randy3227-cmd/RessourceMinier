CREATE DATABASE ressource_miniere;
\c ressource_miniere;
CREATE EXTENSION IF NOT EXISTS postgis;


CREATE TABLE public.region (
    id_region SERIAL PRIMARY KEY,
    geom geometry(MULTIPOLYGON, 4326),
    num_region NUMERIC(10,0),
    nom_region VARCHAR(30),
    superficie NUMERIC(15,2),
    nb_pop NUMERIC(10,0)
);

CREATE TABLE type_ressource (
    id_type SERIAL PRIMARY KEY,
    nom_type VARCHAR(100) NOT NULL -- ex : or, cobalt, ...
);


CREATE TABLE statut_ressource (
    id_statut SERIAL PRIMARY KEY,
    nom_statut VARCHAR(100) NOT NULL -- ex: En prospection, En exploitation, Épuisée
 );


CREATE TABLE ressource_miniere (
    id_ressource SERIAL PRIMARY KEY,
    nom_site VARCHAR(150) NOT NULL,
    description TEXT,
    id_type_ressource INT REFERENCES type_ressource(id_type),
    id_statut_ressource INT REFERENCES statut_ressource(id_statut),
    image VARCHAR(255), -- URL de l'image
    geom GEOMETRY(Point, 4326) NOT NULL,
    lien VARCHAR(255)
);

CREATE TABLE historique_modification(
    id_historique_modification SERIAL PRIMARY KEY,
    id_ressource INT REFERENCES ressource_miniere(id_ressource),
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    description_modification TEXT NOT NULL
);
