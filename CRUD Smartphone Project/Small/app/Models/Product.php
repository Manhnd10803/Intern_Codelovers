<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'idProduct';
    protected $fillable = ['productName', 'productColor', 'productStorage', 'productImage', 'cate_id'];
}
