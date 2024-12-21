<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use HasFactory;
    protected $table = 'posts';

    protected $primaryKey = 'post_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = ['title', 'views', 'rating', 'status', 'description', 'user_id'];

    protected $guarded = ['id'];
}