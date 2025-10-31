<?php
namespace App\Http\Traits\Teacher;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
trait AddressesRelations {
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
    public function billing_country()
    {
        return $this->belongsTo(Country::class , 'billing_country_id');
    }
    public function billing_state()
    {
        return $this->belongsTo(State::class , 'billing_state_id');
    }
    public function billing_city()
    {
        return $this->belongsTo(City::class , 'billing_city_id');
    }
    public function shipping_country()
    {
        return $this->belongsTo(Country::class , 'shipping_country_id');
    }
    public function shipping_state()
    {
        return $this->belongsTo(State::class , 'shipping_state_id');
    }
    public function shipping_city()
    {
        return $this->belongsTo(City::class , 'shipping_city_id');
    }
    public function work_country()
    {
        return $this->belongsTo(Country::class , 'work_country_id');
    }
    public function work_state()
    {
        return $this->belongsTo(State::class , 'work_state_id');
    }
    public function work_city()
    {
        return $this->belongsTo(City::class , 'work_city_id');
    }
}