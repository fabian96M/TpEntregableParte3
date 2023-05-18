<?php
class Viaje
{
    //atributos
    private $codViaje;
    private $destino;
    private $maxPasajeros;
    private $pasajeros = array();
    //metodo constructor
    public function __construct($cViaje,$dest,$maxP){
   $this->pasajeros = array();
   $this->codViaje = $cViaje;
   $this->destino = $dest;
   $this->maxPasajeros = $maxP;
    }
    //metododos de acceso
    //setters
    public function setPasajero($nPasajero, $pos){
    $this->pasajeros[$pos] = $nPasajero;
    }
    public function setCodViaje($nCodViaje){
    $this->codViaje = $nCodViaje;
    }
    public function setDestino($ndestino){
    $this->destino = $ndestino;
    }
    public function setMaxPasajeros($nMaxPasajeros){
    $this->maxPasajeros = $nMaxPasajeros;
    }
    //getters
    public function getPasajeros(){
    return $this->pasajeros;
    }
    public function getCodViaje(){
    return $this->codViaje;
    }
    public function getDestino(){
return $this->destino;
    }
    public function getMaxPasajeros(){
    return $this->maxPasajeros;
    }
    //Funcion para agregar un pasajero
    public function agregarPasajero($nombre, $apellido, $dni) {
        if (count($this->pasajeros) < $this->maxPasajeros) {
            $pasajero = array(
                "nombre" => $nombre,
                "apellido" => $apellido,
                "DNI" => $dni
            );
            $this->pasajeros[] = $pasajero;
    }
}
    //funcion para obtener el indice que coincide con el dni que ingresa por parametro
public function buscarIndPasajero( $dniPasajero){
    $ind=-1;
    $bandera=true;
    $i = 0;
    while($bandera && $i<count($this->pasajeros)){
      if( $this->pasajeros[$i]['DNI']==$dniPasajero){
      $ind = $i;
      $i=count($this->pasajeros);
      $bandera = false;
   }
    }
    return $ind;

}
public function ModificarDatosPasajero($dniPasajero, $nombre, $apellido){
   /** recibe por parametro los datos del pasajero a ingresar, busca la ubicacion del pasajero segun el dni ingresado y reemplaza los datos por el nombre y apellido ingresados*/
   $indice = $this->buscarIndPasajero($dniPasajero);
   if($indice >= 0 && $indice < count($this->pasajeros)){
    $this->pasajeros[$indice]["nombre"] = $nombre;
    $this->pasajeros[$indice]["apellido"] = $apellido;
    return true;
   }
   else{
    return false;
   }

}
public function __toString()
{
    $datosViaje = "\n 
                  Codigo viaje: ".$this->codViaje." \n 
                  Destino: ".$this->destino." \n
                  maximo de pasajeros: ".$this->maxPasajeros." \n
                  Cantidad de pasajeros: ".count($this->getPasajeros())."\n";
    return $datosViaje;
}

}
 