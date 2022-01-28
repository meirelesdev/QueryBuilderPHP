<?php

declare(strict_types=1);

namespace Daniel\QueryBuilder\Sql;


class Select
{
    private string $table;
    private string $where = '';
    private string $orderBy = '';
    private array $fields = [];

    public function setTable(string $table): Select
    {
        $this->table = $table;
        return $this;
    }
    public function getTable(): string
    {
        return $this->table;
    }
    public function getSQL(): string
    {
        $fields = $this->getFields();
        $where = $this->getWhere();
        $order = $this->getOrderBy();
        return "SELECT {$fields} FROM {$this->table}{$where}{$order};";
    }
    public function setFields(array $fields): Select
    {
        $this->fields = $fields;
        return $this;
    }
    public function where(string $field, string $compar, $value): void
    {
        $this->where = " WHERE {$field} {$compar} {$value}";
    }
    public function orderBy(string $field, string $order): void
    {
        $this->orderBy = " ORDER BY {$field} {$order}";
    }
    protected function getOrderBy()
    {
        return $this->orderBy;
    }
    protected function getFields(): string
    {
        return count($this->fields) > 0 ? implode(', ', $this->fields) : '*';
    }
    protected function getWhere(): string
    {
        return $this->where;
    }
}
