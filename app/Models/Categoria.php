<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nombre', 'foto'
    ];

    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }
    use HasFactory;
}
