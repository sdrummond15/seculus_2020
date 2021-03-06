<?php
$servername = "localhost";
$username = "root";
$password = "";
$result = '';

// Create connection
$conn = new mysqli($servername, $username, $password,'db_show_pre');

$type_zone = '';

if (isset($_POST["type_zone"])) {
    $type_zone = $_POST["type_zone"];
    $type_zone = "and type_zone = '" . $type_zone . "'";
}

if (isset($_POST["date_drawn"])) {
    $date_drawn = $_POST["date_drawn"];
}

if (isset($_POST["type"])) {
    $type = $_POST["type"];
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql = "select s.*
            from sweepstakes s
            where type = '$type'
            and date_drawn = '$date_drawn' " . "$type_zone";

    $res = $conn->query($sql);
    $count = 0;
    $result = '<h4>Parabéns aos ganhadores! <br>Seu número da sorte continua valendo!</h4>';

    while ($row = $res->fetch_assoc()) {
        $img = 'images/';
        if(strtoupper($row["premium"]) == 'SMARTPHONE')
            $img .= 'smartphone.png';
        if(strtoupper($row["premium"]) == 'SMARTV32')
            $img .= 'smarttv_32.png';
        if(strtoupper($row["premium"]) == 'CAIXA DE SOM JBL')
            $img .= 'caixa_jbl.png';
        if(strtoupper($row["premium"]) == 'ARGO')
            $img .= 'argo.png';
	    if(strtoupper($row["premium"]) == 'MOTO')
            $img .= 'moto.png';
    	if(strtoupper($row["premium"]) == 'IPAD')
            $img .= 'ipad.png';
    	if(strtoupper($row["premium"]) == 'IPHONE')
            $img .= 'iphone.png';
	    if(strtoupper($row["premium"]) == 'CARRO')
            $img .= 'argo.png';
	    if(strtoupper($row["premium"]) == 'TABLET')
            $img .= 'tablet.png';
	    if(strtoupper($row["premium"]) == 'ASPIRADOR DE PO ROBO')
            $img .= 'aspiradores_po_robo.png';
	    if(strtoupper($row["premium"]) == 'PURIFICADOR DE ÁGUA')
            $img .= 'purificador_agua.png';

        $result .= '<div class="ganhador_sorteio">';
        $result .= '<h3>' . utf8_encode($row["premium"]) . '</h3>';
        $result .= '<img src="' . $img . '" alt="' . utf8_encode($row["premium"]) . '"/>';
        $result .= '<p>Número do pedido: ' . utf8_encode($row["pedido"]) . '</p>';
        $result .= '<p>Razão Social: ' . utf8_encode($row["cnpj"]) . '</p>';
        $result .= '<p>Número da sorte: ' . utf8_encode($row["sort_number"]) . '</p>';
        $result .= '<p>Marca: ' . utf8_encode($row["modelo"]) . '</p>';
        $result .= '</div>';

        $count++;
    }

    if ($count == 0) {
        $result = '<p>Não houveram ganhadores para essa data!</p>';
    }

}

echo $result;
exit();

?>