CREATE schema sm default CHARACTER SET utf8 COLLATE utf8_general_ci;

USE sm;

create table cartao(
c_id int not null primary key auto_increment,
c_token varchar(50) unique not null
);

create table transacao(
t_id int not null primary key auto_increment,
c_id int references cartao(c_id),
t_valor decimal(10,2) not null default 0,
t_tipo boolean not null,
t_horario timestamp default now()
);
