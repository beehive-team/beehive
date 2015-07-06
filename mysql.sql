sudo /Applications/XAMPP/xamppfiles/bin/mysql.server start

alias mysql=/applications/xampp/bin/mysql
/applications/xampp/bin/mysqladmin -u root -p password
mysql -u root -p



create database beehive;

use beehive;

-- 电影分类表
create table bee_mclassify(
	id int unsigned not null auto_increment primary key, 
	name  varchar(255) not null,    -- 分类名
	pid int unsigned,               -- 父id
	path varchar(255)               -- 路径
)engine=InnoDB default charset=utf8;

-- 电影表
create table bee_movie(
	id int unsigned not null auto_increment primary key, 
    name varchar(255) not null unique,  -- 电影名
    crelease_t varchar(255),            -- 中国上映时间
    orelease_t varchar(255),            -- 其他地区上映时间
    director varchar(255),              -- 导演
    writer varchar(255),                -- 作者
    country int unsigned,               -- 国家
    tlong int,                          -- 片长
    brief longtext,                     -- 简要
    alias varchar(255),                 -- 别名
    year int unsigned,                  -- 年份
    hot int,                            -- 热度
    score int,                          -- 得分
    foreign key (country) references bee_mclassify(id) on update cascade on delete restrict,
    foreign key (year) references bee_mclassify(id) on update cascade on delete restrict 
)engine=InnoDB default charset=utf8;

-- 电影_分类映射表
create table bee_m_c(
	id int unsigned not null auto_increment primary key, 
	m_id int unsigned,              -- 电影id
	c_id int unsigned,              -- 分类id
	foreign key (m_id) references bee_movie(id) on update cascade on delete restrict,
	foreign key (c_id) references bee_mclassify(id) on update cascade on delete restrict
)engine=InnoDB default charset=utf8;

-- 电影标签表
create table bee_mtag(
	id int unsigned not null auto_increment primary key, 
	name varchar(255)               -- 标签名
)engine=InnoDB default charset=utf8;

-- 电影标签映射表
create table bee_m_t(
	id int unsigned not null auto_increment primary key, 
	m_id int unsigned,              -- 电影id
	t_id int unsigned,              -- 标签id
	foreign key (m_id) references bee_movie(id) on update cascade on delete restrict,
	foreign key (t_id) references bee_mtag(id) on update cascade on delete restrict

)engine=InnoDB default charset=utf8;

-- 电影图片表
create table bee_mimage(
	id int unsigned not null auto_increment primary key,
	name varchar(255),               -- 电影图片名
	m_id int unsigned,               -- 电影id
	is_cover tinyint default 0,      -- 封面
	foreign key (m_id) references bee_movie(id) on update cascade on delete restrict
)engine=InnoDB default charset=utf8;

-- 图书分类表
create table bee_bclassify(
	id int unsigned not null auto_increment primary key, 
	name  varchar(255) not null,    -- 分类名
	pid int unsigned,               -- 父id
	path varchar(255)               -- 路径
)engine=InnoDB default charset=utf8;

-- 图书分类
create table bee_bclassify(
	id int unsigned not null auto_increment primary key, 
	name  varchar(255) not null,  -- 图书分类名
	pid int unsigned,             -- 父id
	path varchar(255)             -- 路径
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

-- 用户表
create table bee_user(
	id int unsigned not null auto_increment primary key,
    name varchar(255) unique,
    password varchar(32),
    phone varchar(11) unique,
    email varchar(255),
    sex tinyint,
    image varchar(255),
    time varchar(13),
    introduce varchar(255)
)engine=InnoDB default charset=utf8;

-- 日记标签表
create table bee_dtag(
	id int unsigned not null auto_increment primary key,
	name varchar(255) unique,

)engine=InnoDB default charset=utf8;

-- 日记表
create table bee_diary(
	id int unsigned not null auto_increment primary key,
	title varchar(255),
	time varchar(13),
	u_id int unsigned,
	power tinyint,
	show tinyint,
	browse int,
    hot int,
 	tolist tinyint
	foreign key (u_id) references bee_user(id) on update cascade on delete restrict

)engine=InnoDB default charset=utf8;

-- 日记标签映射表
create table bee_d_t(
	id int unsigned not null auto_increment primary key,
	d_id int unsigned,
	t_id int unsigned,
	foreign key (d_id) references bee_diary(id) on update cascade on delete restrict,
	foreign key (t_id) references bee_dtag(id) on update cascade on delete restrict

)engine=InnoDB default charset=utf8;
-- 日记图片表
create table bee_d_image(
	id int unsigned not null auto_increment primary key,
	d_id int unsigned,
	name varchar(255),
	is_cover tinyint default 0
)engine=InnoDB default charset=utf8;

-- 相册表
 create table bee_album(
 	id int unsigned not null auto_increment primary key,
 	name varchar(255),
 	des varchar(255),
 	u_id int unsigned,
 	show tinyint,
    time varchar(13),
 	browse tinyint,
 	tolist tinyint,
 	hot int,
	foreign key (a_id) references bee_album(id) on update cascade on delete restrict

 )engine=InnoDB default charset=utf8;

 -- 照片表
 create table bee_photo(
 	id int unsigned not null auto_increment primary key,
 	name varchar(255),
    time varchar(13),
 	a_id int unsigned,
	foreign key (a_id) references bee_album(id) on update cascade on delete restrict
)engine=InnoDB default charset=utf8;

-- 用户关注表
create table bee_u_f(
    id int unsigned not null auto_increment primary key,
    u_id int unsigned,
    f_id int unsigned,
    time varchar(13),
	foreign key (u_id) references bee_user(id) on update cascade on delete restrict,
	foreign key (f_id) references bee_user(id) on update cascade on delete restrict
)engine=InnoDB default charset=utf8;

-- 用户喜欢表
create table bee_u_like(
    id int unsigned not null auto_increment primary key,
    u_id int unsigned,
    controllername varchar(255),
    like_id int unsigned,
    time varchar(13),
)engine=InnoDB default charset=utf8;

-- 用户提问表
create table bee_u_q(
    id int unsigned not null auto_increment primary key,
    u_id int unsigned,
    title varchar(255) not null,
    content varchar(255) not null,
    time varchar(13),
	foreign key (u_id) references bee_user(id) on update cascade on delete restrict
)engine=InnoDB default charset=utf8;

-- 提问回答表
create table bee_q_a(
    id int unsigned not null auto_increment primary key,
    u_id int unsigned,
    q_id int unsigned,
    content varchar(255) not null,
    hot int,
    time varchar(13),
	foreign key (u_id) references bee_user(id) on update cascade on delete restrict,
	foreign key (q_id) references bee_u_q(id) on update cascade on delete restrict
)engine=InnoDB default charset=utf8;

-- 小组表
create table bee_group(
    id int unsigned not null auto_increment primary key,
    u_id int unsigned,
    name varchar(255) not null,
    brief varchar(255) not null,
    time varchar(13),
	foreign key (u_id) references bee_user(id) on update cascade on delete restrict
)engine=InnoDB default charset=utf8;

-- 加入小组表
create table bee_add_g(
    id int unsigned not null auto_increment primary key,
    u_id int unsigned,
    g_id int unsigned,
    time varchar(13),
	foreign key (u_id) references bee_user(id) on update cascade on delete restrict,
	foreign key (g_id) references bee_group(id) on update cascade on delete restrict
)engine=InnoDB default charset=utf8;

-- 小组话题表
create table bee_g_topic(
    id int unsigned not null auto_increment primary key,
    g_id int unsigned,
    u_id int unsigned,
    title varchar(255),
    content varchar(255),
	foreign key (g_id) references bee_group(id) on update cascade on delete restrict
	foreign key (u_id) references bee_user(id) on update cascade on delete restrict,
)engine=InnoDB default charset=utf8;
