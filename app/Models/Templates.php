<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Templates extends Model
{
    use HasFactory;
    use HasRecursiveRelationships;

    public function getFiles(){
        return $this->hasMany(Files::class);
    }
}
