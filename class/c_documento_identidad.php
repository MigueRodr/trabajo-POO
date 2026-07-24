<?php
include_once("basedatos.php");
class Documento_identidad extends basedatos{
    public $nuip;
    public $tipo_documento;
    public $apellidos;
    public $nombres;
    public $nacionalidad;
    public $fecha_nacimiento;
    public $lugar_nacimiento;
    public $estatura;
    public $sexo;
    public $grupo_sanguineo;
    public $fecha_expedicion;
    public $lugar_expedicion;
    public $huella;
    public $foro_persona;
    public $fecha_expiracion;
    public $firma_persona;
    public $qr;
    public $firma_registrador;
    public $codigo_verificacion;

    function __construct($nuip = NULL, $tipo_documento = NULL, $apellidos = NULL, $nombres = NULL, $nacionalidad = NULL, $fecha_nacimiento = NULL, $lugar_nacimiento = NULL, $estatura = NULL, $sexo = NULL, $grupo_sanguineo = NULL, $fecha_expedicion = NULL, $lugar_expedicion = NULL, $huella = NULL, $foro_persona = NULL, $fecha_expiracion = NULL, $firma_persona = NULL, $qr = NULL, $firma_registrador = NULL, $codigo_verificacion = NULL){
        $this->nuip = $nuip;
        $this->tipo_documento = $tipo_documento;
        $this->apellidos = $apellidos;
        $this->nombres = $nombres;
        $this->nacionalidad = $nacionalidad;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->lugar_nacimiento = $lugar_nacimiento;
        $this->estatura = $estatura;
        $this->sexo = $sexo;
        $this->grupo_sanguineo = $grupo_sanguineo;
        $this->fecha_expedicion = $fecha_expedicion;
        $this->lugar_expedicion = $lugar_expedicion;
        $this->huella = $huella;
        $this->foro_persona = $foro_persona;
        $this->fecha_expiracion = $fecha_expiracion;
        $this->firma_persona = $firma_persona;
        $this->qr = $qr;
        $this->firma_registrador = $firma_registrador;
        $this->codigo_verificacion = $codigo_verificacion;
    }

    public function getNuip(){
        return $this->nuip;
    }

    public function getTipo_documento(){
        return $this->tipo_documento;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function getNombres(){
        return $this->nombres;
    }

    public function getNacionalidad(){
        return $this->nacionalidad;
    }

    public function getFecha_nacimiento(){
        return $this->fecha_nacimiento;
    }

    public function getLugar_nacimiento(){
        return $this->lugar_nacimiento;
    }

    public function getEstatura(){
        return $this->estatura;
    }

    public function getSexo(){
        return $this->sexo;
    }

    public function getGrupo_sanguineo(){
        return $this->grupo_sanguineo;
    }

    public function getFecha_expedicion(){
        return $this->fecha_expedicion;
    }

    public function getLugar_expedicion(){
        return $this->lugar_expedicion;
    }

    public function getHuella(){
        return $this->huella;
    }

    public function getForo_persona(){
        return $this->foro_persona;
    }

    public function getFecha_expiracion(){
        return $this->fecha_expiracion;
    }

    public function getFirma_persona(){
        return $this->firma_persona;
    }

    public function getQr(){
        return $this->qr;
    }

    public function getFirma_registrador(){
        return $this->firma_registrador;
    }

    public function getCodigo_verificacion(){
        return $this->codigo_verificacion;
    }

    public function setNuip($nuip){
        $this->nuip = $nuip;
    }

    public function setTipo_documento($tipo_documento){
        $this->tipo_documento = $tipo_documento;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }

    public function setNombres($nombres){
        $this->nombres = $nombres;
    }

    public function setNacionalidad($nacionalidad){
        $this->nacionalidad = $nacionalidad;
    }

    public function setFecha_nacimiento($fecha_nacimiento){
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function setLugar_nacimiento($lugar_nacimiento){
        $this->lugar_nacimiento = $lugar_nacimiento;
    }

    public function setEstatura($estatura){
        $this->estatura = $estatura;
    }

    public function setSexo($sexo){
        $this->sexo = $sexo;
    }

    public function setGrupo_sanguineo($grupo_sanguineo){
        $this->grupo_sanguineo = $grupo_sanguineo;
    }

    public function setFecha_expedicion($fecha_expedicion){
        $this->fecha_expedicion = $fecha_expedicion;
    }

    public function setLugar_expedicion($lugar_expedicion){
        $this->lugar_expedicion = $lugar_expedicion;
    }

    public function setHuella($huella){
        $this->huella = $huella;
    }

    public function setForo_persona($foro_persona){
        $this->foro_persona = $foro_persona;
    }

    public function setFecha_expiracion($fecha_expiracion){
        $this->fecha_expiracion = $fecha_expiracion;
    }

    public function setFirma_persona($firma_persona){
        $this->firma_persona = $firma_persona;
    }

    public function setQr($qr){
        $this->qr = $qr;
    }

    public function setFirma_registrador($firma_registrador){
        $this->firma_registrador = $firma_registrador;
    }

    public function setCodigo_verificacion($codigo_verificacion){
        $this->codigo_verificacion = $codigo_verificacion;
    }

    public function insertar(){
        $sql = sprintf("INSERT INTO documento_identidad (nuip, tipo_documento, apellidos, nombres, nacionalidad, fecha_nacimiento, lugar_nacimiento, estatura, sexo, grupo_sanguineo, fecha_expedicion, lugar_expedicion, huella, foro_persona, fecha_expiracion, firma_persona, qr, firma_registrador, codigo_verificacion) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $this->nuip, $this->tipo_documento, $this->apellidos, $this->nombres, $this->nacionalidad, $this->fecha_nacimiento, $this->lugar_nacimiento, $this->estatura, $this->sexo, $this->grupo_sanguineo, $this->fecha_expedicion, $this->lugar_expedicion, $this->huella, $this->foro_persona, $this->fecha_expiracion, $this->firma_persona, $this->qr, $this->firma_registrador, $this->codigo_verificacion);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    public function listar(){
        $sql = "SELECT * FROM documento_identidad";
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }

    public function consultar(){
        $sql = sprintf("SELECT * FROM documento_identidad WHERE nuip = %s", $this->nuip);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarRegistro();
        $this->desconectar();
        $this->tipo_documento = $res['tipo_documento'];
        $this->apellidos = $res['apellidos'];
        $this->nombres = $res['nombres'];
        $this->nacionalidad = $res['nacionalidad'];
        $this->fecha_nacimiento = $res['fecha_nacimiento'];
        $this->lugar_nacimiento = $res['lugar_nacimiento'];
        $this->estatura = $res['estatura'];
        $this->sexo = $res['sexo'];
        $this->grupo_sanguineo = $res['grupo_sanguineo'];
        $this->fecha_expedicion = $res['fecha_expedicion'];
        $this->lugar_expedicion = $res['lugar_expedicion'];
        $this->huella = $res['huella'];
        $this->foro_persona = $res['foro_persona'];
        $this->fecha_expiracion = $res['fecha_expiracion'];
        $this->firma_persona = $res['firma_persona'];
        $this->qr = $res['qr'];
        $this->firma_registrador = $res['firma_registrador'];
        $this->codigo_verificacion = $res['codigo_verificacion'];
    }

    public function eliminar(){
        $sql = sprintf("DELETE FROM documento_identidad WHERE nuip = %s", $this->nuip);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    public function actualizar(){
        $sql = sprintf("UPDATE documento_identidad SET tipo_documento = '%s', apellidos = '%s', nombres = '%s', nacionalidad = '%s', fecha_nacimiento = '%s', lugar_nacimiento = '%s', estatura = '%s', sexo = '%s', grupo_sanguineo = '%s', fecha_expedicion = '%s', lugar_expedicion = '%s', huella = '%s', foro_persona = '%s', fecha_expiracion = '%s', firma_persona = '%s', qr = '%s', firma_registrador = '%s', codigo_verificacion = '%s' WHERE nuip = %s", $this->tipo_documento, $this->apellidos, $this->nombres, $this->nacionalidad, $this->fecha_nacimiento, $this->lugar_nacimiento, $this->estatura, $this->sexo, $this->grupo_sanguineo, $this->fecha_expedicion, $this->lugar_expedicion, $this->huella, $this->foro_persona, $this->fecha_expiracion, $this->firma_persona, $this->qr, $this->firma_registrador, $this->codigo_verificacion, $this->nuip);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $this->desconectar();
    }

    public function buscar($valor){
        $sql = sprintf("SELECT * FROM documento_identidad WHERE tipo_documento LIKE '%%%s%%'", $valor);
        $this->conectar();
        $this->ejecutarSQL($sql);
        $res = $this->cargarTodo();
        $this->desconectar();
        return $res;
    }
}
?>