<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmModel extends Model
{
    use HasFactory;
    protected $fillable =[
        'Noms_commerciaux',
        'Adresse_postale',
        'code_postale',
        'Numero_SIRET',
        'ville',
        'name',
        'first_name',
        'function',
        'phone',
        'fixe',
        'email',
        'exterieur',
        'type',
        'Agent',
        'PR30WMCEE',
        'PR50WMCEE',
        'PR100WMCEE',
        'HUB1600RWBCEE',
    ];
}
