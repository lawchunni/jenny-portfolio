<?php

namespace App\Models;

class Dashboard extends Model
{
    /**
     * Count total products which are not deleted
     *
     * @return array
     */
    public function countProducts(): array
    {
        $query = "SELECT
                    count(*) as total
                  FROM
                    product
                  WHERE
                    deleted <> 1;
                 ";

        $stmt = self::$dbh->query($query);

        $result = $stmt->fetch();

        return $result ?? [];
    }

    /**
     * Count total users which are not deleted
     *
     * @return array
     */
    public function countUsers(): array
    {
        $query = "SELECT
                    count(*) as total
                  FROM
                    user
                  WHERE
                    deleted <> 1;
                 ";

        $stmt = self::$dbh->query($query);

        $result = $stmt->fetch();

        return $result ?? [];
    }

    /**
     * Count total invoice
     *
     * @return array
     */
    public function countInvoice(): array
    {
        $query = "SELECT
                    count(*) as total
                  FROM
                    invoice;
                 ";

        $stmt = self::$dbh->query($query);

        $result = $stmt->fetch();

        return $result ?? [];
    }

    /**
     * Product price aggregation
     *
     * @return array
     */
    public function productsOverview(): array
    {
        $query = "SELECT
                    MAX(price) as max_price,
                    MIN(price) as min_price,
                    AVG(price) as avg_price
                  FROM
                    product
                  WHERE
                    deleted <> 1;
                 ";

        $stmt = self::$dbh->query($query);

        $result = $stmt->fetch();

        return $result ?? [];
    }

    /**
     * Invoice amount aggregation
     *
     * @return array
     */
    public function invoicesOverview(): array
    {
        $query = "SELECT
                    MAX(total_amount) as max_amount,
                    MIN(total_amount) as min_amount,
                    AVG(total_amount) as avg_amount
                  FROM
                    invoice;
                 ";

        $stmt = self::$dbh->query($query);

        $result = $stmt->fetch();

        return $result ?? [];
    }

    public function create():array|int { }

}