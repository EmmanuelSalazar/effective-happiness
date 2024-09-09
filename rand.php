<?php
        require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
class   IdRand {
    public $query, $credenciales, $table, $col, $colRow, $cont, $contQuery, $reCount;
    public function __construct($table, $col) {
        $this->query = "SELECT * FROM ".$table."";
        $this->col = $col;
        $this->table = $table;
    }
    private function idCon() {
        $this->credenciales = parse_ini_file(CONFIG_PATH."config.php.ini");
        $mysqli = new mysqli($this->credenciales["servidor"], $this->credenciales["usuario"], $this->credenciales["contrasena"], $this->credenciales["db"]);
        $query = $mysqli->query($this->query);
        $count = $query->num_rows;
        $reCount = rand(1, $count);
        $contQuery = "SELECT * FROM ".$this->table." WHERE ".$this->col."=".$reCount."";
        $contQuery = $mysqli->query($contQuery);
        $contQuery = $contQuery->fetch_object();
        return $contQuery->ID;
    }
    public function idRand() {
            $contQuery = $this->idCon();
                    if($contQuery != NULL OR "") {
                        return $contQuery;
                       
                    } else {
                        $contQuery = $this->idCon();
                        return $contQuery;
                    }
        }
    }
/* $foo = new IdRand("usuarios", "ID");
$foo = $foo->idRand();
echo $foo; */
?>