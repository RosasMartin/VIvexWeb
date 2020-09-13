
<?php 

if(isset($_POST['id'])):

	require "conexion.php";
    $user = new vivexDB();
    //echo $_POST['id_institucion']; 
    //echo $_POST['id_ciudad'];
    //echo $_POST['id_provincia'];
    //echo $_POST['id_pais'];
    //echo $_POST['id_contrato'];
    
    //Admin
    //Insti
    //Alumn
    $htmlAdmin1="";
    $htmlAdmin2="";
    $AdminPais1="";
    $AdminPais2="";
    $AdminPais3="";
    
?>

<?php
    
    if(strpos($_POST['id'], "Admin")=="true"){  
        //Multiselect paises
        $AdminPais1="    
        <form class='demo-example'>
            <select id='paisespopup' name='paises' class='pais_popup' onchange='ddselectpaispopup();'>
            <option id='null' value='0';'>Pais</option>";

                
                    
        $paises=$user->buscar('paises','1');
        foreach($paises as $paises):
            $AdminPais2.="<option id='pais_optpopup' value='".$paises['id_pais']."'>".$paises['nombre_pais']."</option>";
        endforeach;
                
        $AdminPais3="
        <script type='text/javascript'>
            
            function ddselectpaispopup() {
                            
                var select = $('#paises').val();
                var selectedpaises = [];
                for (var option of document.getElementById('paisespopup').options) {
                    if (option.selected) {
                        selectedpaises.push(option.value);
                    }
                }

                popupPaisSelect(selectedpaises);
            }
            function popupPaisSelect(selectedpaises){
                alert(selectedpaises);
            }
        </script>";
        

        $htmlAdmin1.="
        <style type='text/css'>

        /* ------------------------- */
        /* POPUP */
        /* ------------------------- */
    
        main .overlay {
            background: rgba(0,0,0,.4);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            align-items: center;
            justify-content: center;
            display: flex;
            visibility: hidden;
            z-index: 1;
        }
    
        main .overlay.active {
            visibility: visible;
        }
    
        main .popup {
            display:grid;
            background: #F8F8F8;
            box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.4);
            border-radius: 6px;
            font-family: 'Montserrat', sans-serif;
            padding: 20px;
            text-align: center;
            width: 800px;
            height: 500px;
            transition: .3s ease all;
            transform: scale(0.7);
            opacity: 0;
            z-index: 2;
        }
    
        main .popup .btn-cerrar-popup {
            height: 2.5px;
            display: block;
            text-align: right;
            transition: .3s ease all;
            color: #BBBBBB;
        }
    
        main .popup .btn-cerrar-popup:hover {
            color: #000;
        }
    
        main .popup h3 {
            font-size: 25px;
            font-weight: 600;
            margin-bottom: 5px;
            opacity: 0;
            color: rgba(0, 0, 0, 0.6);
        }
    
        main .popup h4 {
            font-size: 20px;
            font-weight: 300;
            margin-bottom: 15px;
            opacity: 0;
        }
        main .popup form .contenedor-inputs {
            opacity: 0;
            display:grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows:1fr .5fr;
        }
        main .popup form .contenedor-inputs imput1{
            display:grid;
            grid-row: 1 / 2;
        }
        main .popup form .contenedor-inputs imput2{
            display:grid;
            grid-row: 2 / 3;
        }
        main .popup form .contenedor-inputs imput3{
            display:grid;
            grid-row: 1 / 2;
            padding-top:20px;
        }
        main .popup form .contenedor-inputs imput4{
            display:grid;
            grid-row: 2 / 3;
           
        }
        main .popup form .contenedor-inputs input {
            width: 100%;
            margin-bottom: 10px;
            height: 28px;
            width: 350px;
            font-size: 18px;
            line-height: 52px;
            text-align: center;
            border: 1px solid #BBBBBB;
            border-radius: 20px;
        }
        
        main .popup form .contenedor-inputs .pais_popup {
            width: 100%;
            margin-bottom: 10px;
            height: 28px;
            width: 350px;
            font-size: 18px;
            line-height: 52px;
            text-align: center;
            border: 1px solid #BBBBBB;
            border-radius: 20px;
            color:#6C6B6B;
            text-align-last: center;
            align-self: center;
            justify-self: center;
        }
        
    
        main .popup form .btn-submit {
            padding: 0 20px;
            margin-top: 10px;
            height: 40px;
            line-height: 40px;
            border: none;
            color: #fff;
            background: #551919;
            border-radius: 3px;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            cursor: pointer;
            transition: .3s ease all;
        }
    
        main .popup form .btn-submit:hover {
            background: rgba(94,125,227, .9);
            background: #8c4848c0;
        }
    
        /* ------------------------- */
        /* ANIMACIONES */
        /* ------------------------- */
        main .popup.active {	transform: scale(1); opacity: 1; }
        main .popup.active h3 { animation: entradaTitulo .8s ease .5s forwards; }
        main .popup.active h4 { animation: entradaSubtitulo .8s ease .5s forwards; }
        main .popup.active .contenedor-inputs { animation: entradaInputs 1s linear 1s forwards; }
    
        @keyframes entradaTitulo {
            from {
                opacity: 0;
                transform: translateY(-25px);
            }
    
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    
        @keyframes entradaSubtitulo {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
    
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    
        @keyframes entradaInputs {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        </style>

        <a href='#' id='btn-cerrar-popup' class='btn-cerrar-popup'><img src='../img/clear.png' alt=''></a>
                    <h3>Administrador</h3>
                    <h4>Agregar administrador</h3>
                    <form action=''>
                        <div class=contenedor-maestro>
                            <div class='contenedor-inputs'>
                                <div class='imput1'>
                                <input type='text' placeholder='ID Contrato'>
                                <input type='text' placeholder='Estatus'>
                                <input type='text' placeholder='Nombre'>
                                <input type='text' placeholder='Apellido'>
                                <input type='email' placeholder='Correo'>
                                </div>
                                <div class='imput2'>";

                                $htmlAdmin2="
                                <input id='popupProvSelect' type='text' placeholder='Provincia'>
                                <input type='text' placeholder='Ciudad'>
                                <input type='text' placeholder='Institución'>
                                </div>
                                <div class='imput3' style='padding-top: 30px;'>
                                <input type='password' placeholder='Password'>
                                </div>
                                <div class='imput4' style='padding-top: 30px;'>
                                <input type='password' placeholder='Reingrese Password'>
                                </div>
                            </div>
                        </div>
                        <div>
                            <input type='submit' class='btn-submit' value='Suscribirse'>
                        </div>
                    </form>
        ";
    }
    

    echo $htmlAdmin1;
    echo $AdminPais1;
    echo $AdminPais2;
    echo $AdminPais3;
    echo $htmlAdmin2;
    
    
    	
endif;
?>
