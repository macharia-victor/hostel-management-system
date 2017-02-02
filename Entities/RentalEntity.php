<?php

class RentalEntity
{
    public $id;
    public $name;
    public $type;
    public $price;
    public $size;
    public $zone;
    public $image;
    public $review;
    
    function __construct($id, $name, $type, $price, $size, $zone, $image, $review) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
        $this->size = $size;
        $this->zone = $zone;
        $this->image = $image;
        $this->review = $review;
    }

}

?>
