<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Client extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'uuid';


    protected $fillable = [
        'name',
        'email',
        'contact',
        'address',
        'company',
        'tender_id',
        'apply_date',
    ];

    
}
