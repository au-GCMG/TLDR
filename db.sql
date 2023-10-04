SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS TLDR;
CREATE DATABASE TLDR;

USE TLDR;

CREATE TABLE sys_Instructor(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    licence varchar(10),
    mdi varchar(10)    
) AUTO_INCREMENT = 1;

CREATE TABLE sys_SALicence(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    licence varchar(10),
    style varchar(5),
    expiry date,
    held integer 
) AUTO_INCREMENT = 1;

CREATE TABLE sys_unit(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    unitNO varchar(10),
    description varchar(100)    
) AUTO_INCREMENT = 1;

CREATE TABLE sys_task(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    taskNO varchar(10),
    description varchar(100)    
) AUTO_INCREMENT = 1;

CREATE TABLE sys_item(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    itemNO varchar(10),
    description varchar(100)    
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
    sc varchar(20),
    expiry date,
    held  integer,
    mdi varchar(10),
    completed boolean NOT NULL DEFAULT 0,
    style varchar(50),
    code varchar(10)
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

CREATE TABLE payment(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    studentL varchar(10),
    studentName varchar(100),
    payeeL varchar(10),
    payeeName varchar(100),
    date date,
    invoiceN varchar(50),
    description varchar(100),
    unitprice decimal(5,2),
    unit decimal(5,2),
    amount decimal(5,2),
    tax decimal(5,2),    
    paid boolean NOT NULL DEFAULT 0 
) AUTO_INCREMENT = 1;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON TLDR.User TO dbadmin@localhost;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON TLDR.sys_Instructor TO dbadmin@localhost;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON TLDR.RecordGreen TO dbadmin@localhost;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON TLDR.sys_SALicence TO dbadmin@localhost;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON TLDR.payment TO dbadmin@localhost;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON TLDR.sys_unit TO dbadmin@localhost;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON TLDR.sys_task TO dbadmin@localhost;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON TLDR.sys_item TO dbadmin@localhost;

INSERT INTO sys_unit(unitNO,description) VALUES('U1','Basic driving procedures');
INSERT INTO sys_unit(unitNO,description) VALUES('U2','Slow speed manoeuvres');
INSERT INTO sys_unit(unitNO,description) VALUES('U3','Basic road skills');
INSERT INTO sys_unit(unitNO,description) VALUES('U4','Traffic management skills');

INSERT INTO sys_task(taskNO,description) VALUES('U1T1','Cabin drill and controls');
INSERT INTO sys_task(taskNO,description) VALUES('U1T2','Starting up and shutting dwon the engine');
INSERT INTO sys_task(taskNO,description) VALUES('U1T3','Moving off from kerb');
INSERT INTO sys_task(taskNO,description) VALUES('U1T4','Stopping and securing the vehicle');
INSERT INTO sys_task(taskNO,description) VALUES('U1T5','Stop and go(using the park brake)');
INSERT INTO sys_task(taskNO,description) VALUES('U1T6','Gear changing(up and down)');
INSERT INTO sys_task(taskNO,description) VALUES('U1T7','Steering(forward and reverse)');
INSERT INTO sys_task(taskNO,description) VALUES('U1T8','Review all basic driving procedures');

INSERT INTO sys_item(itemNO,description) VALUES('U1T1IA','a.Ensure the door and close');
INSERT INTO sys_item(itemNO,description) VALUES('U1T1IB','b.check that the park brake is firmly applied');
INSERT INTO sys_item(itemNO,description) VALUES('U1T1IC','c.Adjust the seat, head restraint and steering wheel');
INSERT INTO sys_item(itemNO,description) VALUES('U1T1ID','d.Adjust all mirrors');
INSERT INTO sys_item(itemNO,description) VALUES('U1T1IE','e.Locate,identify and be able to use all vehicle controls when driving');
INSERT INTO sys_item(itemNO,description) VALUES('U1T1IF','f.Perform all step(a) to (e) in sequence');
INSERT INTO sys_item(itemNO,description) VALUES('U1T1IG','g.Ensure all requiredd seat belts are fastened correctly');


INSERT INTO sys_Instructor(licence,mdi) VALUES('IN0001','MD0001');
INSERT INTO sys_Instructor(licence,mdi) VALUES('IN0002','MD0002');

INSERT INTO sys_SALicence(licence,style,expiry,held) VALUES('ST0001','L', '2024-06-04','2023');
INSERT INTO sys_SALicence(licence,style,expiry,held) VALUES('ST0002','L', '2025-06-04','2023');
INSERT INTO sys_SALicence(licence,style,expiry,held) VALUES('ST0003','L', '2024-01-04','2023');
INSERT INTO sys_SALicence(licence,style,expiry,held) VALUES('ST0004','L', '2024-07-04','2023');
INSERT INTO sys_SALicence(licence,style,expiry,held) VALUES('ST0005','P', '2026-10-10','2021');
INSERT INTO sys_SALicence(licence,style,expiry,held) VALUES('ST0006','L', '2023-10-10','2022');
INSERT INTO sys_SALicence(licence,style,expiry,held) VALUES('IN0001','F', '2026-07-04','2020');
INSERT INTO sys_SALicence(licence,style,expiry,held) VALUES('IN0002','F', '2028-07-04','2020');
INSERT INTO sys_SALicence(licence,style,expiry,held) VALUES('QSD0002','F', '2025-06-04','2017');
INSERT INTO sys_SALicence(licence,style,expiry,held) VALUES('QSD0002','F', '2026-06-04','2017');


/*Example data*/
INSERT INTO User(firstname,surname,password,gender,dob,address,suburb,state,post,email,tel,mobile,licence,sc,expiry,held,mdi,completed,style,code) VALUES('SHERLOCK','HOLMES','81dc9bdb52d04dc20036dbd8313ed055','M','1989-06-04','21B BAKER STREET','LONDON','ENGLAND','NW1 6XE','SH@GMAIL.COM',08123456,'0411111111','ST0001', 'SA','2024-06-04','2023','', 0,'STUDENT','123');
INSERT INTO User(firstname,surname,password,gender,dob,address,suburb,state,post,email,tel,mobile,licence,sc,expiry,held,mdi,completed,style,code) VALUES('JOHN','WATSON','d93591bdf7860e1e4ee2fca799911215','M','1988-06-04','21B BAKER STREET','LONDON','ENGLAND','NW1 6XE','JW@GMAIL.COM',08123456,'0422222222','ST0002','SA','2025-06-04','2023','', 0,'STUDENT','123');
INSERT INTO User(firstname,surname,password,gender,dob,address,suburb,state,post,email,tel,mobile,licence,sc,expiry,held,mdi,completed,style,code) VALUES('HERCULE','POIROT','46d045ff5190f6ea93739da6c0aa19bc','M','1999-01-01','56B WHITEHAVEN HOUSE SANDHURST SQUARE','LONDON','ENGLAND','EC1','HP@GMAIL.COM',08654321,'0433333333','ST0003','SA','2024-01-04','2023','', 0,'STUDENT','123');
INSERT INTO User(firstname,surname,password,gender,dob,address,suburb,state,post,email,tel,mobile,licence,sc,expiry,held,mdi,completed,style,code) VALUES('ARTHUR','HASTINGS','912e79cd13c64069d91da65d62fbb78c','M','1998-01-01','14 WARWICK STREET','LONDON','ENGLAND','W1B5NF','AH@GMAIL.COM',08654321,'0444444444','ST0004','SA','2024-07-04','2023','', 0,'STUDENT','123');
INSERT INTO User(firstname,surname,password,gender,dob,address,suburb,state,post,email,tel,mobile,licence,sc,expiry,held,mdi,completed,style,code) VALUES('JANE','MARPLE','6074c6aa3488f3c2dddff2a7ca821aab','F','1980-06-04','13 ST MARY MEAD','ST MARY MEAD','ENGLAND','OX28 4EZ','JM@GMAIL.COM',085555555,'0455555555','ST0005','VIC','2028-06-04','2023','', 1,'STUDENT','123');


INSERT INTO User(firstname,surname,password,gender,dob,address,suburb,state,post,email,tel,mobile,licence,sc,expiry,held,mdi,completed,style,code) VALUES('JAMES','BOND','9e94b15ed312fa42232fd87a55db0d39','M','1989-01-01','111 FLINDERS RD','ADELAIDE','SA','5000','JB@GMAIL.COM',087891011,'049999999','IN0001','SA','2026-07-04','2020','MD0001', 0,'INSTRUCTOR','123');
INSERT INTO User(firstname,surname,password,gender,dob,address,suburb,state,post,email,tel,mobile,licence,sc,expiry,held,mdi,completed,style,code) VALUES('ETHAN','HUNT','a13ee062eff9d7295bfc800a11f33704','M','1964-08-18','222 LANGLEY', 'LANGLEY','VIRGINIA','22101','EH@GMAIL.COM',08888888,'04888888','IN0002','SA','2028-07-04','2020','MD0002', 0,'INSTRUCTOR','123');

INSERT INTO User(firstname,surname,password,gender,dob,address,suburb,state,post,email,tel,mobile,licence,sc,expiry,held,mdi,completed,style,code) VALUES('DAVID','HOOK','202cb962ac59075b964b07152d234b70','M','1989-11-14','14 ADELAIDE RD','ADELAIDE','SA','5000','DH@GMAIL.COM',0877777777,'04777777','QSD0001','SA','2025-06-04','2017','', 0,'QSD','123');
INSERT INTO User(firstname,surname,password,gender,dob,address,suburb,state,post,email,tel,mobile,licence,sc,expiry,held,mdi,completed,style,code) VALUES('NING','HOOK','caf1a3dfb505ffed0d024130f58c5cfa','F','1989-11-14','14 ADELAIDE RD','ADELAIDE','SA','5000','NH@GMAIL.COM',08000000,'04000000','QSD0002','SA','2025-07-04','2017','', 0,'QSD','123');




INSERT INTO RecordGreen(studentL, studentName,date, startTime,finishTime,duration,fromLocation,toLocation,road,weather,traffic,qsdName,qsdLicence,studentSignature,qsdSignature) VALUES('ST0001','SHERLOCK HOLMES','2023-09-18','8:00:00', '9:30:00', 90, 'FLINDERS UNI','MARION SHOPPING CENTRE','SEALS','DRY','HEAVY','DAVID HOOK','QSD0001',0,1);
INSERT INTO RecordGreen(studentL, studentName,date, startTime,finishTime,duration,fromLocation,toLocation,road,weather,traffic,qsdName,qsdLicence,studentSignature,qsdSignature) VALUES('ST0001','SHERLOCK HOLMES','2023-09-19','10:00:00', '11:30:00', 60, 'FLINDERS UNI','MARION SHOPPING CENTRE','SEALS','WET','LIGHT','NING HOOK','QSD0002',0,1);
INSERT INTO RecordGreen(studentL, studentName,date, startTime,finishTime,duration,fromLocation,toLocation,road,weather,traffic,qsdName,qsdLicence,studentSignature,qsdSignature) VALUES('ST0001','SHERLOCK HOLMES','2023-09-20','18:00:00', '19:30:00', 90, 'FLINDERS UNI','MARION SHOPPING CENTRE','SEALS','DRY','HEAVY','DAVID HOOK','QSD0001',0,1);
INSERT INTO RecordGreen(studentL, studentName,date, startTime,finishTime,duration,fromLocation,toLocation,road,weather,traffic,qsdName,qsdLicence,studentSignature,qsdSignature) VALUES('ST0001','SHERLOCK HOLMES','2023-09-20','20:00:00', '21:30:00', 90, 'MARION SHOPPING CENTRE','BLACKWOOD','SEALS','DRY','LIGHT','NING HOOK','QSD0002',1,1);

INSERT INTO RecordGreen(studentL, studentName,date, startTime,finishTime,duration,fromLocation,toLocation,road,weather,traffic,qsdName,qsdLicence,studentSignature,qsdSignature) VALUES('ST0002','JOHN WATSON','2023-09-21','21:00:00', '21:30:00', 30, 'FLINDERS UNI','BLACKWOOD','SEALS','DRY','LIGHT','NING HOOK','QSD0001',1,1);

INSERT INTO payment(studentL,studentName,payeeL,payeeName,date,invoiceN,description,unitprice,unit,amount,tax,paid) VALUES('ST0001','SHERLOCK HOLMES','IN0001','JAMES BOND','2023-09-20','INV0001','MEONY MEONY',30,4,120,12,'0');
INSERT INTO payment(studentL,studentName,payeeL,payeeName,date,invoiceN,description,unitprice,unit,amount,tax,paid) VALUES('ST0001','SHERLOCK HOLMES','IN0001','JAMES BOND','2023-09-23','INV0001','MEONY MEONY',30,2.5,75,7.5,'0');
