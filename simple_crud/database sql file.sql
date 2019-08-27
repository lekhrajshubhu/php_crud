
create database crudcore;
use crudcore;
create table users(
	id int not null primary key auto_increment,
    name varchar(30) not null,
    address varchar(49) not null,
    email varchar(40) not null,
    phone varchar(10) not null
);
create table persons(
	id int not null primary key auto_increment,
    fullname varchar(30) not null,
    address varchar(49) not null,
    email varchar(40) not null,
    phone varchar(10) not null
);

show tables;
desc users;
desc persons;
select * from persons;