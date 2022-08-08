<?php

namespace App\Models;

class Order extends Model
{

    /**
     * Array of key/value pairs to be stored
     *
     * @var array
     */
    protected $session;


    public function __construct(\PDO $dbh, string $table, string $key, array $session = []) 
    {

        parent::__construct($dbh, $table, $key);
        $this->session = $session;

    }

    public function create():array|int
    {

    }

    /**
     * Insert new invoice row into invoice table
     *
     * @return string
     */
    public function createOrder(array $params):int
    {
        // Insert query start
        $query = "INSERT INTO invoice
                    (
                        subtotal,
                        discount_amount,
                        gst_amount,
                        pst_amount,
                        total_amount,
                        user_id,
                        user_information
                    )
                    VALUES
                    (
                        :subtotal,
                        :discount_amount,
                        :gst_amount,
                        :pst_amount,
                        :total_amount,
                        :user_id,
                        :user_information
                    );";


        $stmt = self::$dbh->prepare($query);

        $stmt->execute($params);

        $id = self::$dbh->lastInsertId();

        return $id ?? null;
    }

    /**
     * Insert new records into invoiceline table
     *
     * @param array $params
     * @return integer
     */
    public function createOrderLineItem(array $params):int
    {
        $query = "INSERT INTO invoiceline
                    (
                        product_name,
                        product_price,
                        line_price,
                        quantity,
                        invoice_id,
                        product_id
                    )
                    VALUES
                    (
                        :product_name,
                        :product_price,
                        :line_price,
                        :quantity,
                        :invoice_id,
                        :product_id
                    );";


        $stmt = self::$dbh->prepare($query);

        $stmt->execute($params);

        $id = self::$dbh->lastInsertId();

        return $id ?? null;
    }

    /**
     * get all invoice data
     *
     * @return array
     */
    public function getAllAdmin(): array
    {
        $query = "SELECT 
                    a.id,
                    a.created_at,
                    a.user_information,
                    a.subtotal,
                    a.discount_amount,
                    a.gst_amount,
                    a.pst_amount,
                    a.total_amount,
                    count(b.quantity) as quantity
                    FROM 
                    {$this->table} a
                    JOIN 
                    invoiceline b
                    ON a.id = b.invoice_id
                    GROUP BY
                    a.id,
                    a.created_at,
                    a.user_information,
                    a.subtotal,
                    a.discount_amount,
                    a.gst_amount,
                    a.pst_amount,
                    a.total_amount
                    ORDER BY
                    a.created_at DESC";

        $stmt = self::$dbh->query($query);

        $results = $stmt->fetchAll();
        
        return $results ?? [];
    }

    /**
     * Get Invocie by Id
     *
     * @return array
     */
    public function getInvoiceById(): array
    {
        $query = "SELECT 
                    *
                    FROM 
                    invoice
                    WHERE
                    {$this->key} = :{$this->key};";

        $stmt = self::$dbh->prepare($query);

        $stmt->bindParam(":id", $this->session['latest_order'], \PDO::PARAM_INT);

        $stmt->execute();

        $results = $stmt->fetch();

        return $results ?? [];
    }

    /**
     * Get invoice line item from invoice table id
     *
     * @return array
     */
    public function getInvoicelineByInvoiceId(): array
    {
        $query = "SELECT 
                    *
                    FROM 
                    invoiceline
                    WHERE
                    invoice_id = :invoice_id;";

        $stmt = self::$dbh->prepare($query);

        $stmt->bindParam(":invoice_id", $this->session['latest_order'], \PDO::PARAM_INT);

        $stmt->execute();
        
        $results = $stmt->fetchAll();

        return $results ?? [];
    }

}
