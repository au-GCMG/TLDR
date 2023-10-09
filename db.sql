SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS TLDR;
CREATE DATABASE TLDR;

USE TLDR;

-- cbt

CREATE TABLE sys_unit(
    id int NOT NULL PRIMARY KEY,
    unitNO varchar(10),
    description text    
);

CREATE TABLE sys_task(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    unitid int,
    taskNO varchar(10),
    description text
) AUTO_INCREMENT = 1;

CREATE TABLE sys_subtask (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    taskid int,
    subtaskNO VARCHAR(255),
    subtaskname VARCHAR(255),
    subtaskdescription TEXT
) AUTO_INCREMENT = 1;

CREATE TABLE sys_item(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    taskid int,
    subtaskid int,
    itemNO varchar(10),
    description text
) AUTO_INCREMENT = 1;




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


CREATE TABLE user(
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

CREATE TABLE homeworkcompletion (
    licence VARCHAR(255),
    itemid int,
    studentsign1 BOOLEAN,
    studentsign2 BOOLEAN
);

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
GRANT all privileges ON TLDR.sys_subtask TO dbadmin@localhost;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON TLDR.sys_item TO dbadmin@localhost;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON TLDR.homeworkcompletion TO dbadmin@localhost;

-- Example

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

INSERT INTO sys_unit(id,unitNO,description) VALUES(1,'UNIT1','Basic driving procedures');
INSERT INTO sys_unit(id,unitNO,description) VALUES(2,'UNIT2','Slow speed manoeuvres');
INSERT INTO sys_unit(id,unitNO,description) VALUES(3,'UNIT3','Basic road skills');
INSERT INTO sys_unit(id,unitNO,description) VALUES(4,'UNIT4','Traffic management skills');


INSERT INTO sys_task (unitid, taskNO, description) VALUES(1,'TASK1','Cabin drill and controls');
INSERT INTO sys_task (unitid, taskNO, description) VALUES(1,'TASK2','Starting up and shutting dwon the engine');
INSERT INTO sys_task (unitid, taskNO, description) VALUES(1,'TASK3','Moving off from kerb');
INSERT INTO sys_task (unitid, taskNO, description) VALUES(1,'TASK4','Stopping and securing the vehicle');
INSERT INTO sys_task (unitid, taskNO, description) VALUES(1,'TASK5','Stop and go(using the park brake)');
INSERT INTO sys_task (unitid, taskNO, description) VALUES(1,'TASK6','Gear changing(up and down)');
INSERT INTO sys_task (unitid, taskNO, description) VALUES(1,'TASK7','Steering(forward and reverse)');
INSERT INTO sys_task (unitid, taskNO, description) VALUES(1,'TASK8','Review all basic driving procedures');

INSERT INTO sys_subtask (taskid, subtaskNO, subtaskname, subtaskdescription) VALUES (2, '(1)','(1) Starting the engine',' ');
INSERT INTO sys_subtask (taskid, subtaskNO, subtaskname, subtaskdescription) VALUES (2, '(b)','(b) Shutting down the engine',' ');
INSERT INTO sys_subtask (taskid, subtaskNO, Subtaskname, subtaskdescription) VALUES (4, '(1)','(1) Stopping the vehicle (including slowing)',' ');
INSERT INTO sys_subtask (taskid, subtaskNO, Subtaskname, subtaskdescription) VALUES (4, '(2)','(2) Securing the vehicle (to prevent rolling)',' ');
INSERT INTO sys_subtask (taskid, subtaskNO, Subtaskname, subtaskdescription) VALUES (6, '(1)','(1) Changing gears (up and down, manual and automatics)',' ');
INSERT INTO sys_subtask (taskid, subtaskNO, Subtaskname, subtaskdescription) VALUES (6, '(2)','(2) Accurate selection of appropriate gears for varying speeds',' ');
INSERT INTO sys_subtask (taskid, subtaskNO, Subtaskname, subtaskdescription) VALUES (7, '(1)','(1) Steering in a forward direction',' ');
INSERT INTO sys_subtask (taskid, subtaskNO, Subtaskname, subtaskdescription) VALUES (7, '(b)','(2) Steering in reverse',' ');

INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (1, NULL, '(a)', '(a) Ensure the doors are closed (and locked for security and safety - optional);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (1, NULL, '(b)', '(b) Check that the park brake is firmly applied;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (1, NULL, '(c)', '(c) Adjust the seat, head restraint and steering wheel (as required);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (1, NULL, '(d)','(d) Adjust all mirrors (electric mirrors, if fitted, may be adjusted after starting the engine -Task 2);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (1, NULL, '(e)', '(e) Locate, identify and be able to use all vehicle controls (as required) when driving (including climate controls);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (1, NULL, '(f)', '(f) Perform all steps (a) to (e) in sequence;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (1, NULL, '(g)', '(g) Ensure all required seat belts are fastened correctly.');

INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 1, '(a)', '(a) If the park brake is not on, correctly apply it;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 1, '(b)', '(b) Clutch down to the floor and keep it down (manuals only);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 1, '(c)', '(c) Check gear lever in Neutral (manuals) or Neutral/Park (automatics);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 1, '(d)', '(d) Switch the ignition (key) to the ON position;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 1, '(e)', '(e) Check all gauges and warning lights for operation;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 1, '(f)', '(f) Start the engine;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 1, '(g)', '(g) Check all gauges and warning lights again for operation; and');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 1, '(h)', '(h) Performs all steps 1(a) to 1(g) in sequence.');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 2, '(a)', '(a) Bring the vehicle to a complete stop (clutch down-manuals);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 2, '(b)', '(b) Secure the vehicle using the park brake;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 2, '(c)', '(c) Select Neutral (manuals) or Neutral/Park (automatics);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 2, '(d)', '(d) Release brake pedal (to check for rolling);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 2, '(e)', '(e) Release clutch pedal (manuals only);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 2, '(f)', '(f) Switch off appropriate controls (eg lights, air conditioner etc);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 2, '(g)', '(g) Check all gauges and warning lights for operation;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 2, '(h)', '(h) Turn ignition to OFF or LOCK position; and');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (2, 2, '(i)', '(i) Perform all steps 2(a) to 2(h) in sequence.');

INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (3, NULL, '(a)', '(a) If the park brake is not applied, correctly apply it;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (3, NULL, '(b)', '(b) Check the centre mirror, then the right mirror, then signal right for at least 5 seconds;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (3, NULL, '(c)', '(c) Push clutch pedal down (manuals) / Right foot on footbrake (automatics);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (3, NULL, '(d)', '(d) Select 1st gear (manuals) / Select Drive (automatics);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (3, NULL, '(e)', '(e) Apply appropriate power, (and for manuals) clutch to friction point;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (3, NULL, '(f)', '(f) Check the centre mirror again, then the right mirror, then over the right shoulder (blind spot check) for traffic (from driveways, roads opposite or U-turning traffic);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (3, NULL, '(g)', '(g) If safe, look forward and release the park brake;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (3, NULL, '(h)', '(h) Accelerate smoothly away from the kerb without stalling or rolling back, and cancel the signal; and');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (3, NULL, '(i)', '(i) Perform all steps (a) to (h) in sequence.');

INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (4, 3, '(a)', '(a) Select appropriate stopping position;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (4, 3, '(b)', '(b) Check the centre mirror, then the left mirror (for cyclists etc.) and signal left ;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (4, 3, '(c)', '(c) Smoothly slow the vehicle (to just above engine idle speed) using the footbrake operated by the right foot');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (4, 3, '(d)', '(d) (For manuals) push the clutch down just before reaching engine idle speed to prevent stalling while maintaining light pressure on the footbrake;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (4, 3, '(e)', '(e) Bring vehicle to a smooth stop without jerking the vehicle; and');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (4, 3, '(f)', '(f) Perform all steps 1(a) to 1 (e) in sequence.');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (4, 4, '(a)', '(a) Check that the vehicle has stopped (as above) and correctly, apply the park brake to prevent rolling;' );
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (4, 4, '(b)', '(b) Select Neutral (manuals) or Park (automatics);'); 
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (4, 4, '(c)', '(c) Release the brake pedal and then (for manuals) release the clutch;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (4, 4, '(d)', '(d) Perform all steps 2(a) to 2(c) in sequence; and');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (4, 4, '(e)', '(e) Cancel any signal after stopping.');

INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (5, NULL, '(a)', '(a) Select the suitable stopping position on the road (e.g. - stop lines, positioning for view and proximity to other vehicles);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (5, NULL, '(b)', '(b) Check the centre mirror, (then if required the appropriate side mirror), and if required signal intention;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (5, NULL, '(c)', '(c) Slow the vehicle smoothly using the footbrake only; ');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (5, NULL, '(d)', '(d) For manuals only, when the vehicle slows to just above stalling speed, push the clutch down;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (5, NULL, '(e)', '(e) For manuals only, just as the vehicle is stopping, select first gear;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (5, NULL, '(f)', '(f) When the vehicle comes to a complete stop, apply the park brake (holding the handbrake button in, where possible*) and release the footbrake (right foot placed over accelerator);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (5, NULL, '(g)', '(g) Check that it is safe to move off and apply appropriate power (and for manuals, clutch to friction point);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (5, NULL, '(h)', '(h) If safe, look forward and release the park brake which results in the vehicle immediately moving off in a smooth manner without stalling and under full control; and');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (5, NULL, '(i)', '(i) Perform all steps (a) to (h) in sequence.');

INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (6, 5, '(a)', '(a)  Move off smoothly from a stationary position in first gear (manuals) or (automatics);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (6, 5, '(b)', '(b) Adjust the speed of the vehicle prior to selecting the new gear;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (6, 5, '(c)', '(c) 7 Change gears, one at a time from first gear (manuals)  or the lowest gear (automatics) through to the highest gear without clashing, missing the gear, unnecessarily jerking the vehicle OR looking at the gear lever;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (6, 5, '(d)', '(d) 7 Change gear from a high gear (4th, 5th or Drive) to various appropriate gears 7 without significantly jerking the vehicle OR looking at the gear lever/selector; and');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (6, 5, '(e)', '(e) 7 Demonstrate full control (including steering) over the vehicle during gear changing.');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (6, 6, '(a)', '(a) 7 Adjust the speed of the vehicle up and down and then select the appropriate gear for that speed (manuals and automatics);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (6, 6, '(b)', '(b) 7 When the vehicle is moving, demonstrate all gear selections without looking at the gear lever or gear selector; and');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (6, 6, '(c)', '(c) 7 Demonstrate accurate selection of the gears without significant jerking of the vehicle or clashing of gears.');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (6, 6, '(d)', '(d) 7 Demonstrate the selection of appropriate gears, whilst descending and ascending gradients; and');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (6, 6, '(e)', '(e) 7 Be able to select an appropriate gear to avoid unnecessary braking on descents and to have control on ascents.');

INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (7, 7, '(a)', '(a) Maintain a straight course of at least 100 metres between turns with the hands placed in approximately the “10 to 2” clock position on the steering wheel with a light grip pressure;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (7, 7, '(b)', '(b) Demonstrate turning to the left and right through 90 degrees using either the “Pull-Push” or “Hand over Hand” method of steering while maintaining full vehicle control without over-steering;and');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (7, 7, '(c)', '(c) Look in the direction where the driver is intending to go when turning (First Rule of Observation - Aim high in steering).');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (7, 8, '(a)', '(a) Reverse the vehicle in a straight line for a minimum of 20 metres with a deviation not exceeding 1 metre, followed by step 2(b);');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (7, 8, '(b)', '(b) Reverse the vehicle through an angle of approximately 90 degrees to the left followed by reversing in a straight line for 5 metres with a deviation not exceeding half a metre (500mm); and;');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (7, 8, '(c)', '(c) Look in the appropriate directions and to the rear while reversing.');


INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (8, NULL, '(a)', '(a) Demonstrate Task 1 - cabin drill and controls');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (8, NULL, '(b)', '(b) Demonstrate Task 2 - starting up and shutting down the engine');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (8, NULL, '(c)', '(c) Demonstrate Task 3 - moving off from the kerb');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (8, NULL, '(d)', '(d) Demonstrate Task 4 - stopping and securing the vehicle');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (8, NULL, '(e)', '(e) Demonstrate Task 5 - stop and go (using the park brake)');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (8, NULL, '(f)', '(f) Demonstrate Task 6 - gear changing (up and down)');
INSERT INTO sys_item (taskid, subtaskid, itemNO, description) VALUES (8, NULL, '(g)', '(g) Demonstrate Task 7 - control of the steering (forward and reverse)');
