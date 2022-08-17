<?php

namespace App\Models;

use App\Http\Traits\QueryTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    use QueryTrait, HasFactory;

    protected $table = 'surats';
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'text',
        'text_translate',
        'surat_category_id',
    ];

    public function ayats(): HasMany
    {
        return $this->hasMany(Ayat::class, 'surat_id');
    }

    /**
     * Get the user that owns the Surat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(SuratCategory::class, 'surat_category_id');
    }
}
