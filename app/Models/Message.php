<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  /**
   * Create 1 to many relationship between the user table and messages table
   *
   */
  public function userFrom(){
    return $this->belongsTo('\App\User', 'user_id_from');
  }
}
