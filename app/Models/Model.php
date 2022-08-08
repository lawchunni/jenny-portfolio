<?php

namespace App\Models;

abstract class Model
{

    use Traits\FieldFormatter;
    use Traits\SqlStmtHelper;

    /**
     * database handler
     *
     * @var \PDO
     */
    protected static $dbh;

    /**
     * String of the database table name
     *
     * @var string
     */
    protected $table;

    /**
     * String of the key name for where clause
     *
     * @var string
     */
    protected $key;

    /**
     * Init
     *
     * @param array $post - requerst method
     * @param array $session
     */
    public function __construct(\PDO $dbh, string $table, string $key)
    {
        self::$dbh = $dbh;
        $this->table = $table;
        $this->key = $key;
        
    }

    abstract public function create():array|int;

}