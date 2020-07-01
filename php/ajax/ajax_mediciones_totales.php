<?php 
require "conexion.php";
$user = new vivexDB();
$dni = "";
$t_unix = "";
$mediciones_unix = "";
$cantidad_unix = 0;
$meses_unix = "";
$ene=0;
$feb=0;
$mar=0;
$abr=0;
$may=0;
$jun=0;
$jul=0;
$ago=0;
$sep=0;
$oct=0;
$nov=0;
$dic=0;


if(isset($_POST['instituciones'])):
    if($_POST['instituciones']!="null"){
        
        if($_POST['masculino']!="" && $_POST['femenino']!=""){
            $u=$user->buscar("alumnos",'instituciones_id_institucion in ('.$_POST['instituciones'].') AND edad >= '.$_POST['edadmin'].' AND edad <= '.$_POST['edadmax'].'');
            $html="";
        }
        if($_POST['masculino']!="" && $_POST['femenino']==""){
            $u=$user->buscar("alumnos",'instituciones_id_institucion in ('.$_POST['instituciones'].') AND genero = "M" AND edad >= '.$_POST['edadmin'].' AND edad <= '.$_POST['edadmax'].'');
            $html="";
        }
        if($_POST['masculino']=="" && $_POST['femenino']!=""){
            $u=$user->buscar("alumnos",'instituciones_id_institucion in ('.$_POST['instituciones'].') AND genero = "F" AND edad >= '.$_POST['edadmin'].' AND edad <= '.$_POST['edadmax'].'');
            $html="";
        }
        
        if($_POST["masculino"]!=""||$_POST["femenino"]!=""){
            foreach ($u as $key => $value)
            $html.=$value['dni'].",";
            $dni=$html;
            
        }
        
    }
    
    	
endif;

if(isset($_POST['ciudades'])):
    if($_POST['instituciones']=="null" && $_POST['ciudades']!="null"){
        

        if($_POST['masculino']!="" && $_POST['femenino']!=""){
            $u=$user->buscar("alumnos",'ciudad_alumno in ('.$_POST['ciudades'].') AND edad >= '.$_POST['edadmin'].' AND edad <= '.$_POST['edadmax'].'');
            $html="";
        }
        if($_POST['masculino']!="" && $_POST['femenino']==""){
            $u=$user->buscar("alumnos",'ciudad_alumno in ('.$_POST['ciudades'].') AND genero = "M" AND edad >= '.$_POST['edadmin'].' AND edad <= '.$_POST['edadmax'].'');
            $html="";
        }
        if($_POST['masculino']=="" && $_POST['femenino']!=""){
            $u=$user->buscar("alumnos",'ciudad_alumno in ('.$_POST['ciudades'].') AND genero = "F" AND edad >= '.$_POST['edadmin'].' AND edad <= '.$_POST['edadmax'].'');
            $html="";
        }
        
        if($_POST["masculino"]!=""||$_POST["femenino"]!=""){
            foreach ($u as $key => $value)
            $html.=$value['dni'].",";   
            $dni=$html;
        }
        
    }
endif;

if(isset($_POST['provincias'])):
    if($_POST['instituciones']=="null" && $_POST['ciudades']=="null" && $_POST['provincias']!="null"){
        

        if($_POST['masculino']!="" && $_POST['femenino']!=""){
            $u=$user->buscar("alumnos",'provincia_alumno in ('.$_POST['provincias'].') AND edad >= '.$_POST['edadmin'].' AND edad <= '.$_POST['edadmax'].'');
            $html="";
        }
        if($_POST['masculino']!="" && $_POST['femenino']==""){
            $u=$user->buscar("alumnos",'provincia_alumno in ('.$_POST['provincias'].') AND genero = "M" AND edad >= '.$_POST['edadmin'].' AND edad <= '.$_POST['edadmax'].'');
            $html="";
        }
        if($_POST['masculino']=="" && $_POST['femenino']!=""){
            $u=$user->buscar("alumnos",'provincia_alumno in ('.$_POST['provincias'].') AND genero = "F" AND edad >= '.$_POST['edadmin'].' AND edad <= '.$_POST['edadmax'].'');
            $html="";
        }
        
        if($_POST["masculino"]!=""||$_POST["femenino"]!=""){    
            foreach ($u as $key => $value)
            $html.=$value['dni'].",";   
            $dni=$html;
        }
        
    }
endif;

//$MesesAtras_1 = time() - (1 * 4 * 7 * 24 * 60 * 60);
//echo '1 Meses Atras: '. date('m', $MesesAtras_1) ."\n";
//$MesesAtras_2 = time() - (2 * 4 * 7 * 24 * 60 * 60);
//echo '2 Meses Atras: '. date('m', $MesesAtras_2) ."\n";
//$MesesAtras_3 = time() - (3 * 4 * 7 * 24 * 60 * 60);
//echo '3 Meses Atras: '. date('m', $MesesAtras_3) ."\n";
//$MesesAtras_4 = time() - (4 * 4 * 7 * 24 * 60 * 60);
//echo '4 Meses Atras: '. date('m', $MesesAtras_4) ."\n";
//$MesesAtras_5 = time() - (5 * 4 * 7 * 24 * 60 * 60);
//echo '5 Meses Atras: '. date('m', $MesesAtras_5) ."\n";
//$MesesAtras_6 = time() - (6 * 4 * 7 * 24 * 60 * 60);
//echo '6 Meses Atras: '. date('m', $MesesAtras_6) ."\n";
//$MesesAtras_7 = time() - (7 * 4 * 7 * 24 * 60 * 60);
//echo '7 Meses Atras: '. date('m', $MesesAtras_7) ."\n";
//$MesesAtras_8 = time() - (8 * 4 * 7 * 24 * 60 * 60);
//echo '8 Meses Atras: '. date('m', $MesesAtras_8) ."\n";
//$MesesAtras_9 = time() - (9 * 4 * 7 * 24 * 60 * 60);
//echo '9 Meses Atras: '. date('m', $MesesAtras_9) ."\n";
//$MesesAtras_10 = time() - (10 * 4 * 7 * 24 * 60 * 60);
//echo '10 Meses Atras: '. date('m', $MesesAtras_10) ."\n";
//$MesesAtras_11 = time() - (11 * 4 * 7 * 24 * 60 * 60);
//echo '11 Meses Atras: '. date('m', $MesesAtras_11) ."\n";

// 7 días; 24 horas; 60 minutos; 60 segundos
//echo 'Ahora: '. date('Y-m-d') ."\n";
//echo 'Ahora: '. time()."\n";
//echo '6 Meses Atras: '. date('Y-m-d', $seisMesesAtras) ."\n";
//echo '6 Meses Atras: '.$seisMesesAtras."\n";


if(isset($_POST['provincias'])):
    if($dni!=""){
        $dni = substr($dni, 0, -1);
        $alumnos = explode(",", $dni);
        $cantidad_dni=count($alumnos);
        $i=0;
        $html2="";
        
        while($i<=$cantidad_dni){
        $u=$user->buscar("alumnos_salud",'alumnos_dni in ('.$dni.')');
        
        $i++;   
        }
        foreach ($u as $key => $value)
        $html2.=$value['tiempo_unix_UTC'].",";   
        $t_unix=$html2;


        $t_unix = substr($t_unix, 0, -1);
        $mediciones_unix = explode(",", $t_unix);
        $meses_unix = explode(",", $t_unix);
        $cantidad_unix=count($mediciones_unix);

        //echo $cantidad_unix;
        //echo "\n";    
        //echo $t_unix;    
    }
endif;

if($dni!=""){
    $e=0;
    while($e!=$cantidad_unix){
        $meses_unix[$e] = date('Y-m', $mediciones_unix[$e]);
        $e++;   
    }


    $i=0;
    while($i!=$cantidad_unix){
        $meses_unix[$i] = str_replace("-", ",", $meses_unix[$i]);
        $i++;   
    }

    $ahora = date('Y-m');
    $i=0;

    while($i!=$cantidad_unix){

        $referencia= explode("-",$ahora);//actual

        $consulta =  explode(",", $meses_unix[$i]);//Fecha anterior

        //echo intval($referencia[0]) - intval($consulta[0]);
        //echo "Referencia:".$referencia[0]." ".$referencia[1]."Fecha:".$consulta [0]." ".$consulta [1]." ";
        if(intval($referencia[0]) - intval($consulta[0])<=1){// que las mediciones no sean anteriores a dos años atras

            if(intval($consulta[1])==1){
                $ene++;
            }
            if(intval($consulta[1])==2){
                $feb++;
            }
            if(intval($consulta[1])==3){
                $mar++;
            }
            if(intval($consulta[1])==4){
                $abr++;
            }
            if(intval($consulta[1])==5){
                $may++;
            }
            if(intval($consulta[1])==6){
                $jun++;
            }
            if(intval($consulta[1])==7){
                $jul++;
            }
            if(intval($consulta[1])==8){
                $ago++;
            }
            if(intval($consulta[1])==9){
                $sep++;
            }
            if(intval($consulta[1])==10){
                $oct++;
            }
            if(intval($consulta[1])==11){
                $nov++;
            }
            if(intval($consulta[1])==12){
                $dic++;
            }


        }


        
        $i++;   
    }

    $array_meses=['ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic'];
    $array_totales=[$ene,$feb,$mar,$abr,$may,$jun,$jul,$ago,$sep,$oct,$nov,$dic];

    $i=0;
    while($i!=(intval(12-$referencia[1]))){
    // Retiras el último elemento del arreglo.
    $last = array_pop($array_meses);
    // Lo insertas en la primera posición.
    array_unshift($array_meses, $last);
    $i++;
    }

    $i=0;
    while($i!=(intval(12-$referencia[1]))){
    // Retiras el último elemento del arreglo.
    $last = array_pop($array_totales);
    // Lo insertas en la primera posición.
    array_unshift($array_totales, $last);
    $i++;
    }

    $i=0;
    while($i!=12){
    //echo $array_meses[$i]." ";
    $i++;
    }
    //echo "\n";
    $i=0;
    while($i!=12){
    //echo $array_totales[$i]." ";
    $i++;
    }
    //echo "\n";



    //echo "\n";
    //echo $ene." ".$feb." ".$mar." ".$abr." ".$may." ".$jun." ".$jul." ".$ago." ".$sep." ".$oct." ".$nov." ".$dic;

    echo "
    <canvas id='myChart2' height='370vh'></canvas>
    <script>
        var ctx= document.getElementById('myChart2').getContext('2d');
        var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#80b6f4');
        gradientStroke.addColorStop(1, '#f49080');
        var myChart = new Chart(ctx, {
            type:'bar',
            data:{
                labels:['$array_meses[0]','$array_meses[1]','$array_meses[2]','$array_meses[3]','$array_meses[4]','$array_meses[5]','$array_meses[6]','$array_meses[7]','$array_meses[8]','$array_meses[9]','$array_meses[10]','$array_meses[11]'],
                
                datasets:[{
                    label:'Mediciones',
                    borderColor:               gradientStroke,
                    pointBorderColor:          gradientStroke,
                    pointBackgroundColor:      gradientStroke,
                    pointHoverBackgroundColor: gradientStroke,
                    pointHoverBorderColor:     gradientStroke,
                    fill: false,
                    data:[$array_totales[0],$array_totales[1],$array_totales[2],$array_totales[3],$array_totales[4],$array_totales[5],$array_totales[6],$array_totales[7],$array_totales[8],$array_totales[9],$array_totales[10],$array_totales[11],],
                    //backgroundColor:['#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63',],
                    backgroundColor: gradientStroke,
                    borderWidth:3,
                }]
            },
            options:{
                responsive: true,
                maintainAspectRatio: false,
                yAxisID:false,
                scales:{
                    yAxes:[{
                        ticks:{
                            beginAtZero:true
                        }
                    }]
                },
                legend: {
                        align: 'center',
                        position:'top',
                        labels: {
                            // This more specific font property overrides the global property
                            fontColor: 'white',
                        
                            fontSize: 0,
                            boxWidth: 0
                        }
                }
            }
        });
    </script>

    ";

}

if($dni==""){
    $array_meses=['ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic'];
    $array_totales=[0,0,0,0,0,0,0,0,0,0,0,0];

    $ahora = date('Y-m');
    $referencia= explode("-",$ahora);//actual
        

    $i=0;
    while($i!=(intval(12-$referencia[1]))){
    // Retiras el último elemento del arreglo.
    $last = array_pop($array_meses);
    // Lo insertas en la primera posición.
    array_unshift($array_meses, $last);
    $i++;
    }

    echo "
    <canvas id='myChart2' height='370vh'></canvas>
    <script>
        var ctx= document.getElementById('myChart2').getContext('2d');
        var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#80b6f4');
        gradientStroke.addColorStop(1, '#f49080');
        var myChart = new Chart(ctx, {
            type:'bar',
            data:{
                labels:['$array_meses[0]','$array_meses[1]','$array_meses[2]','$array_meses[3]','$array_meses[4]','$array_meses[5]','$array_meses[6]','$array_meses[7]','$array_meses[8]','$array_meses[9]','$array_meses[10]','$array_meses[11]'],
                
                datasets:[{
                    label:'Mediciones',
                    borderColor:               gradientStroke,
                    pointBorderColor:          gradientStroke,
                    pointBackgroundColor:      gradientStroke,
                    pointHoverBackgroundColor: gradientStroke,
                    pointHoverBorderColor:     gradientStroke,
                    fill: false,
                    data:[$array_totales[0],$array_totales[1],$array_totales[2],$array_totales[3],$array_totales[4],$array_totales[5],$array_totales[6],$array_totales[7],$array_totales[8],$array_totales[9],$array_totales[10],$array_totales[11],],
                    //backgroundColor:['#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63','#2E4B63',],
                    backgroundColor: gradientStroke,
                    borderWidth:3,
                }]
            },
            options:{
                responsive: true,
                maintainAspectRatio: false,
                yAxisID:false,
                scales:{
                    yAxes:[{
                        ticks:{
                            beginAtZero:true
                        }
                    }]
                },
                legend: {
                        align: 'center',
                        position:'top',
                        labels: {
                            // This more specific font property overrides the global property
                            fontColor: 'white',
                        
                            fontSize: 0,
                            boxWidth: 0
                        }
                }
            }
        });
    </script>

    ";
}


?>