create table users (
    -> user_id int not null primary key auto_increment,
    -> name varchar(255) not null,
    -> username varchar(255) not null,
    -> email varchar(255) not null,
    -> password text not null,
    -> is_admin int(1)
);