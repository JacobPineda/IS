-- DELETE DB IS EXIST
DROP DATABASE IF EXISTS report_analytics_portal_db;

-- CREATE DATABASE
CREATE DATABASE report_analytics_portal_db;
USE report_analytics_portal_db;

-- CREATE TABLES
CREATE TABLE Admin(admin_id int, username varchar(50), password varchar(100), primary key(admin_id, username, password));

CREATE TABLE Industry(industry_id int, name varchar(50), primary key(industry_id), index idx_industry_id(industry_id));

CREATE TABLE Region(region_id varchar(50), region_name varchar(50), primary key (region_id));

CREATE TABLE School(industry_id int, school_id varchar(50), name varchar(100), region_id varchar(50), contact varchar(50), email varchar(50), index idx_school_id(school_id), primary key (industry_id, school_id), foreign key (industry_id) references Industry(industry_id) on update cascade on delete cascade , foreign key (region_id) references Region(region_id) on update cascade on delete cascade );

CREATE TABLE Course(course_id varchar(50), course_name varchar(50), primary key(course_id), index idx_course_id(course_id));

CREATE TABLE Student(student_id varchar(50), school_id varchar(50), course_id varchar(50), student_name varchar(100), birthdate varchar(50), gender varchar(50), contact varchar(50), address varchar(100), primary key (student_id), foreign key (school_id) references School(school_id) on update cascade on delete cascade , foreign key (course_id) references Course(course_id) on update cascade on delete cascade );

CREATE TABLE Enrollment(enrollment_id varchar(50), student_id varchar(50), num_units int, school_year int, semester varchar(50), tuition real, payment_status varchar(50), enrollment_status varchar(50), primary key (enrollment_id), foreign key (student_id) references Student (student_id) on update cascade on delete cascade );

CREATE TABLE Cost_Per_Student(school_id varchar(50), total_tuition real, num_students int, primary key (school_id), foreign key (school_id) references School(school_id) on update cascade on delete cascade);

CREATE TABLE Grade_Level(level_id varchar(50), level_name varchar(50), primary key (level_id));

CREATE TABLE Public_Elementary_School(industry_id int, elementary_school_id varchar(50), region_id varchar(50), school_name varchar(50), index idx_elementary_school_id(elementary_school_id), primary key (industry_id, elementary_school_id), foreign key (industry_id) references Industry(industry_id) on update cascade on delete cascade, foreign key (region_id) references Region(region_id) on update cascade on delete cascade);

CREATE TABLE Offers(elementary_school_id varchar(50), level_id varchar(50), no_of_students int, primary key (elementary_school_id, level_id), foreign key (elementary_school_id) references Public_Elementary_School(elementary_school_id) on update cascade on delete cascade, foreign key (level_id) references Grade_Level(level_id) on update cascade on delete cascade );

CREATE TABLE Trader(trader_no int, name varchar(50), primary key (trader_no), index idx_trader_no(trader_no));

CREATE TABLE Importer(importer_no int, name varchar(50), primary key (importer_no), index idx_importer_no(importer_no));

CREATE TABLE Distributor(dist_no int, name varchar(50), primary key (dist_no), index idx_dist_no(dist_no));

CREATE TABLE Manufacturer(manu_no int, name varchar(50), primary key (manu_no), index idx_manu_no(manu_no));

CREATE TABLE Drug(industry_id int, cpr_no varchar(50), dr_no varchar(50), country varchar(50), rsn varchar(50),validity_date date,generic_name varchar(200),brand_name varchar(200),strength varchar(50),form varchar(50), index idx_cpr_no(cpr_no), primary key (industry_id, cpr_no), foreign key (industry_id) references Industry(industry_id) on update cascade on delete cascade );

CREATE TABLE Food(industry_id int, cpr_no varchar(50), food_name varchar(200), dr_no varchar(50), country varchar(50), rsn varchar(50),validity_date date,index idx_cpr_no(cpr_no), primary key (industry_id, cpr_no), foreign key (industry_id) references Industry(industry_id) on update cascade on delete cascade );

CREATE TABLE Trades(drug_cpr_no varchar(50), food_cpr_no varchar(50), trader_no int, primary key (drug_cpr_no, food_cpr_no, trader_no), foreign key (drug_cpr_no) references Drug(cpr_no) on update cascade on delete cascade , foreign key (food_cpr_no) references Food(cpr_no) on update cascade on delete cascade , foreign key (trader_no) references Trader(trader_no) on update cascade on delete cascade );

CREATE TABLE Imports(drug_cpr_no varchar(50), food_cpr_no varchar(50), importer_no int, primary key (drug_cpr_no, food_cpr_no, importer_no), foreign key (drug_cpr_no) references Drug(cpr_no) on update cascade on delete cascade , foreign key (food_cpr_no) references Food(cpr_no) on update cascade on delete cascade , foreign key (importer_no) references Importer(importer_no) on update cascade on delete cascade );

CREATE TABLE Distributes(drug_cpr_no varchar(50), food_cpr_no varchar(50), dist_no int, primary key (drug_cpr_no, food_cpr_no, dist_no), foreign key (drug_cpr_no) references Drug(cpr_no) on update cascade on delete cascade , foreign key (food_cpr_no) references Food(cpr_no) on update cascade on delete cascade , foreign key (dist_no) references Distributor(dist_no) on update cascade on delete cascade );

CREATE TABLE Manufactures(drug_cpr_no varchar(50), food_cpr_no varchar(50), manu_no int, primary key (drug_cpr_no, food_cpr_no, manu_no), foreign key (drug_cpr_no) references Drug(cpr_no) on update cascade on delete cascade , foreign key (food_cpr_no) references Food(cpr_no) on update cascade on delete cascade , foreign key (manu_no) references Manufacturer(manu_no) on update cascade on delete cascade );


-- INSERT VALUES
INSERT INTO Admin VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

INSERT INTO Industry VALUES (1, 'Drug');
INSERT INTO Industry VALUES (2, 'Food');
INSERT INTO Industry VALUES (3, 'School');
INSERT INTO Industry VALUES (4, 'Public_Elementary_School');


INSERT INTO Drug VALUES (1,"0",null,null,null,null,null,null,null,null);
INSERT INTO Drug VALUES (1,"NO-004746","DRP-1228-01",null,"20100000000000",'2020-10-10',"Purified Water (Distilled Water)",null,null,null);
INSERT INTO Drug VALUES (1,"DE-000331","DR-XY13892","Australia","05A-1915",'2020-8-11',"Budesonide",'Budecort Respules',"250 mg/mL",'Nebulizing Suspension (Sterile)');
INSERT INTO Drug VALUES (1,"NO-004749","DRP-924-01",null,"20100000000000",'2020-5-29',"Sodium Chloride",null,"450 mg/50 mL (0.9% w/v)","Solution for IV Infusion");
INSERT INTO Drug VALUES (1,"DC-000195","DR-XY30762",null,"04A-1251",'2020-5-17',"Cefalexin (As Monohydrate)",'Felfalex',"250 mg/5 mL","Granules for Suspension");
INSERT INTO Drug VALUES (1,"NO-004748","DRP-944-01",null,"20100000000000",'2020-2-3',"Sterile Water for Injection",null,null,"Solution for Injection");
INSERT INTO Drug VALUES(1,"NO-004391","DRP-825-01","India","20100000000000","2020-1-3","Ranitidine (as Hydrochloride)","Rentsan","25 mg/mL","Solution for Injection IM/IV");
INSERT INTO Drug VALUES(1,"NO-004756","DRP-3196-01","India","20100000000000","2019-12-29","Cefuroxime (as Sodium)","Dinoxime","750 mg","Powder for Injection IM/IV");
INSERT INTO Drug VALUES(1,"NO-004633","DRP-3707-04","India","20100000000000","2019-12-21","Cetirizine Hydrochloride","Qualcet","5 mg/5 mL","Syrup");
INSERT INTO Drug VALUES(1,"NO-004673","DRP-3707-01","India","20100000000000","2019-12-21","Cetirizine Hydrochloride",null,"5 mg/5 mL","Syrup");
INSERT INTO Drug VALUES(1,"NO-004710","DRP-076-02","Korea","20100000000000","2019-12-21","Cefuroxime (as Sodium)","Ceft","750 mg","Powder for Injection IM/IV");
INSERT INTO Drug VALUES(1,"NO-004706","DRP-076-09","Korea","20100000000000","2019-12-21","Cefuroxime (as Sodium)","Fuzef","750 mg","Powder for Injection IM/IV");
INSERT INTO Drug VALUES(1,"NO-004708","DRP-076-08","Korea","20100000000000","2019-12-21","Cefuroxime (as Sodium)","Rucef","750 mg","Powder for Injection IM/IV");
INSERT INTO Drug VALUES(1,"NO-004707","DRP-076-01","Korea","20100000000000","2019-12-21","Cefuroxime (as Sodium)","Altoxime","750 mg","Powder for Injection IM/IV");
INSERT INTO Drug VALUES(1,"NO-004721","DRP-076-05","Korea","20100000000000","2019-12-21","Cefuroxime (as Sodium)","Zefur","750 mg","Powder for Ijection IM/IV");
INSERT INTO Drug VALUES(1,"NO-004723","DRP-076-10","Korea","20100000000000","2019-12-21","Cefuroxime (as Sodium)","Furoxen","750 mg","Powder for Injection IM/IV");
INSERT INTO Drug VALUES(1,"NO-004755","DRP-076-03","Korea","20100000000000","2019-12-21","Cefuroxime (as Sodium)","Cefurax","750 mg","Powder for Injection IM/IV");
INSERT INTO Drug VALUES(1,"NO-004639","DRP-5073-02","India","20100000000000","2019-12-20","Dichlorobenzyl Alcohol + Amylmetacresol","Muracept","1.2 mg/600 mcg","Lozenge");
INSERT INTO Drug VALUES(1,"NO-004486","DRP-1505-02",null,"20100000000000","2019-12-13","Phenylephrine Hydrochloride / Brompheniramine","Sinulif","12.5 mg/4 mg per 5 mL","Syrup");
INSERT INTO Drug VALUES(1,"NO-004487","DRP-1505-01",null,"20100000000000","2019-12-13","Phenylephrine Hydrochloride / Brompheniramine Maleate","Cold-Aid","12.5 mg/4 mg per 5 mL","Syrup");
INSERT INTO Drug VALUES(1,"NO-004537","DRP-3416-04","India","20140903120756,20150223145719","2019-12-8","Piperacillin (As Sodium) + Tazobactam (As Sodiuim)","Nazovac","4 g/500 mg","Powder for Injection IM/IV");
INSERT INTO Drug VALUES(1,"NO-004538","DRP-3416-03","India","20100000000000","2019-12-8","Piperacillin (As Sodium) + Tazobactam (As Sodiuim)","Tazmar","4 g/500 mg","Powder for Injection IM/IV");

INSERT INTO Food VALUES (2,"0",null,null,null,null,null);
insert into Food values(2,"FDA-0049904","Chowking Chicken Marinade Xbm51 (For Export Market)","FR-105694","Philippines","20100000000000","2020-12-10");
insert into Food values(2,"FDA-0057527","My-Marvel Taheebo Herbal Dietary Supplement Tea","FR-19018","Philippines","20100000000000","2020-11-12");
insert into Food values(2,"FDA-0058293","Kgc Kgc Korean Red Ginseng","FR-128825","Korea","20200000000000","2020-10-12");
insert into Food values(2,"FDA-0056539","Fresenius Kabi Supportan Drink - Cappucinno Flavor Reformulated (Food For Special Medical Purpose)","FR-103810","Germany","20100000000000","2020-10-03");
insert into Food values(2,"FDA-0058278","Falcon's Valley Falcon's Valley Choice Whole Young Corn","FR-87500","Thailand","20100000000000","2020-09-28");
insert into Food values(2,"FDA-0055616","Calciday Calcium Carbonate + Vitamin D Food Supplement Tablet","FR-103883","Philippines","20100000000000","2020-09-13");
insert into Food values(2,"FDA-0057528","Interhealthcare Pharmaceuticals Inc. Green Juice (Wheat Grass + Barley Grass) Food Supplement Powder","FR-103682","Philippines","20100000000000","2020-09-11");
insert into Food values(2,"FDA-0054728","App-Essentials A To Z Kid's Vitamin C Dietary Supplement Tablet - Strawberry Flavor","FR-103449","Malaysia","20100000000000","2020-08-24");
insert into Food values(2,"FDA-0048937","Maya All Purpose Flour (With Corn Nuggets Recipe On The Back Panel)","FR-85997","Philippines","20100000000000","2020-07-01");
insert into Food values(2,"FDA-0048936","Maya All Purpose Flour (With Seafood Tempura Recipe On The Back Panel)","FR-85998","Philippines","20100000000000","2020-07-01");
insert into Food values(2,"FDA-0048935","Maya All Purpose Flour (With Strawberry Jam, Muffins and Fudge-Filled Shortbread Recipes On The Back Panel)","FR-85999","Philippines","20100000000000","2020-07-01");
insert into Food values(2,"FDA-0048934","Maya All Purpose Flour (With Siopao Recipe On The Back Panel)","FR-86000","Philippines","20100000000000","2020-07-01");
insert into Food values(2,"FDA-0058295","Nestle Nestvit Omega Plus Actitol Nestle Nestvit Omega Plus Actitol Adult Nutritional Beverage (Exclusive For Export To Singapore And Malaysia","FR-78778","Philippines","20100000000000","2020-06-30");
insert into Food values(2,"FDA-0053789","Century Quality Bangus Fillet - Spanish Style","FR-72662","Philippines","20100000000000","2020-06-24");
insert into Food values(2,"FDA-0053790","Century Quality Bangus Fillet With Tausi","FR-72661","Philippines","20100000000000","2020-06-24");
insert into Food values(2,"FDA-0058046","Lucky Me! Special Instant Curly Spaghetti With Yummy Red Sauce","FR-92652","Philippines","20100000000000","2020-05-30");
insert into Food values(2,"FDA-0053824","Homesoy Soya Milk Brown Sugar","FR-110025","Malaysia","20100000000000","2020-05-03");
insert into Food values(2,"FDA-0053823","Homesoy Soya Milk Original","FR-110024","Malaysia","20100000000000","2020-05-03");
insert into Food values(2,"FDA-0055552","Schoko Compound Chocolate - Milk Compound","FR-100353","USA","20100000000000","2020-04-19");
insert into Food values(2,"FDA-0058267","La Preferida La Preferida Tortilla Chips - Yellow Corn","FR-21234","USA","20100000000000","2020-03-11");
insert into Food values(2,"FDA-0058266","La Preferida La Preferida Salsa Picante Mild - Dip and Sauce","FR-21230","USA","20100000000000","2020-03-11");
insert into Manufacturer values(1,"Edward Keller (Philippines) Inc.");
insert into Manufacturer values(2,"Herbs and Natures Corporation");
insert into Manufacturer values(3,"Korean Ginseng Group");
insert into Manufacturer values(4,"Fresenius Kabi Deutschland GmbH");
insert into Manufacturer values(5,"Majestic Food Indsutry Co., Ltd.");
insert into Manufacturer values(6,"Novagen Pharmaceutical Co. Inc.");
insert into Manufacturer values(7,"Northfield Laboratories Inc.");
insert into Manufacturer values(8,"Kontra Pharma (M) Sdn. Bhd.");
insert into Manufacturer values(9,"Liberty Flour Mills, Inc.");
insert into Manufacturer values(10,"Nestle Philippines, Inc.");
insert into Manufacturer values(11,"General Tuna Corporation");
insert into Manufacturer values(12,"Monde Nissin Corporation");
insert into Manufacturer values(13,"Ace Canning Corporation Sdn. Bhd.");
insert into Manufacturer values(14,"PT. Wahana Interfood Nusantra");
insert into Manufacturer values(15,"LP International Inc.");
INSERT INTO Manufacturer VALUES(16,'Best Drug Industries Inc');
INSERT INTO Manufacturer VALUES(17,'Astra');
INSERT INTO Manufacturer VALUES(18,'Lloyd Lab Inc.');
INSERT INTO Manufacturer VALUES(19,'Syncom Formulation Ltd');
INSERT INTO Manufacturer VALUES(20,'Lyka labs Ltd');
INSERT INTO Manufacturer VALUES(21,'XL Labs Pvt Ltd');
INSERT INTO Manufacturer VALUES(22,'Kyungdong Pharma Co., Ltd');
INSERT INTO Manufacturer VALUES(23,"Agio Pharma'l Ltd");
INSERT INTO Manufacturer VALUES(24,'Lloyd Labs Inc');
INSERT INTO Manufacturer VALUES(25,'Stallion Labs Pvt Ltd');

insert into Trader values(1,"Edward Keller (Philippines) Inc.");
insert into Trader values(2,"Herbs and Natures Corporation");
insert into Trader values(3,"Richie Import and Export Trading Ltd., Inc.");
insert into Trader values(4,"Fresenius Kabi Philippines Inc.");
insert into Trader values(5,"Link Import Export Enterprise Inc.");
insert into Trader values(6,"Wert Philippines Inc.");
insert into Trader values(7,"Northfield Laboratories, Inc.");
insert into Trader values(8,"Tokagawa Global Corporation");
insert into Trader values(9,"Liberty Flour Mills, Inc.");
insert into Trader values(10,"Nestle Philippines, Inc.");
insert into Trader values(11,"Century Canning Corporation");
insert into Trader values(12,"Monde Nissin Corporation");
insert into Trader values(13,"JIA2 Corp.");
insert into Trader values(14,"Romar's Manufacturing (Food Dept.)");
INSERT INTO Trader VALUES(15,"First Fil-Bio Import Export Corp.");
INSERT INTO Trader VALUES(16,"Interhealthcare Pharma'l Inc");

INSERT INTO Importer VALUES(1,"AstraZeneca Pharmaceuticals (Phils.) Inc.");
INSERT INTO Importer VALUES(2,"Pharmasan Inc");
INSERT INTO Importer VALUES(3,"Pasteur Pharma'l Sales");
INSERT INTO Importer VALUES(4,"Ambica Int'l Trading Corp");
INSERT INTO Importer VALUES(5,"D.B. Manix Int'l Inc");

INSERT INTO Distributor VALUES(1,"Quinosil Laboratory Inc");
INSERT INTO Distributor VALUES(2,"AstraZeneca Pharmaceuticals (Phils.) Inc.");
INSERT INTO Distributor VALUES(3,"Cris Pharma House");
INSERT INTO Distributor VALUES(4,"DNBG Pharma'l Phils");
INSERT INTO Distributor VALUES(5,"All-Bio Pharma");
INSERT INTO Distributor VALUES(6,"Pharex Health Corp");
INSERT INTO Distributor VALUES(7,"Medirich Pharma Distribution Corp");
INSERT INTO Distributor VALUES(8,"Foramen Products Corp");
INSERT INTO Distributor VALUES(9,"Solvang Pharma'l Inc");
INSERT INTO Distributor VALUES(10,"Altomed Pharma'l Inc");
INSERT INTO Distributor VALUES(11,"Innogen Pharma'l Inc");
INSERT INTO Distributor VALUES(12,"Randril Int'l Co., Inc");
INSERT INTO Distributor VALUES(13,"Wecare Pharma Corp");
INSERT INTO Distributor VALUES(14,"Ambicare Pharma'l Inc");
INSERT INTO Distributor VALUES(15,"GPC Geo Pharma Corp");
INSERT INTO Distributor VALUES(16,"Marzan Pharma Corp");

insert into Manufactures values("0","FDA-0049904",1);
insert into Manufactures values("0","FDA-0057527",2);
insert into Manufactures values("0","FDA-0058293",3);
insert into Manufactures values("0","FDA-0056539",4);
insert into Manufactures values("0","FDA-0058278",5);
insert into Manufactures values("0","FDA-0055616",6);
insert into Manufactures values("0","FDA-0057527",7);
insert into Manufactures values("0","FDA-0057528",8);
insert into Manufactures values("0","FDA-0048937",9);
insert into Manufactures values("0","FDA-0048936",9);
insert into Manufactures values("0","FDA-0048935",9);
insert into Manufactures values("0","FDA-0048934",9);
insert into Manufactures values("0","FDA-0058295",10);
insert into Manufactures values("0","FDA-0053789",11);
insert into Manufactures values("0","FDA-0053790",11);
insert into Manufactures values("0","FDA-0058046",12);
insert into Manufactures values("0","FDA-0053824",13);
insert into Manufactures values("0","FDA-0053823",13);
insert into Manufactures values("0","FDA-0055552",14);
insert into Manufactures values("0","FDA-0058266",15);
insert into Manufactures values("0","FDA-0058267",15);
INSERT INTO Manufactures VALUES("NO-004746",'0',16);
INSERT INTO Manufactures VALUES("DE-000331",'0',17);
INSERT INTO Manufactures VALUES("NO-004749",'0',16);
INSERT INTO Manufactures VALUES("DC-000195",'0',18);
INSERT INTO Manufactures VALUES("NO-004748",'0',16);
INSERT INTO Manufactures VALUES("NO-004391",'0',19);
INSERT INTO Manufactures VALUES("NO-004756",'0',20);
INSERT INTO Manufactures VALUES("NO-004633",'0',21);
INSERT INTO Manufactures VALUES("NO-004673",'0',21);
INSERT INTO Manufactures VALUES("NO-004710",'0',22);
INSERT INTO Manufactures VALUES("NO-004706",'0',22);
INSERT INTO Manufactures VALUES("NO-004708",'0',22);
INSERT INTO Manufactures VALUES("NO-004707",'0',22);
INSERT INTO Manufactures VALUES("NO-004721",'0',22);
INSERT INTO Manufactures VALUES("NO-004723",'0',22);
INSERT INTO Manufactures VALUES("NO-004755",'0',22);
INSERT INTO Manufactures VALUES("NO-004639",'0',23);
INSERT INTO Manufactures VALUES("NO-004486",'0',24);
INSERT INTO Manufactures VALUES("NO-004487",'0',24);
INSERT INTO Manufactures VALUES("NO-004537",'0',25);
INSERT INTO Manufactures VALUES("NO-004538",'0',25);

insert into Trades values("0","FDA-0049904",1);
insert into Trades values("0","FDA-0057527",2);
insert into Trades values("0","FDA-0058293",3);
insert into Trades values("0","FDA-0056539",4);
insert into Trades values("0","FDA-0058278",5);
insert into Trades values("0","FDA-0055616",6);
insert into Trades values("0","FDA-0057527",7);
insert into Trades values("0","FDA-0057528",8);
insert into Trades values("0","FDA-0048937",9);
insert into Trades values("0","FDA-0048936",9);
insert into Trades values("0","FDA-0048935",9);
insert into Trades values("0","FDA-0048934",9);
insert into Trades values("0","FDA-0058295",10);
insert into Trades values("0","FDA-0053789",11);
insert into Trades values("0","FDA-0053790",11);
insert into Trades values("0","FDA-0058046",12);
insert into Trades values("0","FDA-0053824",13);
insert into Trades values("0","FDA-0053823",13);
insert into Trades values("0","FDA-0055552",5);
insert into Trades values("0","FDA-0058266",14);
insert into Trades values("0","FDA-0058267",14);
INSERT INTO Trades VALUES("DC-000195","0",15);
INSERT INTO Trades VALUES("NO-004486","0",16);
INSERT INTO Trades VALUES("NO-004487","0",16);

INSERT INTO Imports VALUES("DE-000331","0",1);
INSERT INTO Imports VALUES("NO-004391","0",2);
INSERT INTO Imports VALUES("NO-004756","0",3);
INSERT INTO Imports VALUES("NO-004633","0",4);
INSERT INTO Imports VALUES("NO-004673","0",4);
INSERT INTO Imports VALUES("NO-004710","0",5);
INSERT INTO Imports VALUES("NO-004706","0",5);
INSERT INTO Imports VALUES("NO-004708","0",5);
INSERT INTO Imports VALUES("NO-004707","0",5);
INSERT INTO Imports VALUES("NO-004721","0",5);
INSERT INTO Imports VALUES("NO-004723","0",5);
INSERT INTO Imports VALUES("NO-004755","0",5);
INSERT INTO Imports VALUES("NO-004639","0",4);
INSERT INTO Imports VALUES("NO-004537","0",4);
INSERT INTO Imports VALUES("NO-004538","0",4);

INSERT INTO Distributes VALUES("NO-004746","0",1);
INSERT INTO Distributes VALUES("DE-000331","0",2);
INSERT INTO Distributes VALUES("NO-004749","0",1);
INSERT INTO Distributes VALUES("NO-004748","0",1);
INSERT INTO Distributes VALUES("NO-004391","0",3);
INSERT INTO Distributes VALUES("NO-004756","0",4);
INSERT INTO Distributes VALUES("NO-004633","0",5);
INSERT INTO Distributes VALUES("NO-004673","0",6);
INSERT INTO Distributes VALUES("NO-004710","0",7);
INSERT INTO Distributes VALUES("NO-004706","0",8);
INSERT INTO Distributes VALUES("NO-004708","0",9);
INSERT INTO Distributes VALUES("NO-004707","0",10);
INSERT INTO Distributes VALUES("NO-004721","0",11);
INSERT INTO Distributes VALUES("NO-004723","0",12);
INSERT INTO Distributes VALUES("NO-004755","0",13);
INSERT INTO Distributes VALUES("NO-004639","0",14);
INSERT INTO Distributes VALUES("NO-004486","0",7);
INSERT INTO Distributes VALUES("NO-004537","0",15);
INSERT INTO Distributes VALUES("NO-004538","0",16);

INSERT INTO Region VALUES ('RID-01', 'NCR');
INSERT INTO Region VALUES ('RID-02', 'CAR');
INSERT INTO Region VALUES ('RID-03', 'REGION I');
INSERT INTO Region VALUES ('RID-04', 'REGION II');
INSERT INTO Region VALUES ('RID-05', 'REGION III');
INSERT INTO Region VALUES ('RID-06', 'REGION IV-A');
INSERT INTO Region VALUES ('RID-07', 'REGION IV-B');
INSERT INTO Region VALUES ('RID-08', 'REGION V');
INSERT INTO Region VALUES ('RID-09', 'REGION VI');
INSERT INTO Region VALUES ('RID-10', 'REGION VII');
INSERT INTO Region VALUES ('RID-11', 'REGION VIII');
INSERT INTO Region VALUES ('RID-12', 'REGION IX');
INSERT INTO Region VALUES ('RID-13', 'REGION X');
INSERT INTO Region VALUES ('RID-14', 'REGION XI');
INSERT INTO Region VALUES ('RID-15', 'REGION XII');
INSERT INTO Region VALUES ('RID-16', 'REGION XIII');
INSERT INTO Region VALUES ('RID-17', 'ARMM');

INSERT INTO School VALUES (3, 'SCID-0001', 'University of the Philippines System', 'RID-01', '(667) 2215286', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0002', 'Philippine Merchant Marine Academy', 'RID-05', '(628) 7754568', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0003', 'MSU - Tawi-Tawi College of Technology and Oceanography', 'RID-14', '(840) 4288563', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0004', 'Adiong Memorial Polytechnic State  College', 'RID-15', '(615) 3219112', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0005', 'Mindanao State University', 'RID-15', '(351) 6464825', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0006', 'Cotabato Foundation College of Science & Tech.', 'RID-15', '(574) 9812516', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0007', 'Don Mariano Marcos Memorial State University', 'RID-03', '(291) 5118210', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0008', 'Tarlac College of Agriculture', 'RID-05', '(710) 7166900', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0009', 'MSU - Iligan Institute of Technology', 'RID-12', '(979) 6378149', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0010', 'Samar State College of Agriculture and Forestry', 'RID-11', '(236) 3987540', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0011', 'Abra State Institute of Science and Technology', 'RID-02', '(355) 8760074', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0012', 'Central Luzon State University', 'RID-05', '(508) 4352459', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0013', 'Central Mindanao University', 'RID-12', '(301) 3824401', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0014', 'Southern Philippines Agri-Business & Marine & Aquatic School of Technology', 'RID-13', '(602) 3031724', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0015', 'Mariano Marcos State University', 'RID-03', '(745) 7906699', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0016', 'Benguet State University', 'RID-02', '(490) 1406782', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0017', 'Iloilo State College of Fisheries', 'RID-09', '(185) 1231843', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0018', 'Davao del Norte State College', 'RID-13', '(537) 7195222', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0019', 'Pampanga Agricultural College', 'RID-05', '(403) 1296490', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0020', 'Misamis Oriental State College of Agriculture & Tech.', 'RID-12', '(629) 2155842', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0021', 'Cotabato City State Polytechnic College', 'RID-15', '(230) 6201223', 'info@suc.edu.ph');

INSERT INTO Course VALUES ('CID-001', 'Applied Physics');
INSERT INTO Course VALUES ('CID-002', 'Biology');
INSERT INTO Course VALUES ('CID-003', 'Broadcast Communication');
INSERT INTO Course VALUES ('CID-004', 'Business Administration');
INSERT INTO Course VALUES ('CID-005', 'Civil Engineering');
INSERT INTO Course VALUES ('CID-006', 'Computer Science');
INSERT INTO Course VALUES ('CID-007', 'Food Technology');
INSERT INTO Course VALUES ('CID-008', 'History');
INSERT INTO Course VALUES ('CID-009', 'Mathematics');
INSERT INTO Course VALUES ('CID-010', 'Political Science');
INSERT INTO Course VALUES ('CID-011', 'Sociology');

INSERT INTO Student VALUES ('SID-00001', 'SCID-0001', 'CID-001', 'Lydia Ratledge', '2000-03-03', 'M', '(971) 7055456', '9 Utah Avenue');
INSERT INTO Student VALUES ('SID-00002', 'SCID-0001', 'CID-002', 'Gratiana Skittle', '2001-06-10', 'Male', '(821) 5013564', '9714 Bayside Hill');
INSERT INTO Student VALUES ('SID-00003', 'SCID-0001', 'CID-003', 'Justin Spratt', '1999-07-31', 'Male', '(111) 6355279', '64303 Harbort Way');
INSERT INTO Student VALUES ('SID-00004', 'SCID-0002', 'CID-004', 'Tessie Littlefield', '1999-02-13', 'Male', '(923) 9614830', '89 Lindbergh Point');
INSERT INTO Student VALUES ('SID-00005', 'SCID-0002', 'CID-005', 'Rutherford Lahiff', '2001-07-25', 'Male', '(476) 5421044', '2 Reindahl Way');
INSERT INTO Student VALUES ('SID-00006', 'SCID-0002', 'CID-006', 'Freeland Sporner', '1998-03-05', 'Male', '(169) 4793608', '7227 Truax Pass');
INSERT INTO Student VALUES ('SID-00007', 'SCID-0003', 'CID-007', 'Tobey Bovaird', '1998-09-04', 'Female', '(849) 7641111', '2185 Nobel Avenue');
INSERT INTO Student VALUES ('SID-00008', 'SCID-0003', 'CID-008', 'Alley Gutowski', '2001-08-16', 'Female', '(574) 6275719', '728 Grayhawk Way');
INSERT INTO Student VALUES ('SID-00009', 'SCID-0003', 'CID-009', 'Codi Rainforth', '2000-04-19', 'Male', '(233) 1338205', '6 Basil Terrace');
INSERT INTO Student VALUES ('SID-00010', 'SCID-0004', 'CID-010', 'Grace Joiris', '2000-01-08', 'Male', '(749) 7019362', '71045 Meadow Ridge Road');
INSERT INTO Student VALUES ('SID-00011', 'SCID-0004', 'CID-011', 'Vickie Kittow', '2001-10-31', 'Female', '(543) 2099171', '918 Farwell Way');
INSERT INTO Student VALUES ('SID-00012', 'SCID-0004', 'CID-001', 'Rudy Enderwick', '1998-10-24', 'Male', '(615) 3219112', '0 Straubel Park');
INSERT INTO Student VALUES ('SID-00013', 'SCID-0005', 'CID-002', 'Lanie Lorkin', '2001-02-25', 'Female', '(667) 2215286', '77 Eagan Park');
INSERT INTO Student VALUES ('SID-00014', 'SCID-0005', 'CID-003', 'Jeff McPhelim', '1999-03-05', 'Male', '(823) 6444164', '85 Butternut Point');
INSERT INTO Student VALUES ('SID-00015', 'SCID-0005', 'CID-004', 'Reta Easton', '2001-03-18', 'Male', '(517) 9780079', '300 Cambridge Circle');
INSERT INTO Student VALUES ('SID-00016', 'SCID-0006', 'CID-005', 'Abrahan Trillo', '1998-07-24', 'Male', '(102) 6266811', '14715 Northland Lane');
INSERT INTO Student VALUES ('SID-00017', 'SCID-0006', 'CID-006', 'Elva Garside', '1998-02-11', 'Male', '(840) 4288563', '36 Carioca Drive');
INSERT INTO Student VALUES ('SID-00018', 'SCID-0006', 'CID-007', 'Neron Keoghan', '1998-11-20', 'Male', '(865) 9029368', '97 Village Junction');
INSERT INTO Student VALUES ('SID-00019', 'SCID-0007', 'CID-008', 'Jammie O''Heaney', '1999-11-26', 'Female', '(295) 7664834', '417 Forest Way');
INSERT INTO Student VALUES ('SID-00020', 'SCID-0007', 'CID-009', 'Ilene Bowsher', '2000-05-18', 'Male', '(213) 4200879', '5323 Grover Junction');
INSERT INTO Student VALUES ('SID-00021', 'SCID-0007', 'CID-010', 'Arin Greggor', '2001-01-28', 'Male', '(638) 3063337', '5284 Fremont Drive');
INSERT INTO Student VALUES ('SID-00022', 'SCID-0008', 'CID-011', 'Salli MacNamee', '1999-02-04', 'Female', '(487) 4546644', '53788 Butternut Drive');
INSERT INTO Student VALUES ('SID-00023', 'SCID-0008', 'CID-001', 'Hamid Purchase', '2000-12-21', 'Female', '(134) 1798347', '194 Barnett Trail');
INSERT INTO Student VALUES ('SID-00024', 'SCID-0008', 'CID-002', 'Jody Pollington', '1999-12-21', 'Female', '(681) 2627361', '678 Kropf Court');
INSERT INTO Student VALUES ('SID-00025', 'SCID-0009', 'CID-003', 'Danya Goundrill', '1999-04-28', 'Female', '(674) 4806830', '878 Bay Place');
INSERT INTO Student VALUES ('SID-00026', 'SCID-0009', 'CID-004', 'Lindie Martt', '2000-04-17', 'Male', '(793) 4305740', '24743 Cottonwood Place');
INSERT INTO Student VALUES ('SID-00027', 'SCID-0009', 'CID-005', 'Vincents Playden', '1997-12-12', 'Male', '(977) 8963314', '73 Mallory Trail');
INSERT INTO Student VALUES ('SID-00028', 'SCID-0010', 'CID-006', 'Ronda Richfield', '1998-12-03', 'Female', '(644) 4793884', '2277 Southridge Place');
INSERT INTO Student VALUES ('SID-00029', 'SCID-0010', 'CID-007', 'Wally Klulisek', '2001-02-15', 'Female', '(628) 7754568', '3 Melvin Hill');
INSERT INTO Student VALUES ('SID-00030', 'SCID-0010', 'CID-008', 'Sheridan Veelers', '1998-04-12', 'Male', '(675) 5524344', '5 Glacier Hill Point');
INSERT INTO Student VALUES ('SID-00031', 'SCID-0011', 'CID-009', 'Kirbie Prickett', '1999-03-11', 'Male', '(240) 8215041', '1593 Bashford Drive');
INSERT INTO Student VALUES ('SID-00032', 'SCID-0011', 'CID-010', 'Ibby Smitheram', '1999-11-22', 'Female', '(345) 5211633', '610 Hermina Alley');
INSERT INTO Student VALUES ('SID-00033', 'SCID-0011', 'CID-011', 'Dominica Andrus', '2000-02-12', 'Female', '(941) 2650588', '017 Butterfield Pass');
INSERT INTO Student VALUES ('SID-00034', 'SCID-0012', 'CID-001', 'Cindee Ruddom', '1999-01-28', 'Female', '(104) 3222289', '2 Fulton Point');
INSERT INTO Student VALUES ('SID-00035', 'SCID-0012', 'CID-002', 'Alla Wickwar', '1999-05-16', 'Male', '(580) 8389991', '178 Gulseth Park');
INSERT INTO Student VALUES ('SID-00036', 'SCID-0012', 'CID-003', 'Llywellyn Spencley', '1998-08-24', 'Male', '(809) 8411565', '5 Moulton Center');
INSERT INTO Student VALUES ('SID-00037', 'SCID-0013', 'CID-004', 'Myrtice Maharg', '1999-06-06', 'Male', '(555) 2759945', '88037 Farmco Park');
INSERT INTO Student VALUES ('SID-00038', 'SCID-0013', 'CID-005', 'Buckie Judge', '2001-04-11', 'Male', '(711) 8599597', '5 Burning Wood Trail');
INSERT INTO Student VALUES ('SID-00039', 'SCID-0013', 'CID-006', 'Joseito Weeks', '1998-02-20', 'Female', '(459) 9461047', '012 Corben Plaza');
INSERT INTO Student VALUES ('SID-00040', 'SCID-0014', 'CID-007', 'Quill Luney', '1999-06-08', 'Male', '(536) 7994810', '5720 Shopko Park');
INSERT INTO Student VALUES ('SID-00041', 'SCID-0014', 'CID-008', 'Ginny Treversh', '2001-11-06', 'Female', '(810) 5189238', '33 Delladonna Place');
INSERT INTO Student VALUES ('SID-00042', 'SCID-0014', 'CID-009', 'Jeddy Craze', '2000-02-16', 'Female', '(793) 4472741', '7142 Haas Junction');
INSERT INTO Student VALUES ('SID-00043', 'SCID-0015', 'CID-010', 'Erhard Rosenfeld', '1999-02-20', 'Female', '(342) 2507183', '6174 Golden Leaf Hill');
INSERT INTO Student VALUES ('SID-00044', 'SCID-0015', 'CID-011', 'Anna Stebbins', '2001-02-15', 'Male', '(291) 5118210', '3 Mccormick Crossing');
INSERT INTO Student VALUES ('SID-00045', 'SCID-0015', 'CID-001', 'Kienan Houdhury', '2000-02-23', 'Male', '(770) 7266883', '6968 Sunfield Hill');
INSERT INTO Student VALUES ('SID-00046', 'SCID-0016', 'CID-002', 'Raymond Bockin', '1999-09-12', 'Female', '(254) 8826328', '63998 Dapin Place');
INSERT INTO Student VALUES ('SID-00047', 'SCID-0016', 'CID-003', 'Pietra Myott', '1999-01-02', 'Male', '(816) 5913721', '5234 Russell Lane');
INSERT INTO Student VALUES ('SID-00048', 'SCID-0016', 'CID-004', 'Vinny Churly', '2001-07-16', 'Male', '(698) 4998593', '469 Blaine Court');
INSERT INTO Student VALUES ('SID-00049', 'SCID-0017', 'CID-005', 'Paulie McGuirk', '1999-01-05', 'Male', '(351) 6464825', '232 Bultman Court');
INSERT INTO Student VALUES ('SID-00050', 'SCID-0017', 'CID-006', 'Bryant Loweth', '1999-07-28', 'Female', '(631) 2128026', '5 Browning Crossing');
INSERT INTO Student VALUES ('SID-00051', 'SCID-0017', 'CID-007', 'Emerson Peachman', '2000-07-31', 'Female', '(509) 3535060', '65733 Dakota Point');
INSERT INTO Student VALUES ('SID-00052', 'SCID-0018', 'CID-008', 'Dael Terbrug', '1999-05-12', 'Male', '(846) 6223201', '90 Starling Hill');
INSERT INTO Student VALUES ('SID-00053', 'SCID-0018', 'CID-009', 'Krysta De Dantesie', '1999-11-17', 'Male', '(404) 8898505', '443 Talisman Road');
INSERT INTO Student VALUES ('SID-00054', 'SCID-0018', 'CID-010', 'Ellery Vela', '1999-05-05', 'Male', '(408) 5013314', '13902 Arizona Street');
INSERT INTO Student VALUES ('SID-00055', 'SCID-0019', 'CID-011', 'Shawna Lockhart', '2001-02-27', 'Male', '(352) 1518518', '333 Birchwood Point');
INSERT INTO Student VALUES ('SID-00056', 'SCID-0019', 'CID-001', 'Eddy Maric', '2000-07-26', 'Male', '(299) 2207717', '7 Shelley Lane');
INSERT INTO Student VALUES ('SID-00057', 'SCID-0019', 'CID-002', 'Carolyne Frissell', '2000-04-24', 'Female', '(195) 9928298', '55267 Glacier Hill Circle');
INSERT INTO Student VALUES ('SID-00058', 'SCID-0020', 'CID-003', 'Trace Kaasmann', '2000-09-29', 'Female', '(467) 2377952', '2663 Hansons Plaza');
INSERT INTO Student VALUES ('SID-00059', 'SCID-0020', 'CID-004', 'Budd Prisley', '1997-11-13', 'Male', '(536) 6324948', '7 Artisan Court');
INSERT INTO Student VALUES ('SID-00060', 'SCID-0020', 'CID-005', 'Griswold Garlette', '2000-03-19', 'Male', '(943) 5104028', '9077 Hauk Terrace');
INSERT INTO Student VALUES ('SID-00061', 'SCID-0021', 'CID-006', 'Bebe Wackly', '2001-07-27', 'Female', '(405) 7095511', '9739 Mallard Street');
INSERT INTO Student VALUES ('SID-00062', 'SCID-0021', 'CID-007', 'Merell Twyford', '1998-12-17', 'Female', '(393) 4257666', '8 Veith Terrace');
INSERT INTO Student VALUES ('SID-00063', 'SCID-0021', 'CID-008', 'Fowler Comins', '1999-04-06', 'Male', '(864) 2142279', '5 Sunfield Pass');

INSERT INTO Enrollment VALUES ('EID-00001', 'SID-00001', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00002', 'SID-00002', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00003', 'SID-00003', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00004', 'SID-00004', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00005', 'SID-00005', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00006', 'SID-00006', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00007', 'SID-00007', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00008', 'SID-00008', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00009', 'SID-00009', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00010', 'SID-00010', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00011', 'SID-00011', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00012', 'SID-00012', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00013', 'SID-00013', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00014', 'SID-00014', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00015', 'SID-00015', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00016', 'SID-00016', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00017', 'SID-00017', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00018', 'SID-00018', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00019', 'SID-00019', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00020', 'SID-00020', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00021', 'SID-00021', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00022', 'SID-00022', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00023', 'SID-00023', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00024', 'SID-00024', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00025', 'SID-00025', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00026', 'SID-00026', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00027', 'SID-00027', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00028', 'SID-00028', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00029', 'SID-00029', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00030', 'SID-00030', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00031', 'SID-00031', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00032', 'SID-00032', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00033', 'SID-00033', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00034', 'SID-00034', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00035', 'SID-00035', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00036', 'SID-00036', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00037', 'SID-00037', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00038', 'SID-00038', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00039', 'SID-00039', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00040', 'SID-00040', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00041', 'SID-00041', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00042', 'SID-00042', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00043', 'SID-00043', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00044', 'SID-00044', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00045', 'SID-00045', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00046', 'SID-00046', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00047', 'SID-00047', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00048', 'SID-00048', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00049', 'SID-00049', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00050', 'SID-00050', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00051', 'SID-00051', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00052', 'SID-00052', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00053', 'SID-00053', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00054', 'SID-00054', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00055', 'SID-00055', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00056', 'SID-00056', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00057', 'SID-00057', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00058', 'SID-00058', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00059', 'SID-00059', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00060', 'SID-00060', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00061', 'SID-00061', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00062', 'SID-00062', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00063', 'SID-00063', 20, 2017, '1', '20000', 'PAID', 'REGULAR');

INSERT INTO Cost_Per_Student VALUES ('SCID-0001', '54000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0002', '59000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0003', '55000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0004', '57000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0005', '58000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0006', '55000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0007', '61000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0008', '54000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0009', '59000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0010', '55000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0011', '57000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0012', '58000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0013', '55000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0014', '61000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0015', '55000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0016', '59000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0017', '55000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0018', '57000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0019', '58000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0020', '55000', '3');
INSERT INTO Cost_Per_Student VALUES ('SCID-0021', '61000', '3');

INSERT INTO Grade_Level VALUES ('GID-01', 'Grade 1');
INSERT INTO Grade_Level VALUES ('GID-02', 'Grade 2');
INSERT INTO Grade_Level VALUES ('GID-03', 'Grade 3');
INSERT INTO Grade_Level VALUES ('GID-04', 'Grade 4');
INSERT INTO Grade_Level VALUES ('GID-05', 'Grade 5');
INSERT INTO Grade_Level VALUES ('GID-06', 'Grade 6');
INSERT INTO Grade_Level VALUES ('GID-07', 'Grade 7');
INSERT INTO Grade_Level VALUES ('GID-08', 'Grade 8');
INSERT INTO Grade_Level VALUES ('GID-09', 'Grade 9');
INSERT INTO Grade_Level VALUES ('GID-10', 'Grade 10');
INSERT INTO Grade_Level VALUES ('GID-11', 'Grade 11');
INSERT INTO Grade_Level VALUES ('GID-12', 'Grade 12');

INSERT INTO Public_Elementary_School VALUES (4, 'PESID-102252', 'RID-03', 'Abanon Central Elementary School');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-103773', 'RID-04', 'Malasin Elementary School');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-105074', 'RID-05', 'Kalawakan Elementary School');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-109719', 'RID-06', 'Ilayang Dupay Elementary School');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-110618', 'RID-07', 'Paraway Mangyan School');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-114537', 'RID-08', 'Gajo Elementary School');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-114681', 'RID-09', 'Batan Elementary School');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-118705', 'RID-10', 'City East Elementary School');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-121314', 'RID-11', 'Guinarona Elementary School');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-125721', 'RID-12', 'Naga Central Elementary School');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-126375', 'RID-13', 'Hagpa Elementary School');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-129180', 'RID-14', 'Causwagan Elementary School');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-131355', 'RID-15', 'Macebolig Integrated School');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-131794', 'RID-16', 'Inagawan Learning Center');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-133754', 'RID-17', 'Calombog Elementary School');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-136393', 'RID-02', 'Bonifacio Elementary school');
INSERT INTO Public_Elementary_School VALUES (4, 'PESID-136624', 'RID-01', 'Tandang Sora IS');

INSERT INTO Offers VALUES ('PESID-102252', 'GID-01', 133);
INSERT INTO Offers VALUES ('PESID-102252', 'GID-02', 131);
INSERT INTO Offers VALUES ('PESID-102252', 'GID-03', 112);
INSERT INTO Offers VALUES ('PESID-102252', 'GID-04', 112);
INSERT INTO Offers VALUES ('PESID-102252', 'GID-05', 115);
INSERT INTO Offers VALUES ('PESID-102252', 'GID-06', 123);
INSERT INTO Offers VALUES ('PESID-103773', 'GID-01', 50);
INSERT INTO Offers VALUES ('PESID-103773', 'GID-02', 49);
INSERT INTO Offers VALUES ('PESID-103773', 'GID-03', 37);
INSERT INTO Offers VALUES ('PESID-103773', 'GID-04', 46);
INSERT INTO Offers VALUES ('PESID-103773', 'GID-05', 49);
INSERT INTO Offers VALUES ('PESID-103773', 'GID-06', 46);
INSERT INTO Offers VALUES ('PESID-105074', 'GID-01', 51);
INSERT INTO Offers VALUES ('PESID-105074', 'GID-02', 57);
INSERT INTO Offers VALUES ('PESID-105074', 'GID-03', 24);
INSERT INTO Offers VALUES ('PESID-105074', 'GID-04', 22);
INSERT INTO Offers VALUES ('PESID-105074', 'GID-05', 19);
INSERT INTO Offers VALUES ('PESID-105074', 'GID-06', 7);
INSERT INTO Offers VALUES ('PESID-109719', 'GID-01', 59);
INSERT INTO Offers VALUES ('PESID-109719', 'GID-02', 63);
INSERT INTO Offers VALUES ('PESID-109719', 'GID-03', 46);
INSERT INTO Offers VALUES ('PESID-109719', 'GID-04', 50);
INSERT INTO Offers VALUES ('PESID-109719', 'GID-05', 42);
INSERT INTO Offers VALUES ('PESID-109719', 'GID-06', 46);
INSERT INTO Offers VALUES ('PESID-110618', 'GID-01', 16);
INSERT INTO Offers VALUES ('PESID-110618', 'GID-02', 14);
INSERT INTO Offers VALUES ('PESID-110618', 'GID-03', 9);
INSERT INTO Offers VALUES ('PESID-110618', 'GID-04', 19);
INSERT INTO Offers VALUES ('PESID-110618', 'GID-05', 19);
INSERT INTO Offers VALUES ('PESID-110618', 'GID-06', 7);
INSERT INTO Offers VALUES ('PESID-114537', 'GID-01', 15);
INSERT INTO Offers VALUES ('PESID-114537', 'GID-02', 8);
INSERT INTO Offers VALUES ('PESID-114537', 'GID-03', 12);
INSERT INTO Offers VALUES ('PESID-114537', 'GID-04', 0);
INSERT INTO Offers VALUES ('PESID-114537', 'GID-05', 9);
INSERT INTO Offers VALUES ('PESID-114537', 'GID-06', 6);
INSERT INTO Offers VALUES ('PESID-114681', 'GID-01', 102);
INSERT INTO Offers VALUES ('PESID-114681', 'GID-02', 93);
INSERT INTO Offers VALUES ('PESID-114681', 'GID-03', 97);
INSERT INTO Offers VALUES ('PESID-114681', 'GID-04', 103);
INSERT INTO Offers VALUES ('PESID-114681', 'GID-05', 83);
INSERT INTO Offers VALUES ('PESID-114681', 'GID-06', 93);
INSERT INTO Offers VALUES ('PESID-118705', 'GID-01', 126);
INSERT INTO Offers VALUES ('PESID-118705', 'GID-02', 137);
INSERT INTO Offers VALUES ('PESID-118705', 'GID-03', 134);
INSERT INTO Offers VALUES ('PESID-118705', 'GID-04', 126);
INSERT INTO Offers VALUES ('PESID-118705', 'GID-05', 115);
INSERT INTO Offers VALUES ('PESID-118705', 'GID-06', 120);
INSERT INTO Offers VALUES ('PESID-121314', 'GID-01', 126);
INSERT INTO Offers VALUES ('PESID-121314', 'GID-02', 137);
INSERT INTO Offers VALUES ('PESID-121314', 'GID-03', 134);
INSERT INTO Offers VALUES ('PESID-121314', 'GID-04', 126);
INSERT INTO Offers VALUES ('PESID-121314', 'GID-05', 115);
INSERT INTO Offers VALUES ('PESID-121314', 'GID-06', 120);
INSERT INTO Offers VALUES ('PESID-125721', 'GID-01', 92);
INSERT INTO Offers VALUES ('PESID-125721', 'GID-02', 83);
INSERT INTO Offers VALUES ('PESID-125721', 'GID-03', 75);
INSERT INTO Offers VALUES ('PESID-125721', 'GID-04', 71);
INSERT INTO Offers VALUES ('PESID-125721', 'GID-05', 76);
INSERT INTO Offers VALUES ('PESID-125721', 'GID-06', 84);
INSERT INTO Offers VALUES ('PESID-126375', 'GID-01', 182);
INSERT INTO Offers VALUES ('PESID-126375', 'GID-02', 232);
INSERT INTO Offers VALUES ('PESID-126375', 'GID-03', 138);
INSERT INTO Offers VALUES ('PESID-126375', 'GID-04', 143);
INSERT INTO Offers VALUES ('PESID-126375', 'GID-05', 145);
INSERT INTO Offers VALUES ('PESID-126375', 'GID-06', 110);
INSERT INTO Offers VALUES ('PESID-129180', 'GID-01', 85);
INSERT INTO Offers VALUES ('PESID-129180', 'GID-02', 67);
INSERT INTO Offers VALUES ('PESID-129180', 'GID-03', 53);
INSERT INTO Offers VALUES ('PESID-129180', 'GID-04', 97);
INSERT INTO Offers VALUES ('PESID-129180', 'GID-05', 42);
INSERT INTO Offers VALUES ('PESID-129180', 'GID-06', 30);
INSERT INTO Offers VALUES ('PESID-131355', 'GID-01', 23);
INSERT INTO Offers VALUES ('PESID-131355', 'GID-02', 23);
INSERT INTO Offers VALUES ('PESID-131355', 'GID-03', 21);
INSERT INTO Offers VALUES ('PESID-131355', 'GID-04', 13);
INSERT INTO Offers VALUES ('PESID-131355', 'GID-05', 16);
INSERT INTO Offers VALUES ('PESID-131355', 'GID-06', 14);
INSERT INTO Offers VALUES ('PESID-131794', 'GID-01', 17);
INSERT INTO Offers VALUES ('PESID-131794', 'GID-02', 24);
INSERT INTO Offers VALUES ('PESID-131794', 'GID-03', 10);
INSERT INTO Offers VALUES ('PESID-131794', 'GID-04', 6);
INSERT INTO Offers VALUES ('PESID-131794', 'GID-05', 4);
INSERT INTO Offers VALUES ('PESID-131794', 'GID-06', 1);
INSERT INTO Offers VALUES ('PESID-133754', 'GID-01', 36);
INSERT INTO Offers VALUES ('PESID-133754', 'GID-02', 31);
INSERT INTO Offers VALUES ('PESID-133754', 'GID-03', 25);
INSERT INTO Offers VALUES ('PESID-133754', 'GID-04', 21);
INSERT INTO Offers VALUES ('PESID-133754', 'GID-05', 22);
INSERT INTO Offers VALUES ('PESID-133754', 'GID-06', 155);
INSERT INTO Offers VALUES ('PESID-136393', 'GID-01', 164);
INSERT INTO Offers VALUES ('PESID-136393', 'GID-02', 166);
INSERT INTO Offers VALUES ('PESID-136393', 'GID-03', 151);
INSERT INTO Offers VALUES ('PESID-136393', 'GID-04', 132);
INSERT INTO Offers VALUES ('PESID-136393', 'GID-05', 121);
INSERT INTO Offers VALUES ('PESID-136393', 'GID-06', 165);
INSERT INTO Offers VALUES ('PESID-136624', 'GID-01', 171);
INSERT INTO Offers VALUES ('PESID-136624', 'GID-02', 136);
INSERT INTO Offers VALUES ('PESID-136624', 'GID-03', 138);
INSERT INTO Offers VALUES ('PESID-136624', 'GID-04', 140);
INSERT INTO Offers VALUES ('PESID-136624', 'GID-05', 160);
INSERT INTO Offers VALUES ('PESID-136624', 'GID-06', 170);


CREATE VIEW suc_Cost_Per_Student AS 
(
  SELECT s.name, r.region_name, TRUNCATE((c.total_tuition / c.num_students), 2) AS cost_per_student 
  FROM School AS s, Cost_Per_Student AS c, Region AS r 
  WHERE s.school_id = c.school_id AND s.region_id = r.region_id
);

/* Generalized SQL Statements
INSERT INTO Drug VALUES( <drug_values>);
UPDATE Drug SET <drug_attribute> = <drug_values> where <condition>;
DELETE FROM Drug where <condition>;
SELECT FROM <Drug_attributes> from Drug where <condition>;


INSERT into Food values(<food_values>);
UPDATE Food set <Food_attribute> = <Food_values> where <condition>;
DELETE FROM Food where <condition>;
SELECT FROM <Food_attribute> from Food where <condition>;

INSERT into Manufacturer values(<manufacturer_values>);
UPDATE Manufacturer set <Manufacturer_attribute> = <manufacturer_values> where <condition>;
DELETE FROM Manufacturer where <condition>;
SELECT FROM <Manufacturer_attribute> from Manufacturer where <condition>;

INSERT into Trader values(<trader_values>);
UPDATE Trader set <Trader_attribute> = <trader_values> where <condition>;
DELETE FROM Trader where <condition>;
SELECT FROM <Trader_attribute> from Trader where <condition>;

INSERT into Importer values(<Importer_values>);
UPDATE Importer set <Importer_attribute> = <Importer_values> where <condition>;
DELETE FROM Importer where <condition>;
SELECT FROM <Importer_attribute> from Importer where <condition>;


INSERT into Distributor values(<distributor_values>);
UPDATE Distributor set <Distributor_attribute> = <distirbutor_values> where <condition>;
DELETE FROM Distributor where <condition>;
SELECT FROM <Distributor_attribute> from Distributor where <condition>;

INSERT into Manufactures values(<manufactures_values>);
UPDATE Manufactures set <Manufactures_attribute> = <manufactures_values> where <condition>;
DELETE FROM Manufactures where <condition>;
SELECT FROM <Manufactures_attribute> from Manufactures where <condition>;

INSERT into Trades values(<trades_values>);
UPDATE Trades set <Trades_attribute> = <trades_values> where <condition>;
DELETE FROM Trades where <condition>;
SELECT FROM <Trades_attribute> from Trades where <condition>;

INSERT into Imports values(<Imports_values>);
UPDATE Importer set <imports_attribute> = <Imports_values> where <condition>;
DELETE FROM Imports where <condition>;
SELECT FROM <Imports_attribute> from Imports where <condition>;


INSERT into Distributes values(<distributes_values>);
UPDATE Distributes set <Distributes_attribute> = <distirbutes_values> where <condition>;
DELETE FROM Distributes where <condition>;
SELECT FROM <Distributes_attribute> from Distributes where <condition>;

INSERT INTO Region values(<Region_values>);
UPDATE Region set <Region_attribute> = <Region_values> where <condition>;
DELETE FROM Region where <condition>;
SELECT FROM <Region_attribute> from Region where <condition>;

INSERT INTO School values(<School_values>);
UPDATE School set <School_attribute> = <School_values> where <condition>;
DELETE FROM School where <condition>;
SELECT FROM <School_attribute> from School where <condition>;

INSERT INTO Course values(<Course_values>);
UPDATE Course set <Course_attribute> = <Course_values> where <condition>;
DELETE FROM Course where <condition>;
SELECT FROM <Course_attribute> from Course where <condition>;

INSERT INTO Student values(<Student_values>);
UPDATE Student set <Student_attribute> = <Student_values> where <condition>;
DELETE FROM Student where <condition>;
SELECT FROM <Student_attribute> from Student where <condition>;

INSERT INTO Enrollment values(<Enrollment_values>);
UPDATE Enrollment set <Enrollment_attribute> = <Enrollment_values> where <condition>;
DELETE FROM Enrollment where <condition>;
SELECT FROM <Enrollment_attribute> from Enrollment where <condition>;

INSERT INTO Cost_Per_Student values(<cps_values>);
UPDATE Cost_Per_Student set <cps_attribute> = <cps_values> where <condition>;
DELETE FROM Cost_Per_Student where <condition>;
SELECT FROM <cps_attribute> from Cost_Per_Student where <condition>;

INSERT INTO Grade_Level values(<Level_values>);
UPDATE Grade_Level set <Level_attribute> = <Level_values> where <condition>;
DELETE FROM Grade_Level where <condition>;
SELECT FROM <Level_attribute> from Grade_Level where <condition>;

INSERT INTO Public_Elementary_School values(<PES_values>);
UPDATE Public_Elementary_School set <PES_attribute> = <PES_values> where <condition>;
DELETE FROM Public_Elementary_School where <condition>;
SELECT FROM <PES_attribute> from Public_Elementary_School where <condition>;

INSERT INTO Offers values(<Offers_values>);
UPDATE Offers set <Offers_attribute> = <Offers_values> where <condition>;
DELETE FROM Offers where <condition>;
SELECT FROM <Offers_attribute> from Offers where <condition>;


-- DEFINITIONS
<imports_values> -> values that follow the data types of the attributes of the Imports table
<imports_attribute> -> attributes/columns of the Import table
<importer_values> -> values that follow the data types of the attributes of the Importer table
<importer_attribute> -> attributes/columns of the Importer table
<drug_values> -> values that follow the data types of the attributes of the Drug table
<Drug_attribute> -> attributes/columns of the Drug table
<food_values> -> values that follow the data types of the attributes of the Food table
<Food_attribute> -> attributes/columns of the Food table
<manufacturer_values> -> values that follow the data types of the attributes of the Manufacturer table
<Manufacturer_attribute> -> attributes/columns of the Manufacturer table
<trader_values> -> values that follow the data types of the attributes of the Trader table
<Trader_attribute> -> attributes/columns of the Trader table
<distributor_values> -> values that follow the data types of the attributes of the Distributor table
<Distributor_attribute> -> attributes/columns of the Distributor table
<manufactures_values> -> values that follow the data types of the attributes of the Manufactures table
<Manufactures_attribute> -> attributes/columns of the Manufactures table
<trades_values> -> values that follow the data types of the attributes of the Trades table
<Trades_attribute> -> attributes/columns of the Trades table
<distributes_values> -> values that follow the data types of the attributes of the Distributes table
<Distributes_attribute> -> attributes/columns of the Distributes table
<Region_values> -> values that follow the data types of the attributes of the Region table
<Region_attribute> -> attributes/columns of the Region table
<School_values> -> values that follow the data types of the attributes of the School table
<School_attribute> -> attributes/columns of the School table
<Course_values> -> values that follow the data types of the attributes of the Course table
<Course_attribute> -> attributes/columns of the Course table
<Student_values> -> values that follow the data types of the attributes of the Student table
<Student_attribute> -> attributes/columns of the Student table
<Enrollment_values> -> values that follow the data types of the attributes of the Enrollment table
<Enrollment_attribute> -> attributes/columns of the Enrollment table
<cps_values> -> values that follow the data types of the attributes of the Cost_Per_Student table
<cps_attribute> -> attributes/columns of the Cost_Per_Student table
<Level_values> -> values that follow the data types of the attributes of the Grade_Level table
<Level_attribute> -> attributes/columns of the Grade_Level table
<PES_values> -> values that follow the data types of the attributes of the Public_Elementary_School table
<PES_attribute> -> attributes/columns of the Public_Elementary_School table
<Offers_values> -> values that follow the data types of the attributes of the Offers table
<Offers_attribute> -> attributes/columns of the Offers table

<condition> -> 
*/
