<?php		        
    $pagina = isset($_GET['p']) ? $_GET['p'] : 'inicio'; 
    include ('paginas/php/conexion.php');
    require_once 'paginas/header.php';    
    require_once 'paginas/' . $pagina . '.php';
        
    require_once 'paginas/footer.php'; 
 ?>