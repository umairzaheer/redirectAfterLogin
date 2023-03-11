<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
        'redirect_url',
        'priority',
        'user_id'
    ];
    
    public function customer_tags()
    {
        return $this->hasMany(CustomerTag::class, 'registration_id');
    }
}
