<?php
namespace App\Utilities;



class Validator{

    public function province_validate($province_id)
    {
      if(!isset($province_id)){
        return true;
      }

      $result= getCities($province_id);
      
      foreach($result as $value){
        if($province_id == $value->province_id ){
            return true;
        }

      }
      return false;
    }
}

