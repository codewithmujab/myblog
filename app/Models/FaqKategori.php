<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqKategori extends Model
{
    use HasFactory;
    protected $table = 'faq_kategoris';
    protected $fillable = [
        'name',
    ];
}
