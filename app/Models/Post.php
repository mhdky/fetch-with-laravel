<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the title in title case.
     *
     * @param  string  $value
     * @return string
     */
    public function getTitleAttribute($value)
    {
        return Str::title($value);
    }

    /**
     * Set the title in title case.
     *
     * @param  string  $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);
    }

    /**
     * Get the author in title case.
     *
     * @param  string  $value
     * @return string
     */
    public function getAuthorAttribute($value)
    {
        return Str::title($value);
    }

    /**
     * Set the author in title case.
     *
     * @param  string  $value
     * @return void
     */
    public function setAuthorAttribute($value)
    {
        $this->attributes['author'] = Str::title($value);
    }
}
