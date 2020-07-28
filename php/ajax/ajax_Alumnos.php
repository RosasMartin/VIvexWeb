<?php 
require "conexion.php";
$user = new vivexDB();
$dni="";
$generos="";
$masculinos=0;
$femeninos=0;
$cantidad_dni=0;
$html2="";

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
            //$html.=$value['genero'].",";
            //$generos=$html;  
        }
        if($_POST["masculino"]!=""||$_POST["femenino"]!=""){
            foreach ($u as $key => $value)
            $html2.=$value['genero'].",";
            $generos=$html2;  
        }
        //echo "dni|";
        //echo $html;
        //echo "|";
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
            //$html.=$value['genero'].",";
            //$generos=$html;
        }
        if($_POST["masculino"]!=""||$_POST["femenino"]!=""){
            foreach ($u as $key => $value)
            $html2.=$value['genero'].",";
            $generos=$html2;
        }
        //echo "dni|";
        //echo $html;
        //echo "|";
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
            //$html.=$value['genero'].",";
            //$generos=$html;
        }
        if($_POST["masculino"]!=""||$_POST["femenino"]!=""){    
            foreach ($u as $key => $value)
            $html2.=$value['genero'].",";
            $generos=$html2;
            
        }
        //echo "dni|";
        //echo $html;
        //echo "|";
    }
endif;



if(isset($_POST['provincias'])):
    if($_POST['instituciones']!="null" || $_POST['ciudades']!="null" || $_POST['provincias']!="null"){
        
        
        
        $dni = substr($dni, 0, -1);
        $array = explode(",", $dni);

        $cantidad_dni=count($array);
        

        $generos = substr($generos, 0, -1);
        $arrayGeneros= explode(",", $generos);

        $e=0;
        while($e!=$cantidad_dni){
            if($arrayGeneros[$e]=="M"){
                $masculinos++;
            }
            if($arrayGeneros[$e]=="F"){
                $femeninos++;
            }
            $e++;  
        }

        $i=0;
        $imc2="";
        if($dni!="" && ($_POST["masculino"]!=""||$_POST["femenino"]!="")){
            while($i!=$cantidad_dni){
                $u=$user->buscar_maximo("alumnos_salud",'alumnos_dni='.$array[$i]);
                $imc="";
                    
                foreach ($u as $key => $value)
                $imc.=$value['imc'].",";
                $imc2.=$imc;
                $i++;    
            }
        }
        
        $imc2 = substr($imc2, 0, -1);
        $arrayIMC = explode(",", $imc2);
        $cantidad_mediciones = count($arrayIMC);
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
            while($i!=$cantidad_mediciones){
                //delgadez severa
                if($arrayIMC[$i]<16){
                    $rds++;
                }
                //delgadez moderada
                if($arrayIMC[$i]>16 && $arrayIMC[$i]<16.99){
                    $rdm++;
                }
                //delgadez aceptable
                if($arrayIMC[$i]>17 && $arrayIMC[$i]<18.49){
                    $rda++;
                }
                //Normal
                if($arrayIMC[$i]>18.5 && $arrayIMC[$i]<24.99){
                    $rn++;
                }
                //sobrepeso
                if($arrayIMC[$i]>25 && $arrayIMC[$i]<29.99){
                    $rs++;
                }
                //obesidad tipo 1
                if($arrayIMC[$i]>30 && $arrayIMC[$i]<34.99){
                    $ro1++;
                }
                //obesidad tipo 2
                if($arrayIMC[$i]>35 && $arrayIMC[$i]<39.99){
                    $ro2++;
                }
                //obesidad tipo 3
                if($arrayIMC[$i]>40){
                    $ro3++;
                }
                $i++;    
            }
        }



        //echo "Mediciones:";
        //echo $cantidad_mediciones;
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
        $nn= $cantidad_dni-$cantidad_mediciones;
        

        $rds= number_format((($rds/$cantidad_mediciones)*100), 2, '.', '');
        //echo ",";
        $rdm= number_format((($rdm/$cantidad_mediciones)*100), 2, '.', '');
        //echo ",";
        $rda= number_format((($rda/$cantidad_mediciones)*100), 2, '.', '');
        //echo ",";
        $rn= number_format((($rn/$cantidad_mediciones)*100), 2, '.', '');
        //echo ",";
        $rs= number_format((($rs/$cantidad_mediciones)*100), 2, '.', '');
        //echo ",";
        $ro1= number_format((($ro1/$cantidad_mediciones)*100), 2, '.', '');
        //echo ",";
        $ro2= number_format((($ro2/$cantidad_mediciones)*100), 2, '.', '');
        //echo ",";
        $ro3= number_format((($ro3/$cantidad_mediciones)*100), 2, '.', '');

        $bad=($ro1+$ro2+$ro3+$rs+$rda+$rdm+$rds);
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

        $resto=100-($ro1+$ro2+$ro3+$rs+$rda+$rdm+$rds+$rn);
        if($resto<0){
            $resto=0;
        }

        echo "<canvas id='myChart' height='240vh'></canvas>
            <script>
                var ctx= document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type:'bar',
                    data:{
                        labels:['Obes Tipo 3','Obes Tipo 2' ,'Obes Tipo 1','Sobrepeso','Normal','Delg Aceptable','Delg Moderada','Delg Severa','Resto'],
                        datasets:[{
                            label:'Porcentaje',
                            data:['$ro3','$ro2','$ro1','$rs','$rn','$rda','$rdm','$rds','$resto'],
                            backgroundColor:['#AD4F9A','#ED1C24','#EB6419','#EDE537','#82BC57','#25A5DD','#87D1D1','#DFCCE4','#B7B7B7'],
                            borderWidth:0.5
                        }]
                    },
                    
                    options:{
                        responsive: true,
                        maintainAspectRatio: false,
                        yAxisID:false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    
                                    // Include a dollar sign in the ticks
                                    callback: function(value, index, values) {
                                        return value + '%';
                                    },
                                    beginAtZero:true                                   
                                    
                                }
                            }]
                        },
                        tooltips: {
                            callbacks: {
                              label: function(tooltipItem, data) {
                                return data['datasets'][0]['data'][tooltipItem['index']] + '%';
                              }
                            }
                          },
                        legend: {
                                display: false,
                                align: 'start',
                                position:'right',
                                labels: {
                                    // This more specific font property overrides the global property
                                    fontColor: 'white',
                                    fontSize: 8,
                                    boxWidth: 9
                                }
                        }
                    }
                });
                
            </script>
            <script>
                document.getElementById('gf').innerHTML =$femeninos;
                document.getElementById('gm').innerHTML =$masculinos;
                document.getElementById('totalalumnos').innerHTML =$cantidad_dni;
                document.getElementById('ro1').innerHTML ='($ro1 %) - $ro1_alum alumnos';
                document.getElementById('ro2').innerHTML ='($ro2 %) - $ro2_alum alumnos';
                document.getElementById('ro3').innerHTML ='($ro3 %) - $ro3_alum alumnos';
                document.getElementById('rda').innerHTML ='($rda %) - $rda_alum alumnos';
                document.getElementById('rdm').innerHTML ='($rdm %) - $rdm_alum alumnos';
                document.getElementById('rds').innerHTML ='($rds %) - $rds_alum alumnos';
                document.getElementById('rn').innerHTML ='($rn %) - $rn_alum alumnos';
                document.getElementById('rs').innerHTML ='($rs %) - $rs_alum alumnos';
                document.getElementById('nn').innerHTML ='$nn alumnos';
                
            </script>
            ";

            if($dni==""){
                echo "<script>
                document.getElementById('totalalumnos').innerHTML =0;
                </script>";
            }
                


        //echo "|";
        
        //echo "Alumnos ";
        //echo $cantidad_dni;
        //echo "|";
    }
endif;






?>