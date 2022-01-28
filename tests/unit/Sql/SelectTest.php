<?php

declare(strict_types=1);

namespace Test\Sql;

use Daniel\QueryBuilder\Sql\Select;
use PHPUnit\Framework\TestCase;

class SelectTest extends TestCase
{
    protected $selectInstance;
    protected $table;

    protected function setUp(): void
    {
        $select = new Select();
        $this->table = 'users';
        $select->setTable($this->table);
        $this->selectInstance = $select;
    }
    public function testSelectSemFiltro()
    {   
        $actual = $this->selectInstance->getSQL();
        $expected = 'SELECT * FROM users;';
        $this->assertEquals($expected, $actual);
    }
    public function testShouldReturnTableName()
    {
        $actual = $this->selectInstance->getTable();
        $expected = $this->table;
        $this->assertEquals($expected, $actual);
    }
    public function testSelectWithFieldsSpecified()
    {
        $this->selectInstance->setFields(['name', 'email']);
        $expected = 'SELECT name, email FROM users;';
        $this->assertEquals($expected, $this->selectInstance->getSQL());
    }
    public function testSelectWithWhere()
    {
        $this->selectInstance->where('id', '=', 1);
        $actual = $this->selectInstance->getSQL();
        $expected = 'SELECT * FROM users WHERE id = 1;';
        $this->assertEquals($expected, $actual);
    }
    public function testSelectWithOrderBy()
    {
        $this->selectInstance->orderBy('createdAt', 'DESC');
        $actual = $this->selectInstance->getSQL();
        $expected = 'SELECT * FROM users ORDER BY createdAt DESC;';
        $this->assertEquals($expected, $actual);
    }
}