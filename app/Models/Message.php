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

  /**
   * Create 1 to many relationship between the user table and messages table
   *
   */
  public function userTo(){
    return $this->belongsTo('\App\User', 'user_id_to');
  }

  /**
   * Return values where deleted = false
   *
   */
  public function scopeNotDeleted($query){
    return $query->where('deleted', false);
  }

  /**
   * Return values where deleted = true
   *
   */
  public function scopeDeleted($query){
    return $query->where('deleted', true);
  }
}
