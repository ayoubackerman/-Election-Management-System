<?php
class database 
{
    var $pdo;
    
    public function __construct()
    {
        try {
            $this->pdo = new Pdo('mysql:host=127.0.0.1;dbname=election', 'root', '');
        } catch (PDOException $e){
            print_r($e);
        }
    }
    
    public function getOne(string $sql)
    {
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $tab = $query->fetchAll(PDO::FETCH_ASSOC);
        return $tab[0];
    }
    public function getMany(string $sql)
    {
        $query = $this->pdo->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function sendSQL(string $sql, array $param = [])
    {
        $query = $this->pdo->prepare($sql);
        return $query->execute($param);
    }
}
   

?>