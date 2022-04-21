<?php
class ResponsableV
{
    //Atributos
    private $numEmpleado;
    private $numLicencia;
    private $nombre;
    private $apellido;

    //Constructo
    public function __construct($numEmpleado, $numLicencia, $nombre, $apellido)
    {
        $this->numEmpleado = $numEmpleado;
        $this->numLicencia = $numLicencia;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    //Getters y setters
    public function getNumeroEmpleado()
    {
        return $this->numEmpleado;
    }

    public function setNumeroEmpleado($numEmpleado)
    {
        $this->numEmpleado = $numEmpleado;
    }

    public function getNumeroLicencia()
    {
        return $this->numLicencia;
    }

    public function setNumeroLicencia($numLicencia)
    {
        $this->numLicencia = $numLicencia;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    //toString
    public function __toString()
    {
        $str = "Número de empleado: {$this->getNumeroEmpleado()}.\nNúmero de licencia: {$this->getNumeroLicencia()}.\nNombre: {$this->getNombre()}.\nApellido: {$this->getApellido()}.\n";
        return $str;
    }
}