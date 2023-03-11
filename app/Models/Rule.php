<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'rule_for',
        'category',
        'redirect_to',
        'priority'
    ];

    public function customer_tags()
    {
        return $this->hasMany(CustomerTag::class, 'rule_id');
    }

    public function redirect()
    {
        return $this->hasOne(Redirect::class, 'rule_id');
    }
}
