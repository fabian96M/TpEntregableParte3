<?php
include_once 'Viaje.php';
//instancias de la clase viaje x defecto
$viaje1 = new Viaje('f31n','villa traful', 8);
$viaje2 = new Viaje('qwert','villa gessell', 5);
$viaje3 = new Viaje('gfdsa','villa regina', 6);
//creamos e instanciamos arreglos de pasajeros
$p1=array('nombre'=>"Dinora" , 'apellido'=>"Juarez", 'DNI'=>908765);
$p2=array('nombre'=>"juan" , 'apellido'=>"perez", 'DNI'=>8079672);
$p3=array('nombre'=> "Ricardo", 'apellido'=>"Tapia", 'DNI'=>906986);
$p4=array('nombre'=>"Fernando" , 'apellido'=>"Escandon", 'DNI'=>8076567);
//asignamos pasajeros en los viajes instanciados
$viaje1->setPasajero($p1,count($viaje1->getPasajeros()));
$viaje1->setPasajero($p2,count($viaje1->getPasajeros()));
$viaje1->setPasajero($p3,count($viaje1->getPasajeros()));
$viaje1->setPasajero($p4,count($viaje1->getPasajeros()));
//creacion de un arreglo para almacenar los viajes
$viajes = array();
//se asignan las instancias al arreglo creado dentro de las primeras posiciones
$viajes[0] = $viaje1;
$viajes[1] = $viaje2;
$viajes[2] = $viaje3;
//el menu principal se cargara hasta que el usuario ingrese un numero 4
$eleccion=0;
while($eleccion!=4){
    echo(" \n
    //////////////////////////////////////////////////\n
 A continuacion elija una de las siguientes opciones: \n
1) para cargar informacion de un viaje \n
2) Para modificar un viaje \n
3) Para ver los datos de un viaje \n
4) Para salir \n
////////////////////////////////////////////////////
");
//se recibe por entrada y se asigna como numero de eleccion
$eleccion = trim(fgets(STDIN));
switch($eleccion){
    ////////////////////////////////////////////////////////////////////////
    case "1":
    $opcion=1;
    $i=1;
    $viajeN= datosViaje();
    
    /**AGREGA PASAJEROS - mientras el usuario no marque 2 o exceda el numero maximo de pasajeros no se detendra el conteo de datos de pasajeros  */
    while($opcion!=2 && $i<=$viajeN->getMaxPasajeros()){
    echo "\n ingrese el nombre del pasajero ".$i."\n";
    $nombreP=trim(fgets(STDIN));
    echo "ingrese el apellido del pasajero ".$i."\n";
    $apellidoP=trim(fgets(STDIN));
    echo "ingrese el DNI del pasajero ".$i."\n";
    $dniP=trim(fgets(STDIN));
    $viajeN->agregarPasajero($nombreP,$apellidoP,$dniP);
    $i++;
    echo("\n //////////////////////////////////////////\n
             1) para agregar otro pasajero\n
             2) Para salir \n
             /////////////////////////////////////////");
     $opcion =trim(fgets(STDIN));
    }
    $viajes[count($viajes)]= $viajeN;
    break;
    ////////////////////////////////////////////////////////////////////////
    case "2":
    //modificar un viaje
    echo "\n Ingrese el numero del viaje que desea modificar \n ";    
    $numeroViaje = trim(fgets(STDIN));
    modificarViaje($viajes[$numeroViaje-1]);
    if($numeroViaje< count($viajes) && $numeroViaje>0){
    $viajeN=  datosViaje();
    $viajes[$numeroViaje]->setCodViaje= $viajeN->getCodViaje();
    $viajes[$numeroViaje]->setDestino = $viajeN->getDestino();
    $viajes[$numeroViaje]->setMaxPasajeros = $viajeN->getMaxPasajeros();
    while($viajeN->getMaxPasajeros()>$i){
    echo "////////////////////////////////////////////\n
         ingrese el nombre del pasajero ".$i."\n";
    echo "\n ingrese el apellido del pasajero ".$i."\n";
    echo "\n ingrese el nombre del pasajero ".$i."\n
    /////////////////////////////////////////////////";
    
    }
    }
    else{
        echo("\n el numero no coincide con el rango de viajes almacenados \n");
    }
    break;
    ////////////////////////////////////////////////////////////////////////
    case "3":  
    //ver los datos de un viaje
    echo "\n escriba el numero del viaje que desea conocer \n";
    $indice = trim(fgets(STDIN));
    echo $viajes[$indice+1]->__toString();
    break;
}
}
/**\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ */
//modulo para pedir los datos de un viaje y devolverlos en un arreglo
 function datosViaje(){
    echo "\n Ingrese el Código del viaje:\n ";
    $codigo = trim(fgets(STDIN));
    echo " \n Ingrese el Destino del viaje: \n";
    $destino = trim(fgets(STDIN));
    echo "\n Ingrese la Cantidad máxima de pasajeros: \n";
    $cantMaxima = trim(fgets(STDIN));
    $viajeN = new Viaje($codigo, $destino, $cantMaxima);
    return $viajeN;
}
/**\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ */
//modulo para modificar un viaje
function modificarViaje($viaje){
        $opcion = 0;
        while ($opcion != '5') {
            echo "\n 
            ¿Qué desea modificar?\n";
            echo "1. Código de viaje\n";
            echo "2. Destino\n";
            echo "3. Cantidad máxima de pasajeros\n";
            echo "4. modificar los datos de un pasajero\n";
            echo "5. Salir\n";
            $opcion = trim(fgets(STDIN));
            switch($opcion){
                case "1":
                    //modifica codigo viaje
                    echo "ingrese el nuevo codigo de viaje\n";
                    $viaje->setCodViaje(trim(fgets(STDIN)));
                    break;
                case "2":
                    //modifica destino 
                    echo "ingrese el nuevo destino de viaje\n";
                    $viaje->setDestino(trim(fgets(STDIN)));
                    break;
                case "3":
                    //modifica cantidad maxima de pasajeros
                    $maxNoValida=true;
                    $nMaxima=0;
                    while($maxNoValida){
                    echo "ingrese una nueva cantidad maxima de pasajeros\n";
                    $nMaxima=trim(fgets(STDIN));
                    if($nMaxima< count($viaje->getPasajeros())){
                        echo "\n la maxima es menor a ".count($viaje->getPasajeros).", que es el numero de pasajeros cargados";
                    }
                    else{
                        $viaje->setMaxPasajeros($nMaxima);
                        echo "la nueva maxima se establecio";
                        $maxNoValida=false;
                    }

                }
                    break;
                case "4":
                    //modifica los datos de un pasajero
                    $bandera = true;
                    $comprobacion=false;
                    while($bandera){
                    echo "\n ingrese el dni del pasajero que quiera modificar\n";
                    $dniPas= trim(fgets(STDIN));
                    echo "ingrese el nombre a asignar\n";
                    $nombre= trim(fgets(STDIN));
                    echo "ingrese el apellido a asignar\n";
                    $apellido= trim(fgets(STDIN));
                    $comprobacion = $viaje->ModificarDatosPasajero($dniPas, $nombre, $apellido);
                    if($comprobacion){
                        echo"\n El pasajero se modifico ";
                    }
                    else{
                        echo"\n El pasajero no fue encontrado. Por favor reintentelo";
                    }
                    echo("\n 
                    Desea modificar otro pasajero? \n
                    1) si \n
                    2) no \n
                    ////////////////////////////////////////\n");
                    $respuesta = trim(fgets(STDIN));
                    if($respuesta != 1){
                        $bandera=false;
                    }


                }
                    break;
            }
}
}

