<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = "care_cities";
    protected $primaryKey = "id";
    protected $fillable = ['city_name'];

    // 👇 YE YAHA ADD KARO
 public function doctors()
{
    return $this->hasMany(Doctor::class, 'city_id');
}
}
