<?php

namespace App\Models;

class Categories extends Model
{
    /**
     * Get all the details from category table
     *
     * @return array
     */
    public function getAllCategories(): array
    {
        $query = "SELECT 
                    id,
                    title,
                    deleted
                    FROM
                    {$this->table}";
        
        $stmt = self::$dbh->query($query);

        $results = $stmt->fetchAll();

        return $results ?? [];
    }

    public function create():array|int {}

}
