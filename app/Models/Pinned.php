<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinned extends Model
{
    use HasFactory;

    protected $table = 'pinneds';
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
        'ayat_id',
    ];
}
