
<?php 

if(isset($_POST['id_pais'])):

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
    $html="";
    $html2="";
    $html3="";
    $pago="";
    
    //echo $value2['colegio'];

    if($u!=""){  
        
            //$html.="<option id='ciud_opt' value='".$value['id_ciudad']."'>".$value['ciudad']."</option>";
             
            
            //$html2.="'".$value2['colegio']."',";

            
            foreach ($u as $key => $value){
                $e=$user->buscar('instituciones','id_institucion in ('.$value['id_institucion'].')');
                foreach ($e as $key2 => $value2){
                    $a=$user->buscar('contratos','id_contrato in ('.$value['id_contrato'].')');
                    foreach ($a as $key3 => $value3){ 
                        if($value['pago']=="1"){
                            $pago="Activa";
                        }else{
                            $pago="Bloqueada";
                        }   
                        $html.="['".$value2['colegio']."', ".$value['latitud'].", ".$value['longitud']."],";
                        $html2.='["<div id=content>"+
                        "<div id=siteNotice>"+
                        "</div>"+
                        "<p style=color:red; text-align:left; line-height:.5; font-weight: bold; >'.$value2['colegio'].'</p>"+
                        "<hr>"+
                        "<div id=bodyContent style="+"color:black; text-align:left; line-height: .5; font-weight: bold;"+">"+
                        "<p>Administrador: '.$value3['nombre'].' '.$value3['apellido'].'</p>"+
                        "<p>Email: '.$value3['email'].'</p>"+
                        "<p>Contrato: '.$value3['descripcion'].'</p>"+
                        "<p>ID Contrato: '.$value['id_contrato'].' </p>"+
                        "<p>Estado de pago: '.$pago.' </p>"+
                        "<p>Más Información: <a href=http://190.17.14.237:81/vivex3/vivexwebmob/php/balanzas.php>"+
                        "Vivex/'.$value2['colegio'].'</p>"+
                        "</div>"+
                        "</div>"],';
                            $html3.="['".$value['pago']."'],";
                        }
                }
            }
            
            

        
        
        
    }

    //echo "entro mapa";

    
    // Multiple markers location, latitude, and longitude
    $markers = $html;
    
    // Info window content  
    $infoWindowContent= $html2;

    //pago icon
    $icon_select=$html3;

    if($markers!=null){
        
        $html="";   
        $html='
        <script>
            var markers=['.$markers.'] ;
            var infoWindowContent=['.$infoWindowContent.'];
            var icon_select=['.$icon_select.'];
            initMap(); 
        </script>';
    }else{
        $html="";   
        $html='
        <script>
        var markers = [
            ["Vivex", -31.4287235, -64.1888398]
            
        ];
                            
        // Info window content
        var infoWindowContent = [
            ["<div class=info_content>" +
            "<h3>Vivex</h3>"]];
        
        var icon_select="2";
            initMap(); 
        </script>';
    }

    
    
    echo $html;
    
    	
endif;
?>
