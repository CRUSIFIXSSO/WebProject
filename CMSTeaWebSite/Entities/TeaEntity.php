<?php

class TeaEntity
{
    public $id;
    public $name;
    public $type;
    public $price;
    public $flavour;
    public $country;
    public $image;
    public $review;
    
    function __construct($id, $name, $type, $price, $flavour, $country, $image, $review) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
        $this->flavour = $flavour;
        $this->country = $country;
        $this->image = $image;
        $this->review = $review;
    }

}

?>
