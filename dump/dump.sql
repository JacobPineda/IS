create table Admin(admin_id int, username varchar(50), password varchar(50), primary key(admin_id, username));
insert into admin values (1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

create table Industry(industry_id int, name varchar(50), primary key(industry_id));
insert into industry values (1, 'School');
insert into industry values (2, 'Product');

create table Biological( industry_id int, cpr_no varchar(50), dr_no varchar(50), country varchar(50), rsn varchar(50), validity_date date);

insert into biological values (1, 'DB-007939', 'BR-935', 'Germany', 'CDRR2013-0502-281420140626083249', '1/16/2019');
insert into biological values (2, 'DB-007923', 'BR-934', 'Germany', 'CDRR2013-0508-3004', '1/16/2019');