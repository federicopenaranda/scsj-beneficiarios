<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" type="image/ico" href="">	
        <title>SISSCSJ - Ingreso al Sistema</title>
        <link href="resources/css/style_index.css" type="text/css" media="screen" rel="stylesheet">
        <script src="resources/js/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
        <style type="text/css">
            img, div { behavior: url(iepngfix.htc) }
        </style>

        <script>
            $( document ).ready(function() {
                $( "#ingresar" ).click(function( event ) {
                    var data = $( "#login_form" ).serialize();
                    $.ajax({
                        //url: "http://190.181.18.240/sisscsj/yii/index.php/usuario/login?" + data,
                        //url: "http://200.105.158.70:8080/sisscsj/yii/index.php/usuario/login?" + data,
                        //url: "http://192.168.1.110:8080/sisscsj/yii/index.php/usuario/login?" + data,
                        //url: "http://192.168.100.102/sisscsj/yii/index.php/usuario/login?" + data,
                        url: "http://192.168.146.128/sisscsj/sisscsj/yii/index.php/usuario/login?" + data,
                        jsonp: "callback",
                        dataType: "jsonp",
                        success: function (response) {
                            //(response.success === "true") ? location.replace('build/production/sisscsj/index.html') : $( "#mensaje" ).html( '<p class="error">Datos de ingreso err&oacute;neos, intente nuevamente.</p>' );
                            (response.success === "true") ? location.replace('index.html') : $( "#mensaje" ).html( '<p class="error">Datos de ingreso err&oacute;neos, intente nuevamente.</p>' );
                        },
                        failure: function (response) {
                            $( "#mensaje" ).html( '<p class="error">Error de conexión al servidor</p>' );
                        }
                    });
                });

                $( "#login_usuario" ).keyup(function (event) {
                    if ( event.which === 13 ) {
                        $( "#ingresar" ).trigger('click');
                    }
                });
                
                $( "#password_usuario" ).keyup(function (event) {
                    if ( event.which === 13 ) {
                        $( "#ingresar" ).trigger('click');
                    }
                });
            });
        </script>
        
    </head>
    <body id="login">
        <div id="wrappertop"></div>
        <div id="wrapper">
            <div id="content">
                <div id="header">
                    <h1><a href=""><img src="resources/images/logo3.png" alt="SISSCSJ - Sociedad Católica San José"></a></h1>
                    <span class="title2">Sistema SISSCSJ</span>
                </div>
                <div id="darkbanner" class="banner320">
                    <h2>Ingreso</h2>
                </div>
                <div id="darkbannerwrap">
                </div>
                <form name="login_form" method="post" action="#" id="login_form">
                    <fieldset class="form">
                        <span id="mensaje"></span>
                        <p>
                            <label for="login_usuario">Usuario:</label>
                            <input name="login_usuario" id="login_usuario" type="text">
                        </p>
                        <p>
                            <label for="password_usuario">Contrase&ntilde;a:</label>
                            <input name="password_usuario" id="password_usuario" type="password">
                        </p>
                        <button type="button" class="positive" name="ingresar" id="ingresar">
                            <img src="resources/images/key.png" alt="Ingresar">Ingresar</button>
                        <ul id="forgottenpassword">
                            <li class="boldtext">|</li>
                            <li><a href="">¿Olvidó su Contraseña?</a></li>
                        </ul>
                    </fieldset>
                </form>
            </div>
        </div>   

        <div id="wrapperbottom_branding">
            <div id="wrapperbottom_branding_text">
            </div>
        </div>
    </body>
</html>