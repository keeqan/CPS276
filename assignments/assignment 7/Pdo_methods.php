<?php
require 'Db_conn.php';

class PdoMethods extends DatabaseConn {
    private $sth;

    public function otherBinded($sql, $bindings) {
        $this->dbOpen();
        $this->sth = $this->conn->prepare($sql);
        
        foreach ($bindings as $binding) {
            $this->sth->bindValue($binding[0], $binding[1], $binding[2] === 'int' ? PDO::PARAM_INT : PDO::PARAM_STR);
        }

        if ($this->sth->execute()) {
            return true;
        } else {
            return 'error';
        }
    }

    public function selectNotBinded($sql) {
        $this->dbOpen();
        $this->sth = $this->conn->prepare($sql);
        $this->sth->execute();
        return $this->sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
