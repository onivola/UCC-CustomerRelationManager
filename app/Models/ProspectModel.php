<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProspectModel extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_lead',
        'Numero_SIRET',
        'etat_signature',
        'maybe',
        'date_signature',
    ];
}
