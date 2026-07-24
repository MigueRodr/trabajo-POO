<?php
require_once 'basedatos.php';
require_once '../libs/phpqrcode/qrlib.php';  // Asegúrate de tener la librería

class c_documento_identidad extends basedatos {
    private $nuip;
    private $tipo_documento;
    private $apellidos;
    private $nombres;
    private $nacionalidad;
    private $fecha_nacimiento;
    private $lugar_nacimiento;
    private $estatura;
    private $sexo;
    private $grupo_sanguineo;
    private $fecha_expedicion;
    private $lugar_expedicion;
    private $huella;
    private $foro_persona;
    private $fecha_expiracion;
    private $firma_persona;
    private $qr;
    private $firma_registrador;
    private $codigo_verificacion;  // Guarda el hash Bcrypt

    // ========== GETTERS Y SETTERS ==========
    public function getNuip() { return $this->nuip; }
    public function setNuip($nuip) { $this->nuip = $nuip; }

    public function getTipo_documento() { return $this->tipo_documento; }
    public function setTipo_documento($tipo_documento) { $this->tipo_documento = $tipo_documento; }

    public function getApellidos() { return $this->apellidos; }
    public function setApellidos($apellidos) { $this->apellidos = $apellidos; }

    public function getNombres() { return $this->nombres; }
    public function setNombres($nombres) { $this->nombres = $nombres; }

    public function getNacionalidad() { return $this->nacionalidad; }
    public function setNacionalidad($nacionalidad) { $this->nacionalidad = $nacionalidad; }

    public function getFecha_nacimiento() { return $this->fecha_nacimiento; }
    public function setFecha_nacimiento($fecha_nacimiento) { $this->fecha_nacimiento = $fecha_nacimiento; }

    public function getLugar_nacimiento() { return $this->lugar_nacimiento; }
    public function setLugar_nacimiento($lugar_nacimiento) { $this->lugar_nacimiento = $lugar_nacimiento; }

    public function getEstatura() { return $this->estatura; }
    public function setEstatura($estatura) { $this->estatura = $estatura; }

    public function getSexo() { return $this->sexo; }
    public function setSexo($sexo) { $this->sexo = $sexo; }

    public function getGrupo_sanguineo() { return $this->grupo_sanguineo; }
    public function setGrupo_sanguineo($grupo_sanguineo) { $this->grupo_sanguineo = $grupo_sanguineo; }

    public function getFecha_expedicion() { return $this->fecha_expedicion; }
    public function setFecha_expedicion($fecha_expedicion) { $this->fecha_expedicion = $fecha_expedicion; }

    public function getLugar_expedicion() { return $this->lugar_expedicion; }
    public function setLugar_expedicion($lugar_expedicion) { $this->lugar_expedicion = $lugar_expedicion; }

    public function getHuella() { return $this->huella; }
    public function setHuella($huella) { $this->huella = $huella; }

    public function getForo_persona() { return $this->foro_persona; }
    public function setForo_persona($foro_persona) { $this->foro_persona = $foro_persona; }

    public function getFecha_expiracion() { return $this->fecha_expiracion; }
    public function setFecha_expiracion($fecha_expiracion) { $this->fecha_expiracion = $fecha_expiracion; }

    public function getFirma_persona() { return $this->firma_persona; }
    public function setFirma_persona($firma_persona) { $this->firma_persona = $firma_persona; }

    public function getQr() { return $this->qr; }
    public function setQr($qr) { $this->qr = $qr; }

    public function getFirma_registrador() { return $this->firma_registrador; }
    public function setFirma_registrador($firma_registrador) { $this->firma_registrador = $firma_registrador; }

    public function getCodigo_verificacion() { return $this->codigo_verificacion; }
    public function setCodigo_verificacion($codigo_verificacion) { $this->codigo_verificacion = $codigo_verificacion; }

    // ========== MÉTODOS AUXILIARES ==========

    // Traduce códigos numéricos a texto (para el frontend)
    public static function getTipoTexto($tipo) {
        $tipos = [
            1 => 'Cédula de Ciudadanía',
            2 => 'Tarjeta de Identidad',
            3 => 'Registro Civil',
            4 => 'Pasaporte',
            5 => 'Cédula de Extranjería',
            6 => 'Tarjeta de Extranjería',
            7 => 'Permiso de Protección Temporal',
            8 => 'Permiso Especial de Permanencia',
            9 => 'NIT',
            10 => 'Carné Diplomático'
        ];
        return isset($tipos[$tipo]) ? $tipos[$tipo] : $tipo;
    }

    public static function getNacionalidadTexto($nacionalidad) {
        $paises = [
            57 => 'Colombia',
            1 => 'Estados Unidos',
            54 => 'Argentina',
            56 => 'Chile',
            52 => 'México',
            34 => 'España',
        ];
        return isset($paises[$nacionalidad]) ? $paises[$nacionalidad] : $nacionalidad;
    }

    public static function getSexoTexto($sexo) {
        $sexos = [
            1 => 'Masculino',
            2 => 'Femenino'
        ];
        return isset($sexos[$sexo]) ? $sexos[$sexo] : $sexo;
    }

    public static function getGrupoSanguineoTexto($grupo) {
        $grupos = [
            1 => 'A+',
            2 => 'A-',
            3 => 'B+',
            4 => 'B-',
            5 => 'AB+',
            6 => 'AB-',
            7 => 'O+',
            8 => 'O-'
        ];
        return isset($grupos[$grupo]) ? $grupos[$grupo] : $grupo;
    }

    // Genera código de verificación aleatorio y lo hashea con Bcrypt
    public static function generarCodigoVerificacion() {
        $codigo = bin2hex(random_bytes(8)); // 16 caracteres
        $hash = password_hash($codigo, PASSWORD_BCRYPT);
        return ['codigo' => $codigo, 'hash' => $hash];
    }

    // Genera código QR usando phpqrcode y guarda la imagen
    public function generarQR() {
        if (empty($this->nuip)) return false;

        // Datos para el QR: NUIP, Tipo, Nombre completo, Fecha nac, Estatura, Sexo, Grupo Sanguíneo
        $nombreCompleto = $this->nombres . ' ' . $this->apellidos;
        $tipoTexto = self::getTipoTexto($this->tipo_documento);
        $sexoTexto = self::getSexoTexto($this->sexo);
        $grupoTexto = self::getGrupoSanguineoTexto($this->grupo_sanguineo);

        $datosQR = "NUIP: {$this->nuip}\n";
        $datosQR .= "Tipo: $tipoTexto\n";
        $datosQR .= "Nombre: $nombreCompleto\n";
        $datosQR .= "Fecha Nac: {$this->fecha_nacimiento}\n";
        $datosQR .= "Estatura: {$this->estatura} cm\n";
        $datosQR .= "Sexo: $sexoTexto\n";
        $datosQR .= "Grupo Sanguíneo: $grupoTexto";

        $rutaQR = '../uploads/qr_' . $this->nuip . '.png';
        $rutaRelativa = 'qr_' . $this->nuip . '.png';

        // Generar QR
        QRcode::png($datosQR, $rutaQR, QR_ECLEVEL_H, 8);

        if (file_exists($rutaQR)) {
            $this->qr = $rutaRelativa;
            return true;
        }
        return false;
    }

    // ========== MÉTODOS CRUD CON PREPARED STATEMENTS ==========

    public function listar($buscar = '') {
        $sql = "SELECT * FROM documento_identidad";
        $params = [];
        if (!empty($buscar)) {
            $sql .= " WHERE nuip LIKE ? OR apellidos LIKE ? OR nombres LIKE ?";
            $like = "%$buscar%";
            $params = [$like, $like, $like];
        }
        $stmt = $this->Conexion_ID->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultar() {
        $sql = "SELECT * FROM documento_identidad WHERE nuip = ?";
        $stmt = $this->Conexion_ID->prepare($sql);
        $stmt->execute([$this->nuip]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            $this->tipo_documento = $resultado['tipo_documento'];
            $this->apellidos = $resultado['apellidos'];
            $this->nombres = $resultado['nombres'];
            $this->nacionalidad = $resultado['nacionalidad'];
            $this->fecha_nacimiento = $resultado['fecha_nacimiento'];
            $this->lugar_nacimiento = $resultado['lugar_nacimiento'];
            $this->estatura = $resultado['estatura'];
            $this->sexo = $resultado['sexo'];
            $this->grupo_sanguineo = $resultado['grupo_sanguineo'];
            $this->fecha_expedicion = $resultado['fecha_expedicion'];
            $this->lugar_expedicion = $resultado['lugar_expedicion'];
            $this->huella = $resultado['huella'];
            $this->foro_persona = $resultado['foro_persona'];
            $this->fecha_expiracion = $resultado['fecha_expiracion'];
            $this->firma_persona = $resultado['firma_persona'];
            $this->qr = $resultado['qr'];
            $this->firma_registrador = $resultado['firma_registrador'];
            $this->codigo_verificacion = $resultado['codigo_verificacion'];
        }
        return $resultado;
    }

    public function insertar() {
        $sql = "INSERT INTO documento_identidad SET 
                nuip = ?,
                tipo_documento = ?,
                apellidos = ?,
                nombres = ?,
                nacionalidad = ?,
                fecha_nacimiento = ?,
                lugar_nacimiento = ?,
                estatura = ?,
                sexo = ?,
                grupo_sanguineo = ?,
                fecha_expedicion = ?,
                lugar_expedicion = ?,
                huella = ?,
                foro_persona = ?,
                fecha_expiracion = ?,
                firma_persona = ?,
                qr = ?,
                firma_registrador = ?,
                codigo_verificacion = ?";
        $stmt = $this->Conexion_ID->prepare($sql);
        return $stmt->execute([
            $this->nuip,
            $this->tipo_documento,
            $this->apellidos,
            $this->nombres,
            $this->nacionalidad,
            $this->fecha_nacimiento,
            $this->lugar_nacimiento,
            $this->estatura,
            $this->sexo,
            $this->grupo_sanguineo,
            $this->fecha_expedicion,
            $this->lugar_expedicion,
            $this->huella,
            $this->foro_persona,
            $this->fecha_expiracion,
            $this->firma_persona,
            $this->qr,
            $this->firma_registrador,
            $this->codigo_verificacion
        ]);
    }

    public function actualizar() {
        $sql = "UPDATE documento_identidad SET 
                tipo_documento = ?,
                apellidos = ?,
                nombres = ?,
                nacionalidad = ?,
                fecha_nacimiento = ?,
                lugar_nacimiento = ?,
                estatura = ?,
                sexo = ?,
                grupo_sanguineo = ?,
                fecha_expedicion = ?,
                lugar_expedicion = ?,
                huella = ?,
                foro_persona = ?,
                fecha_expiracion = ?,
                firma_persona = ?,
                qr = ?,
                firma_registrador = ?,
                codigo_verificacion = ?
                WHERE nuip = ?";
        $stmt = $this->Conexion_ID->prepare($sql);
        return $stmt->execute([
            $this->tipo_documento,
            $this->apellidos,
            $this->nombres,
            $this->nacionalidad,
            $this->fecha_nacimiento,
            $this->lugar_nacimiento,
            $this->estatura,
            $this->sexo,
            $this->grupo_sanguineo,
            $this->fecha_expedicion,
            $this->lugar_expedicion,
            $this->huella,
            $this->foro_persona,
            $this->fecha_expiracion,
            $this->firma_persona,
            $this->qr,
            $this->firma_registrador,
            $this->codigo_verificacion,
            $this->nuip
        ]);
    }

    public function eliminar() {
        $sql = "DELETE FROM documento_identidad WHERE nuip = ?";
        $stmt = $this->Conexion_ID->prepare($sql);
        return $stmt->execute([$this->nuip]);
    }
}
?>