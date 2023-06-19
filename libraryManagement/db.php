<?php

function Database(){
    
    try{
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=libraryManagement', 'root', 'mysql');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}



