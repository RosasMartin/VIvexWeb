<?php
echo "";
?>

<?php 

if(isset($_POST['id_pais'])||isset($_POST['id_provincia'])||isset($_POST['id_ciudad'])||isset($_POST['id_institucion'])):

	require "conexion.php";
    $user = new vivexDB();
    //echo $_POST['id_institucion']; 
    //echo $_POST['id_ciudad'];
    //echo $_POST['id_provincia'];
    //echo $_POST['id_pais'];

    $u="";
    if($_POST['id_provincia']=="null"&&$_POST['id_pais']!="null"){
        $u=$user->buscar("dispositivos",'paises_id_pais in ('.$_POST['id_pais'].')');
    }
    if($_POST['id_ciudad']=="null"&&$_POST['id_provincia']!="null"){
        $u=$user->buscar("dispositivos",'provincias_id_provincia in ('.$_POST['id_provincia'].')');
    }
    if($_POST['id_institucion']=="null"&&$_POST['id_ciudad']!="null"){
        $u=$user->buscar("dispositivos",'ciudades_id_ciudad in ('.$_POST['id_ciudad'].')');
    }
    if($_POST['id_institucion']!="null"){
        $u=$user->buscar("dispositivos",'id_institucion in ('.$_POST['id_institucion'].')');
    }
    if($_POST['id_pais']=="null"&&$_POST['id_provincia']=="null"&&$_POST['id_ciudad']=="null"&&$_POST['id_institucion']=="null"){
        $u=="";
    }
    if($_POST['id_contrato']!="null"){
        $u=$user->buscar("dispositivos",'id_contrato in ('.$_POST['id_contrato'].')');
    }
    $html="";
    $html2="";
    
    $e="";
    $cien=100;
    $online=0;
    $offline=0;
    $dispositivos=0;
    $dispositivos_online=0;
    $dispositivos_offline=0;
    $ultima_fecha="";
    $ultima_hora="";
    $ultima_id="";
    $cantidad_mes=0;
    $cantidad_dia=0;

    if($u!=""){
        foreach ($u as $key => $value){
            $html2.=$value['id_institucion'].",";
            $dispositivos++;
            if($value['estado']=="On Line"){
                $dispositivos_online++; 
            }
            if($value['estado']=="Off Line"){
                $dispositivos_offline++;
            }
        }
        if($dispositivos!="0"){
            $e=$user->buscar_maximo("alumnos_salud",'id_Institucion in ('.$value['id_institucion'].')');
            foreach ($e as $key2 => $value2){
                
                $ultima_fecha=$value2['fecha_medicion'];
                $ultima_hora=$value2['hora_medicion'];
                $ultima_id=$value2['id_medicion'];
            }

            $UnMesesAtras = time() - (1 * 4 * 7 * 24 * 60 * 60);
            $UnDia = time() - (1 * 24 * 60 * 60);
            $a=$user->buscar("alumnos_salud","id_Institucion in (".substr($html2, 0, -1).")AND tiempo_unix_UTC>".$UnMesesAtras);
            foreach ($a as $key3 => $value3){
                $cantidad_mes++;
            }

            $b=$user->buscar("alumnos_salud","id_Institucion in (".substr($html2, 0, -1).")AND tiempo_unix_UTC>".$UnDia."");
            foreach ($b as $key4 => $value4){
                $cantidad_dia++;
            }
        }
    }
   
    if($dispositivos!="0"){
       $html='
        <div class="estado-uno">
            <div class="uno-valores">
                <p class="cantidad-balanzas">'.$dispositivos_online.'</p>
                <p class="porcentaje-balanzas">'.number_format(($dispositivos_online/$dispositivos)*$cien, 2, '.', '').'%</p>
            </div>
            <div class="online">
                <p>Dispositivos Online</p>
            </div>
        </div>
        <div class="estado-dos">
            <div class="dos-valores">
                <p class="cantidad-balanzas">'.$dispositivos_offline.'</p>
                <p class="porcentaje-balanzas">'.number_format(($dispositivos_offline/$dispositivos)*$cien, 2, '.', '').'%</p>
            </div>
            <div class="offline">
                <p>Dispositivos Offline</p>
            </div>
        </div>
        <div class="estado-tres">
            <div class="tres-valores">
                <p class="cantidad-transacciones">'.$cantidad_mes.'</p>
            </div>
            <div class="transacciones">
                <p>Transacciones Mensuales</p>
            </div>
        </div>
        <div class="estado-cuatro">
            <div class="cuatro-valores">
                <p class="cantidad-transacciones">'.$cantidad_dia.'</p>
            </div>
            <div class="transacciones">
                <p>Transacciones diarias</p>
            </div>
        </div>
        <div class="estado-cinco">
            <p>Ultima Medición:</p>
            <p>'.$ultima_fecha.'</p>
            <p>'.$ultima_hora.'</p>
            <p>id: '.$ultima_id.'</p>
        </div>';
    }else{
        $html='
        <div class="estado-uno">
            <div class="uno-valores">
                <p class="cantidad-balanzas">0</p>
                <p class="porcentaje-balanzas">0%</p>
            </div>
            <div class="online">
                <p>Dispositivos Online</p>
            </div>
        </div>
        <div class="estado-dos">
            <div class="dos-valores">
                <p class="cantidad-balanzas">0</p>
                <p class="porcentaje-balanzas">0%</p>
            </div>
            <div class="offline">
                <p>Dispositivos Offline</p>
            </div>
        </div>
        <div class="estado-tres">
            <div class="tres-valores">
                <p class="cantidad-transacciones">0</p>
            </div>
            <div class="transacciones">
                <p>Transacciones Mensuales</p>
            </div>
        </div>
        <div class="estado-cuatro">
            <div class="cuatro-valores">
                <p class="cantidad-transacciones">0</p>
            </div>
            <div class="transacciones">
                <p>Transacciones diarias</p>
            </div>
        </div>
        <div class="estado-cinco">
            <p>Ultima Medición:</p>
        </div>';
    }
    echo $html;
    
    	
endif;
?>
<?php    
echo "";
?>