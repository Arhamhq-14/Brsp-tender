<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Setting extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'uuid';

    protected $fillable= [
        'type',
        'title'
    ];

}
