SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS TLDR;
CREATE DATABASE TLDR;

USE TLDR;

CREATE TABLE User(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname varchar(100),
    surname varchar(100),
    password varchar(512),
    gender varchar(1),
    dob date,
    address varchar(512),
    suburb varchar(200),
    state varchar(50),
    post integer,
    email varchar(200),
    tel varchar(20),
    mobile varchar(20),
    licence varchar(10),
    completed boolean NOT NULL DEFAULT 0,
    style varchar(50)
    /*updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP*/
) AUTO_INCREMENT = 1;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON TLDR.User TO dbadmin@localhost;

INSERT INTO User(firstname,surname,password,gender,dob,address,suburb,state,post,email,tel,mobile,licence,completed,style) VALUES('James','Bond','1234','M',1989-06-04,'21B Baker Street','Adelaide','SA',5000,'007@m16.com',08123456,'0412345678','BT2222',0,'STUDENT');
/*
INSERT INTO Task(name) VALUES('Complete Checkpoint 1');
INSERT INTO Task(name) VALUES('Complete Checkpoint 2');
INSERT INTO Task(name) VALUES('Complete Checkpoint 3');
INSERT INTO Task(name) VALUES('Complete Checkpoint 4');
INSERT INTO Task(name) VALUES('Complete Checkpoint 5');
*/
