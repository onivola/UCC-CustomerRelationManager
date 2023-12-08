<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevisModel extends Model
{
    use HasFactory;
    protected $fillable =[
        'agent',
        'id_lead',
        'email',
        'raison_social',
        'numero_siret',
        'Id_signature',
        'total_led',
    ];
}
