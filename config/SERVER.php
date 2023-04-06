<?php
//Parametros base de datos
const SERVER="localhost";
const DB="reserva_mesas";
const USER="root";
const PASS="";
//PDO para pasar unico  parametro
//constante que se usara para enviar los parametros al modelo que se conecta a la BD
const SGBD="mysql:host=".SERVER.";dbname=".DB;

const METHOD="AES-256-CBC";
//definir llave secreta
const SECRET_KEY='$RESERVA@2022';
//identificador unico
const SECRET_IV='214976';

?>