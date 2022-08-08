<?php 

require __DIR__ . '/credentials.php';

try {

    // create connection to MySQL using POD
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASS);
    // Tell PDO that we want to see exceptions
    $dbh->setAttribute(PDO::ATTR_ERRMODE, 
                        PDO::ERRMODE_EXCEPTION);
    // Tell PDO to return results as associative arrays
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, 
                        PDO::FETCH_ASSOC);

} catch(PDOException $e) {

    echo 'MySQL Connection Problem: ' . $e->getMessage();
    die;

}
