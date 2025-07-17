<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content'; // karena nama tabel bukan "contents"
    public $timestamps = false;   // karena kamu pakai created_date dan updated_date manual

    protected $fillable = [
        'name_exercise', 'description', 'created_date', 'created_by',
        'updated_date', 'updated_by', 'categories', 'img'
    ];
}