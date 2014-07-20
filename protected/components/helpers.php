<?php

/**
 * Imprime el menu de opciones para la aplicacion 
 * 
 * @param array $opciones Opciones a mostrar
 * @param string $activo clase css para rederizar la opcion activa, por defecto
 * se aplicara a la primera opcion
 * @return string html generado con las opciones
 */
function ulMenu($opciones = [], $activo = "")
{
    $ulMenu = "<ul>";
    
    foreach($opciones as $key => $opcion)
    {
        $class = ($key == 0) ? $activo : "";        
        $ulMenu .= "<li>";
        $ulMenu .= CHtml::link($opcion->nombre, "#", [
            "id" => "nav-$opcion->id",
            "class" => $class,
        ]);
        $ulMenu .= "</li>";
    }
                    
    return  $ulMenu . "</ul>";
}
