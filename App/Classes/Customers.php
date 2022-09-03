<?php

namespace App\Classes;

use App\Entities\CustomerEntity;
use App\Interfaces\ClassInterface;

class Customers extends CustomerEntity implements ClassInterface
{
    use BaseClass;

    public static function search(string $s): array|null
    {
        $model = self::getModel();

        $data = $model->search($s);

        $return = [];
        foreach ($data as $item) {
            $EntityName = $model->entity;
            $return[] = (new $EntityName())->load($item);
        }

        return $return;
    }
}