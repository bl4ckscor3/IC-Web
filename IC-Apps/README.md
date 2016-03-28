#IC-Apps

Application form and  application management for IgneousCraft

----

Setting up the database is essential for this to work:

1. Login to MySQL or similar
2. create database applications;
3. use applications;
4. create table apps (id int not null primary key auto_increment, timestamp text not null, username text not null, age int not null, servertime text not null, experience text not null, why text not null, additionalInfo text not null, state text not null, hidden int not null, score int not null, votes int not null);
5. create table comments (appid int not null, user text not null, comment text not null, timestamp text not null);
6. create table users (username text not null, password text not null, admin int not null);
7. create table restrictions (username text not null);
8. create table votedOn (username text not null, id int not null);
9. create table register (state int not null);
10. insert into register (state) values (1);


(Make user admin: update users set admin=1 where username='INSERT USERNAME HERE';)
