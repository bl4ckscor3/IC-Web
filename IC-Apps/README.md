#IC-Apps

Application form and  application management for IgneousCraft

----

Setting up the database is essential for this to work:

Login to MySQL or similar
create database applications;
use applications;
create table apps (id int not null primary key auto_increment, timestamp text not null, username text not null, age int not null, servertime text not null, experience text not null, why text not null, additionalInfo text not null, state text not null, hidden int not null, score int not null, votes int not null);
create table comments (appid int not null, user text not null, comment text not null, timestamp text not null);
create table users (username text not null, password text not null, admin int not null);
create table restrictions (username text not null);
create table votedOn (username text not null, id int not null);
create table register (state int not null);
insert into register (state) values (1);


(Make user admin: update users set admin=1 where username='INSERT USERNAME HERE';)
