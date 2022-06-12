<?php

namespace App\Services;


class CityService{

    public function getsities($data=null)
    {
        return getCities($data);
    }

    public function addcity($data)
    {
        return addCity($data);
    }

    public function updatecity($city_id,$name)
    {
        return  changeCityName($city_id,$name);
    }

    public function deletecity($city_id)
    {
        return deleteCity($city_id);
    }

}