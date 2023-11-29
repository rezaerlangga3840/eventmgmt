<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    use HasFactory, SoftDeletes;
    public $table = "status";
    protected $primaryKey = 'id_status';
    protected $guarded=[];
}
