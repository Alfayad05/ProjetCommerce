CREATE TABLE utilisateurs (
                              id INT AUTO_INCREMENT PRIMARY KEY,
                              nom VARCHAR(100) NOT NULL,
                              prenom VARCHAR(100) NOT NULL,
                              email VARCHAR(255) NOT NULL UNIQUE,
                              mot_de_passe VARCHAR(255) NOT NULL,
                              date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE produits (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          nom VARCHAR(255) NOT NULL,
                          description TEXT NOT NULL,
                          prix DECIMAL(10, 2) NOT NULL,
                          image VARCHAR(255) NOT NULL
);
INSERT INTO `produits` (nom, description, prix, image) VALUES
    ('Nike Air Force 1', 'La légendaire chaussure de basketball revisitée pour le quotidien.', 99.99, 'air_force_1.jpg'),
    ('Nike Air Max 90', 'Un design intemporel avec un confort Air Max inégalé.', 129.99, 'air_max_90.jpg'),
    ('Nike Blazer Mid 77', 'Style vintage et look emblématique des années 70.', 109.99, 'blazer_mid_77.jpg'),
    ('Nike Dunk Low', 'Un classique indémodable inspiré du basketball.', 114.99, 'dunk_low.jpg'),
    ('Nike Pegasus 40', 'Une chaussure de running légère et réactive.', 124.99, 'pegasus_40.jpg'),
    ('Nike ZoomX Vaporfly Next%', 'La chaussure ultime pour les courses longues.', 249.99, 'zoomx_vaporfly.jpg'),
    ('Nike React Infinity Run', 'Conçue pour réduire les risques de blessure.', 159.99, 'react_infinity.jpg'),
    ('Nike SB Dunk High', 'Chaussure de skateboard alliant confort et durabilité.', 119.99, 'sb_dunk_high.jpg'),
    ('Nike Air Zoom Pegasus 38', 'Un mix parfait entre réactivité et amorti.', 119.99, 'air_zoom_pegasus_38.jpg'),
    ('Nike Free Run 5.0', 'Flexibilité maximale pour un mouvement naturel.', 99.99, 'free_run_5.jpg');


);

INSERT INTO `adidas` (nom, description, prix, image) VALUES
                                                         ('Adidas Ultraboost 22', 'Chaussure de running alliant confort et performance.', 180.00, 'ultraboost_22.jpg'),
                                                         ('Adidas Stan Smith', 'Le classique intemporel au style épuré.', 99.99, 'stan_smith.jpg'),
                                                         ('Adidas Superstar', 'Une icône du streetwear avec une coque avant emblématique.', 89.99, 'superstar.jpg'),
                                                         ('Adidas NMD_R1', 'Design moderne et confort pour un usage quotidien.', 139.99, 'nmd_r1.jpg'),
                                                         ('Adidas Gazelle', 'Un style rétro avec une touche de modernité.', 99.99, 'gazelle.jpg'),
                                                         ('Adidas Adizero Adios Pro 3', 'Chaussure de compétition ultra-légère.', 220.00, 'adizero_adios_pro_3.jpg'),
                                                         ('Adidas 4D FWD', 'Technologie 4D pour un amorti optimisé.', 200.00, '4d_fwd.jpg'),
                                                         ('Adidas Terrex Swift R3 GTX', 'Chaussure de randonnée imperméable et robuste.', 149.99, 'terrex_swift_r3.jpg'),
                                                         ('Adidas Forum Mid', 'Style vintage des années 80 remis au goût du jour.', 110.00, 'forum_mid.jpg'),
                                                         ('Adidas Predator Edge.1', 'Pour un contrôle précis sur le terrain de football.', 250.00, 'predator_edge.jpg');


INSERT INTO `new_balance` (nom, description, prix, image) VALUES
                                                              ('New Balance 574', 'Le classique iconique avec une silhouette intemporelle.', 84.99, 'nb_574.jpg'),
                                                              ('New Balance 990v6', 'Confort et performance avec un style premium.', 199.99, 'nb_990v6.jpg'),
                                                              ('New Balance Fresh Foam 1080v12', 'Amorti exceptionnel pour les longues distances.', 159.99, 'nb_1080v12.jpg'),
                                                              ('New Balance 327', 'Un look rétro inspiré des années 70.', 109.99, 'nb_327.jpg'),
                                                              ('New Balance FuelCell Rebel v3', 'Chaussure de running légère et réactive.', 129.99, 'nb_fuelcell_rebel.jpg'),
                                                              ('New Balance 9060', 'Un design audacieux avec un confort moderne.', 149.99, 'nb_9060.jpg'),
                                                              ('New Balance Minimus TR', 'Parfaite pour l’entraînement en salle.', 119.99, 'nb_minimus_tr.jpg'),
                                                              ('New Balance XC-72', 'Une approche futuriste des chaussures rétro.', 139.99, 'nb_xc72.jpg'),
                                                              ('New Balance Fresh Foam X More v4', 'Un maximum de confort pour les longues courses.', 159.99, 'nb_fresh_foam_x_more.jpg'),
                                                              ('New Balance Kawhi 2', 'Chaussure de basketball conçue avec Kawhi Leonard.', 159.99, 'nb_kawhi_2.jpg');


INSERT INTO `asics` (nom, description, prix, image) VALUES
                                                        ('Asics Gel-Kayano 29', 'Stabilité et confort pour les longues courses.', 159.99, 'gel_kayano_29.jpg'),
                                                        ('Asics Gel-Nimbus 25', 'Un amorti maximal pour une course douce.', 179.99, 'gel_nimbus_25.jpg'),
                                                        ('Asics Gel-Cumulus 24', 'Parfait équilibre entre amorti et légèreté.', 129.99, 'gel_cumulus_24.jpg'),
                                                        ('Asics Metaspeed Sky+', 'Conçue pour les compétitions et la vitesse.', 249.99, 'metaspeed_sky_plus.jpg'),
                                                        ('Asics GT-2000 11', 'Stabilité accrue pour les coureurs pronateurs.', 139.99, 'gt_2000_11.jpg'),
                                                        ('Asics Gel-Venture 9', 'Idéale pour le trail et les terrains accidentés.', 89.99, 'gel_venture_9.jpg'),
                                                        ('Asics Novablast 3', 'Rebond et légèreté pour une expérience dynamique.', 139.99, 'novablast_3.jpg'),
                                                        ('Asics Fuji Lite 3', 'Chaussure de trail inspirée de la nature.', 129.99, 'fuji_lite_3.jpg'),
                                                        ('Asics Magic Speed 2', 'Conçue pour les entraînements de vitesse.', 149.99, 'magic_speed_2.jpg'),
                                                        ('Asics Hyper Speed', 'Un modèle simple et léger pour le running.', 99.99, 'hyper_speed.jpg');

CREATE TABLE favoris (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         utilisateur_id INT NOT NULL,
                         produit_id INT NOT NULL,
                         FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
                         FOREIGN KEY (produit_id) REFERENCES produits(id) ON DELETE CASCADE
);
