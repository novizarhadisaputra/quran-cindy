<?php

namespace App\Models;

use App\Http\Traits\QueryTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tafsir extends Model
{
    use QueryTrait, HasFactory;

    protected $table = 'tafsirs';
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'ayat_id',
        'tafsir_wajiz',
        'tafsir_tahlili',
    ];

    /**
     * Get the ayat that owns the Tafsir
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ayat(): BelongsTo
    {
        return $this->belongsTo(Ayat::class, 'ayat_id');
    }

}
