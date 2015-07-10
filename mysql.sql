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
    foreign key (country) references bee_mclassify(id) on update cascade on delete CASCADE,
    foreign key (year) references bee_mclassify(id) on update cascade on delete CASCADE 
)engine=InnoDB default charset=utf8;

-- 电影_分类映射表
create table bee_m_c(
	id int unsigned not null auto_increment primary key, 
	m_id int unsigned,              -- 电影id
	c_id int unsigned,              -- 分类id
	foreign key (m_id) references bee_movie(id) on update cascade on delete CASCADE,
	foreign key (c_id) references bee_mclassify(id) on update cascade on delete CASCADE
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
	foreign key (m_id) references bee_movie(id) on update cascade on delete CASCADE,
	foreign key (t_id) references bee_mtag(id) on update cascade on delete CASCADE

)engine=InnoDB default charset=utf8;

-- 电影图片表
create table bee_mimage(
	id int unsigned not null auto_increment primary key,
	name varchar(255),               -- 电影图片名
	m_id int unsigned,               -- 电影id
	is_cover tinyint default 0,      -- 封面
	foreign key (m_id) references bee_movie(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;

-- 图书分类表
create table bee_bclassify(
	id int unsigned not null auto_increment primary key, 
	name  varchar(255) not null,    -- 分类名
	pid int unsigned,               -- 父id
	path varchar(255)               -- 路径
)engine=InnoDB default charset=utf8;


-- 图书表
create table bee_book(
	id int unsigned not null auto_increment primary key, 
    name varchar(255) not null unique,		-- 图书名
    release_t varchar(255),					-- 出版时间
    writer varchar(255),					-- 作者
    publisher varchar(255),					-- 出版社
    isbn varchar(255),						-- isbn编号
    translater varchar(255),				-- 翻译者
   	brief longtext,							-- 简要
   	w_brief longtext,						-- 作者简要
   	book_cover varchar(255),				-- 封面图
   	hot int             					-- 点赞数
)engine=InnoDB default charset=utf8;

-- 图书分类映射表
create table bee_b_c(
	id int unsigned not null auto_increment primary key, 
	b_id int unsigned,  					-- 图书id
	c_id int unsigned,						-- 分类id
	foreign key (b_id) references bee_book(id) on update cascade on delete CASCADE,
	foreign key (c_id) references bee_bclassify(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;

--图书标签表
create table bee_btag(
	id int unsigned not null auto_increment primary key, 
	name varchar(255),						-- 标签名
	path varchar(255),						-- 路径
	pid int unsigned						-- 父id
)engine=InnoDB default charset=utf8;

-- 图书标签映射表
create table bee_b_t(
	id int unsigned not null auto_increment primary key, 
	b_id int unsigned,						-- 图书id
	t_id int unsigned,						-- 标签id
	foreign key (b_id) references bee_book(id) on update cascade on delete CASCADE,
	foreign key (t_id) references bee_btag(id) on update cascade on delete CASCADE

)engine=InnoDB default charset=utf8;

-- 图书图片表
create table bee_bimage(
	id int unsigned not null auto_increment primary key,
	name varchar(255),						-- 图片名
	b_id int unsigned,						-- 图书id
	is_cover tinyint default 0,				-- 是封面吗
	foreign key (b_id) references bee_book(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;

-- 用户表
create table bee_user(
	id int unsigned not null auto_increment primary key,
    name varchar(255) unique,				-- 用户名
    password varchar(32),					-- 密码
    phone varchar(11) unique,				-- 手机号
    email varchar(255),						-- 邮件
    sex tinyint,							-- 性别
    image varchar(255),						-- 头像名
    time varchar(13),						-- 注册时间
    introduce varchar(255)					-- 一句话介绍
)engine=InnoDB default charset=utf8;

-- 日记标签表
create table bee_dtag(
	id int unsigned not null auto_increment primary key,
	name varchar(255) unique				-- 日记标签名
)engine=InnoDB default charset=utf8;

-- 日记表
create table bee_diary(
	id int unsigned not null auto_increment primary key,
	title varchar(255),						-- 日记标题
	content longtext,						-- 日记内容
	time varchar(13),						-- 日记发表时间
	u_id int unsigned,						-- 用户id
	power tinyint,							-- 权限设置（可回复）
	browse tinyint,							-- 设置可见
    hot int,								-- 点赞个数
 	tolist tinyint							-- 创建到蜂蜜
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE

)engine=InnoDB default charset=utf8;

-- 日记标签映射表
create table bee_d_t(
	id int unsigned not null auto_increment primary key,
	d_id int unsigned,						-- 日记id
	t_id int unsigned,						-- 标签id
	foreign key (d_id) references bee_diary(id) on update cascade on delete CASCADE,
	foreign key (t_id) references bee_dtag(id) on update cascade on delete CASCADE

)engine=InnoDB default charset=utf8;
-- 日记图片表
create table bee_d_image(
	id int unsigned not null auto_increment primary key,
	d_id int unsigned,						-- 日记id
	name varchar(255),						-- 图片名
	is_cover tinyint default 0				-- 是封面吗
)engine=InnoDB default charset=utf8;

-- 相册表
 create table bee_album(
 	id int unsigned not null auto_increment primary key,
 	name varchar(255),						-- 相册名
 	des varchar(255),						-- 描述
 	u_id int unsigned,						-- 用户id
 	power tinyint,							-- 权限设置
    time varchar(13),						-- 时间戳
 	browse tinyint,							-- 浏览设置
 	tolist tinyint,							-- 创建到蜂蜜
 	hot int,								-- 点赞个数
	foreign key (a_id) references bee_album(id) on update cascade on delete CASCADE

 )engine=InnoDB default charset=utf8;

 -- 照片表
 create table bee_photo(
 	id int unsigned not null auto_increment primary key,
 	name varchar(255),						-- 照片名
    time varchar(13),						-- 时间戳
 	a_id int unsigned,						-- 相册id
	foreign key (a_id) references bee_album(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;

-- 用户关注表
create table bee_u_f(
    id int unsigned not null auto_increment primary key,
    u_id int unsigned,						-- 用户id
    f_id int unsigned,						-- 关注者id
    time varchar(13),						-- 时间戳
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE,
	foreign key (f_id) references bee_user(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;

-- 用户喜欢表
create table bee_u_like(
    id int unsigned not null auto_increment primary key,
    u_id int unsigned,						-- 用户id
    controllername varchar(255),			-- 关注的类型
    like_id int unsigned,					-- 喜欢的id
    time varchar(13),						-- 时间戳
)engine=InnoDB default charset=utf8;

-- 用户提问表
create table bee_u_q(
    id int unsigned not null auto_increment primary key,
    u_id int unsigned,						-- 用户id
    title varchar(255) not null,			-- 提问标题
    content varchar(255) not null,			-- 提问内容
    time varchar(13),						-- 时间戳
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;

-- 提问回答表
create table bee_q_a(
    id int unsigned not null auto_increment primary key,
    u_id int unsigned,						-- 用户id
    q_id int unsigned,						-- 提问id
    content varchar(255) not null,			-- 回答的内容
    hot int,								-- 点赞个数
    time varchar(13),						-- 回答时间戳
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE,
	foreign key (q_id) references bee_u_q(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;

-- 小组表
create table bee_group(
    id int unsigned not null auto_increment primary key,
    u_id int unsigned,						-- 用户id
    name varchar(255) not null,				-- 小组名
    brief varchar(255) not null,			-- 简要
    time varchar(13),						-- 时间戳
    status tinyint,							-- 状态
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;

-- 加入小组表
create table bee_add_g(
    id int unsigned not null auto_increment primary key,
    u_id int unsigned,						-- 用户id
    g_id int unsigned,						-- 小组id
    time varchar(13),						-- 时间戳
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE,
	foreign key (g_id) references bee_group(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;

-- 小组话题表
create table bee_g_topic(
    id int unsigned not null auto_increment primary key,
    g_id int unsigned,						-- 小组id
    u_id int unsigned,						-- 用户id
    title varchar(255),						-- 话题标题
    content varchar(255),					-- 话题内容
	foreign key (g_id) references bee_group(id) on update cascade on delete CASCADE
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE,
)engine=InnoDB default charset=utf8;
