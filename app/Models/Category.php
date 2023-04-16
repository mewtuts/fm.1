<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use HasFactory;
    use HasRecursiveRelationships;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'parent_id'];

    public function getFiles(){
        return $this->hasMany(Files::class);
    }

    public function subcategories(){
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function children(){
        return $this->subcategories()->with('children');
    }

    public function hasChildren(){
        if($this->children->count()){
            return true;
        }
        return false;
    }

    public function findDescendants(Category $category){
        $this->descendants[] = $category->id;

        if($category->hasChildren()){
            foreach($category->children as $child){
                $this->findDescendants($child);
            }
        }
    }

    public function getDescendants(Category $category){
        $this->findDescendants($category);
        return $this->descendants;
    }

}
