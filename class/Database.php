<?php

class Database {
    public static function connect() {
        $dsn = 'mysql:dbname=cuisinx;host=127.0.0.1';
        $user = 'root';
        $password = '';
        $dbh = null;
        try {
            $dbh = new PDO($dsn, $user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            exit(0);
        }
        return $dbh;
    }
}

/*
function requete($dbh,$query){
    $sth = $dbh->prepare($query);
    $request_succeeded = $sth->execute();
    if ($request_succeeded){
        return $sth;
    }
}

*/