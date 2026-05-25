<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name', 'email', 'phone', 'company',
        'flock_size', 'message',
        'locale', 'ip_address', 'status', 'contacted_at',
    ];

    protected $casts = ['contacted_at' => 'datetime'];

    public const STATUSES = ['new', 'contacted', 'closed'];

    public function calculatorRequest()
    {
        return $this->hasOne(CalculatorRequest::class);
    }

    public function scopeNew($q) { return $q->where('status', 'new'); }
}
