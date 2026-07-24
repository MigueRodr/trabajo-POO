<?php
abstract class basedatos
{
    private $Servidor = 'localhost';
    private $BaseDatos = 'persona';
    private $Usuario = 'root';
    private $Clave = '';

    protected $Conexion_ID;
    protected $Consulta_ID;
    protected $ResultadoCon;
    protected $ErrNo;
    protected $ErrTxt;

    // ========== NUEVO CONSTRUCTOR ==========
    public function __construct() {
        $this->conectar();  // Establece la conexión al instanciar
    }
    // =======================================

    abstract protected function consultar();
    abstract protected function insertar();
    abstract protected function actualizar();
    abstract protected function eliminar();

    protected function conectar()
    {
        try {
            $this->Conexion_ID = new PDO(
                'mysql:host=' . $this->Servidor . ';dbname=' . $this->BaseDatos,
                $this->Usuario,
                $this->Clave,
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
                    PDO::MYSQL_ATTR_LOCAL_INFILE => true
                ]
            );
        } catch (PDOException $e) {
            $this->ErrNo = -1;
            $this->ErrTxt = $e->getMessage();
        }
    }

    protected function desconectar()
    {
        $this->Conexion_ID = null;
    }

    public function ejecutarSQL($sql)
    {
        if ($this->Conexion_ID) {
            try {
                $this->Consulta_ID = $this->Conexion_ID->query($sql);
                return $this->Consulta_ID;
            } catch (PDOException $e) {
                $this->ErrTxt = $e->getMessage();
                return false;
            }
        }
        return false;
    }

    protected function cargarTodo()
    {
        if ($this->Conexion_ID) {
            $this->ResultadoCon = $this->Consulta_ID->fetchAll();
        } else {
            $this->ResultadoCon = false;
        }
        return $this->ResultadoCon;
    }

    protected function cargarRegistro()
    {
        if ($this->Conexion_ID) {
            $this->ResultadoCon = $this->Consulta_ID->fetch(PDO::FETCH_BOTH);
        } else {
            $this->ResultadoCon = false;
        }
        return $this->ResultadoCon;
    }

    public function imprimirError()
    {
        return sprintf("Error: %s - %s", $this->ErrNo, $this->ErrTxt);
    }

    private function limpiarerror()
    {
        $this->ErrNo = "";
        $this->ErrTxt = "";
    }
}