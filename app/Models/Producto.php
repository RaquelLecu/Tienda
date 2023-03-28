<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Producto extends Model
{
    use HasFactory, Rateable;
    protected $fillable = [
        'nombre', 'descripcion', 'precio', 'foto', 'categoria_id'
    ];

    public function categoria()
    {
        return $this->hasOne(Categoria::class);
    }

}
