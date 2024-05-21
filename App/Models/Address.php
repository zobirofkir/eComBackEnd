<?php
namespace Model;

use Model\Model;

class Address extends Model
{
    private $table = "addresses";

    public function storeAddress($address_line1, $address_line2, $city, $state, $postal_code, $country)
    {
        $fields = [
            "address_line1"=>$address_line1,
            "address_line2"=>$address_line2,
            "city"=>$city,
            "state"=>$state,
            "postal_code"=>$postal_code,
            "country"=>$country
        ];
        return $this->store($this->table, $fields);
    }
}
