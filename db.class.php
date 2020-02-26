<?php

    class db{
        
        private $host = 'localhost';
        private $usuario = 'root';
        private $senha = '';
        private $database = 'twitter_clone';

        public function conecta_mysql(){

            //cria a conexao com o bd
            $con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);
            
            //ajusta o charset de comunicação entre a aplicação e o bd.
            mysqli_set_charset($con, 'utf8');

            //verifica se houve erro de conexão
            if(mysqli_connect_errno()){
                echo "Erro ao tentar conectar com o BD MySql: " . mysqli_connect_error();
            }

            return $con;
        }
    }

?>