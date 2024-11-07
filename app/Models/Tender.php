<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Tender extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'uuid';

    protected $fillable = [
        'title', 
        'description', 
        'reference_number', 
        'created_by', 
        'posting_date', 
        'start_date', 
        'end_date',
        'project',
        'donor',
        'type',
        't_type',
        'document', 
        'archived', 
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function clients()
    {
        return $this->hasMany(Client::class,'tender_id');
    }

    public function projects()
    {
        return $this->belongsTo(Setting::class,'project');
    }

    public function donors()
    {
        return $this->belongsTo(Setting::class,'donor');
    }

}
