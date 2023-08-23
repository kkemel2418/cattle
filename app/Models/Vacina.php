<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacina extends Model
{
    use HasFactory;

    protected $table      = 'tb_vacina';
    protected $primaryKey = 'vacina_id';

    protected $fillable = [
        'nome_vacina',
        'recorrencia',
        'tipo_animal',
        'status'
    ];
}
