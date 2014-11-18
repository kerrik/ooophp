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


$dbcreate[] = array('type'=>'TABLE', 'name'=>'User' , 'sql'=> <<<EOF
    CREATE TABLE IF NOT EXISTS User 
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  acronym CHAR(12) UNIQUE NOT NULL,
  name VARCHAR(80),
  password CHAR(32),
  salt INT NOT NULL
) ENGINE INNODB CHARACTER SET utf8;
EOF
, 'data'=> <<<EOF
INSERT INTO User (acronym, name, salt) VALUES 
    ('doe', 'John/Jane Doe', unix_timestamp()),
    ('admin', 'Administrator', unix_timestamp())
;
UPDATE User SET password = md5(concat('doe', salt)) WHERE acronym = 'doe';
UPDATE User SET password = md5(concat('admin', salt)) WHERE acronym = 'admin';
     
EOF
    ); //end $dbcreate




