create table user
(
	id int auto_increment,
	name varchar(255) null,
	password varchar(255) null,
	constraint user_pk
		primary key (id)
);

create unique index user_name_uindex
	on user (name);


INSERT INTO testWork.user (id, name, password) VALUES (1, 'hello', 'world');
INSERT INTO testWork.user (id, name, password) VALUES (2, 'Sanya', 'secret');
INSERT INTO testWork.user (id, name, password) VALUES (3, 'Vanya', 'secret');