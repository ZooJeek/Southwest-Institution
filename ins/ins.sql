create database Institute;
use Institute;
create table admin(
	user_name varchar(20),
	user_pwd varchar(20) not null,
	super_admin bool default false,
	primary key(user_name)
);

create table article(
	article_key int auto_increment,
    article_title longtext not null,
    article_content longtext not null,
    article_read int not null default 0,
    article_author varchar(100) not null,
    article_photo varchar(100) not null,
    article_check varchar(100) not null,
    article_from varchar(100) not null,
    article_note varchar(100) not null,
    article_face varchar(100) default '',
    article_time datetime,
    article_type int,
    primary key(article_key)
)auto_increment = 1000000001;
-- 1:通知公告   2:工作动态  3：学术交流   4:科研成果   5:机构概况    6:联系我们  7:成员介绍    8：研究方向

create table img(
	img_key int,
    img_data MediumBlob not null,
    img_type varchar(10) not null,
    primary key(img_key)
)auto_increment=1000000001;

create table fie(
	fie_key int auto_increment,
    fie_name varchar(100) not null,
    fie_article longtext not null,
    fie_del bool,
    primary key (fie_key)
)auto_increment = 1000000001;

create table member(
	member_key int auto_increment,
    member_name varchar(10),
    member_face varchar(200),
    member_article int,
    member_fie int,
    member_time datetime,
    primary key (member_key),
    foreign key(member_fie ) references fie(fie_key),
    foreign key(member_article) references article(article_key)
)auto_increment=1000000001;

