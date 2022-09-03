<?php

namespace App\Classes;

use App\Entities\GoodEntity;
use App\Interfaces\ClassInterface;

class Goods extends GoodEntity implements ClassInterface
{
    use BaseClass;
}