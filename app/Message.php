<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=['body','from','to','source','read_at','file','type'];



    public function since(){
      $created = new \Carbon\Carbon($this->created_at);
      $now = \Carbon\Carbon::now();

      if ($created->diffInMinutes($now) < 1) {
          $since = "منذ اقل من دقيقة";
      } elseif ( $created->diffInMinutes($now) <= 60) {
          $since = $created->diffInMinutes($now) > 1 ? sprintf("منذ %d دقائق", $created->diffInMinutes($now)) : sprintf("منذ %d دقيقة", $created->diffInMinutes($now));
      } elseif ($created->diffInHours($now) <= 24) {
          $since = $created->diffInHours($now) > 1 ? sprintf("منذ %d ساعات", $created->diffInHours($now)) : sprintf("منذ %d ساعة", $created->diffInHours($now));
      } else {
          $since = $created->diffInDays($now) > 1 ? sprintf("منذ %d ايام", $created->diffInDays($now)) : sprintf("منذ %d يوم", $created->diffInDays($now));
      }
      return $since;
    }

    public function readat(){
        $read_at='';
      if($this->read_at){
        $read_at=\Carbon\Carbon::parse($this->read_at)->format('h:i a');
      }
      return $read_at;
    }
}
