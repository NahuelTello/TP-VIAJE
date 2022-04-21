<?php
require_once ('Viaje.php');
require_once ('Pasajero.php');
require_once ('ResponsableV.php');


echo "Por favor, si quiere ingresar un viaje precargado por defecto ingrese (si)! \n";
echo "------------------------------------------- \n";
$consulta = trim(fgets(STDIN));

if ($consulta == 'si' || $consulta == 'Si' ||$consulta == 'SI' ) {
    $obj_Responsable = new ResponsableV(15, 3489, "Jorge" , "Benitez");
    $obj_Viaje = new Viaje(2904, "Buenos Aires", 15, $obj_Responsable);
    $obj_Pasajero1 = new Pasajero("Nahuel", "Tello", 40440691, 2995673455 );
    $obj_Pasajero2 = new Pasajero("Lucas", "Mendez", 12345675, 2995671254 );
    $obj_Pasajero3 = new Pasajero("Pepe", "Honguito", 34567890, 2995214689 );
    $obj_Pasajero4 = new Pasajero("Fulano", "Rodriguez", 12345678, 2995976543 );
    $obj_Viaje->agregarPasajero($obj_Pasajero1);
    $obj_Viaje->agregarPasajero($obj_Pasajero2);
    $obj_Viaje->agregarPasajero($obj_Pasajero3);
    $obj_Viaje->agregarPasajero($obj_Pasajero4);
} else {
    echo "BIENVENIDO A NUESTRA EMPRESA DE VIAJES! :) \n";
    echo "Por favor, ingresar los siguientes datos \n";
    echo "------------------------------------------- \n";
    echo "Ingrese el código del viaje: \n";
    $idViaje = trim(fgets(STDIN));
    echo "Ingrese el destino: \n";
    $destino = trim(fgets(STDIN));
    echo "Ingrese la máxima cantidad de lugares: \n";
    $lugares = trim(fgets(STDIN));
    echo "------------------------------------------- \n";
    echo "Ingrese los datos del responsable del viaje: \n";
    echo "Número de empleado: \n";
    $numEmpleado = trim(fgets(STDIN));
    echo "Número de licencia: \n";
    $numLicencia = trim(fgets(STDIN));
    echo "Nombre: \n";
    $nombre = trim(fgets(STDIN));
    echo "Apellido: \n";
    $apellido = trim(fgets(STDIN));

    //Creamos el objeto Viaje y Responable
    $obj_Responsable = new ResponsableV($numEmpleado, $numLicencia,$nombre,$apellido);
    $obj_Viaje = new Viaje($idViaje,$destino,$lugares,$obj_Responsable);
}

$terminar = true;

do {
    echo menuPrincipal();
    $opcion = trim(fgets(STDIN));
    switch ($opcion) {
        case 1:
            echo "ID VIAJE (actual): {$obj_Viaje->getIdViaje()} .\n";
            echo "Ingresar el nuevo ID: \n";
            $nuevoID = trim(fgets(STDIN));
            $obj_Viaje->setIdViaje($nuevoID);
            break;
        case 2:
            echo "DESTINO VIAJE (actual): {$obj_Viaje->getDestino()}.\n";
            echo "Ingresar el nuevo DESTINO: \n";
            $nuevoDestino = trim(fgets(STDIN));
            $obj_Viaje->setDestino($nuevoDestino);
            break;
        case 3:
            echo "CANTIDAD DE LUGARES (asientos): {$obj_Viaje->getCantidadMaxPasajeros()}.\n";
            echo "Ingresar la nueva cantidad de lugares (asientos): \n";
            $nuevaCantidadLugares = trim(fgets(STDIN));
            $obj_Viaje->setCantidadMaxPasajeros($nuevaCantidadLugares);
            break;
        case 4:
            echo "Antes de añadir un pasajero, verificamos que haya lugar! \n";
            if ($obj_Viaje->hayLugar()) {
                echo "Ingrese los datos del pasajero: \n";
                $obj_Pasajero = almacenarDatosPasajero();
                if ($obj_Viaje->agregarPasajero($obj_Pasajero)) {
                    echo "Agregado con exito! \n";
                } else {
                    echo "El mismo ya se encuentra en el viaje. \n";
                }
            } else {
                echo "No hay mas lugares en este viaje :( \n";
            }
            break;
        case 5:
            echo "Ingrese el dni del pasajero a eliminar: \n" ;
            $dniSelect = trim(fgets(STDIN));
            if ($obj_Viaje->sacarPasajero($dniSelect)) {
                echo "Pasajero eliminado! \n";
            } else {
                echo "El pasajero ingresado no se ha encontrado \n";
            }
            break;
        case 6:
            echo "Ingresar el dni del pasajero: \n";
            $dniPasajero = trim(fgets(STDIN));
            /* echo "Ingrese los nuevos datos: \n";
            $datosPasajero2 = almacenarDatosPasajero(); */
            if ($obj_Viaje->modificarDatos($dniPasajero)) {
                echo "Datos modificados con exito! \n";
            } else {
                echo "El pasajero ingresado no se ha encontrado \n";
            }
            break;
        case 7:
            echo $obj_Viaje;
            break;
        case 8: 
            $responsableV = $obj_Viaje->getResponsableViaje();
            echo $responsableV;
            break;
        case 9:
            echo "Por favor, ingresar los nuevos datos del responsable \n";
            echo "Numero de empleado: ";
            $nEmpleado = trim(fgets(STDIN));
            echo "Numero de Licencia: ";
            $nLicencia = trim(fgets(STDIN));
            echo "Nombre: ";
            $nombre = trim(fgets(STDIN));
            echo "Apellido: ";
            $apellido = trim(fgets(STDIN));

            $obj_Responsable = new ResponsableV($nEmpleado, $nLicencia, $nombre, $apellido);
            $obj_Viaje->setRespondableViaje($obj_Responsable);
            break;

        default:
            $terminar = false;
            break;
    }
} while ($terminar);

function menuPrincipal(){
    $menu = "
    1) Modificar ID del viaje.\n
    2) Modificar el destino.\n
    3) Modificar la cantidad de lugares (asientos).\n
    4) Añadir Pasajero. \n
    5) Eliminar Pasajero. \n
    6) Modificar Pasajero. \n
    7) Ver Viaje. \n
    8) Ver datos del responsable. \n
    9) Modificar datos del responsable. \n
    10) Salir. \n";
    return $menu;
}

function almacenarDatosPasajero(){
    echo "Ingrese el Nombre: \n";
    $nombre = trim(fgets(STDIN));
    echo "Ingrese el Apellido: \n";
    $apellido = trim(fgets(STDIN));
    echo "Ingrese el DNI: \n";
    $dni = trim(fgets(STDIN));
    echo "Ingrese el telefono: \n";
    $telefono = trim(fgets(STDIN));
    $obj_Pasajero = new Pasajero($nombre, $apellido, $dni, $telefono);
    return $obj_Pasajero;
}