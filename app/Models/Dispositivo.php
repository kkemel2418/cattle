<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");

class Dispositivo extends Model
{

    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dispositivo_serie',
        'dispositivo_modelo',
        'dispositivo_fabricante',
        'updated_at'
    ];

    protected $table      = 'tb_dispositivo';
    protected $primaryKey = 'id';
}
