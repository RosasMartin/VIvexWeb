<?php
echo "
<form class='demo-example'>
<select id='provincias' name='provincias' multiple onchange='ddselect();'>";
?>

<?php 

if(isset($_POST['id'])):
    
    //echo "<option id='all_ciud' value='0' onchange='allciud();'>TODAS</option>";

	require "conexion.php";
    $user = new vivexDB();

    if($_POST['id']!="null"){
        $u=$user->buscar("provincias",'paises_id_pais in ('.$_POST['id'].')');
        $html="";
        //echo"<script> alert(".json_encode($u)."); </script>";
        if($u!=""){
            echo "<option id='all_prov' value='0' onchange='allprov();'>TODAS</option>";
                
            foreach ($u as $key => $value)
            $html.="<option id='prov_opt' value='".$value['id_provincia']."'>".$value['provincia']."</option>";
        }
        echo $html;

        
    }
    	
endif;
?>
<?php    
echo "
    </select>
    </form>
    <script type='text/javascript'>
                            $(function() {
                                $('#provincias').multiSelect({
                                    'noneText': 'Provincias',
    
                                });
                            });
                        </script>";
?>