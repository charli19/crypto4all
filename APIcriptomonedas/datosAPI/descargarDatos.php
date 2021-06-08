<?php

    $fp=fopen("../datosAPI/bitcoin.json", "w");
    // Se crea un manejador CURL
    $ch=curl_init();
    // Se establece la URL y algunas opciones
    curl_setopt($ch, CURLOPT_URL, "https://api.coinmarketcap.com/v1/ticker/Bitcoin/");
    //determina si descargamos las cabeceras del servidor [0-No mostramos|1-mostramos]
    curl_setopt($ch, CURLOPT_HEADER, false);
    //determina si mostramos el resultado en el nevagador [0-mostramos|1-NO mostramos]
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
    //determina donde guardar el fichero
    curl_setopt($ch, CURLOPT_FILE, $fp);
    // Se obtiene la URL indicada
    curl_exec($ch);
    // Se cierra el recurso CURL y se liberan los recursos del sistema
    curl_close($ch);
    //se cierra el manejador de ficheros
    fclose($fp);


    $fp=fopen("../datosAPI/ethereum.json", "w");
    // Se crea un manejador CURL
    $ch=curl_init();
    // Se establece la URL y algunas opciones
    curl_setopt($ch, CURLOPT_URL, "https://api.coinmarketcap.com/v1/ticker/Ethereum/");
    //determina si descargamos las cabeceras del servidor [0-No mostramos|1-mostramos]
    curl_setopt($ch, CURLOPT_HEADER, 0);
    //determina si mostramos el resultado en el nevagador [0-mostramos|1-NO mostramos]
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //determina donde guardar el fichero
    curl_setopt($ch, CURLOPT_FILE, $fp);
    // Se obtiene la URL indicada
    curl_exec($ch);
    // Se cierra el recurso CURL y se liberan los recursos del sistema
    curl_close($ch);
    //se cierra el manejador de ficheros
    fclose($fp);


    $fp=fopen("../datosAPI/litecoin.json", "w");
    // Se crea un manejador CURL
    $ch=curl_init();
    // Se establece la URL y algunas opciones
    curl_setopt($ch, CURLOPT_URL, "https://api.coinmarketcap.com/v1/ticker/Litecoin/");
    //determina si descargamos las cabeceras del servidor [0-No mostramos|1-mostramos]
    curl_setopt($ch, CURLOPT_HEADER, 0);
    //determina si mostramos el resultado en el nevagador [0-mostramos|1-NO mostramos]
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //determina donde guardar el fichero
    curl_setopt($ch, CURLOPT_FILE, $fp);
    // Se obtiene la URL indicada
    curl_exec($ch);
    // Se cierra el recurso CURL y se liberan los recursos del sistema
    curl_close($ch);
    //se cierra el manejador de ficheros
    fclose($fp);


    $fp=fopen("../datosAPI/bitcoinCash.json", "w");
    // Se crea un manejador CURL
    $ch=curl_init();
    // Se establece la URL y algunas opciones
    curl_setopt($ch, CURLOPT_URL, "https://api.coinmarketcap.com/v1/ticker/bitcoin-cash/");
    //determina si descargamos las cabeceras del servidor [0-No mostramos|1-mostramos]
    curl_setopt($ch, CURLOPT_HEADER, 0);
    //determina si mostramos el resultado en el nevagador [0-mostramos|1-NO mostramos]
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //determina donde guardar el fichero
    curl_setopt($ch, CURLOPT_FILE, $fp);
    // Se obtiene la URL indicada
    curl_exec($ch);
    // Se cierra el recurso CURL y se liberan los recursos del sistema
    curl_close($ch);
    //se cierra el manejador de ficheros
    fclose($fp);

?>