<?php
echo "
<form class='demo-example'>
    <select id='instituciones' name='instituciones' multiple onchange='ddselect3();'>";
?>

<?php 

if(isset($_POST['id'])):
    
	require "conexion.php";
	$user=new vivexDB();
	$u=$user->buscar("instituciones",'ciudades_id_ciudad in ('.$_POST['id'].')');
    $html="";

    
         
        foreach ($u as $key => $value)
        $html.="<option value='".$value['id_institucion']."'>".$value['colegio']."</option>";
        
        echo $html;
    	
endif;
?>
<?php    
echo "
    </select>
    </form>
    <script type='text/javascript'>
                            $(function() {
                                $('#instituciones').multiSelect({
                                    'noneText': 'Instituciones',
    
                                });
                            });
                        </script>";
?>