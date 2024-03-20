<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Artikel extends Model
{
    use HasFactory;
    protected $table = 'artikels';
    protected $fillable = [
        'user_id',
        'kategori_id',
        'tag_id',
        'judul',
        'tumbnail',
        'slug',
        'isi',
        'publish',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
