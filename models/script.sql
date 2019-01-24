create database sales;
use sales;

create table product(
  id int auto_increment,
  name varchar(100),
  price int,
  stock int,
  primary key(id),

);

insert into product values(null, 'Salchicha', 180, 20);
insert into product values(null, 'Mortadela', 90, 10);
insert into product values(null, 'Pan', 8, 100);
insert into product values(null, 'Manteca de cerdo', 100, 30);
insert into product values(null, 'Leche', 30, 60);
insert into product values(null, 'Vinagre de manzana', 9, 50);
insert into product values(null, 'Jugo de naranja', 39, 60);
insert into product values(null, 'Dulce de chocolate', 25, 70);

create table sale(
  id int auto_increment,
  fecha datetime,
  total int,
  primary key(id)
);

create table detail(
  id int auto_increment,
  sale_id int,
  product_id int,
  amount int,
  sub_total int,
  primary key (id),
  --foreign key(room) references rooms(id),
  foreign key (sale_id) references sale(id),
  foreign key (product_id) references product(id)
);
