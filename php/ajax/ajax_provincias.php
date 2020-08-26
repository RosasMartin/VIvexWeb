<?php
echo "
<form class='demo-example'>
    <select id='provincias' name='provincias' multiple onchange='ddselect0();'>";
?>

<?php 

if(isset($_POST['id'])):
    
    //echo "<option id='all_ciud' value='0' onchange='allciud();'>TODAS</option>";

	require "conexion.php";
    $user = new vivexDB();

    $u=$user->buscar("provincias",'paises_id_pais in ('.$_POST['id'].')');
    $html="";

    echo "<option id='all_provincia' value='0' onchange='allprovincia();'>TODAS</option>";
         
    foreach ($u as $key => $value)
    $html.="<option id='provincia_opt' value='".$value['id_provincia']."'>".$value['provincia']."</option>";
    
    echo $html;
    if($html==""){
        echo "
        <script>
            change_provincia();
            change_ciudad();
        </script>
        ";
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
                                    'noneText': 'provincias',
    
                                });
                            });
                        </script>";
?>