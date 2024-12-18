CREATE TABLE produits (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          nom VARCHAR(255) NOT NULL,
                          description TEXT NOT NULL,
                          prix DECIMAL(10, 2) NOT NULL,
                          image VARCHAR(255) NOT NULL
);

INSERT INTO produits (nom, description, prix, image) VALUES
                                                         ('Chaussure A', 'Description A', 79.99, 'chaussure_a.jpg'),
                                                         ('Chaussure B', 'Description B', 89.99, 'chaussure_b.jpg');
