INSERT INTO region (nom_region) VALUES
('Analamanga'),
('Vakinankaratra'),
('Itasy'),
('Bongolava'),
('Diana'),
('Sava'),
('Boeny'),
('Sofia'),
('Alaotra-Mangoro'),
('Analanjirofo'),
('Atsinanana'),
('Menabe'),
('Melaky'),
('Amoron`i Mania'),
('Haute Matsiatra'),
('Ihorombe'),
('Atsimo-Andrefana'),
('Atsimo-Atsinanana'),
('Androy'),
('Anosy'),
('Betsiboka'),
('Vatovavy');

Nord,
 Sud,
  Est,  (Faniry)
  Ouest, 
  [NO,NE]
  , [SO,SE]

INSERT INTO type_ressource (nom_type) VALUES
('Or'),
('Nickel'),
('Cobalt'),
('Ilménite'),
('Graphite'),
('Saphir'),
('Rubis'),
('Zircon'),
('Uranium'),
('Bauxite'),
('Chrome'),
('Fer'),
('Pierre précieuse'),
('Pierre ornementale'),
('Quartz'),
('Charbon'),
('Sel'),
('Gypse'),
('Calcite'),
('Kaolin');

INSERT INTO statut_ressource (nom_statut) VALUES
('En prospection'),
('En exploration'),
('En exploitation'),
('Suspendue'),
('Abandonnee'),
('Epuisee'),
('En attente de permis'),
('Projet en etude');

INSERT INTO ressource_miniere (
    nom_site, description, id_type_ressource, id_statut_ressource, geom
) VALUES
('Ambatovy', 'Mine de nickel et cobalt, grande exploitation industrielle.', 2, 3,
    ST_SetSRID(ST_MakePoint(47.5079, -18.8792), 4326)),
('QMM - Fort Dauphin', 'Exploitation d`ilménite à Fort Dauphin.', 4, 3,
    ST_SetSRID(ST_MakePoint(46.9960, -25.0400), 4326)),
('Ilakaka', 'Zone riche en saphirs et rubis, exploitation artisanale.', 7, 3,
    ST_SetSRID(ST_MakePoint(45.8667, -22.1333), 4326)),
('Maniry', 'Mine de graphite active dans la région Atsimo-Andrefana.', 6, 3,
    ST_SetSRID(ST_MakePoint(44.5500, -22.9667), 4326)),
('Manantenina', 'Projet de bauxite en cours d`etude.', 10, 8,
    ST_SetSRID(ST_MakePoint(47.2000, -20.3667), 4326)),
('Toliara Sands', 'Exploitation de minerais lourds (ilménite, zircon).', 4, 3,
    ST_SetSRID(ST_MakePoint(43.6333, -23.3500), 4326)),
('Analabe', 'Zone en prospection pour l''extraction d`or.', 1, 1,
    ST_SetSRID(ST_MakePoint(47.5167, -18.9167), 4326)),
('Betafo', 'Prospection minière pour nickel et cobalt.', 2, 1,
    ST_SetSRID(ST_MakePoint(46.8333, -19.0333), 4326)),
('Ikalamavony', 'Mine de fer en exploitation.', 12, 3,
    ST_SetSRID(ST_MakePoint(46.5667, -21.6667), 4326)),
('Tsinjoarivo', 'Exploitation de kaolin pour l`industrie céramique.', 20, 3,
    ST_SetSRID(ST_MakePoint(47.3667, -19.7000), 4326));



