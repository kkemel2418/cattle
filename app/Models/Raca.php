<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");

class Raca extends Model
{
    use HasFactory;

    protected $fillable = [
        'raca_nome',
        'descricao',
        'quantidade',
        'updated_at'
    ];

    protected $table      = 'tb_raca';
    protected $primaryKey = 'raca_id';
}




