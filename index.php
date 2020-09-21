<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vivex</title>
    <link href="https://necolas.github.io/normalize.css/8.0.1/normalize.css" rel="stylesheet">
    <link rel="stylesheet" href="../vivexwebmob/css/index.css">
    <!-- jQuery AJAX -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="links">
            <a href="http://www.arconsultores.com.ar/">
                <img src="../vivexwebmob/img/ARConsultores.png" alt="AR logo">
            </a>
        
            <a href="http://www.sanjuan.gov.ar/">
                <img src="../vivexwebmob/img/SanJuan.png" alt="logo san juan">
            </a>
        </div>
        <div class="barra">
            <nav class="nav">
                <a href="#">Sobre Nosotros</a>
                <a href="#">Información del proyecto</a>
            </nav>
        </div>
    </header>
    
    <main>
        <div class="login-contenedor">
            <img class="img-login" src="../vivexwebmob/img/Vivex.png" alt="logo vivex">

            <form class="contacto" >

                <input type="text" id="email" placeholder="Usuario" required name="query" onchange="login();">

                <input type="password" id="password" placeholder="Contraseña" required name="query2" onchange="login();">
                <a id= "btn_submit" class="boton boton-rojo" style='cursor: default;' onclick="submit();">Ingresar</a>
            </form>
            <p class='mensaje' id='mensaje'>Error: Complete todos los campos</p>
        </div>
    </main>
    
    <footer class="footer">
        <p>Copyright © Sistema Vivex 2020 - Todos los derechos reservados</p>
    </footer>
   
</body>
</html>

<script type="text/javascript">
    function login(){
        
        var usuario = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        if(usuario!=""){
            document.getElementById('email').style.border = '1px solid #89fc00';
            //alert(usuario);
        }
        
        if(password!=""){
            document.getElementById('password').style.border = '1px solid #89fc00';
            //alert(password);
        }

        
        if(usuario!="" && password!=""){
            document.getElementById('btn_submit').style.cursor ='default';
            document.getElementById('mensaje').innerHTML = '';
        }
    }

    function submit(){
        var usuario = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        //alert(usuario+" "+password);

        $.ajax({
                    data: { 'usuario':usuario,
                            'password':password},
                    url:   './php/ajax/ajax_login.php',
                    type:  'POST',
                    beforeSend: function () {
                    //alert('Enviando');
                        
                    },
                    success:  function (response) { 
                        //console.log(response);
                        //alert(response);
                        

                        if(response.includes("fail")){
                            document.getElementById('mensaje').innerHTML = 'Error: Usuario o Contraseña Incorrectos';
                        }else{
                            
                            window.location.href = "./php/principal.php";
                        }
                    
                    },
                    error:function(){
                        //alert('error')
                        document.getElementById('mensaje').innerHTML = 'Error: error critico';
                    }
        });
    }
    
    
</script>