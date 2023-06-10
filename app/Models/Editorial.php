<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    use HasFactory;
    
    /**
     * Table name
     *
     */
    protected $table = 'editorials';

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


    public function format(){

        return $this;
    }
}
