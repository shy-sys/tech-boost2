<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = ['id'];

    // 以下を追記
    public static $rules = array(
        'name' => 'required',
        'age' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required',
    );
    public function histories()
    {
      return $this->hasMany('App\ProfileHistory');

    }

}
