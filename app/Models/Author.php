<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    
    /**
     * Table name
     *
     */
    protected $table = 'authors';

    /**
     * Primary Key table
     * 
     * @var array
     */
    protected $primaryKey = 'id';

    /**
     * Disable the default created_at and updated_at timestamps
     * 
     */
    
    public $timestamps = false;

}
