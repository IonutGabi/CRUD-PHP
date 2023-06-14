<?php
function validarTitulo($tituloValido)
{
     if (!preg_match('/[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?)*/', $tituloValido)) 
        return "El formato del campo Titulo no es válido";
       

}
function validarAutor($autorValido)
{
    if (!preg_match('/[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?)*/', $autorValido))
        return "El formato del campo Autor no es válido";

}

function validarFecha($fechaPublicacionValida)
{
    if (!preg_match('/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/', $fechaPublicacionValida))
        return "El formato del campo Fecha no es válido";

}
function validarGenero($generoValido)
{
    if (!preg_match('/[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?)*/', $generoValido))
        return "El formato del campo Género no es válido";

}

function validarNombre($nombreValido)
{
    if (!preg_match('/[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?)*/', $nombreValido))
        return "El formato del campo Nombre no es válido";

}

function validarApellidos($apellidosValidos)
{
    if (!preg_match('/[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?(( |\-)[a-zA-ZÀ-ÖØ-öø-ÿ]+\.?)*/', $apellidosValidos))
        return "El formato del campo Apellidos no es válido";

}

function validarDNI($dniValido)
{
    if (!preg_match('/[0-9]{7,8}[A-Z]/', $dniValido))
        return "El formato del campo DNI no es válido";
}

function validarCódigos($codigolibro, $codigosocio)
{
    if (!preg_match('/[0-9]/', $codigolibro, $codigosocio))
        return "El formato de los campos de los códigos no es válido";
}

function validarFechasPrestamo ($fechasalidaValida, $fechadevolucionValida) {
    if(!preg_match('/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/', $fechasalidaValida, $fechadevolucionValida))
    return "El formato de las fechas no es válido";
}

?>