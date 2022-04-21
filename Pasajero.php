<?php 
class Pasajero{
    //Atributos
    private $nombre;
    private $apellido;
    private $numDni;
    private $telefono;

    //Constructo
    public function __construct($nombre, $apellido, $numDni, $telefono)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->numDni = $numDni;
        $this->telefono = $telefono;
    }

    //Getters y setters
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

    public function getDni()
    {
        return $this->numDni;
    }

    public function setDni($nuevoDni)
    {
        $this->numDni = $nuevoDni;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function __toString()
    {
        $str = " Nombre: {$this->getNombre()}.\nApellido: {$this->getApellido()}.\nDNI: {$this->getDni()}.\nTelefono: {$this->getTelefono()}.\n";
        return $str;
    }
}