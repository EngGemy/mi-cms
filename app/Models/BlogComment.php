<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_post_id', 'parent_id',
        'author_name', 'author_email', 'body',
        'ip_address', 'status',
    ];

    public const STATUSES = ['pending', 'approved', 'spam'];

    public function post()    { return $this->belongsTo(BlogPost::class, 'blog_post_id'); }
    public function parent()  { return $this->belongsTo(self::class, 'parent_id'); }
    public function replies() { return $this->hasMany(self::class, 'parent_id')->where('status', 'approved'); }

    public function scopeApproved($q) { return $q->where('status', 'approved'); }
    public function scopePending($q)  { return $q->where('status', 'pending'); }
}
