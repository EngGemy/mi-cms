<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculatorRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_submission_id',
        'length', 'width', 'height', 'floors', 'lines',
        'bird_count', 'grand_total', 'breakdown',
        'locale', 'ip_address',
    ];

    protected $casts = [
        'length'      => 'decimal:2',
        'width'       => 'decimal:2',
        'height'      => 'decimal:2',
        'floors'      => 'integer',
        'lines'       => 'integer',
        'bird_count'  => 'integer',
        'grand_total' => 'decimal:2',
        'breakdown'   => 'array',
    ];

    public function contactSubmission()
    {
        return $this->belongsTo(ContactSubmission::class);
    }
}
