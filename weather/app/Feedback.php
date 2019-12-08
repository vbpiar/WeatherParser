<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Feedback extends Model
{

    public $fillable = ['name','email','text'];

    protected $table = 'feedback';

    public function user()
    {
            return $this->belongsTo(User::class);
    }




}
