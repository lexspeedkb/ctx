<?php

namespace App\Types;

use JetBrains\PhpStorm\ArrayShape;

class DBWhereParamsType extends BaseType
{
    public int $limit = -1;
    public int $offset = 0;
    public string|bool $sort_row = false;
    public string $sort_direction = 'DESC';
    public string $select = '*';
    public string $where = '';
    public string $join = '';
    public string $custom_entity = '';

    public function __construct(array $payload = [])
    {
        parent::__construct($payload);
    }
}