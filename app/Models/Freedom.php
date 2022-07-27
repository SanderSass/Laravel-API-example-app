<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freedom extends Model
{
    use HasFactory;
    protected $fillable = ['year', 'iso_code', 'country', 'personal_freedom_score', 'economic_freedom_score', 'human_freedom_score', 'human_freedom_rank', 'human_freedom_quartile'];

    public function find($year, $country)
    {
        return static::where($year)->where('country', $country)->first();
    }

    public function where($year)
    {
        return static::where($year)->get();
    }
}
