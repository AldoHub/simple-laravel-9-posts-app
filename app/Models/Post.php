<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'title',
        'description',
        'tags',
        'cover',
    ];


    //scope filter
    public function scopeFilter($query, array $filters){
        
        //ddd($filters);

        //tags
        if($filters[0]){
            $query->where('tags', 'like', '%'.$filters[0].'%');
        }

        //search
        if($filters[1]){
            $query->where('tags', 'like', '%'.$filters[1].'%')
            ->orWhere('title', 'like', '%'.$filters[1].'%')
            ->orWhere('description', 'like', '%'.$filters[1].'%');
        }
       
    }

}
