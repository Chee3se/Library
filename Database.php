<?php
//initiate connection with database and execute querrys?
class Database {

    private $connection;

    public function __construct($config) {
        $connection_string = "mysql:".http_build_query($config,"",";");
        $this->connection = new PDO($connection_string);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    public function execute($query_string, $params) {
        $query = $this->connection->prepare($query_string);
        $query->execute($params);
        return $query->fetchAll();
    }

    public function __destruct() {
        $this->connection = null;
    }
 }
?>