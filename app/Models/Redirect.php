<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    use HasFactory;
    protected $fillable = [
        'rule_id',
        'product_id',
        'collection_id',
        'page_id',
        'custom_url'
    ];

    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }
}
