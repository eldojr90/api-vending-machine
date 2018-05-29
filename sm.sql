/*
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
t_tipo smallint not null,
t_horario timestamp default now()
);

INSERT INTO cartao(c_token) VALUES 
('f7d2186e4bbbe8512b425407cce6d193e59795a0'),
('1512d2a4035a3457d4805a81e47360f256bda7e1'),
('af8c4538bf831133a86293fc91658e094bcd8ab4'),
('943d40f0a5dd68b9e833398cb13fd54298a114d6'),
('7ac71ff635ee312b0cfaa555ca8deeabb62f8584');
*/