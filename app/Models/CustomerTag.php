<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'rule_id',
        'customer_tag',
    ];

    public function login()
    {
        return $this->belongsTo(Login::class);
    }

    public function logout()
    {
        return $this->belongsTo(Logout::class);
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }
}
