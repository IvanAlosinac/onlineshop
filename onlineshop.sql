drop database if exists onlineshop;
create database onlineshop character set utf8 collate utf8_general_ci;
use onlineshop; 
/* alter database onlineshop character set utf8 collate utf8_general_ci; */

create table user(
id int not null primary key auto_increment,
companyname varchar(50),
firstname varchar(20) not null,
surname varchar(50) not null,
homeaddress varchar(100) not null,
phone varchar(50) not null,
email varchar(50) not null,
userpassword varchar(60) not null
);

create table product(
id int not null primary key auto_increment,
productname varchar(30) not null,
productdescription varchar(100) not null,
priceperpiece decimal(10,2) not null,
stock int not null,
category int not null,
productimage varchar(50) not null
);

create table orderproduct(
id int not null primary key auto_increment,
orderdate datetime not null,
user int not null
);

#create table price(
#id int not null primary key auto_increment,
#quantity varchar(20) not null,
#price decimal(10,2)
#);

create table category(
id int not null primary key auto_increment,
categoryname varchar(30) 
);

create table product_order(
product int not null,
orderproduct int not null
);

#create table product_price(
#product int not null,
#price int not null
#);

alter table orderproduct add foreign key (user) references user(id);

alter table product_order add foreign key (orderproduct) references orderproduct(id);
alter table product_order add foreign key (product) references product(id);

alter table product add foreign key (category) references category(id);

#alter table product_price add foreign key (product) references product(id);
#alter table product_price add foreign key (price) references price(id);
 
#1 unos podataka

 insert into category(id,categoryname) values 
(null,'Božuri'),
(null,'Ostalo rezano cvijeće');

#insert into price (id,quantity,priceperpiece) values
#(null,'1+',6.00),
#(null,'20+',5.00),
#(null,'100+',4.00);

insert into user (id,companyname,firstname,surname,homeaddress,phone,email,userpassword) values
(null,'OPG Alošinac','Ivan','Alošinac','Braće Radić 14, Belišće','091/5687 235, 031/597 265','alosinac111@gmail.com','$2y$10$hrFObWL/4l7Zjoxhe981xet9X0Qv82zNAAhv22GSJHIKAquXtPbxq'),
(null,'Cvjećara Flores','Dražen','Dražić','Bosutska 6, Osijek','091/568 2511','floresinfo@gmail.com','doS48f'),
(null,'Cvjećara Artist','Pero','Đurić','Matije Gupca, Sikirevci','091/5687 235, 031/597 265','p.djuric@gmail.com','38fA3P');

#2 unos podataka

insert into product (id,productname,productdescription,priceperpiece,stock,category,productimage) values
(null,'Coral Charm','Boja:Koraljna',6.00,2500,1,'CoralC.jpg'),
(null,'Karl Rosenfield','Boja:tamno crvena',6.00,3000,1,'KarlR.jpg'),
(null,'Sarah Bernhardt','Boja:ružićasta',6.00,6000,1,'SarahBB.jpg'),
(null,'Duchesse de Nemours','Boja:bijela',7.00,500,1,'DuchesseN.jpg'),
(null,'Ranunculus','Boja:višebojni',1.50,1500,2,'Ranunculus.jpg');

insert into orderproduct (id,orderdate,user) values
(null,'2019-02-23',1),
(null,'2019-02-26',2),
(null,'2019-03-05',1);

#3 unos podataka

insert into product_order (product,orderproduct) values
(1,1),(2,1),(3,1),
(1,2),(3,2),(4,2),
(2,3),(3,3),(4,3);

    create table operater(
	sifra int not null primary key auto_increment,
	ime varchar(50) not null,
	prezime varchar(50) not null,
	email varchar(100) not null,
	lozinka char(60) not null
);

insert into operater (ime,prezime,email,lozinka) values
(
	'Ivan',
	'Alosinac',
	'alosinac111@gmail.com',
	'$2y$10$hrFObWL/4l7Zjoxhe981xet9X0Qv82zNAAhv22GSJHIKAquXtPbxq'

); 





select 'Gotov sam';
 


