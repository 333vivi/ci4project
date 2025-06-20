<?php

namespace App\Models;

use CodeIgniter\Model;

class GuitarModel extends Model
{
    protected $table = 'guitars'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'price', 'description', 'stock', 'brand', 'type', 'image']; 
    protected $useTimestamps = false;
}
