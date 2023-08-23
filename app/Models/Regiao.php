<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{

    use HasFactory;

    protected $table      = 'tb_regiao';
    protected $primaryKey = 'regiao_id';
}
