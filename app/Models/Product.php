<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\PickUp;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory; 

    protected $fillable = [
        'category_id',
        'subcategory_id ',
        'childcategory_id',
        'brand_id',
        'pickup_point_id',
        'product_name',
        'product_code',
        'product_unit',
        'product_tags',
        'product_video',
        'purchase_price',
        'selling_price',
        'discount_price',
        'stock_quantity',
        'warehouse',
        'product_description',
        'product_thumbnail',
        'product_images',
        'product_featured',
        'today_deal',
        'product_status',
        'cash_on_delivery',
        'color',
        'size',
        'admin_id',
        'flash_deal_id',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function childcategory()
    {
        return $this->belongsTo(ChildCategory::class, 'childcategory_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function pickup()
    {
        return $this->belongsTo(PickUp::class, 'pickup_point_id');
    }
}
