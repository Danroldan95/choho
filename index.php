<?php
include 'includes/functions.php';
if (isset($_POST['enviado'])) {
    $condiciones = $_POST['cod_asesor'];
    $rs = clientes('C', $condiciones, '');
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <title>Consulta Clientes</title>
        <style>

        </style>
    </head>

    <body>
        <div class="card text-center">
            <div class="card-header">
                <img src="img/choho.jpg" height="80px">
            </div>
            <div class="card-body">
                <h5 class="card-title">Buscar asesor</h5>
                <br>
                <form name="contact_form" method="POST" action="">
                    <input type="hidden" name="enviado">
                    <input id="cod_asesor" name="cod_asesor" class="form-control form-control-lg" type="text" placeholder="Código Asesor" required>
                    <br>
                    <button type="submit" class="btn btn-primary btn-lg consulta" onclick="document.form_consulta.enviado.value='S';">Consultar</button>
                </form>
            </div>

        </div>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>

    </html>