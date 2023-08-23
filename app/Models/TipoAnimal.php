<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAnimal extends Model
{
    use HasFactory;

    protected $table      = 'tb_tipo_animal';
    protected $primaryKey = 'tipo_animal_id';

}