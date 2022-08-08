<?php 

namespace App\Models;

class User extends Model
{
    /**
     * Array of key/value pairs to be validated
     *
     * @var array
     */
    private $post;

    /**
     * Array of key/value pairs to be stored
     *
     * @var array
     */
    protected $session;

    /**
     * Array of the table fields with rules to apply
     *
     * @var array
     */
    protected $fieldsRules;


    public function __construct(\PDO $dbh, string $table, string $key,array $post = [], array $session = [],  array $fieldsRules = []) 
    {

        parent::__construct($dbh, $table, $key);
        
        $this->post = $post;
        $this->session = $session;
        $this->fieldsRules = $fieldsRules;
    }


    /**
     * Insert new created user profile into database
     *
     * @return string
     */
    public function create():array|int
    {
        // generate dynamic sql statement
        $stmtFields = $this->stmtFormatter('create', $this->fieldsRules, $this->post);

        $fieldStr = $stmtFields['fieldStr'];
        $valueStr = $stmtFields['valueStr'];

        // Insert query start
        $query = "INSERT INTO {$this->table}
                ($fieldStr)
                VALUES
                ($valueStr)";

        $stmt = self::$dbh->prepare($query);

        $params = $this->formatField($stmtFields['post']);

        $stmt->execute($params);

        $id = self::$dbh->lastInsertId();

        $results = [
            'id'=>$id,
            'name'=>ucwords($this->post['first_name'])
        ];

        return $id ? $results : [];
    }

    /**
     * get All user profile information from darabase
     *
     * @return array
     */
    public function getAllUsers():array
    {
        
        $query = "SELECT 
                    *
                    FROM
                    {$this->table}
                    ";

        $stmt = self::$dbh->query($query);

        $results = $stmt->fetchAll();

        return $results ?? [];
    }

    /**
     * get user profile information from darabase
     *
     * @return array
     */
    public function getUserProfile():array
    {
        // generate dynamic sql statement
        $stmtFields = $this->stmtFormatter('read', $this->fieldsRules);
        $fieldStr = $stmtFields['fieldStr'];

        $query = "SELECT 
                    $fieldStr
                    FROM
                    {$this->table}
                    WHERE
                    {$this->key} = :id;
                    ";

        $stmt = self::$dbh->prepare($query);

        $user_id = $this->session['user_id']; 

        $stmt->bindValue(':id', $user_id, \PDO::PARAM_INT);

        $stmt->execute();

        $results = $stmt->fetch();

        return $results ?? [];
    }

    /**
     * get users basic information when login for 
     * 1. email exist checking
     * 2. password matching
     * 3. first_name for flash message greeting when login success
     *
     * @param [type] $email
     * @return array
     */
    public function getUserLogin($email):array
    {
        // generate dynamic sql statement
        $stmtFields = $this->stmtFormatter('read', $this->fieldsRules);
        $fieldStr = $stmtFields['fieldStr'];

        $query = "SELECT 
                    $fieldStr
                    FROM
                    {$this->table}
                    WHERE
                    {$this->key} = :email";
        
        $stmt = self::$dbh->prepare($query);

        $stmt->bindValue(':email', $email);

        $stmt->execute();

        $result = $stmt->fetch();

        return !empty($result) ? $result : [];
    }

    /**
     * check email exist when register
     *
     * @param [type] $email
     * @return array
     */
    public function checkEmailExist($email):bool
    {

        $query = "SELECT 
                    id,
                    email
                    FROM
                    {$this->table}
                    WHERE
                    email = :email";
        
        $stmt = self::$dbh->prepare($query);

        $stmt->bindValue(':email', $email);

        $stmt->execute();

        $result = $stmt->fetch();

        return !empty($result) ? true : false;
    }

}
