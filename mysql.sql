﻿sudo /Applications/XAMPP/xamppfiles/bin/mysql.server start

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
	i_path varchar(255),			 
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

-- 图书标签表
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
    sign varchar(255),
    introduce varchar(255),					-- 一句话介绍
    status tinyint default 0							-- 状态
)engine=InnoDB default charset=utf8;

-- 日记标签表
create table bee_dtag(
	id int unsigned not null auto_increment primary key,
	name varchar(255) unique,				-- 日记标签名
	hot int  default 1						-- 标签使用个数
)engine=InnoDB default charset=utf8;

-- 日记表
create table bee_diary(
	id int unsigned not null auto_increment primary key,
	title varchar(255),						-- 日记标题
	content longtext,						-- 日记内容
	time varchar(13),						-- 日记发表时间
	u_id int unsigned,						-- 用户id
	power tinyint,							-- 权限设置（可回复） 1为不可回复
	browse tinyint,							-- 设置可见 0为所有人可见 1 为仅朋友可见 2仅自己可见
    hot int,								-- 点赞个数
 	tolist tinyint, 						-- 创建到蜂蜜
	update_time varchar(13),				-- 日记修改时间	
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
 	hot int, 								-- 点赞个数
 	update_time varchar(13)					-- 修改时间
 )engine=InnoDB default charset=utf8;

 -- 照片表
 create table bee_photo(
 	id int unsigned not null auto_increment primary key,
 	name varchar(255),						-- 照片名
    time varchar(13),						-- 时间戳
 	a_id int unsigned,						-- 相册id
 	path varchar(255),						-- 图片路径名
 	is_cover tinyint default 0,				-- 封面
 	descr varchar(255),						-- 图片描述
	foreign key (a_id) references bee_album(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;

-- 相册标签表
create table bee_atag(
	id int unsigned not null auto_increment primary key,
	name varchar(255) unique,				-- 相册标签名
	hot int default 1  						-- 使用个数
)engine=InnoDB default charset=utf8;

-- 相册标签映射表
create table bee_a_t(
	id int unsigned not null auto_increment primary key,
	a_id int unsigned,						-- 日记id
	t_id int unsigned,						-- 标签id
	foreign key (a_id) references bee_album(id) on update cascade on delete CASCADE,
	foreign key (t_id) references bee_atag(id) on update cascade on delete CASCADE

)engine=InnoDB default charset=utf8;

-- 用户关注表
create table bee_follow(
    id int unsigned not null auto_increment primary key,
    u_id int unsigned,						-- 用户id
    f_id int unsigned,						-- 关注者id
    time varchar(13),						-- 时间戳
    status tinyint default 0,				-- 被关注者知道否
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE,
	foreign key (f_id) references bee_user(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;


-- 用户朋友表
create table bee_friend(
	id int unsigned not null auto_increment primary key,
	u_id int unsigned,
	f_id int unsigned,
	time varchar(13),						-- 时间戳
    status tinyint default 0,				-- 双方知道否
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE,
	foreign key (f_id) references bee_user(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;

-- 用户喜欢表
create table bee_u_like(
    id int unsigned not null auto_increment primary key,
    u_id int unsigned,						-- 用户id
    p_id int unsigned,						-- 被喜欢的用户id
    action varchar(255),			        -- 喜欢的类型
    like_id int unsigned,					-- 喜欢的id
    time varchar(13)						-- 时间戳
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
	foreign key (g_id) references bee_group(id) on update cascade on delete CASCADE,
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;


-- 用户说说表
create table bee_say(
	id int unsigned not null auto_increment primary key,
	u_id int unsigned,
	content varchar(255),
	time varchar(13),
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;


-- 用户说说图片表
create table bee_s_i(
	id int unsigned not null auto_increment primary key,
	s_id int unsigned,
	name varchar(255),
	foreign key (s_id) references bee_say(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;

-- 动态表
create table bee_trend(
	id int unsigned not null auto_increment primary key,
	action varchar(255) not null,
	time varchar(13) not null,
	u_id int unsigned not null,
	do_id int unsigned not null,
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;




-- 电影短评表
create table bee_s_r(
	id int unsigned not null auto_increment primary key,
	content varchar(255) not null,					-- 评论内容
	hot int default 0,								-- 热度
	u_id int,										-- 用户id
	time varchar(13),								-- 时间表
	m_id int,	
	statut tinyint default 0,						-- 想看 0 看过  1 
  	`show` tinyint default 0                          -- 显示字段  不显示0   显示1											
)engine=InnoDB default charset=utf8;

-- 电影长评表
create table bee_l_r(
	id int unsigned not null auto_increment primary key,
	content text not null,							-- 评论内容
	hot int default 0,								-- 热度
	u_id int,										-- 用户id
	time varchar(13),								-- 时间表
	m_id int,	
	title varchar(255),	
	grade int,										-- 得分	
    `show` tinyint default 0                          -- 显示字段  不显示0   显示1	
)engine=InnoDB default charset=utf8;


-- 相册回应表
create table bee_a_replay(
	id int unsigned not null auto_increment primary key,
	content text not null,
	time varchar(13),
	a_id int unsigned,
	r_id int unsigned default 0,
	u_id int unsigned,
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE,
	foreign key (a_id) references bee_album(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;

-- 日记回应表
create table bee_d_replay(
	id int unsigned not null auto_increment primary key,
	content text not null,
	time varchar(13),
	d_id int unsigned,
	r_id int unsigned default 0,
	u_id int unsigned,
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE,
	foreign key (d_id) references bee_diary(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;

-- 提醒表
create table bee_tip(
	id int unsigned not null auto_increment primary key,
	u_id int unsigned,                           -- 谁做的
	action varchar(255),
	time varchar(13),
	do_id int unsigned,
	status int default 0,
	p_id int unsigned,							 -- 提醒谁
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE,	
	foreign key (p_id) references bee_user(id) on update cascade on delete CASCADE	
)engine=InnoDB default charset=utf8;

-- 发起私信表
create table bee_conversation(
	id int unsigned not null auto_increment primary key,
	u_id int unsigned,							-- 发起人id
	p_id int unsigned,							-- 相应人id
	time varchar(13),							-- 时间
	update_time varchar(13),					-- 更新时间
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE,	
	foreign key (p_id) references bee_user(id) on update cascade on delete CASCADE	
)engine=InnoDB default charset=utf8;

-- 对话内容表
create table bee_message(
	id int unsigned not null auto_increment primary key,
	m_id int unsigned,							-- 对话id
	u_id int unsigned,							-- 说话的人
	content varchar(255),						-- 说的内容
	time varchar(13),							-- 说话时间
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE,	
	foreign key (m_id) references bee_conversation(id) on update cascade on delete CASCADE	
)engine=InnoDB default charset=utf8;

-- 后台用户表
create table bee_back_user(
	id int unsigned not null auto_increment primary key,
	name varchar(255),							-- 用户名
	password varchar(32),						-- 密码
	status tinyint default 0
)engine=InnoDB default charset=utf8;

-- 后台角色表
create table bee_power(
	id int unsigned not null auto_increment primary key,
	name varchar(255)							-- 权限名
)engine=InnoDB default charset=utf8;



-- 权限类名对应表
create table bee_ac_po(
	id int unsigned not null auto_increment primary key,
	a_name varchar(255),
	c_name varchar(255),
	p_id int unsigned not null,	
	foreign key (p_id) references bee_power(id) on update cascade on delete CASCADE	

)engine=InnoDB default charset=utf8;

-- 用户权限表
create table bee_u_p(
	id int unsigned not null auto_increment primary key,
	u_id int unsigned not null,
	p_id int unsigned not null,
	foreign key (u_id) references bee_back_user(id) on update cascade on delete CASCADE,	
	foreign key (p_id) references bee_power(id) on update cascade on delete CASCADE	

)engine=InnoDB default charset=utf8;

-- 图书回应表
create table bee_b_replay(
	id int unsigned not null auto_increment primary key,
	content text not null,
	time varchar(13),
	b_id int unsigned,
	r_id int unsigned default 0,
	u_id int unsigned,
	rc_id int unsigned,
	foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE,
	foreign key (b_id) references bee_book(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;

-- 图书短评表
create table bee_s_b(
	id int unsigned not null auto_increment primary key,
	content varchar(255) not null,					-- 评论内容
	hot int default 0,								-- 热度
	u_id int,										-- 用户id
	time varchar(13),								-- 时间表
	b_id int,	
	statut tinyint default 0,						-- 想看 0 看过  1 
  	`show` tinyint default 0                          -- 显示字段  不显示0   显示1											
)engine=InnoDB default charset=utf8;

-- 电影长评表
create table bee_l_b(
	id int unsigned not null auto_increment primary key,
	content text not null,							-- 评论内容
	hot int default 0,								-- 热度
	u_id int,										-- 用户id
	time varchar(13),								-- 时间表
	b_id int,	
	title varchar(255),	
	grade int,										-- 得分	
    `show` tinyint default 0                          -- 显示字段  不显示0   显示1	
)engine=InnoDB default charset=utf8;


-- 广告表
create table bee_ad(
	id int unsigned not null auto_increment primary key,
	link varchar(255),								-- 	链接名
	style tinyint,									--  类型
	i_path varchar(255),							--  图片路径
	i_name varchar(255)								--  图片名
)engine=InnoDB default charset=utf8;

-- 电影回应表
create table bee_m_replay(
	id int unsigned not null auto_increment primary key,
	content text not null,
	time varchar(13),
	m_id int unsigned,
	r_id int unsigned default 0,
	u_id int unsigned,
    l_id int unsigned
    foreign key (u_id) references bee_user(id) on update cascade on delete CASCADE,
	foreign key (m_id) references bee_movie(id) on update cascade on delete CASCADE
)engine=InnoDB default charset=utf8;
