<?php

namespace App\Models;

use App\Models\File;
use App\Http\Traits\QueryTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ayat extends Model
{
    use QueryTrait, HasFactory;

    protected $table = 'ayats';
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'text',
        'text_translate',
        'text_latin',
        'text_notes',
        'surat_id',
        'juz_id',
        'order'
    ];

    public function tafsir(): HasOne
    {
        return $this->hasOne(Tafsir::class, 'ayat_id');
    }

    /**
     * Get the juz that owns the Ayat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function juz(): BelongsTo
    {
        return $this->belongsTo(Juz::class, 'juz_id');
    }

    /**
     * Get the surat that owns the Ayat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function surat(): BelongsTo
    {
        return $this->belongsTo(Surat::class, 'surat_id');
    }

    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
