<?php
    
    while(true){
        include('../datosAPI/descargarDatos.php'); 
        insertBitcoin();
        insertEthereum();
        insertLitecoin();
        insertBitconCash();

        sleep(100);
    }
    
    function insertBitcoin(){

        //crear la conexión
        $server = "localhost";
        $user = "root";
        $pass = "";
        $bd = "c4a";
        $conexion = mysqli_connect($server, $user, $pass, $bd) 
        or die("Ha sucedido un error inexperado en la conexion de la base de datos");
        
        
        //Insertar nombre y volumen Bitcoin JSON
        //------------------------------------//
        $json = file_get_contents('../datosAPI/bitcoin.json');//leemos los datos del json
        $bitcoin = json_decode($json, true);//decodificamos los datos
        $fecha = strftime( "%Y-%m-%d-%H-%M-%S", time() );//creamos la fecha para la BD
        /*
        foreach ($bitcoin as $btc) {
            mysqli_query($conexion,"LOAD DATA LOCAL INFILE '../historial/bitcoin/historialBitcoin.csv' INTO TABLE historial_criptomoneda FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n';");
        }
        */
        //obtener la primera fila, en este caso no debe tener ninguna
        $consulta = mysqli_query($conexion,"SELECT COUNT(*) AS total FROM criptomoneda");
        $row = mysqli_fetch_assoc($consulta);

        //comparar con el alias total de la consulta para insertar o actualizar
        if($row['total'] == '0' || $row['total'] < '4'){
            //reiniciar el ID para que empiece por el 1
            mysqli_query($conexion,"ALTER TABLE criptomoneda AUTO_INCREMENT = 1");
            //insertar los valores de la API sino actualizar-los
            foreach ($bitcoin as $btc) {
                mysqli_query($conexion,"INSERT INTO criptomoneda (nombre,ranking,volumen_24h,capital_mercado_dolar,total_circulacion,porcentaje_1h,porcentaje_24h,porcentaje_7d,precio_btc,fecha) 
                VALUES ('".$btc['name']."','".$btc['rank']."','".$btc['24h_volume_usd']."','".$btc['market_cap_usd']."','".$btc['total_supply']."','".$btc['percent_change_1h']."','".$btc['percent_change_24h']."','".$btc['percent_change_7d']."','".$btc['price_btc']."','".$fecha."')");
            }
        }else{
            foreach ($bitcoin as $btc) {
                mysqli_query($conexion,"UPDATE criptomoneda SET ranking = ('".$btc['rank']."') WHERE nombre = '".$btc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET volumen_24h = ('".$btc['24h_volume_usd']."') WHERE nombre = '".$btc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET capital_mercado_dolar = ('".$btc['market_cap_usd']."') WHERE nombre = '".$btc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET total_circulacion = ('".$btc['total_supply']."') WHERE nombre = '".$btc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET porcentaje_1h = ('".$btc['percent_change_1h']."') WHERE nombre = '".$btc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET porcentaje_24h = ('".$btc['percent_change_24h']."') WHERE nombre = '".$btc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET porcentaje_7d = ('".$btc['percent_change_7d']."') WHERE nombre = '".$btc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET precio_btc = ('".$btc['price_btc']."') WHERE nombre = '".$btc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET fecha = ('".$fecha."') WHERE nombre = '".$btc['name']."'");
            }
        }
        //insertar historial cada X tiempo
        foreach ($bitcoin as $btc) {
            mysqli_query($conexion,"INSERT INTO historial_criptomoneda (id_criptomoneda,precio_dolar,fecha)
            SELECT id_criptomoneda,'".$btc['price_usd']."','".$fecha."' FROM criptomoneda WHERE nombre = '".$btc['name']."'");        
        }
        //cerrar conexion
        mysqli_close($conexion);
    }

    function insertEthereum(){
        $server = "localhost";
        $user = "root";
        $pass = "";
        $bd = "c4a";
    
        //Creamos la conexión
        $conexion = mysqli_connect($server, $user, $pass, $bd) 
        or die("Ha sucedido un error inexperado en la conexion de la base de datos");
        //Insertar nombre y volumen Bitcoin JSON
        $json = file_get_contents('../datosAPI/ethereum.json');//leemos los datos del json
        $ethereum = json_decode($json, true);//decodificamos los datos
        $fecha = strftime( "%Y-%m-%d-%H-%M-%S", time() );//creamos la fecha para la BD
        
        $consulta = mysqli_query($conexion,"SELECT COUNT(*) AS total FROM criptomoneda");
        // obtenemos la primera fila, en este caso solo tendremos una
        $row = mysqli_fetch_assoc($consulta);

        // comparamos con el alias total que dimos en la consulta
        if($row['total'] == '0' || $row['total'] < '4'){
            foreach ($ethereum as $eth) {
                mysqli_query($conexion,"INSERT INTO criptomoneda (nombre,ranking,volumen_24h,capital_mercado_dolar,total_circulacion,porcentaje_1h,porcentaje_24h,porcentaje_7d,precio_btc,fecha) 
                VALUES ('".$eth['name']."','".$eth['rank']."','".$eth['24h_volume_usd']."','".$eth['market_cap_usd']."','".$eth['total_supply']."','".$eth['percent_change_1h']."','".$eth['percent_change_24h']."','".$eth['percent_change_7d']."','".$eth['price_btc']."','".$fecha."')");
            }
        }else{
            foreach ($ethereum as $eth) {
                mysqli_query($conexion,"UPDATE criptomoneda SET ranking = ('".$eth['rank']."') WHERE nombre = '".$eth['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET volumen_24h = ('".$eth['24h_volume_usd']."') WHERE nombre = '".$eth['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET capital_mercado_dolar = ('".$eth['market_cap_usd']."') WHERE nombre = '".$eth['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET total_circulacion = ('".$eth['total_supply']."') WHERE nombre = '".$eth['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET porcentaje_1h = ('".$eth['percent_change_1h']."') WHERE nombre = '".$eth['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET porcentaje_24h = ('".$eth['percent_change_24h']."') WHERE nombre = '".$eth['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET porcentaje_7d = ('".$eth['percent_change_7d']."') WHERE nombre = '".$eth['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET precio_btc = ('".$eth['price_btc']."') WHERE nombre = '".$eth['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET fecha = ('".$fecha."') WHERE nombre = '".$eth['name']."'");
            }
        }
        foreach ($ethereum as $eth) {
            mysqli_query($conexion,"INSERT INTO historial_criptomoneda (id_criptomoneda,precio_dolar,fecha)
            SELECT id_criptomoneda,'".$eth['price_usd']."','".$fecha."' FROM criptomoneda WHERE nombre = '".$eth['name']."'");        
        }
        mysqli_close($conexion);
    }

    function insertLitecoin(){
        $server = "localhost";
        $user = "root";
        $pass = "";
        $bd = "c4a";
    
        //Creamos la conexión
        $conexion = mysqli_connect($server, $user, $pass, $bd) 
        or die("Ha sucedido un error inexperado en la conexion de la base de datos");
        //Insertar nombre y volumen Bitcoin JSON
        $json = file_get_contents('../datosAPI/litecoin.json');//leemos los datos del json
        $litecoin = json_decode($json, true);//decodificamos los datos
        $fecha = strftime( "%Y-%m-%d-%H-%M-%S", time() );//creamos la fecha para la BD

        // obtenemos la primera fila, en este caso solo tendremos una
        $consulta = mysqli_query($conexion,"SELECT COUNT(*) AS total FROM criptomoneda");
        $row = mysqli_fetch_assoc($consulta);

        // comparamos con el alias total que dimos en la consulta
        if($row['total'] == '0' || $row['total'] < '4'){
            foreach ($litecoin as $ltc) {
                mysqli_query($conexion,"INSERT INTO criptomoneda (nombre,ranking,volumen_24h,capital_mercado_dolar,total_circulacion,porcentaje_1h,porcentaje_24h,porcentaje_7d,precio_btc,fecha) 
                VALUES ('".$ltc['name']."','".$ltc['rank']."','".$ltc['24h_volume_usd']."','".$ltc['market_cap_usd']."','".$ltc['total_supply']."','".$ltc['percent_change_1h']."','".$ltc['percent_change_24h']."','".$ltc['percent_change_7d']."','".$ltc['price_btc']."','".$fecha."')");
            }
        }else{
            foreach ($litecoin as $ltc) {
                mysqli_query($conexion,"UPDATE criptomoneda SET ranking = ('".$ltc['rank']."') WHERE nombre = '".$ltc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET volumen_24h = ('".$ltc['24h_volume_usd']."') WHERE nombre = '".$ltc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET capital_mercado_dolar = ('".$ltc['market_cap_usd']."') WHERE nombre = '".$ltc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET total_circulacion = ('".$ltc['total_supply']."') WHERE nombre = '".$ltc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET porcentaje_1h = ('".$ltc['percent_change_1h']."') WHERE nombre = '".$ltc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET porcentaje_24h = ('".$ltc['percent_change_24h']."') WHERE nombre = '".$ltc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET porcentaje_7d = ('".$ltc['percent_change_7d']."') WHERE nombre = '".$ltc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET precio_btc = ('".$ltc['price_btc']."') WHERE nombre = '".$ltc['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET fecha = ('".$fecha."') WHERE nombre = '".$ltc['name']."'");
            }
        }
        foreach ($litecoin as $ltc) {
            mysqli_query($conexion,"INSERT INTO historial_criptomoneda (id_criptomoneda,precio_dolar,fecha)
            SELECT id_criptomoneda,'".$ltc['price_usd']."','".$fecha."' FROM criptomoneda WHERE nombre = '".$ltc['name']."'");        
        }
        mysqli_close($conexion);
    }

    function insertBitconCash(){

        $server = "localhost";
        $user = "root";
        $pass = "";
        $bd = "c4a";
    
        //Creamos la conexión
        $conexion = mysqli_connect($server, $user, $pass, $bd) 
        or die("Ha sucedido un error inexperado en la conexion de la base de datos");

        mysqli_query($conexion,"LOAD DATA INFILE '../historial/bitcoin/historialBitcoinCash.csv' INTO TABLE 'criptomoneda' FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' IGNORE 1 ROWS;");

        //Insertar nombre y volumen Bitcoin JSON
        $json = file_get_contents('../datosAPI/bitcoinCash.json');//leemos los datos del json
        $bitcoinCash = json_decode($json, true);//decodificamos los datos
        $fecha = strftime( "%Y-%m-%d-%H-%M-%S", time() );//creamos la fecha para la BD
        
        $consulta = mysqli_query($conexion,"SELECT COUNT(*) AS total FROM criptomoneda");
        // obtenemos la primera fila, en este caso solo tendremos una
        $row = mysqli_fetch_assoc($consulta);

        // comparamos con el alias total que dimos en la consulta
        if($row['total'] == '0' || $row['total'] < '4'){
            foreach ($bitcoinCash as $bch) {
                mysqli_query($conexion,"INSERT INTO criptomoneda (nombre,ranking,volumen_24h,capital_mercado_dolar,total_circulacion,porcentaje_1h,porcentaje_24h,porcentaje_7d,precio_btc,fecha) 
                VALUES ('".$bch['name']."','".$bch['rank']."','".$bch['24h_volume_usd']."','".$bch['market_cap_usd']."','".$bch['total_supply']."','".$bch['percent_change_1h']."','".$bch['percent_change_24h']."','".$bch['percent_change_7d']."','".$bch['price_btc']."','".$fecha."')");
            }
        }else{
            foreach ($bitcoinCash as $bch) {
                mysqli_query($conexion,"UPDATE criptomoneda SET ranking = ('".$bch['rank']."') WHERE nombre = '".$bch['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET volumen_24h = ('".$bch['24h_volume_usd']."') WHERE nombre = '".$bch['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET capital_mercado_dolar = ('".$bch['market_cap_usd']."') WHERE nombre = '".$bch['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET total_circulacion = ('".$bch['total_supply']."') WHERE nombre = '".$bch['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET porcentaje_1h = ('".$bch['percent_change_1h']."') WHERE nombre = '".$bch['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET porcentaje_24h = ('".$bch['percent_change_24h']."') WHERE nombre = '".$bch['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET porcentaje_7d = ('".$bch['percent_change_7d']."') WHERE nombre = '".$bch['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET precio_btc = ('".$bch['price_btc']."') WHERE nombre = '".$bch['name']."'");
                mysqli_query($conexion,"UPDATE criptomoneda SET fecha = ('".$fecha."') WHERE nombre = '".$bch['name']."'");
            }
        }
        foreach ($bitcoinCash as $bch) {
            mysqli_query($conexion,"INSERT INTO historial_criptomoneda (id_criptomoneda,precio_dolar,fecha)
            SELECT id_criptomoneda,'".$bch['price_usd']."','".$fecha."' FROM criptomoneda WHERE nombre = '".$bch['name']."'");        
        }
        mysqli_close($conexion);
    }

?>