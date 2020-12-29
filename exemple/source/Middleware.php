<?php

/**
 * Função para verificar um visitante
 */
// function checkAuth()
// {
//     return true;
//     if (!isset($_SESSION)) {session_start();} // Inicia a sessão PHP
    
//     /**
//      * Ira chegar Utilizador e permissões
//      * ou o que se definir para validar o middleware
//      * mas deve se colocar antes do return de true para funcionar!
//      */    
//     // if (isset($_SESSION[$_ENV['empresa']]))
//     //     return true;
//     // else if ((!empty($_POST['login'])) and (!empty($_POST['senha'])) and (\App\Controllers\ColaboradorController::validaUtilizador()) )
//     //     return true;
        
//     // return false;
// }

// function semInformacao(String $val='')
// {
//     if ((defined("PG_LOGIN")) and (defined("SESSAO")))
//     {
//         if (($val == "sessao") or ($val == "zona")) {
//             header("Location: " . PG_LOGIN);
//         }

//         if (($val == '') and (empty($_SESSION[SESSAO]))) {
//             header("Location: " . PG_LOGIN);
//         }

//     }
//     else {
//         return false;
//     }


// }
