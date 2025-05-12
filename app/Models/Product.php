<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 
// use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model

{
    //
    use HasFactory;
    
    protected $fillable = ['name', 'description'];
    public function labels(): HasMany
    {
        return $this->hasMany(Label::class);
    }

}
