<?php

namespace Bantenprov\DashboardEpormas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EpormasCounter extends Model
{

    protected $table = 'epormas_counter';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('tahun', 'bulan', 'tanggal', 'count', 'via', 'user_id', 'category_id', 'city_id');

    public function getCategory()
    {
        return $this->hasOne('Dashboard\Epormas\Models\EpormasCategory', 'id', 'category_id');
    }

    public function getCity()
    {
        return $this->hasOne('Dashboard\Epormas\Models\EpormasCity', 'id', 'city_id');
    }

}
