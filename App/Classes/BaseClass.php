<?php

namespace App\Classes;

use App\Entities\BaseEntity;
use App\Types\DBWhereParamsType;
use Exception;
use system\BaseModel;

trait BaseClass
{

    /**
     * @return BaseModel
     */
    public static function getModel(): BaseModel
    {
        $className = explode('\\', static::class);
        $modelName = 'App\\Models\\' . $className[count($className) - 1] . 'Model';
        return new $modelName();
    }

    /**
     * @param DBWhereParamsType|null $DBWhereParamsType $DBWhereParamsType |null $DBWhereParamsType $DBWhereParamsType
     * @return parent[]|null
     */
    public static function findAll(DBWhereParamsType $DBWhereParamsType = null): array|null
    {
        $model = self::getModel();

        if ($DBWhereParamsType === null) {
            $DBWhereParamsType = new DBWhereParamsType();
        }

        $sql = "SELECT $DBWhereParamsType->select FROM $model->table";

        if ($DBWhereParamsType->where !== '') {
            $sql .= " WHERE $DBWhereParamsType->where";
        }

        if ($DBWhereParamsType->join !== '') {
            $sql .= $DBWhereParamsType->join . ' ';
        }

        if ($DBWhereParamsType->sort_row !== false) {
            $sql .= " ORDER BY $DBWhereParamsType->sort_row $DBWhereParamsType->sort_direction";
        }

        if ($DBWhereParamsType->limit !== -1) {
            $sql .= " LIMIT $DBWhereParamsType->offset, $DBWhereParamsType->limit";
        }

        $data = $model->db->query($sql)->fetchAll();

        if (sizeof($data) === 0) {
            return null;
        }

        $return = [];
        foreach ($data as $item) {
            if ($DBWhereParamsType->custom_entity !== '') {
                $EntityName = $DBWhereParamsType->custom_entity;
            } else {
                $EntityName = $model->entity;
            }
            $return[] = (new $EntityName())->load($item);
        }

        return $return;
    }

    /**
     * @param int|string $primary
     * @return parent|null
     */
    public static function findByPrimary(int|string $primary): BaseEntity|null
    {
        $model = self::getModel();
        $item = $model->db->query("SELECT * FROM $model->table WHERE `$model->primary`='$primary'")->fetchArray();

        $EntityName = $model->entity;

        if (sizeof($item) !== 0) {
            return (new $EntityName($item))->load($item);
        } else {
            return null;
        }
    }

    /**
     * @param BaseEntity $BaseEntity
     * @return bool|int
     * @throws Exception
     */
    public static function create(BaseEntity $BaseEntity): bool|int
    {
        $model = self::getModel();

        if (!$BaseEntity instanceof $model->entity) {
            throw new Exception('Try to put in database wrong entity. Expected ' . $model->entity . ', ' . $BaseEntity::class . ' given');
        }

        $sql = "INSERT INTO $model->table ";

        $keys = '(';
        $values = 'VALUES (';
        foreach ($BaseEntity->getAllData() as $key => $value) {
            $keys .= '`' . $key . '`' . ', ';

            if (is_null($value)) {
                $values .= "null, ";
                continue;
            }

            if (is_bool($value)) {
                $value = $value ? 1 : 0;
            }

            $values .= "'" . $value . "', ";
        }
        $keys = substr($keys, 0, -2) . ') ';
        $values = substr($values, 0, -2) . ') ';

        $sql .= $keys . $values;

        try {
            $model->db->query($sql);
        } catch (Exception) {
            return false;
        }

        return $model->db->lastInsertID();
    }

    /**
     * @param BaseEntity $BaseEntity
     * @return bool|int
     * @throws Exception
     */
    public static function update(BaseEntity $BaseEntity): bool|int
    {
        $model = self::getModel();

        if (!$BaseEntity instanceof $model->entity) {
            throw new Exception('Try to put in database wrong entity. Expected ' . $model->entity . ', ' . $BaseEntity::class . ' given');
        }

        $sql = "UPDATE $model->table SET ";

        foreach ($BaseEntity->getAllData() as $key => $value) {
            if ($key === $model->primary) {
                continue;
            }

            if (is_null($value)) {
                $sql .= "`$key`=null, ";
                continue;
            }

            if (is_bool($value)) {
                $value = $value ? 1 : 0;
            }

            $sql .= "`$key`='$value', ";
        }

        $sql = substr($sql, 0, -2);

        $sql .= " WHERE `$model->primary`='{$BaseEntity->{$model->primary}}'";


        try {
            $model->db->query($sql);
        } catch (Exception $exception) {
            return false;
        }

        return true;
    }

    /**
     * @param int|string $primary
     * @return bool
     */
    public static function deleteByPrimary(int|string $primary): bool
    {
        $model = self::getModel();

        $sql = "DELETE FROM $model->table WHERE `$model->primary`='$primary'";

        try {
            $model->db->query($sql);
        } catch (Exception $exception) {
            return false;
        }

        return true;
    }

    /**
     * @param int|string $primary
     * @param array $payload
     * @return bool
     */
    public static function updateByPrimary(int|string $primary, array $payload): bool
    {
        $model = self::getModel();

        $sql = "UPDATE $model->table SET ";

        foreach ($payload as $key => $value) {
            if ($key === $model->primary) {
                continue;
            }

            if (is_null($value)) {
                $sql .= "`$key`=null, ";
                continue;
            }

            if (is_bool($value)) {
                $value = $value ? 1 : 0;
            }

            $sql .= "`$key`='$value', ";
        }

        $sql = substr($sql, 0, -2);

        $sql .= " WHERE `$model->primary`='$primary'";

        try {
            $model->db->query($sql);
        } catch (Exception $exception) {
            return false;
        }

        return true;
    }

    /**
     * @param DBWhereParamsType|null $DBWhereParamsType
     * @return int
     */
    public static function countAll(DBWhereParamsType $DBWhereParamsType = null): int
    {
        $model = self::getModel();

        $sql = "SELECT COUNT(*) FROM $model->table";

        if ($DBWhereParamsType !== null && $DBWhereParamsType->where != '') {
            $sql .= ' WHERE ' . $DBWhereParamsType->where;
        }

        $data = $model->db->query($sql)->fetchArray();

        return $data['COUNT(*)'];
    }
}