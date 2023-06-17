<?php 

// Función que brinda protección contra ataques CSRF
function csrf(){

    session_start();
    
    if (empty($_SESSION['csrf'])) {
        if (function_exists('random_bytes')) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        } else {
            $_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));
        }
    }

}

// Función que nos brinda protección contra ataques XSS
function escapar($html){
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
 // Comprueba si el CSRF si se ha pulsado el botón de enviar y si el CSRF es distinto
function siEsAleatorioElCsrf($submit, $sesion, $csrf){
    if (isset($submit) && !hash_equals($sesion, $csrf)) {
        die();
    }
}

?>