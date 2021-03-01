<?php

namespace App\Models;

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Parsedown;

use CodeIgniter\I18n\Time;
$myTime = new Time('now', 'Europe/Moscow', 'ru_RU');
 

class CommentsModel extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'comment_id'; 
    protected $allowedFields = ['comment_post_id', 'comment_content', 'comment_user_id'];
    
    // Все комментарии
    public function getCommentsAll()
    {
        
        $Parsedown = new Parsedown(); 
        $Parsedown->setSafeMode(true); // безопасность
        
        $db = \Config\Database::connect();
        $builder = $db->table('comments AS a');
        $builder->select('a.*, b.id, b.nickname, b.avatar, c.post_id, c.post_title, c.post_slug');
        $builder->join("users AS b", "b.id = a.comment_user_id");
        $builder->join("posts AS  c", "a.comment_post_id = c.post_id");
        $builder->orderBy('a.comment_id', 'DESC');

        $query = $builder->get();

        $result = Array();
        foreach($query->getResult()as $ind => $row){
             
            if(!$row->avatar ) {
                $row->avatar  = 'noavatar.png';
            } 

            $row->avatar = $row->avatar;
         
            $row->content = $Parsedown->text($row->comment_content);
            $row->date = Time::parse($row->comment_date, 'Europe/Moscow')->humanize();
            $result[$ind] = $row;
         
        }
    
        return $result;
           
    }
    
    // Получаем комментарии в посте
    public function getCommentsPost($post_id)
    {
        $Parsedown = new Parsedown(); 
        $Parsedown->setSafeMode(true); // безопасность
        
        $db = \Config\Database::connect();
        $builder = $db->table('comments AS a');
        
        $builder->select('a.*, b.id, b.nickname, b.avatar');
        $builder->join("users AS b", "b.id = a.comment_user_id");
        $builder->where('a.comment_post_id', $post_id);
        $builder->orderBy('a.comment_id', 'DESC');
         
        $query = $builder->get();

        $result = Array();
        foreach($query->getResult()as $ind => $row){
             
            if(!$row->avatar ) {
                $row->avatar  = 'noavatar.png';
            } 

            $row->avatar = $row->avatar;
            $row->content  = $Parsedown->text($row->comment_content);
            $row->date = Time::parse($row->comment_date, 'Europe/Moscow')->humanize();
            $result[$ind] = $row;
         
        }
    
        return $result;
    
    }

    
}