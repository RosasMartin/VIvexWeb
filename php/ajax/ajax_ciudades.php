<?php
echo "
<form class='demo-example'>
    <select id='ciudades' name='ciudades' multiple onchange='ddselect2();'>";
?>

<?php 

if(isset($_POST['id'])):
    
    //echo "<option id='all_ciud' value='0' onchange='allciud();'>TODAS</option>";

	require "conexion.php";
    $user = new vivexDB();

    $u=$user->buscar("ciudades",'provincias_id_provincia in ('.$_POST['id'].')');
    $html="";
    echo "<option id='all_ciud' value='0' onchange='allciud();'>TODAS</option>";
    
         
    foreach ($u as $key => $value)
    $html.="<option id='ciud_opt' value='".$value['id_ciudad']."'>".$value['ciudad']."</option>";
    
    
    echo $html;
    if($html==""){
        echo "
        <script>
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
                                $('#ciudades').multiSelect({
                                    'noneText': 'Ciudades',
    
                                });
                            });
                        </script>";
?>