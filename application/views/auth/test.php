<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .white {
            background-color:#FFFFFF;
            color:#000000;
        }
        
        .black {
            background-color:#000000;
            color:#FFFFFF;
        }
    </style>
</head>
<body class="white">
    <h1 class="black">Cada 3 segundos se va a cambiar de color el fondo de esta Web.</h1>
    <button id="button">Activar</button>
    <button id="button2">Detener</button>
    
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script type="text/javascript">
        
        var interval = false;

        $(document).ready(function() {

            function changeColor() {
                if ($('body').hasClass('white')) {
                    $('body').removeClass('white');
                    $('body').addClass('black');
                    $('h1').removeClass('black');
                    $('h1').addClass('white');
                }
                else {
                    $('body').removeClass('black');
                    $('body').addClass('white');
                    $('h1').removeClass('white');
                    $('h1').addClass('black');
                }
            }

            $("#button").on('click', function() {
                activar_detener(1);
            });

            $("#button2").on('click', function() {
                activar_detener(2);
            });

            function activar_detener(number) {

                if(number == 1) {
                    if(interval == false) {
                        interval = setInterval(changeColor, 3000);
                    }
                }
                if (number == 2) {
                    if(interval != false) {
                        clearInterval(interval);
                        interval = false;
                    }
                }
            }
        });
    </script>

</body>
</html>