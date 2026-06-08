<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WasteBin extends Model {
    protected $fillable = ['location_name', 'latitude', 'longitude', 'fill_level', 'status', 'waste_category_id'];
    
    public function category() { 
        return $this->belongsTo(WasteCategory::class, 'waste_category_id'); 
    }
}