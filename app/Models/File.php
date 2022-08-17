<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'source',
        'file_path',
        'file_mime',
        'file_name',
        'fileable_id',
        'fileable_type',
    ];

    public function fileable()
    {
        return $this->morphTo();
    }
}
