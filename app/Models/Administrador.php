<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Administrador extends Model
{

    use HasFactory;

    protected $fillable = [
        'id',
        'user_id'
    ];

    public static $filterColumns = ['user_id'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    protected $table = 'administradores';
}
