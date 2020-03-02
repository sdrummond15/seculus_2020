<?php

$tipo = $_GET['sorteio'];

if( (!isset($tipo) || trim($tipo) != 'regional') && (trim($tipo) != 'nacional')){

    $tipo = 'regional';

}





$servername = "localhost";

$username = "root";

$password = "";

$result = '';



// Create connection

$conn = new mysqli($servername, $username, $password,'db_show_pre');

// Check connection

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}else {



    $titulo = 'Informe a data do sorteio:';



    $selectRegional = '';

    if($tipo == 'regional') {

        $sqlRegional = "select * from sweepstakes where type = '$tipo' group by type_zone";

        $resRegional = $conn->query($sqlRegional);

        $countRegional = 0;

        $optionRegional = '';



        while ($rowRegional = $resRegional->fetch_assoc()) {

            $optionRegional.=  '<option value="' . $rowRegional["type_zone"] . '">' . $rowRegional["type_zone"] . '</option>';

            $countRegional ++;

        }

        if($countRegional > 0){

            $selectRegional = '<select name="type_zone" id="type_zone">' . $optionRegional . '</select>';

        }



        $titulo = 'Informe a regional e a data do sorteio:';



    }



    $sqlDate = "select * from sweepstakes where type = '$tipo' group by date_drawn";

    $resDate = $conn->query($sqlDate);

    $countDate = 0;

    $optionDate = '';

    $selectDate = '';

    while ($rowDate = $resDate->fetch_assoc()) {

        $optionDate.=  '<option value="' . $rowDate["date_drawn"] . '">' .

                            implode('/',array_reverse(explode('-',$rowDate["date_drawn"]))) .

                        '</option>';

        $countDate ++;

    }

    if($countDate > 0){

        $selectDate = '<select name="date_drawn" id="date_drawn" >' . $optionDate . '</select>';

    }



}

?>



<!DOCTYPE html>



<html lang="en">



<head>

    <meta charset="UTF-8">

    <title>Seculus</title>

    <meta name="description" content="Show de Prêmios Seculus.">

    <meta name="author" content="SDrummond">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="Show de Prêmios Seculus"/>

    <meta property="og:description" content="Show de Prêmios Seculus.">

    <meta property="og:image:type" content="image/jpeg">

    <meta property="og:image:width" content="450">

    <link rel="icon" type="image/png" href="images/favicon.png"/>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/fontawesome-all.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-24132529-60"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-24132529-60');
</script>


</head>



<body class="sorteios">

<div id="topo"></div>

<header>



    <header>



    <div id="menu">



        <div class="menu">

            <div class="main-menu">

                <ul>

                    <li><a href="index.php#periodo">Como Participar</a></li>

                    <li><a href="index.php#sorteio-nacional">Sorteios e Prêmios</a></li>

                    <li><a href="index.php#resultados">Números da Sorte</a></li>

                    <li><a href="index.php#ganhadores">Resultados</a></li>

                    <li><a href="index.php#contato">Fale Conosco</a></li>


                </ul>

            </div>

        </div>



        <div id="menuresp">

            <button title="button">

                <i class="fas fa-bars"></i>

            </button>

            <ul class="responsive">

                <li><a href="index.php#periodo">Como Participar</a></li>

                <li><a href="index.php#sorteio-nacional">Sorteios e Prêmios</a></li>

                <li><a href="index.php#resultados">Números da Sorte</a></li>

                <li><a href="index.php#ganhadores">Resultados</a></li>

                <li><a href="index.php#contato">Fale Conosco</a></li>


            </ul>

        </div>



    </div>



    <div id="slide-result">

        <img src="images/logo_premios_seculus.png" alt="promocao seculus"/>

    </div>



</header>



<section id="sorteios">



    <div>



        <article>



            <h3><?= $titulo ?></h3>

            <div>

                <form>

                    <fieldset>

                        <input type="hidden" name="type" id="type" value="<?= $tipo ?>"/>

                        <?= $selectRegional ?>

                        <?= $selectDate ?>

                        <input type="submit" id="btn-sorteio" class="btn-sorteio" value="Buscar"/>

                    </fieldset>

                </form>

            </div>



            <div id="ganhadores">



            </div>



        </article>



    </div>



</section>



<section id="chance">

    <article>

        <h3>QUANTO MAIS VOCÊ COMPRAR, MAIS CHANCE TEM DE GANHAR! </h3>

    </article>

</section>



<footer id="footer-result">

    <article>

        <p>&copy; 2019 por Seculus da Amazônia S/A

            Promoção interna válida para parceiros comerciais da Seculus da Amazônia, não aberta ao público em geral. Consulte regras de participação.</p>

    </article>

</footer>



<span class="topo">

    <a href="#topo">

        <i class="fas fa-angle-up"></i>

    </a>

</span>



</body>



<script src="assets/js/jquery_1.9.min.js"></script>

<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/jquery.noty.packaged.min.js"></script>

<script src="assets/js/jquery.maskedinput-1.1.4.pack.js"></script>

<script src="assets/js/jquery.inputmask.bundle.js"></script>

<script src="assets/js/script.js"></script>



</html>

