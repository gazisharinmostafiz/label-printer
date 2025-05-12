<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'used_by',
        'prepared_by_name',
        'date',
        'qty',
    ];

    // Relationship: A Label belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: A Label belongs to a Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
