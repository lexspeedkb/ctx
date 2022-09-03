<?php

namespace App\Interfaces;

use App\Entities\BaseEntity;
use App\Types\DBWhereParamsType;

interface ClassInterface
{
    /**
     * @param DBWhereParamsType|null $DBWhereParamsType
     * @return array|null
     */
    public static function findAll(DBWhereParamsType|null $DBWhereParamsType = null): array|null;

    /**
     * @param int|string $primary
     * @return BaseEntity|null
     */
    public static function findByPrimary(int|string $primary): BaseEntity|null;

    /**
     * @param BaseEntity $BaseEntity
     * @return bool|int
     */
    public static function create(BaseEntity $BaseEntity): bool|int;

    /**
     * @param int|string $primary
     * @return mixed
     */
    public static function deleteByPrimary(int|string $primary): bool;

    /**
     * @param int|string $primary
     * @param array $payload
     * @return bool
     */
    public static function updateByPrimary(int|string $primary, array $payload): bool;

    /**
     * @param DBWhereParamsType|null $DBWhereParamsType
     * @return int
     */
    public static function countAll(DBWhereParamsType $DBWhereParamsType = null): int;
}