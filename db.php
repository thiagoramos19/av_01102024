<?php

// aqui nós vamos criar o arquivo que vai conectar com o banco de dados
// usando mysqli como foi solicitado

class Database {
    private $mysqli;
    private $host;
    private $db;
    private $user;
    private $pass;
    private $port;

 
    public function __construct($host, $db, $user, $pass, $port = 3307) { // constrói uma função de base, definindo host, banco, user, senha e tal
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
        $this->port = $port;
    }

 
    public function connect() {    // função que conecta com o banco de dados
        $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db, $this->port);

        
        if ($this->mysqli->connect_error) { // manda mensagem de erro pro navegador
            die("Erro na conexão com o banco de dados: " . $this->mysqli->connect_error);
        }
        
        echo "Conexão com o banco de dados MySQL realizada com sucesso!"; // anuncia que o banco foi conectado com sucesso
    }

    
    public function getConnection() { // libera a função pros outros arquivos conectarem também
        return $this->mysqli;
    }
}
?>
