-- CREATE DATABASE
CREATE DATABASE report_analytics_portal_db;
USE report_analytics_portal_db;

-- CREATE TABLES
CREATE TABLE Admin(admin_id int, username varchar(50), password varchar(100), primary key(admin_id, username, password));

CREATE TABLE Industry(industry_id int, name varchar(50), primary key(industry_id), index idx_industry_id(industry_id));

CREATE TABLE Region(region_id varchar(50), region_name varchar(50), primary key (region_id));

CREATE TABLE School(industry_id int, school_id varchar(50), name varchar(100), region_id varchar(50), type varchar(50), contact varchar(50), email varchar(50), index idx_school_id(school_id), primary key (industry_id, school_id), foreign key (industry_id) references Industry(industry_id) on update cascade on delete cascade , foreign key (region_id) references Region(region_id) on update cascade on delete cascade );

CREATE TABLE Course(course_id varchar(50), course_name varchar(50), primary key(course_id), index idx_course_id(course_id));


CREATE TABLE Student(student_id varchar(50), school_id varchar(50), course_id varchar(50), student_name varchar(100), birthdate varchar(50), gender varchar(50), contact varchar(50), address varchar(100), primary key (student_id), foreign key (school_id) references School(school_id) on update cascade on delete cascade , foreign key (course_id) references Course(course_id) on update cascade on delete cascade );

CREATE TABLE Enrollment(enrollment_id varchar(50), student_id varchar(50), num_units int, school_year int, semester varchar(50), payment_status varchar(50), primary key (enrollment_id), foreign key (student_id) references Student (student_id) on update cascade on delete cascade );

CREATE TABLE locatedIn(region_id varchar(50), school_id varchar(50), primary key (region_id, school_id), foreign key (region_id) references Region(region_id) on update cascade on delete cascade , foreign key (school_id) references School(school_id) on update cascade on delete cascade );

CREATE TABLE studiesIn(school_id varchar(50), student_id varchar(50), primary key (school_id, student_id), foreign key (school_id) references School(school_id) on update cascade on delete cascade , foreign key (student_id) references Student(student_id) on update cascade on delete cascade );

CREATE TABLE majorsIn(student_id varchar(50), course_id varchar(50), primary key ( student_id, course_id), foreign key (student_id) references Student(student_id) on update cascade on delete cascade , foreign key (course_id) references Course(course_id) on update cascade on delete cascade );

CREATE TABLE enrolled(student_id varchar(50), enrollment_id varchar(50), status varchar(50), primary key ( student_id, enrollment_id),  foreign key (student_id) references Student(student_id) on update cascade on delete cascade , foreign key (enrollment_id) references Enrollment(enrollment_id) on update cascade on delete cascade );

CREATE TABLE costPerStudent(enrollment_id varchar(50), school_id varchar(50), cost real, num_students int, primary key ( enrollment_id, school_id), foreign key (enrollment_id) references Enrollment(enrollment_id) on update cascade on delete cascade ,  foreign key (school_id) references School(school_id) on update cascade on delete cascade );

CREATE TABLE Public_Elementary_School(industry_id int, elementary_school_id int, school_name varchar(50), no_of_students int, index idx_elementary_school_id(elementary_school_id), primary key ( industry_id, elementary_school_id), foreign key (industry_id) references Industry(industry_id) on update cascade on delete cascade );

CREATE TABLE Grade_Level(level_name varchar(50), no_of_students int, primary key (level_name));

CREATE TABLE Offers(elementary_school_id int, level_name varchar(50), primary key (elementary_school_id,level_name), foreign key (elementary_school_id) references Public_Elementary_School(elementary_school_id) on update cascade on delete cascade );

CREATE TABLE Trader(trader_no int, name varchar(50), primary key (trader_no), index idx_trader_no(trader_no));

CREATE TABLE Importer(importer_no int, name varchar(50), primary key (importer_no), index idx_importer_no(importer_no));

CREATE TABLE Distributor(dist_no int, name varchar(50), primary key (dist_no), index idx_dist_no(dist_no));

CREATE TABLE Manufacturer(manu_no int, name varchar(50), primary key (manu_no), index idx_manu_no(manu_no));

CREATE TABLE Drug(industry_id int, cpr_no varchar(50), dr_no varchar(50), country varchar(50), rsn varchar(50),validity_date date,generic_name varchar(50),brand_name varchar(50),strength varchar(50),form varchar(50), index idx_cpr_no(cpr_no), primary key (industry_id, cpr_no), foreign key (industry_id) references Industry(industry_id) on update cascade on delete cascade );

CREATE TABLE Food (
  industry_id int(11) NOT NULL,
  cpr_no varchar(50) NOT NULL,
  food_name varchar(100) DEFAULT NULL,
  dr_no varchar(50) DEFAULT NULL,
  country varchar(50) DEFAULT NULL,
  rsn varchar(50) DEFAULT NULL,
  validity_date date DEFAULT NULL, index idx_cpr_no(cpr_no), primary key (industry_id, cpr_no), foreign key (industry_id) references Industry(industry_id) on update cascade on delete cascade );
 
  
CREATE TABLE Trades(cpr_no varchar(50), trader_no int, primary key (cpr_no, trader_no), foreign key (cpr_no) references Drug(cpr_no) on update cascade on delete cascade , foreign key (cpr_no) references Food(cpr_no) on update cascade on delete cascade , foreign key (trader_no) references Trader(trader_no) on update cascade on delete cascade );

CREATE TABLE Imports(cpr_no varchar(50), importer_no int, primary key (cpr_no, importer_no), foreign key (cpr_no) references Drug(cpr_no) on update cascade on delete cascade , foreign key (cpr_no) references Food(cpr_no) on update cascade on delete cascade , foreign key (importer_no) references Importer(importer_no) on update cascade on delete cascade );

CREATE TABLE Distributes(cpr_no varchar(50), dist_no int, primary key (cpr_no, dist_no), foreign key (cpr_no) references Drug(cpr_no) on update cascade on delete cascade , foreign key (cpr_no) references Food(cpr_no) on update cascade on delete cascade , foreign key (dist_no) references Distributor(dist_no) on update cascade on delete cascade );

CREATE TABLE Manufactures(cpr_no varchar(50), manu_no int, primary key (cpr_no, manu_no), foreign key (cpr_no) references Drug(cpr_no) on update cascade on delete cascade , foreign key (cpr_no) references Food(cpr_no) on update cascade on delete cascade , foreign key (manu_no) references Manufacturer(manu_no) on update cascade on delete cascade );


-- INSERT VALUES
INSERT INTO Admin VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3'); 

INSERT INTO Industry VALUES (1, 'Drug');
INSERT INTO Industry VALUES (2, 'Food');
INSERT INTO Industry VALUES (3, 'School');
INSERT INTO Industry VALUES (4, 'Public_Elementary_School');

industry_id int, cpr_no varchar(50), dr_no varchar(50), country varchar(50), rsn varchar(50),validity_date date,generic_name varchar(50),brand_name varchar(50),strength varchar(50),form varchar(50)


INSERT INTO Drug VALUES (1,"NO-004746","DRP-1228-01",null,"20100000000000",'2020-10-10',"Purified Water (Distilled Water)",null,null,null);
INSERT INTO Drug VALUES (1,"DE-000331","DR-XY13892","Australia","05A-1915",'2020-8-11',"Budesonide",'Budecort Respules',"250 mg/mL",'Nebulizing Suspension (Sterile)');
INSERT INTO Drug VALUES (1,"NO-004749","DRP-924-01",null,"20100000000000",'2020-5-29',"Sodium Chloride",null,"450 mg/50 mL (0.9% w/v)","Solution for IV Infusion");
INSERT INTO Drug VALUES (1,"DC-000195","DR-XY30762",null,"04A-1251",'2020-5-17',"Cefalexin (As Monohydrate)",'Felfalex',"250 mg/5 mL","Granules for Suspension");
INSERT INTO Drug VALUES (1,"NO-004748","DRP-944-01",null,"20100000000000",'2020-2-3',"Sterile Water for Injection",null,null,"Solution for Injection");

/*
INSERT INTO <table_name> VALUES (<table_values>)

-- UPDATE VALUES

-- DELETE VALUES

-- DEFINITIONS 
*/