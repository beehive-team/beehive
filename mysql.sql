sudo /Applications/XAMPP/xamppfiles/bin/mysql.server start

alias mysql=/applications/xampp/bin/mysql
/applications/xampp/bin/mysqladmin -u root -p password
mysql -u root -p



create database beehive;

use beehive;

-- 电影分类表
create table bee_mclassify(
	id int unsigned not null auto_increment primary key, 
	name  varchar(255) not null,
	pid int unsigned,
	path varchar(255)
)engine=InnoDB default charset=utf8;

-- 电影表
create table bee_movie(
	id int unsigned not null auto_increment primary key, 
    name varchar(255) not null unique,
    crelease_t varchar(255),
    orelease_t varchar(255),
    director varchar(255),
    writer varchar(255),
    country int unsigned,
    tlong int,
    brief longtext,
    alias varchar(255),
    year int unsigned,
    hot int,
    score int,
    foreign key (country) references bee_mclassify(id) on update cascade on delete restrict,
    foreign key (year) references bee_mclassify(id) on update cascade on delete restrict 
)engine=InnoDB default charset=utf8;

-- 电影_分类映射表
create table bee_m_c(
	id int unsigned not null auto_increment primary key, 
	m_id int unsigned,
	c_id int unsigned,
	foreign key (m_id) references bee_movie(id) on update cascade on delete restrict,
	foreign key (c_id) references bee_mclassify(id) on update cascade on delete restrict
)engine=InnoDB default charset=utf8;

-- 电影标签表
create table bee_mtag(
	id int unsigned not null auto_increment primary key, 
	name varchar(255)
)engine=InnoDB default charset=utf8;

-- 电影标签映射表
create table bee_m_t(
	id int unsigned not null auto_increment primary key, 
	m_id int unsigned,
	t_id int unsigned,
	foreign key (m_id) references bee_movie(id) on update cascade on delete restrict,
	foreign key (t_id) references bee_mtag(id) on update cascade on delete restrict

)engine=InnoDB default charset=utf8;

-- 电影图片表
create table bee_mimage(
	id int unsigned not null auto_increment primary key,
	name varchar(255),
	m_id int unsigned,
	is_cover tinyint default 0,
	foreign key (m_id) references bee_movie(id) on update cascade on delete restrict
)engine=InnoDB default charset=utf8;

-- 图书分类表
create table bee_bclassify(
	id int unsigned not null auto_increment primary key, 
	name  varchar(255) not null,
	pid int unsigned,
	path varchar(255)
)engine=InnoDB default charset=utf8;

-- 图书分类
create table bee_bclassify(
	id int unsigned not null auto_increment primary key, 
	name  varchar(255) not null,
	pid int unsigned,
	path varchar(255)
)engine=InnoDB default charset=utf8;

-- 图书表
create table bee_book(
	id int unsigned not null auto_increment primary key, 
    name varchar(255) not null unique,
    release_t varchar(255),
    writer varchar(255),
    publisher varchar(255),
    isbn varchar(255),
    translater varchar(255),
   	brief longtext,
   	w_brief longtext,
   	book_cover varchar(255),
   	hot int
)engine=InnoDB default charset=utf8;

-- 图书分类映射表
create table bee_b_c(
	id int unsigned not null auto_increment primary key, 
	b_id int unsigned,
	c_id int unsigned,
	foreign key (b_id) references bee_book(id) on update cascade on delete restrict,
	foreign key (c_id) references bee_bclassify(id) on update cascade on delete restrict
)engine=InnoDB default charset=utf8;

--图书标签表
create table bee_btag(
	id int unsigned not null auto_increment primary key, 
	name varchar(255),
	path varchar(255),
	pid int unsigned
)engine=InnoDB default charset=utf8;

-- 图书标签映射表
create table bee_b_t(
	id int unsigned not null auto_increment primary key, 
	b_id int unsigned,
	t_id int unsigned,
	foreign key (b_id) references bee_book(id) on update cascade on delete restrict,
	foreign key (t_id) references bee_btag(id) on update cascade on delete restrict

)engine=InnoDB default charset=utf8;

-- 图书图片表
create table bee_bimage(
	id int unsigned not null auto_increment primary key,
	name varchar(255),
	b_id int unsigned,
	is_cover tinyint default 0,
	foreign key (b_id) references bee_book(id) on update cascade on delete restrict
)engine=InnoDB default charset=utf8;