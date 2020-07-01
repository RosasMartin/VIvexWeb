<?php
echo "
<form class='demo-example'>
    <select id='ciudades' name='ciudades' multiple onchange='ddselect2();'>";
?>

<?php 

if(isset($_POST['id'])):
    
	require "conexion.php";
    $user = new vivexDB();

    $u=$user->buscar("ciudades",'provincias_id_provincia in ('.$_POST['id'].')');
    $html="";

    
         
    foreach ($u as $key => $value)
    $html.="<option value='".$value['id_ciudad']."'>".$value['ciudad']."</option>";
        
    echo $html;
    	
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