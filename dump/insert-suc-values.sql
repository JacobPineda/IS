--SUC INSERT STATEMENTS
INSERT INTO Region VALUES ('RID-01', 'NCR');
INSERT INTO Region VALUES ('RID-02', 'C A R');
INSERT INTO Region VALUES ('RID-03', 'REGION I');
INSERT INTO Region VALUES ('RID-04', 'REGION III');
INSERT INTO Region VALUES ('RID-05', 'REGION VI');
INSERT INTO Region VALUES ('RID-06', 'REGION VIII');
INSERT INTO Region VALUES ('RID-07', 'REGION IX (ARMM)');
INSERT INTO Region VALUES ('RID-08', 'REGION X')
INSERT INTO Region VALUES ('RID-09', 'REGION XI');
INSERT INTO Region VALUES ('RID-10', 'REGION XII (ARMM)');
INSERT INTO Region VALUES ('RID-11', 'REGION XII (Main)');

INSERT INTO School VALUES (3, 'SCID-0001', 'University of the Philippines System', 'RID-01', '(667) 2215286', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0002', 'Philippine Merchant Marine Academy', 'RID-04', '(628) 7754568', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0003', 'MSU - Tawi-Tawi College of Technology and Oceanography', 'RID-07', '(840) 4288563', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0004', 'Adiong Memorial Polytechnic State  College', 'RID-10', '(615) 3219112', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0005', 'Mindanao State University', 'RID-10', '(351) 6464825', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0006', 'Cotabato Foundation College of Science & Tech.', 'RID-11', '(574) 9812516', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0007', 'Don Mariano Marcos Memorial State University', 'RID-03', '(291) 5118210', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0008', 'Tarlac College of Agriculture', 'RID-04', '(710) 7166900', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0009', 'MSU - Iligan Institute of Technology', 'RID-08', '(979) 6378149', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0010', 'Samar State College of Agriculture and Forestry', 'RID-06', '(236) 3987540', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0011', 'Abra State Institute of Science and Technology', 'RID-02', '(355) 8760074', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0012', 'Central Luzon State University', 'RID-04', '(508) 4352459', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0013', 'Central Mindanao University', 'RID-08', '(301) 3824401', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0014', 'Southern Philippines Agri-Business & Marine & Aquatic School of Technology', 'RID-09', '(602) 3031724', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0015', 'Mariano Marcos State University', 'RID-03', '(745) 7906699', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0016', 'Benguet State University', 'RID-02', '(490) 1406782', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0017', 'Iloilo State College of Fisheries', 'RID-05', '(185) 1231843', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0018', 'Davao del Norte State College', 'RID-09', '(537) 7195222', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0019', 'Pampanga Agricultural College', 'RID-04', '(403) 1296490', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0020', 'Misamis Oriental State College of Agriculture & Tech.', 'RID-08', '(629) 2155842', 'info@suc.edu.ph');
INSERT INTO School VALUES (3, 'SCID-0021', 'Cotabato City State Polytechnic College', 'RID-11', '(230) 6201223', 'info@suc.edu.ph');

INSERT INTO Student VALUES ('SID-00001', '3', 'SCID-001', 'CID-001', 'Lydia Ratledge', '2000-03-03', 'Male', '(971) 7055456', '9 Utah Avenue');
INSERT INTO Student VALUES ('SID-00002', '3', 'SCID-001', 'CID-002', 'Gratiana Skittle', '2001-06-10', 'Male', '(821) 5013564', '9714 Bayside Hill');
INSERT INTO Student VALUES ('SID-00003', '3', 'SCID-001', 'CID-003', 'Justin Spratt', '1999-07-31', 'Male', '(111) 6355279', '64303 Harbort Way');
INSERT INTO Student VALUES ('SID-00004', '3', 'SCID-002', 'CID-004', 'Tessie Littlefield', '1999-02-13', 'Male', '(923) 9614830', '89 Lindbergh Point');
INSERT INTO Student VALUES ('SID-00005', '3', 'SCID-002', 'CID-005', 'Rutherford Lahiff', '2001-07-25', 'Male', '(476) 5421044', '2 Reindahl Way');
INSERT INTO Student VALUES ('SID-00006', '3', 'SCID-002', 'CID-006', 'Freeland Sporner', '1998-03-05', 'Male', '(169) 4793608', '7227 Truax Pass');
INSERT INTO Student VALUES ('SID-00007', '3', 'SCID-003', 'CID-007', 'Tobey Bovaird', '1998-09-04', 'Female', '(849) 7641111', '2185 Nobel Avenue');
INSERT INTO Student VALUES ('SID-00008', '3', 'SCID-003', 'CID-008', 'Alley Gutowski', '2001-08-16', 'Female', '(574) 6275719', '728 Grayhawk Way');
INSERT INTO Student VALUES ('SID-00009', '3', 'SCID-003', 'CID-009', 'Codi Rainforth', '2000-04-19', 'Male', '(233) 1338205', '6 Basil Terrace');
INSERT INTO Student VALUES ('SID-00010', '3', 'SCID-004', 'CID-010', 'Grace Joiris', '2000-01-08', 'Male', '(749) 7019362', '71045 Meadow Ridge Road');
INSERT INTO Student VALUES ('SID-00011', '3', 'SCID-004', 'CID-011', 'Vickie Kittow', '2001-10-31', 'Female', '(543) 2099171', '918 Farwell Way');
INSERT INTO Student VALUES ('SID-00012', '3', 'SCID-004', 'CID-001', 'Rudy Enderwick', '1998-10-24', 'Male', '(615) 3219112', '0 Straubel Park');
INSERT INTO Student VALUES ('SID-00013', '3', 'SCID-005', 'CID-002', 'Lanie Lorkin', '2001-02-25', 'Female', '(667) 2215286', '77 Eagan Park');
INSERT INTO Student VALUES ('SID-00014', '3', 'SCID-005', 'CID-003', 'Jeff McPhelim', '1999-03-05', 'Male', '(823) 6444164', '85 Butternut Point');
INSERT INTO Student VALUES ('SID-00015', '3', 'SCID-005', 'CID-004', 'Reta Easton', '2001-03-18', 'Male', '(517) 9780079', '300 Cambridge Circle');
INSERT INTO Student VALUES ('SID-00016', '3', 'SCID-006', 'CID-005', 'Abrahan Trillo', '1998-07-24', 'Male', '(102) 6266811', '14715 Northland Lane');
INSERT INTO Student VALUES ('SID-00017', '3', 'SCID-006', 'CID-006', 'Elva Garside', '1998-02-11', 'Male', '(840) 4288563', '36 Carioca Drive');
INSERT INTO Student VALUES ('SID-00018', '3', 'SCID-006', 'CID-007', 'Neron Keoghan', '1998-11-20', 'Male', '(865) 9029368', '97 Village Junction');
INSERT INTO Student VALUES ('SID-00019', '3', 'SCID-007', 'CID-008', 'Jammie O''Heaney', '1999-11-26', 'Female', '(295) 7664834', '417 Forest Way');
INSERT INTO Student VALUES ('SID-00020', '3', 'SCID-007', 'CID-009', 'Ilene Bowsher', '2000-05-18', 'Male', '(213) 4200879', '5323 Grover Junction');
INSERT INTO Student VALUES ('SID-00021', '3', 'SCID-007', 'CID-010', 'Arin Greggor', '2001-01-28', 'Male', '(638) 3063337', '5284 Fremont Drive');
INSERT INTO Student VALUES ('SID-00022', '3', 'SCID-008', 'CID-011', 'Salli MacNamee', '1999-02-04', 'Female', '(487) 4546644', '53788 Butternut Drive');
INSERT INTO Student VALUES ('SID-00023', '3', 'SCID-008', 'CID-001', 'Hamid Purchase', '2000-12-21', 'Female', '(134) 1798347', '194 Barnett Trail');
INSERT INTO Student VALUES ('SID-00024', '3', 'SCID-008', 'CID-002', 'Jody Pollington', '1999-12-21', 'Female', '(681) 2627361', '678 Kropf Court');
INSERT INTO Student VALUES ('SID-00025', '3', 'SCID-009', 'CID-003', 'Danya Goundrill', '1999-04-28', 'Female', '(674) 4806830', '878 Bay Place');
INSERT INTO Student VALUES ('SID-00026', '3', 'SCID-009', 'CID-004', 'Lindie Martt', '2000-04-17', 'Male', '(793) 4305740', '24743 Cottonwood Place');
INSERT INTO Student VALUES ('SID-00027', '3', 'SCID-009', 'CID-005', 'Vincents Playden', '1997-12-12', 'Male', '(977) 8963314', '73 Mallory Trail');
INSERT INTO Student VALUES ('SID-00028', '3', 'SCID-010', 'CID-006', 'Ronda Richfield', '1998-12-03', 'Female', '(644) 4793884', '2277 Southridge Place');
INSERT INTO Student VALUES ('SID-00029', '3', 'SCID-010', 'CID-007', 'Wally Klulisek', '2001-02-15', 'Female', '(628) 7754568', '3 Melvin Hill');
INSERT INTO Student VALUES ('SID-00030', '3', 'SCID-010', 'CID-008', 'Sheridan Veelers', '1998-04-12', 'Male', '(675) 5524344', '5 Glacier Hill Point');
INSERT INTO Student VALUES ('SID-00031', '3', 'SCID-011', 'CID-009', 'Kirbie Prickett', '1999-03-11', 'Male', '(240) 8215041', '1593 Bashford Drive');
INSERT INTO Student VALUES ('SID-00032', '3', 'SCID-011', 'CID-010', 'Ibby Smitheram', '1999-11-22', 'Female', '(345) 5211633', '610 Hermina Alley');
INSERT INTO Student VALUES ('SID-00033', '3', 'SCID-011', 'CID-011', 'Dominica Andrus', '2000-02-12', 'Female', '(941) 2650588', '017 Butterfield Pass');
INSERT INTO Student VALUES ('SID-00034', '3', 'SCID-012', 'CID-001', 'Cindee Ruddom', '1999-01-28', 'Female', '(104) 3222289', '2 Fulton Point');
INSERT INTO Student VALUES ('SID-00035', '3', 'SCID-012', 'CID-002', 'Alla Wickwar', '1999-05-16', 'Male', '(580) 8389991', '178 Gulseth Park');
INSERT INTO Student VALUES ('SID-00036', '3', 'SCID-012', 'CID-003', 'Llywellyn Spencley', '1998-08-24', 'Male', '(809) 8411565', '5 Moulton Center');
INSERT INTO Student VALUES ('SID-00037', '3', 'SCID-013', 'CID-004', 'Myrtice Maharg', '1999-06-06', 'Male', '(555) 2759945', '88037 Farmco Park');
INSERT INTO Student VALUES ('SID-00038', '3', 'SCID-013', 'CID-005', 'Buckie Judge', '2001-04-11', 'Male', '(711) 8599597', '5 Burning Wood Trail');
INSERT INTO Student VALUES ('SID-00039', '3', 'SCID-013', 'CID-006', 'Joseito Weeks', '1998-02-20', 'Female', '(459) 9461047', '012 Corben Plaza');
INSERT INTO Student VALUES ('SID-00040', '3', 'SCID-014', 'CID-007', 'Quill Luney', '1999-06-08', 'Male', '(536) 7994810', '5720 Shopko Park');
INSERT INTO Student VALUES ('SID-00041', '3', 'SCID-014', 'CID-008', 'Ginny Treversh', '2001-11-06', 'Female', '(810) 5189238', '33 Delladonna Place');
INSERT INTO Student VALUES ('SID-00042', '3', 'SCID-014', 'CID-009', 'Jeddy Craze', '2000-02-16', 'Female', '(793) 4472741', '7142 Haas Junction');
INSERT INTO Student VALUES ('SID-00043', '3', 'SCID-015', 'CID-010', 'Erhard Rosenfeld', '1999-02-20', 'Female', '(342) 2507183', '6174 Golden Leaf Hill');
INSERT INTO Student VALUES ('SID-00044', '3', 'SCID-015', 'CID-011', 'Anna Stebbins', '2001-02-15', 'Male', '(291) 5118210', '3 Mccormick Crossing');
INSERT INTO Student VALUES ('SID-00045', '3', 'SCID-015', 'CID-001', 'Kienan Houdhury', '2000-02-23', 'Male', '(770) 7266883', '6968 Sunfield Hill');
INSERT INTO Student VALUES ('SID-00046', '3', 'SCID-016', 'CID-002', 'Raymond Bockin', '1999-09-12', 'Female', '(254) 8826328', '63998 Dapin Place');
INSERT INTO Student VALUES ('SID-00047', '3', 'SCID-016', 'CID-003', 'Pietra Myott', '1999-01-02', 'Male', '(816) 5913721', '5234 Russell Lane');
INSERT INTO Student VALUES ('SID-00048', '3', 'SCID-016', 'CID-004', 'Vinny Churly', '2001-07-16', 'Male', '(698) 4998593', '469 Blaine Court');
INSERT INTO Student VALUES ('SID-00049', '3', 'SCID-017', 'CID-005', 'Paulie McGuirk', '1999-01-05', 'Male', '(351) 6464825', '232 Bultman Court');
INSERT INTO Student VALUES ('SID-00050', '3', 'SCID-017', 'CID-006', 'Bryant Loweth', '1999-07-28', 'Female', '(631) 2128026', '5 Browning Crossing');
INSERT INTO Student VALUES ('SID-00051', '3', 'SCID-017', 'CID-007', 'Emerson Peachman', '2000-07-31', 'Female', '(509) 3535060', '65733 Dakota Point');
INSERT INTO Student VALUES ('SID-00052', '3', 'SCID-018', 'CID-008', 'Dael Terbrug', '1999-05-12', 'Male', '(846) 6223201', '90 Starling Hill');
INSERT INTO Student VALUES ('SID-00053', '3', 'SCID-018', 'CID-009', 'Krysta De Dantesie', '1999-11-17', 'Male', '(404) 8898505', '443 Talisman Road');
INSERT INTO Student VALUES ('SID-00054', '3', 'SCID-018', 'CID-010', 'Ellery Vela', '1999-05-05', 'Male', '(408) 5013314', '13902 Arizona Street');
INSERT INTO Student VALUES ('SID-00055', '3', 'SCID-019', 'CID-011', 'Shawna Lockhart', '2001-02-27', 'Male', '(352) 1518518', '333 Birchwood Point');
INSERT INTO Student VALUES ('SID-00056', '3', 'SCID-019', 'CID-001', 'Eddy Maric', '2000-07-26', 'Male', '(299) 2207717', '7 Shelley Lane');
INSERT INTO Student VALUES ('SID-00057', '3', 'SCID-019', 'CID-002', 'Carolyne Frissell', '2000-04-24', 'Female', '(195) 9928298', '55267 Glacier Hill Circle');
INSERT INTO Student VALUES ('SID-00058', '3', 'SCID-020', 'CID-003', 'Trace Kaasmann', '2000-09-29', 'Female', '(467) 2377952', '2663 Hansons Plaza');
INSERT INTO Student VALUES ('SID-00059', '3', 'SCID-020', 'CID-004', 'Budd Prisley', '1997-11-13', 'Male', '(536) 6324948', '7 Artisan Court');
INSERT INTO Student VALUES ('SID-00060', '3', 'SCID-020', 'CID-005', 'Griswold Garlette', '2000-03-19', 'Male', '(943) 5104028', '9077 Hauk Terrace');
INSERT INTO Student VALUES ('SID-00061', '3', 'SCID-021', 'CID-006', 'Bebe Wackly', '2001-07-27', 'Female', '(405) 7095511', '9739 Mallard Street');
INSERT INTO Student VALUES ('SID-00062', '3', 'SCID-021', 'CID-007', 'Merell Twyford', '1998-12-17', 'Female', '(393) 4257666', '8 Veith Terrace');
INSERT INTO Student VALUES ('SID-00063', '3', 'SCID-021', 'CID-008', 'Fowler Comins', '1999-04-06', 'Male', '(864) 2142279', '5 Sunfield Pass');

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

INSERT INTO Enrollment VALUES ('EID-00001', 'SID-00001', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00001', 'SID-00002', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00001', 'SID-00003', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00002', 'SID-00004', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00002', 'SID-00005', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00002', 'SID-00006', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00003', 'SID-00007', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00003', 'SID-00008', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00003', 'SID-00009', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00004', 'SID-00010', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00004', 'SID-00011', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00004', 'SID-00012', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00005', 'SID-00013', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00005', 'SID-00014', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00005', 'SID-00015', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00006', 'SID-00016', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00006', 'SID-00017', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00006', 'SID-00018', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00007', 'SID-00019', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00007', 'SID-00020', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00007', 'SID-00021', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00008', 'SID-00022', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00008', 'SID-00023', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00008', 'SID-00024', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00009', 'SID-00025', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00009', 'SID-00026', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00009', 'SID-00027', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00010', 'SID-00028', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00010', 'SID-00029', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00010', 'SID-00030', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00011', 'SID-00031', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00011', 'SID-00032', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00011', 'SID-00033', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00012', 'SID-00034', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00012', 'SID-00035', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00012', 'SID-00036', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00013', 'SID-00037', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00013', 'SID-00038', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00013', 'SID-00039', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00014', 'SID-00040', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00014', 'SID-00041', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00014', 'SID-00042', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00015', 'SID-00043', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00015', 'SID-00044', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00015', 'SID-00045', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00016', 'SID-00046', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00016', 'SID-00047', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00016', 'SID-00048', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00017', 'SID-00049', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00017', 'SID-00050', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00017', 'SID-00051', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00018', 'SID-00052', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00018', 'SID-00053', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00018', 'SID-00054', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00019', 'SID-00055', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00019', 'SID-00056', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00019', 'SID-00057', 17, 2017, '1', '17000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00020', 'SID-00058', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00020', 'SID-00059', 19, 2017, '1', '19000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00020', 'SID-00060', 18, 2017, '1', '18000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00021', 'SID-00061', 20, 2017, '1', '20000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00021', 'SID-00062', 21, 2017, '1', '21000', 'PAID', 'REGULAR');
INSERT INTO Enrollment VALUES ('EID-00021', 'SID-00063', 20, 2017, '1', '20000', 'PAID', 'REGULAR');

INSERT INTO costPerStudent VALUES ('EID-0001', 'SCID-0001', '54000', '3');
INSERT INTO costPerStudent VALUES ('EID-0002', 'SCID-0002', '59000', '3');
INSERT INTO costPerStudent VALUES ('EID-0003', 'SCID-0003', '55000', '3');
INSERT INTO costPerStudent VALUES ('EID-0004', 'SCID-0004', '57000', '3');
INSERT INTO costPerStudent VALUES ('EID-0005', 'SCID-0005', '58000', '3');
INSERT INTO costPerStudent VALUES ('EID-0006', 'SCID-0006', '55000', '3');
INSERT INTO costPerStudent VALUES ('EID-0007', 'SCID-0007', '61000', '3');
INSERT INTO costPerStudent VALUES ('EID-0008', 'SCID-0008', '54000', '3');
INSERT INTO costPerStudent VALUES ('EID-0009', 'SCID-0009', '59000', '3');
INSERT INTO costPerStudent VALUES ('EID-0010', 'SCID-0010', '55000', '3');
INSERT INTO costPerStudent VALUES ('EID-0011', 'SCID-0011', '57000', '3');
INSERT INTO costPerStudent VALUES ('EID-0012', 'SCID-0012', '58000', '3');
INSERT INTO costPerStudent VALUES ('EID-0013', 'SCID-0013', '55000', '3');
INSERT INTO costPerStudent VALUES ('EID-0014', 'SCID-0014', '61000', '3');
INSERT INTO costPerStudent VALUES ('EID-0015', 'SCID-0015', '55000', '3');
INSERT INTO costPerStudent VALUES ('EID-0016', 'SCID-0016', '59000', '3');
INSERT INTO costPerStudent VALUES ('EID-0017', 'SCID-0017', '55000', '3');
INSERT INTO costPerStudent VALUES ('EID-0018', 'SCID-0018', '57000', '3');
INSERT INTO costPerStudent VALUES ('EID-0019', 'SCID-0019', '58000', '3');
INSERT INTO costPerStudent VALUES ('EID-0020', 'SCID-0020', '55000', '3');
INSERT INTO costPerStudent VALUES ('EID-0021', 'SCID-0021', '61000', '3');
