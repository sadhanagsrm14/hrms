<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class Eod extends Model

{

   protected $fillable = ['user_id','date_of_eod','project_id','hours_spent','task','comment'];
   
   public function user(){
    	return $this->belongsTo('App\User');
   }

   public function project(){
    	return $this->belongsTo('App\Project');  
   }

}

