create table users (`id` int NOT NULL auto_increment ,
`name` varchar(255) NOT NULL ,
`email` varchar(255) NOT NULL ,
`password` varchar(255) NOT NULL ,
`password_conf` varchar(255) NOT NULL ,
`created_at` datetime NOT NULL default now() , 
`photo` varchar(255) ,
# constraint 
primary key(`id`),
unique(`email`)
);


create table posts (`id` int NOT NULL auto_increment ,
 `title` varchar(255) NOT NULL ,
 `body` text NOT NULL ,
 `image` varchar(255) ,
 `created_at` datetime Default now() , 
 user_id int NOT NULL ,
 primary key(`id`),
 foreign key(`user_id`) references users(`id`) on update cascade on delete cascade 
);

-- for test 
-- insert into  users (name , email , password , password_conf) values ('medo' , 'medo@yahoo.com' , '123' , '123');
-- insert into posts (title , body , user_id) values ('today news' , 'fuck fuckesreal' , 1);