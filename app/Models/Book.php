<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Book extends Model
{
    use HasFactory;
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function scopeTitle(EloquentBuilder $query, string $title): EloquentBuilder
    {
        return $query->where("title", "like", "%" . $title . "%");
    }
    public function scopPopuler (EloquentBuilder $query): EloquentBuilder|QueryBuilder
    {
        return  $query->withCount("reviews")->orderBy('reviews_count','desc');
    }
    public function scopHighestRated (EloquentBuilder $query): EloquentBuilder|QueryBuilder
    {
        return $query->withAvg('reviews','rating')->orderBy('reviews_avg_rating','desc');
    }
}
