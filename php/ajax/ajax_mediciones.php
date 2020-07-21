<?php 
require "conexion.php";
$user = new vivexDB();
$dni="";
$imc2="";
$imc3="";
$imc4="";
$imc5="";
$cantidad_dni2="";
$cantidad_dni3="";
$array2="";
$bad="";
$bad_2="";
$rn ="";
$rn_2="";


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



if(isset($_POST['provincias'])):
    if($_POST['instituciones']!="null" || $_POST['ciudades']!="null" || $_POST['provincias']!="null"){
        
            //echo " dni:";
            $dni = substr($dni, 0, -1);
            //echo $dni;

            $alumnos = explode(",", $dni);
            $cantidad_dni=count($alumnos);

            //echo " Cantidad alumnos:";
            //echo $cantidad_dni;
            //echo "\n";

            $seisMesesAtras = time() - (6 * 4 * 7 * 24 * 60 * 60);
            //6meses; 4semenas; 7 días; 24 horas; 60 minutos; 60 segundos
            //echo 'Ahora: '. date('Y-m-d') ."\n";
            //echo 'Ahora: '. time()."\n";
            //echo '6 Meses Atras: '. date('Y-m-d', $seisMesesAtras) ."\n";
            //echo '6 Meses Atras: '.$seisMesesAtras."\n";

            //dni 6 meses atras
        
            if($dni!="" && ($_POST["masculino"]!=""||$_POST["femenino"]!="")){
                $i=0;
                while($i!=$cantidad_dni){
                    
                    $u=$user->buscar_atras("alumnos_salud",$alumnos[$i],$seisMesesAtras);
                    $imc="";
                        
                    foreach ($u as $key => $value)
                    $imc.=$value['alumnos_dni'].",";
                    $i++;
                    $imc2.=$imc;    
                }
                $imc2 = substr($imc2, 0, -1);
                $array2 = explode(",", $imc2);
                $cantidad_dni2=count($array2);

                //echo "dni:";
                //echo $imc2;
                //echo "\n";
                //echo " Cantidad alumnos atras:";
                //echo $cantidad_dni2;
                //echo "\n";

                
            }
        
            //imc 6 meses atras
            
            if($imc2!="" && $dni!="" && ($_POST["masculino"]!=""||$_POST["femenino"]!="")){
                $e=0;
                while($e!=$cantidad_dni){
                    
                    $u=$user->buscar_atras("alumnos_salud",$alumnos[$e],$seisMesesAtras);
                    $imc3="";
                        
                    foreach ($u as $key => $value)
                    $imc3.=$value['imc'].",";
                    $e++;
                    $imc4.=$imc3;    
                }
                $imc4 = substr($imc4, 0, -1);
                $array3 = explode(",", $imc4);
                $cantidad_dni3=count($array3);

                //echo "imc:";
                //echo $imc4;
                //echo "\n";
                //echo " Cantidad alumnos atras:";
                //echo $cantidad_dni3;
                //echo "\n";

                $a=0;
                $ro1_2=0;
                $ro2_2=0;
                $ro3_2=0;
                $rs_2=0;
                $rda_2=0;
                $rdm_2=0;
                $rds_2=0;
                $rn_2=0;
                $sn_2=0;
                
                if($dni!="" && ($_POST["masculino"]!=""||$_POST["femenino"]!="")){
                    while($a!=$cantidad_dni3){
                        //delgadez severa
                        if($array3[$a]<16){
                            $rds_2++;
                        }
                        //delgadez moderada
                        if($array3[$a]>16 && $array3[$a]<16.99){
                            $rdm_2++;
                        }
                        //delgadez aceptable
                        if($array3[$a]>17 && $array3[$a]<18.49){
                            $rda_2++;
                        }
                        //Normal
                        if($array3[$a]>18.5 && $array3[$a]<24.99){
                            $rn_2++;
                        }
                        //sobrepeso
                        if($array3[$a]>25 && $array3[$a]<29.99){
                            $rs_2++;
                        }
                        //obesidad tipo 1
                        if($array3[$a]>30 && $array3[$a]<34.99){
                            $ro1_2++;
                        }
                        //obesidad tipo 2
                        if($array3[$a]>35 && $array3[$a]<39.99){
                            $ro2_2++;
                        }
                        //obesidad tipo 3
                        if($array3[$a]>40){
                            $ro3_2++;
                        }
                        $a++;    
                    }
                }



                //echo "Mediciones:";
                //echo $cantidad_mediciones;
                //echo"|";

                //echo "IMC:";
                //echo " rds:";
                $rds_alum_2=$rds_2;
                $rdm_alum_2=$rdm_2;
                $rda_alum_2=$rda_2;
                $rn_alum_2=$rn_2;
                $rs_alum_2=$rs_2;
                $ro1_alum_2=$ro1_2;
                $ro2_alum_2=$ro2_2;
                $ro3_alum_2=$ro3_2;
                //$nn= $cantidad_dni-$cantidad_mediciones;
                

                $rds_2= number_format((($rds_2/$cantidad_dni3)*100), 2, '.', '');
                //echo ",";
                $rdm_2= number_format((($rdm_2/$cantidad_dni3)*100), 2, '.', '');
                //echo ",";
                $rda_2= number_format((($rda_2/$cantidad_dni3)*100), 2, '.', '');
                //echo ",";
                $rn_2= number_format((($rn_2/$cantidad_dni3)*100), 2, '.', '');
                //echo ",";
                $rs_2= number_format((($rs_2/$cantidad_dni3)*100), 2, '.', '');
                //echo ",";
                $ro1_2= number_format((($ro1_2/$cantidad_dni3)*100), 2, '.', '');
                //echo ",";
                $ro2_2= number_format((($ro2_2/$cantidad_dni3)*100), 2, '.', '');
                //echo ",";
                $ro3_2= number_format((($ro3_2/$cantidad_dni3)*100), 2, '.', '');

                
                
                //'Obesidad Tipo 1','Obesidad Tipo 2','Obesidad Tipo 3','Sobrepeso','Delgadez Aceptable','Delgadez Moderada','Delgadez Severa','Normal'

                if($_POST['ro1']==""){
                    $ro1_2=0;
                    $ro1_alum_2=0;
                }
                if($_POST['ro2']==""){
                    $ro2_2=0;
                    $ro2_alum_2=0;
                }
                if($_POST['ro3']==""){
                    $ro3_2=0;
                    $ro3_alum_2=0;
                }
                if($_POST['rs']==""){
                    $rs_2=0;
                    $rs_alum_2=0;
                }
                if($_POST['rda']==""){
                    $rda_2=0;
                    $rda_alum_2=0;
                }
                if($_POST['rdm']==""){
                    $rdm_2=0;
                    $rdm_alum_2=0;
                }
                if($_POST['rds']==""){
                    $rds_2=0;
                    $rds_alum_2=0;
                }
                if($_POST['rn']==""){
                    $rn_2=0;
                    $rn_alum_2=0;
                }

                $bad_2=($ro1_2+$ro2_2+$ro3_2+$rs_2+$rda_2+$rdm_2+$rds_2);

        
            
            }   
            
            // imc actual
            $i=0;
            $imc5="";
            $array4 = explode(",", $imc2);
            $cantidad_dni4=count($array4);

            if($imc2!="" && $dni!="" && ($_POST["masculino"]!=""||$_POST["femenino"]!="")){
                while($i!=$cantidad_dni4){
                    $u=$user->buscar_maximo("alumnos_salud",'alumnos_dni='.$array4[$i]);
                    $imc6="";
                        
                    foreach ($u as $key => $value)
                    $imc5.=$value['imc'].",";
                    $imc6.=$imc5;
                    $i++;    
                }

                $imc6 = substr($imc6, 0, -1);
                $array4 = explode(",", $imc6);
                $cantidad_dni4=count($array4);
                //echo "imc actual";
                //echo $cantidad_dni4;

                $i=0;
                $ro1=0;
                $ro2=0;
                $ro3=0;
                $rs=0;
                $rda=0;
                $rdm=0;
                $rds=0;
                $rn=0;
                $sn=0;
                
                if($dni!="" && ($_POST["masculino"]!=""||$_POST["femenino"]!="")){
                    while($i!=$cantidad_dni4){
                        //delgadez severa
                        if($array4[$i]<16){
                            $rds++;
                        }
                        //delgadez moderada
                        if($array4[$i]>16 && $array4[$i]<16.99){
                            $rdm++;
                        }
                        //delgadez aceptable
                        if($array4[$i]>17 && $array4[$i]<18.49){
                            $rda++;
                        }
                        //Normal
                        if($array4[$i]>18.5 && $array4[$i]<24.99){
                            $rn++;
                        }
                        //sobrepeso
                        if($array4[$i]>25 && $array4[$i]<29.99){
                            $rs++;
                        }
                        //obesidad tipo 1
                        if($array4[$i]>30 && $array4[$i]<34.99){
                            $ro1++;
                        }
                        //obesidad tipo 2
                        if($array4[$i]>35 && $array4[$i]<39.99){
                            $ro2++;
                        }
                        //obesidad tipo 3
                        if($array4[$i]>40){
                            $ro3++;
                        }
                        $i++;    
                    }
                }



                //echo "Mediciones:";
                //echo $cantidad_dni4;
                //echo"|";

                //echo "IMC:";
                //echo " rds:";
                $rds_alum=$rds;
                $rdm_alum=$rdm;
                $rda_alum=$rda;
                $rn_alum=$rn;
                $rs_alum=$rs;
                $ro1_alum=$ro1;
                $ro2_alum=$ro2;
                $ro3_alum=$ro3;
                $nn= $cantidad_dni-$cantidad_dni4;
                

                $rds= number_format((($rds/$cantidad_dni4)*100), 2, '.', '');
                //echo ",";
                $rdm= number_format((($rdm/$cantidad_dni4)*100), 2, '.', '');
                //echo ",";
                $rda= number_format((($rda/$cantidad_dni4)*100), 2, '.', '');
                //echo ",";
                $rn= number_format((($rn/$cantidad_dni4)*100), 2, '.', '');
                //echo ",";
                $rs= number_format((($rs/$cantidad_dni4)*100), 2, '.', '');
                //echo ",";
                $ro1= number_format((($ro1/$cantidad_dni4)*100), 2, '.', '');
                //echo ",";
                $ro2= number_format((($ro2/$cantidad_dni4)*100), 2, '.', '');
                //echo ",";
                $ro3= number_format((($ro3/$cantidad_dni4)*100), 2, '.', '');

                //'Obesidad Tipo 1','Obesidad Tipo 2','Obesidad Tipo 3','Sobrepeso','Delgadez Aceptable','Delgadez Moderada','Delgadez Severa','Normal'

                if($_POST['ro1']==""){
                    $ro1=0;
                    $ro1_alum=0;
                }
                if($_POST['ro2']==""){
                    $ro2=0;
                    $ro2_alum=0;
                }
                if($_POST['ro3']==""){
                    $ro3=0;
                    $ro3_alum=0;
                }
                if($_POST['rs']==""){
                    $rs=0;
                    $rs_alum=0;
                }
                if($_POST['rda']==""){
                    $rda=0;
                    $rda_alum=0;
                }
                if($_POST['rdm']==""){
                    $rdm=0;
                    $rdm_alum=0;
                }
                if($_POST['rds']==""){
                    $rds=0;
                    $rds_alum=0;
                }
                if($_POST['rn']==""){
                    $rn=0;
                    $rn_alum=0;
                }

                $bad=($ro1+$ro2+$ro3+$rs+$rda+$rdm+$rds);
                
            }

            
            if($imc2!="" && $dni!=""){
                if(intval($bad_2)>=intval($bad)){
                    echo"
                    <script>
                    document.getElementById('tendencia_texto').innerHTML = 'Tendencia Positiva';
                    document.getElementById('tendencia_texto').style.color = '#06B506';
                    document.getElementById('indicador-principal').style.transform = 'rotate(0deg)';
                    document.getElementById('indicador-principal').src='../img/good.png';
                    </script>
                    ";
                }
                if(intval($bad_2)<intval($bad)){
                    echo"
                    <script>
                    document.getElementById('tendencia_texto').innerHTML = 'Tendencia Negativa';
                    document.getElementById('tendencia_texto').style.color = '#B70404';
                    document.getElementById('indicador-principal').style.transform = 'rotate(-1800deg)';
                    document.getElementById('indicador-principal').src='../img/bad.png';
                    </script>
                    ";
                }
                echo "
                    <script>
                    document.getElementById('anterior-good').innerHTML = '$rn_2 %';
                    document.getElementById('anterior-bad').innerHTML = '$bad_2 %';
                    document.getElementById('actual-good').innerHTML = '$rn %';
                    document.getElementById('actual-bad').innerHTML = '$bad %';
                    </script>";
            }
            if($dni==""){

                echo"
                    <script>
                    document.getElementById('tendencia_texto').innerHTML = 'Sin Tendencia';
                    document.getElementById('tendencia_texto').style.color = '#B70404';
                    document.getElementById('indicador-principal').style.transform = 'rotate(-1800deg)';
                    document.getElementById('indicador-principal').src='../img/error.png';
                    </script>
                    ";

                echo "
                    <script>
                    document.getElementById('anterior-good').innerHTML = '0 %';
                    document.getElementById('anterior-bad').innerHTML = '0 %';
                    document.getElementById('actual-good').innerHTML = '0 %';
                    document.getElementById('actual-bad').innerHTML = '0 %';
                    </script>";
            }
           
}

    
endif;






?>