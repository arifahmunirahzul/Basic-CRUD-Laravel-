<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
	protected $primaryKey = 'aduan_id';
    protected $fillable = [
    	'aduan_id', 'title', 'kategori', 'masalah', 'status', 'user_id_fk', 'created_at', 'updated_at'
    ];
}
