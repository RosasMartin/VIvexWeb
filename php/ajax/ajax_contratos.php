<?php
echo "
<form class='demo-example'>
    <select id='contratos' name='contratos' multiple onchange='ddselect4();'>
    <option id='all_contrato' value='0' onchange='allcontrato();'>TODOS</option>";
?>

<?php 

if(isset($_POST['id'])):
    
	require "conexion.php";
	$user=new vivexDB();
	$u=$user->buscar("contratos",'id_contrato');
    $html="";

    
         
        foreach ($u as $key => $value)
        $html.="<option id='contrato_opt' value='".$value['id_contrato']."'>".$value['descripcion']."</option>";
        
        echo $html;
    	
endif;
?>
<?php    
echo "
    </select>
    </form>
    <script type='text/javascript'>
                            $(function() {
                                $('#contratos').multiSelect({
                                    'noneText': 'Contratos',
    
                                });
                            });
                        </script>";
?>