<?php
$db_prefix = "";
$db_new_db = false;
$dbcreate = array();

/* Mall för skapandet av tabeller
$dbcreate[] = array('type'=>'TABLE', 'name'=>'' , 'sql'=> <<<EOF
EOF
    , 'data'=> <<<EOF
EOF
    ); //end $dbcreate
 */

$dbcreate[] = array('type'=>'TABLE', 'name'=>'Movie' , 'sql'=> <<<EOF
  CREATE TABLE IF NOT EXISTS Movie
  (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    title VARCHAR(100) NOT NULL,
    director VARCHAR(100),
    LENGTH INT DEFAULT NULL, -- Length in minutes
    YEAR INT NOT NULL DEFAULT 1900,
    plot TEXT, -- Short intro to the movie
    image VARCHAR(100) DEFAULT NULL, -- Link to an image
    subtext CHAR(3) DEFAULT NULL, -- swe, fin, en, etc
    speech CHAR(3) DEFAULT NULL, -- swe, fin, en, etc
    quality CHAR(3) DEFAULT NULL,
    format CHAR(3) DEFAULT NULL -- mp4, divx, etc
) ENGINE INNODB CHARACTER SET utf8; 
EOF
    , 'data'=> <<<EOF
    INSERT INTO Movie (title, YEAR, image) VALUES
    ('Pulp fiction', 1994, 'img/movie/pulp-fiction.jpg'),
    ('American Pie', 1999, 'img/movie/american-pie.jpg'),
    ('Pokémon The Movie 2000', 1999, 'img/movie/pokemon.jpg'),  
    ('Kopps', 2003, 'img/movie/kopps.jpg'),
    ('From Dusk Till Dawn', 1996, 'img/movie/from-dusk-till-dawn.jpg')
;
EOF
    ); //end $dbcreate
$dbcreate[] = array('type'=>'TABLE', 'name'=>'Gengre' , 'sql'=> <<<EOF
    CREATE TABLE IF NOT EXISTS Genre
(
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  name CHAR(20) NOT NULL -- crime, svenskt, college, drama, etc
) ENGINE INNODB CHARACTER SET utf8;
EOF
    , 'data'=> <<<EOF
    INSERT INTO Genre (name) VALUES 
  ('comedy'), ('romance'), ('college'), 
  ('crime'), ('drama'), ('thriller'), 
  ('animation'), ('adventure'), ('family'), 
  ('svenskt'), ('action'), ('horror')
;
EOF
    ); //end $dbcreate
$dbcreate[] = array('type'=>'TABLE', 'name'=>'Movie2Gengre' , 'sql'=> <<<EOF
  CREATE TABLE IF NOT EXISTS Movie2Genre
(
  idMovie INT NOT NULL,
  idGenre INT NOT NULL,
 
  FOREIGN KEY (idMovie) REFERENCES Movie (id),
  FOREIGN KEY (idGenre) REFERENCES Genre (id),
 
  PRIMARY KEY (idMovie, idGenre)
) ENGINE INNODB;  
EOF
    , 'data'=> <<<EOF
INSERT INTO Movie2Genre (idMovie, idGenre) VALUES
  (1, 1),
  (1, 5),
  (1, 6),
  (2, 1),
  (2, 2),
  (2, 3),
  (3, 7), 
  (3, 8), 
  (3, 9), 
  (4, 11),
  (4, 1),
  (4, 10),
  (4, 9),
  (5, 11),
  (5, 4),
  (5, 12)
;
   
EOF
    ); //end $dbcreate

$dbcreate[] = array('type'=>'VIEW', 'name'=>'VMovie' , 'sql'=> <<<EOF
    CREATE VIEW VMovie
AS
SELECT 
  M.*,
  GROUP_CONCAT(G.name) AS genre
FROM Movie AS M
  LEFT OUTER JOIN Movie2Genre AS M2G
    ON M.id = M2G.idMovie
  LEFT OUTER JOIN Genre AS G
    ON M2G.idGenre = G.id
GROUP BY M.id
;
EOF
    , 'data'=> null
 ); //end $dbcreate


