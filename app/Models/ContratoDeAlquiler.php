<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoDeAlquiler extends Model
{
    use HasFactory;
    protected $table = "contratos_de_alquiler";
    protected $primaryKey = "id";
    public $timestamps = false;
}
