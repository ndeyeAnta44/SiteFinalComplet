<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'stock',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    /**
     * Retourne toujours une URL valide pour l'image.
     * Supporte : URL externe (http...) ou chemin storage local.
     */
    public function getImageSrcAttribute(): string
    {
        if (!$this->image) {
            return 'https://via.placeholder.com/400x300?text='.urlencode($this->name);
        }
        if (str_starts_with($this->image, 'http')) {
            return $this->image; // URL externe
        }
        return asset($this->image); // chemin local
    }
}
