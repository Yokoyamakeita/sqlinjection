-- Project Name : login
-- Date/Time    : 2022/03/26 22:29:10
-- Author       : keita
-- RDBMS Type   : MySQL
-- Application  : A5:SQL Mk-2

/*
  BackupToTempTable, RestoreFromTempTable疑似命令が付加されています。
  これにより、drop table, create table 後もデータが残ります。
  この機能は一時的に $$TableName のような一時テーブルを作成します。
*/

-- 表示ユーザ
--* RestoreFromTempTable
create table displayusers (
  id int(11) not null comment 'ユーザID'
  , comment varchar(255) not null comment 'コメント'
  , constraint displayusers_PKC primary key (id)
) comment '表示ユーザ' ;

-- login
--* RestoreFromTempTable
create table login (
  id int(11) not null auto_increment comment 'ID'
  , user_id varchar(255) not null comment 'ユーザID'
  , password varchar(255) not null comment 'パスワード'
  , constraint login_PKC primary key (id)
) comment 'login' ;

