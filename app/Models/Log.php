<?php

namespace App\Models;

class Log extends Model
{

    /**
     * Log message
     *
     * @var string
     */
    private $event;

    public function __construct(\PDO $dbh, string $table, string $key, string $event = '') {

        parent::__construct($dbh, $table, $key);
        
        $this->event = $event;
    }

    /**
     * Insert new created user profile into database
     *
     * @return string
     */
    public function create():array|int
    {

        // Insert query start
        $query = "INSERT INTO {$this->table}
                (event)
                VALUES
                (:event)";

        $stmt = self::$dbh->prepare($query);

        $stmt->bindValue(':event', $this->event, \PDO::PARAM_STR );

        $stmt->execute();

        $id = self::$dbh->lastInsertId();

        return $id ?? '';
    }

    /**
     * get the record from the table in selected length
     *
     * @param string $len
     * @return array
     */
    public function getRecord(string $len):array
    {
        $query = "SELECT 
                    id,
                    event
                    FROM
                    {$this->table}
                    ORDER BY {$this->key} DESC
                    LIMIT $len";

        $stmt = self::$dbh->prepare($query);

        $stmt->execute();

        $results = $stmt->fetchAll();

        return $results ?? [];
    }

}