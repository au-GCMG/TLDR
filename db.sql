SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS TLDR;
CREATE DATABASE TLDR;

USE TLDR;

CREATE TABLE Instructor(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    licence varchar(10),
    mdi varchar(10)    
) AUTO_INCREMENT = 1;


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
    post varchar(50),
    email varchar(200),
    tel varchar(20),
    mobile varchar(20),
    licence varchar(10),
    mdi varchar(10),
    completed boolean NOT NULL DEFAULT 0,
    style varchar(50)
    /*updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP*/
) AUTO_INCREMENT = 1;

CREATE TABLE RecordGreen(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    studentL varchar(10),
    studentName varchar(100),
    date date,
    startTime time,
    finishTime time,
    duration float,
    fromLocation varchar(200),
    toLocation varchar(200),
    road varchar(20),
    weather varchar(20),
    traffic varchar(20),
    qsdName varchar(100),
    qsdLicence varchar(10),
    studentSignature boolean NOT NULL DEFAULT 0,
    qsdSignature boolean NOT NULL DEFAULT 0    
    /*updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP*/
) AUTO_INCREMENT = 1;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON TLDR.User TO dbadmin@localhost;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON TLDR.Instructor TO dbadmin@localhost;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON TLDR.RecordGreen TO dbadmin@localhost;

INSERT INTO Instructor(licence,mdi) VALUES('IN0001','MD0001');
INSERT INTO Instructor(licence,mdi) VALUES('IN0002','MD0002');


INSERT INTO User(firstname,surname,password,gender,dob,address,suburb,state,post,email,tel,mobile,licence,mdi,completed,style) VALUES('SHERLOCK','HOLMES','81dc9bdb52d04dc20036dbd8313ed055','M','1989-06-04','21B BAKER STREET','LONDON','ENGLAND','NW1 6XE','SH@GMAIL.COM',08123456,'0412345678','ST0001','', 0,'STUDENT');
INSERT INTO User(firstname,surname,password,gender,dob,address,suburb,state,post,email,tel,mobile,licence,mdi,completed,style) VALUES('JAMES','BOND','d93591bdf7860e1e4ee2fca799911215','M','1989-01-01','111 FLINDERS RD','ADELAIDE','SA',5000,'007@GMAIL.COM',087891011,'049999999','IN0001','MD0001', 0,'INSTRUCTOR');

INSERT INTO RecordGreen(studentL, studentName,date, startTime,finishTime,duration,fromLocation,toLocation,road,weather,traffic,qsdName,qsdLicence,studentSignature,qsdSignature) VALUES('ST0001','SHERLOCK HOLMES','2023-09-18','8:00:00', '9:30:00', 90, 'FLINDERS UNI','MARION SHOPPING CENTRE','SEALS','DRY','HEAVY','HERCULE POIROT','QSD0001',0,1);
INSERT INTO RecordGreen(studentL, studentName,date, startTime,finishTime,duration,fromLocation,toLocation,road,weather,traffic,qsdName,qsdLicence,studentSignature,qsdSignature) VALUES('ST0001','SHERLOCK HOLMES','2023-09-19','10:00:00', '11:30:00', 60, 'FLINDERS UNI','MARION SHOPPING CENTRE','SEALS','WET','LIGHT','HERCULE POIROT','QSD0001',0,1);
INSERT INTO RecordGreen(studentL, studentName,date, startTime,finishTime,duration,fromLocation,toLocation,road,weather,traffic,qsdName,qsdLicence,studentSignature,qsdSignature) VALUES('ST0001','SHERLOCK HOLMES','2023-09-20','18:00:00', '19:30:00', 90, 'FLINDERS UNI','MARION SHOPPING CENTRE','SEALS','DRY','HEAVY','HERCULE POIROT','QSD0001',0,1);
INSERT INTO RecordGreen(studentL, studentName,date, startTime,finishTime,duration,fromLocation,toLocation,road,weather,traffic,qsdName,qsdLicence,studentSignature,qsdSignature) VALUES('ST0001','SHERLOCK HOLMES','2023-09-20','20:00:00', '21:30:00', 90, 'MARION SHOPPING CENTRE','BLACKWOOD','SEALS','DRY','LIGHT','HERCULE POIROT','QSD0001',0,1);


/*
INSERT INTO Task(name) VALUES('Complete Checkpoint 1');
INSERT INTO Task(name) VALUES('Complete Checkpoint 2');
INSERT INTO Task(name) VALUES('Complete Checkpoint 3');
INSERT INTO Task(name) VALUES('Complete Checkpoint 4');
INSERT INTO Task(name) VALUES('Complete Checkpoint 5');
*/
