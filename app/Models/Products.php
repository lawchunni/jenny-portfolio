<?php

namespace App\Models;

class Products extends Model
{
    /**
     * Array of key/value pairs to be validated
     *
     * @var array
     */
    private $get;

    /**
     * Array of key/value pairs to be validated
     *
     * @var array
     */
    private $post;


    public function __construct(\PDO $dbh, string $table, string $key, array $get = null, $post = null)
    {
        parent::__construct($dbh, $table, $key);

        $this->get = $get;
        $this->post = $post;
    }

    /**
     * Inset new record into product table
     *
     * @return array|integer
     */
    public function create():array|int
    {
        // Insert query start
        $query = "INSERT INTO {$this->table}
                (
                    title,
                    image,
                    summary,
                    description,
                    technology,
                    price,
                    discount_available,
                    discount_rate,
                    status,
                    category_id,
                    deleted
                )
                VALUES
                (
                    :title,
                    :image,
                    :summary,
                    :description,
                    :technology,
                    :price,
                    :discount_available,
                    :discount_rate,
                    :status,
                    :category_id,
                    :deleted
                )";

        $stmt = self::$dbh->prepare($query);

        $params = [
            ':title' => $this->post['title'],
            ':image' => $this->post['image'],
            ':summary' => $this->post['summary'],
            ':description' => $this->post['description'],
            ':technology' => $this->post['technology'],
            ':price' => $this->post['price'],
            ':discount_available' => $this->post['discount_available'],
            ':discount_rate' => $this->post['discount_rate'],
            ':status' => $this->post['status'],
            ':category_id' => $this->post['category'],
            ':deleted' => $this->post['deleted']
        ];

        $stmt->execute($params);

        $id = self::$dbh->lastInsertId();

        $results = [
            'id'=>$id,
            'title'=>ucwords($this->post['title'])
        ];

        return $id ? $results : [];
    }

    /**
     * update record in product table
     *
     * @return integer
     */
    public function update():int
    {
        $query = "UPDATE 
                    {$this->table}
                  SET
                    title = :title,
                    image = :image,
                    summary = :summary,
                    description = :description,
                    technology = :technology,
                    price = :price,
                    discount_available = :discount_available,
                    discount_rate = :discount_rate,
                    status = :status,
                    category_id = :category_id,
                    deleted = :deleted
                  WHERE
                    {$this->key} = :{$this->key}
              ";

        $stmt = self::$dbh->prepare($query);

        $params = [
            ':title' => $this->post['title'],
            ':image' => $this->post['image'],
            ':summary' => $this->post['summary'],
            ':description' => $this->post['description'],
            ':technology' => $this->post['technology'],
            ':price' => $this->post['price'],
            ':discount_available' => $this->post['discount_available'],
            ':discount_rate' => $this->post['discount_rate'],
            ':status' => $this->post['status'],
            ':category_id' => $this->post['category'],
            ':deleted' => $this->post['deleted'],
            ":$this->key" => $this->post['id']
        ];

        $stmt->execute($params);

        $rowCount = $stmt->rowCount();

        return $rowCount;
    }

    /**
     * Soft delete product from database
     *
     * @return integer
     */
    public function delete():int
    {
        $query = "UPDATE 
                    {$this->table}
                    SET
                    deleted = :deleted
                    WHERE
                    {$this->key} = :{$this->key}
                ";
        
        $stmt = self::$dbh->prepare($query);

        $params = [
            ':deleted' => $this->post['deleted'],
            ":$this->key" => $this->post['id']
        ];

        $stmt->execute($params);

        $rowCount = $stmt->rowCount();

        return $rowCount;
    }

    /**
     * get all the products information for all services page
     *
     * @return array
     */
    public function getAllProducts():array
    {
        $query = "SELECT
                    b.title as category_title,
                    a.id,
                    a.title as product_title,
                    a.summary,
                    a.price,
                    a.discount_available,
                    a.discount_rate,
                    a.category_id,
                    b.title as category_title
                    FROM
                    {$this->table} a
                    JOIN 
                    category b ON a.category_id = b.id
                    WHERE 
                    a.deleted <> 1";
        
        $stmt = self::$dbh->prepare($query);

        $stmt->execute();

        $results = $stmt->fetchAll(\PDO::FETCH_GROUP);

        return $results ?? [];
    }

    /**
     * get all the products information for Admin view product list page
     *
     * @return array
     */
    public function getAllProductsAdminList():array
    {
        $query = "SELECT
                    a.id,
                    a.title,
                    b.title as category_title,
                    a.price,
                    a.discount_rate,
                    a.status,
                    a.deleted
                    FROM
                    {$this->table} a
                    JOIN 
                    category b ON a.category_id = b.id
                    ORDER BY
                    a.id";
        
        $stmt = self::$dbh->prepare($query);

        $stmt->execute();

        $results = $stmt->fetchAll();

        return $results ?? [];
    }

    /**
     * get the products information by Search value for Admin page
     *
     * @return array
     */
    public function getProductsBySearchAdmin():array
    {
        $query = "SELECT 
                    a.id,
                    a.title,
                    b.title as category_title,
                    a.price,
                    a.discount_rate,
                    a.status,
                    a.deleted
                    FROM
                    {$this->table} a
                    JOIN 
                    category b ON a.category_id = b.id
                    AND
                    (a.title LIKE :search OR
                    b.title LIKE :search OR
                    a.status LIKE :search)
                    ORDER BY
                    a.id
                    ";
        
        $stmt = self::$dbh->prepare($query);

        $trimmed_value = trim($this->get['search']);

        $stmt->bindValue(":search", "%{$trimmed_value}%");

        $stmt->execute();
   
        $results = $stmt->fetchAll();

        return $results ?? [];
    }

    /**
     * get the products information by Category
     *
     * @return array
     */
    public function getProductsByCategory():array
    {
        $query = "SELECT 
                    b.title as category_title,
                    a.id,
                    a.title as product_title,
                    a.summary,
                    a.price,
                    a.discount_available,
                    a.discount_rate,
                    a.category_id,
                    b.title as category_title
                    FROM
                    {$this->table} a
                    JOIN 
                    category b ON a.category_id = b.id
                    WHERE 
                    a.deleted <> 1
                    AND
                    a.category_id = :category";
        
        $stmt = self::$dbh->prepare($query);
        
        $stmt->bindParam(":category", $this->get['category']);

        $stmt->execute();

        $results = $stmt->fetchAll(\PDO::FETCH_GROUP);

        return $results ?? [];
    }

    
    /**
     * get the products information by Search value
     *
     * @return array
     */
    public function getProductsBySearch():array
    {
        $query = "SELECT 
                    b.title as category_title,
                    a.id,
                    a.title as product_title,
                    a.summary,
                    a.price,
                    a.discount_available,
                    a.discount_rate,
                    a.category_id
                    FROM
                    {$this->table} a
                    JOIN 
                    category b ON a.category_id = b.id
                    WHERE 
                    a.deleted <> 1
                    AND
                    a.title LIKE :search OR
                    b.title LIKE :search OR
                    a.summary LIKE :search
                    ";
        
        $stmt = self::$dbh->prepare($query);

        $trimmed_value = trim($this->get['search']);

        $stmt->bindValue(":search", "%{$trimmed_value}%");

        $stmt->execute();
   
        $results = $stmt->fetchAll(\PDO::FETCH_GROUP);

        return $results ?? [];
    }

    /**
     * get a single product for service details page
     *
     * @return array
     */
    public function getOneProduct():array
    {

        $query = "SELECT 
                    a.*,
                    b.title as category_title 
                    FROM 
                    {$this->table} a
                    JOIN 
                    category b
                    ON a.category_id = b.id
                    WHERE
                    a.{$this->key} = :{$this->key}
                    AND
                    a.deleted <> 1";

        $stmt = self::$dbh->prepare($query);

        $stmt->bindParam(":{$this->key}", $this->get[$this->key]);

        $stmt->execute();

        $result = $stmt->fetch();

        return $result ?? [];

    }

    /**
     * get a single product for admin page
     *
     * @return array
     */
    public function getOneProductAdmin():array
    {

        $query = "SELECT 
                    a.*,
                    b.title as category_title 
                    FROM 
                    {$this->table} a
                    JOIN 
                    category b
                    ON a.category_id = b.id
                    WHERE
                    a.{$this->key} = :{$this->key}";

        $stmt = self::$dbh->prepare($query);

        $stmt->bindParam(":{$this->key}", $this->get[$this->key]);

        $stmt->execute();

        $result = $stmt->fetch();

        return $result ?? [];

    }

}