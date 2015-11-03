<?php
namespace crawler\mysql;

require 'config.php';

class Mysql{
    private static $_db;
    
    private static $_stmt;
    
    public function __construct() {
        
    }
    
    public function insert($data){
        if (!isset(self::$_db) || !isset(self::$_stmt)){
            self::$_db = new \mysqli(\crawler\DB_HOST, \crawler\DB_USER, \crawler\DB_PASSWD, \crawler\DB_NAME);
            self::$_db->query('set names utf8');
            self::$_stmt = self::$_db->prepare("INSERT INTO `family_jishu`(`jishu_id`, `jishu_section`, `jishu_title`, `jishu_author`, `jishu_author_section`, `jishu_time`, `jishu_hits`, `jishu_article`, `jishu_prize`, `jishu_comment`, `catch_time`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            
        }
        
        self::$_stmt->bind_param('isssssisiis',
                $data['articleId'],
                $data['articleSection'],
                $data['articleTitle'],
                $data['articleAuthor'],
                $data['authorSection'],
                $data['articleTime'],
                $data['hits'],
                $data['article'],
                $data['prize'],
                $data['comment'],
                date('Y-m-d H:i:s'));
        
        self::$_stmt->execute();
        
    }
}