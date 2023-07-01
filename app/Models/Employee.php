<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'city_id',
        'state_id',
        'country_id',
        'department_id',
        'zip_code',
        'birth_date',
        'date_hired',
        'photo',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public static function showImage($id)
    {
        // $post = Asset::findOrFail($id);
        // if (!$post->getFirstMedia('asset_picture')) {
        //     // $post->setMedia(['picture' => 'images/default.png']);
        //     $src = 'images/default.png';
        // }else {
        //     $image = $post->getFirstMedia('asset_picture');
        //     $src = $image->getUrl();
        // }
        // return $src;

        $post = Employee::findOrFail($id);
        return $post;
    }
}
