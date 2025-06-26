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
('Kaolin'),
('Vanadium');

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


-- Sites minières du Sud de Madagascar
INSERT INTO ressource_miniere (
    nom_site, description, id_type_ressource, id_statut_ressource, geom, image, lien
) VALUES
('Mine de Mandena', "Mine à ciel ouvert de titane à partir d'un gisement d'ilménite", 4, 3,
    ST_SetSRID(ST_MakePoint(46.92944, -25.03917), 4326), 'https://omnis.mg/mines/le-projet-ilmenite-de-fort-dauphin/', 'https://fr.wikipedia.org/wiki/Mine_de_Tolagnaro#:~:text=La%20mine%20de%20Tolagnaro%20(ou,(Fort%20Dauphin)%20%C3%A0%20Madagascar.'),
('Mine de Sakoa', 'Exploitation de charbon dans la région de Toliara', 16, 3,
    ST_SetSRID(ST_MakePoint(46.92944, -25.03917), 4326),'','https://omnis.mg/mines/le-projet-charbon-de-la-sakoa/'),
("Mine de Saphir d'Ilakalaka", 'La plus grande mine de Saphir à ciel ouvert du monde', 6, 3,
    ST_SetSRID(ST_MakePoint(44.495306650970214,-22.696848290953497),4326),NULL,'https://www.gia.edu/gia-news-research-Sapphire-Mining-Ilakaka-Madagascar'),
('Mine de Graphite de Maniry', 'Exploitation de graphite dans la région d''Atsimo-Andrefana', 6, 3,
    ST_SetSRID(ST_MakePoint(44.5500, -22.9667), 4326), NULL, 'https://www.mining-technology.com/projects/maniry-graphite-project/'),
('Mine de Nickel Ambatovy', 'Exploitation de nickel et cobalt à Ambatovy', 2, 3,
    ST_SetSRID(ST_MakePoint(47.5079, -18.8792), 4326), NULL, 'https://fr.wikipedia.org/wiki/Ambatovy'),
('Mine de Fer d''Ikalamavony', 'Exploitation de fer dans la région d''Ihorombe', 12, 3,
    ST_SetSRID(ST_MakePoint(46.5667, -21.6667), 4326), NULL, 'https://fr.wikipedia.org/wiki/Ikalamavony#:~:text=dans%20la%20r%C3%A9gion.-,%C3%89conomie,de%20r%C3%A9gulation%20et%20de%20durabilit%C3%A9..'),
('Mine de Bauxite de Manantenina', 'Projet de bauxite en cours d''étude dans la région d''Anosy', 10, 8,
    ST_SetSRID(ST_MakePoint(47.2000, -20.3667), 4326), NULL, 'https://www.matin.mg/?p=2618'),
('Mine de Zircon de Toliara Sands', 'Exploitation de zircon et autres minerais lourds à Toliara', 8, 3,
    ST_SetSRID(ST_MakePoint(43.6333, -23.3500), 4326), NULL, 'https://www.mining-technology.com/projects/toliara-mineral-sands-project-madagascar/'),
('Molo mine', 'Une des plus grandes mine de graphite à Madagascar', 5, 3,
    ST_SetSRID(ST_MakePoint(45.1304, -24.0019), 4326), NULL, 'https://en.wikipedia.org/wiki/Molo_mine'),
('Green Giant mine', 'Une des plus grande mine de Vanadium de Madagascar', 21, 3,
    ST_SetSRID(ST_MakePoint(45.05, -24.01), 4326), NULL, 'https://en.wikipedia.org/wiki/Green_Giant_mine'),
