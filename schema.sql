/* Creating the database*/

DROP DATABASE IF EXISTS dolphin_crm;
CREATE DATABASE dolphin_crm;
USE dolpihn_crm;

/*Creating first table called Users*/

DROP TABLE IF EXISTS 'Users';
CREATE TABLE 'Users' (
    'id' int(10) NOT NULL auto_increment PRIMARY KEY,
    'firstname' varchar NOT NULL DEFAULT '',
    'lastname' varchar NOT NULL DEFAULT '',
    'password' varchar NOT NULL DEFAULT '',
    'email' varchar NOT NULL DEFAULT '',
    'role' varchar NOT NULL DEFAULT '',
    'created at' DATETIME NOT NULL,

)ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

/*Inserting the user with email admin@project2 with password password123, all the other info is made up*/
INSERT INTO 'Users' VALUES(1, 'Matt', 'Green',SHA2_256('password123'),'employee',NOW());
SELECT * FROM Users;
/*Creating second table called Contacts*/
DROP TABLE IF EXISTS 'Contacts';
CREATE TABLE 'Contacts'(
    'id' int(10) NOT NULL auto_increment PRIMARY KEY,
    'title' varchar NOT NULL DEFAULT '',
    'firstname' varchar NOT NULL DEFAULT '',
    'lastname' varchar NOT NULL DEFAULT '',
    'email' varchar NOT NULL DEFAULT '',
    'telephone' varchar NOT NULL DEFAULT '',
    'company' varchar NOT NULL DEFAULT '',
    'type' varchar NOT NULL,
    CHECK('type' IN ('sales lead', 'sales support'))
    'assigned_to' int NOT NULL,
    FOREIGN KEY ('assigned_to') REFERENCES Users('id'),
    'created_by' int NOT NULL,
    FORIEGN KEY ('created_by') REFERENCES Users('id'),
    'created_at' DATETIME NOT NULL,
    'updated_at' DATETIME NOT NULL
)ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

/*Creating the final table*/
DROP TABLE IF EXISTS 'Notes';
CREATE TABLE 'Notes'(
    'id' int auto_imcrement PRIMARY KEY,
    'contact_id' int NOT NULL DEFAULT '0',
    'comment' text,
    'created_by' int NOT NULL,
    FORIEGN KEY ('created_by') REFERENCES Users('id'),
    'created_at' DATETIME NOT NULL
)ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;