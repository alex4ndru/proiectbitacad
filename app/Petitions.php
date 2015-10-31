<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petitions extends Model
{
    protected $table = 'petitions';
    protected $fillable = ['title', 'summary', 'description', 'citizenToken'];
}
