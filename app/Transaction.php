<?php

namespace App;

use Carbon\Carbon;
use Freshwork\Metable\Metadata;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use Metadata;

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('qty');
    }

    public function scopeToday(Builder $query)
    {
        return $query->whereDate('created_at', '=', Carbon::today(config('app.timezone'))->toDateString());
    }

    public function getTodayTransactionsCount()
    {
        $query = $this->newQuery();
        return $query->today()->count();
    }

    public function createNewBuyOrder()
    {
        $count = $this->getTodayTransactionsCount() + 1;
        return $this->buyOrder = Carbon::now(config('app.timezone'))->format('Ymd') . str_pad($count, 3, '0', STR_PAD_LEFT);
    }


}
