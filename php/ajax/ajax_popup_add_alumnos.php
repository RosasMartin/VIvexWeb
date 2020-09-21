
<?php 

if(isset($_POST['id'])):

	require "conexion.php";
    $user = new vivexDB();
    
    
    //Admin
    //Insti
    //Alumn
    $htmlAdmin1="";
    $htmlAdmin2="";
    $AdminPais1="";
    $AdminPais2="";
    $AdminPais3="";
    $AdminContratos="";
    $AdminEstatus="";
    $files="";
    
?>

<?php
    
    if(strpos($_POST['id'], "Alumn")=="true"){  
        
        $filename="";

        


        $htmlAdmin1="
        
        
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
            grid-template-column: 1fr;
            background: #F8F8F8;
            box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.4);
            border-radius: 6px;
            font-family: 'Montserrat', sans-serif;
            padding: 20px;
            text-align: center;
            width: 500px;
            height: 450px;
            transition: .3s ease all;
            transform: scale(0.7);
            opacity: 0;
            z-index: 2;
        }
        
        main .popup .mensaje {
            mergin-top: 10px;
            margin-bottom: 10px;
            color: #551919;
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
            margin-top: 10px;
            opacity: 0;
            color: rgba(0, 0, 0, 0.6);
        }
    
        main .popup h4 {
            font-size: 20px;
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 15px;
            opacity: 0;
        }
        main .popup form .contenedor-inputs {
            opacity: 0;
            display:grid;
            grid-template-columns: 1fr;
            grid-template-rows:5fr 1fr;
        }
        
        main .popup form .contenedor-inputs input {
            display:none;
        }
        
        
        main .popup form .contenedor-inputs .select_popup {
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
            padding: 10px 20px;
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


        /** File **/
        
        /** File **/
        </style>

       

        <a href='#' id='btn-cerrar-popup' class='btn-cerrar-popup'><img src='../img/clear.png' alt=''></a>
        <h3>Alumnos</h3>
        <h4>Agregar alumnos</h3>
        <form action=''>
            <div class=contenedor-maestro>
                <div class='contenedor-inputs'>                    
                <form id='upload_csv' method='post' enctype='multipart/form-data' >
                    <div class='box'>
                        <input type='file' name='File_csv' id='File_alumn' class='inputfile inputfile-5' data-multiple-caption='{count} files selected' multiple  onchange='fileAlumn();'accept='.csv'/>
                        <label for='File_alumn'><figure><svg xmlns='http://www.w3.org/2000/svg' width='20' height='17' viewBox='0 0 20 17'><path d='M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z'/></svg></figure> <span>Seleccione un Archivo .csv</span></label>
                    </div>
                </form>

                <script src='../js/custom-file-input.js'></script>
                
                    ";

                    $htmlAdmin2="
                    
                </div>
                
                <a id='btnAlumn' class='btn-submit' onclick='suscribeAlumn();' style='cursor: not-allowed;'>Suscribirse</a>
                
            </div>
            <p class='mensaje' id='mensajeAlumn'></p>
        </form>

        <script type='text/javascript'>
            function fileAlumn(){
                document.getElementById('btnAlumn').style.cursor = 'default';
            }

            function suscribeAlumn(){

                var formData = new FormData();
                formData.append('file', $('input[type=file]')[0].files[0]);
                
                $.ajax({  
                    url:'./ajax/ajax_popup_add_suscripcionAlumn.php',  
                    method:'POST',  
                    data:formData,  
                    contentType:false,          // The content type used when sending data to the server.  
                    cache:false,                // To unable request pages to be cached  
                    processData:false,          // To send DOMDocument or non processed data file it is set to false  
                    success: function(data){  
                            //alert(data);
                            if(data.includes('true')){
                                document.getElementById('mensajeAlumn').innerHTML = 'Alumnos Agregados correctamente';
                            }
                            if(data.includes('false')){
                                document.getElementById('mensajeAlumn').innerHTML = 'Error: Alumnos no agregados';
                            }
                            if(data.includes('Duplicate')){
                                document.getElementById('mensajeAlumn').innerHTML = 'Error: Los alumnos no pueden ser duplicados';
                            }

                    }  
                });  
            }

        </script>

        ";
    }
    

    echo $htmlAdmin1;
    echo $AdminPais1;
    echo $AdminPais2;
    echo $AdminPais3;
    echo $htmlAdmin2;
    
    
    	
endif;
?>
