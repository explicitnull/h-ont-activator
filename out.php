<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>
            Добавление Huawei ONT
        </title>

    </head>
    <?php
    ?>
    <?
    if (empty($_GET['r_button']))
        die("Узел не задан, товарищ!");
    if (!mysql_connect("localhost", "hwadmin", "hwadmin123")) {
        echo "Ошибка подключения к серверу MySQL";
        exit;
    }
//  setting initial  parameters
//    $slot = $_REQUEST['slot'];
//    $port = $_REQUEST['port'];
    $rb = $_GET['r_button'];
    $slot = $_GET['slot'];
    $port = $_GET['port'];
    $fio = $_GET['fio'];
    $pass = $_GET['pass'];
    $iptv = $_GET['iptv'];
    $desc = $fio . "-" . $pass;
    mysql_select_db("huawei");
    $iptv_vlan = 0;
    $mc_vlan = 0;
    // olt 41 section
    if ($rb == "olt41") {
        $addr = "10.131.41.10";
        $svid = 2243;
        $iptv_vlan = 82;
        $mc_vlan = 80;
        $fnm = "/var/www/hw/41/" . $pass;
        $sqlcvid = "select max(cvid) from `olt41`";
        $sql_maxsrvport = "SELECT max(srvport) from `olt41`";
        $sql_maxsrviptv = "SELECT max(iptvsrvport) FROM `olt41`";
        $sqlontid = "SELECT max(ontid) as max_ontid FROM `olt41` WHERE slot=$slot AND port=$port";
    }
    // olt 420 section
    elseif ($rb == "olt420") {
        $addr = "10.131.41.6";
        $svid = 2240;
        $iptv_vlan = 82;
        $mc_vlan = 80;

        $fnm = "/var/www/hw/420/" . $pass;
        $sqlcvid = "select max(cvid) from `olt420`";
        $sql_maxsrvport = "SELECT max(srvport) from `olt420`";
        $sql_maxsrviptv = "SELECT max(iptvsrvport) FROM `olt420`";

        $sqlontid = "SELECT max(ontid) as max_ontid FROM `olt420` WHERE slot=$slot AND port=$port";
    }
    // olt 422 section
    elseif ($rb == "olt422") {
        $addr = "10.131.41.2";
        $svid = 2241;
        $iptv_vlan = 62;
        $mc_vlan = 81;

        $fnm = "/var/www/hw/422/" . $pass;
        //$sql = "INSERT INTO `huawei`.`olt422` (`slot`, `port`, `fio` ,`pass`, `cvid`, `ontid`) VALUES ('{$slot}', '{$port}', '{$fio}', '{$pass}', '{$cvid}', '{$ontid}')";
        $sqlcvid = "select max(cvid) from `olt422`";
        $sql_maxsrvport = "SELECT max(srvport) from `olt422`";
        $sql_maxsrviptv = "SELECT max(iptvsrvport) FROM `olt422`";

        $sqlontid = "SELECT max(ontid) as max_ontid FROM `olt422` WHERE slot=$slot AND port=$port";
    }
    // olt gsn section
    elseif ($rb == "oltgusinka") {
        $addr = "10.131.41.18";
        $svid = 2244;
        $iptv_vlan = 60;
        $mc_vlan = 68;

        $fnm = "/var/www/hw/gusinka/" . $pass;
        $sql_maxsrvport = "SELECT max(srvport) from `oltgusinka`";
        $sql_maxsrviptv = "SELECT max(iptvsrvport) FROM `oltgusinka`";

        $sqlcvid = "select max(cvid) from `oltgusinka`";
        $sqlontid = "SELECT max(ontid) as max_ontid FROM `oltgusinka` WHERE slot=$slot AND port=$port";
    }

    // olt 467 section
    elseif ($rb == "olt467") {
        $addr = "10.131.41.14";
        $svid = 2242;
        $iptv_vlan = 61;
        $mc_vlan = 70;

        $fnm = "/var/www/hw/467/" . $pass;
            $sql_maxsrvport = "SELECT max(srvport) from `olt467`";
        $sql_maxsrviptv = "SELECT max(iptvsrvport) FROM `olt467`";
    
        $sqlcvid = "select max(cvid) from `olt467`";
        $sqlontid = "SELECT max(ontid) as max_ontid FROM `olt467` WHERE slot=$slot AND port=$port";
    }
    // olt 261 section
    elseif ($rb == "olt261") {
        $addr = "10.131.41.26";
        $svid = 2287;
        $iptv_vlan = 69;
        $mc_vlan = 85;

        $fnm = "/var/www/hw/261/" . $pass;
        $sqlcvid = "select max(cvid) from `olt261`";
            $sql_maxsrvport = "SELECT max(srvport) from `olt261`";
        $sql_maxsrviptv = "SELECT max(iptvsrvport) FROM `olt261`";
    
        $sqlontid = "SELECT max(ontid) as max_ontid FROM `olt261` WHERE slot=$slot AND port=$port";
    }
    // olt 43 section
    elseif ($rb == "olt43") {
        $addr = "10.131.41.22";
        $svid = 2286;
        $iptv_vlan = 91;
        $mc_vlan = 80;

        $fnm = "/var/www/hw/43/" . $pass;
        $sqlcvid = "select max(cvid) from `olt43`";
            $sql_maxsrvport = "SELECT max(srvport) from `olt43`";
        $sql_maxsrviptv = "SELECT max(iptvsrvport) FROM `olt43`";
    
        $sqlontid = "SELECT max(ontid) as max_ontid FROM `olt43` WHERE slot=$slot AND port=$port";
    } else {
        echo "Эта OLT еще не поддерживается.<br/>";
        echo $rb;
        die();
    }
//    unset($rb);
    // поиск следующего сервис порта
    $rz = mysql_query($sql_maxsrvport);
    $r = mysql_fetch_array($rz);
    $lastsrv = $r['0'];
    $srv_port = $lastsrv+1;
    // поиск последнего серв порта для ИПТВ 
    $rz = mysql_query($sql_maxsrviptv);
    $r = mysql_fetch_array($rz);
    if ($_GET['iptv'] == "checked") {
        $lastsrv_iptv = $r['0'];
        if ($lastsrv_iptv<9999) $lastsrv_iptv=9999;
        $srv_port_iptv = $lastsrv_iptv+1;
        
    } else {
        $srv_port_iptv = 0;
    }
    // find new ONT VLAN ID:
    $rz = mysql_query($sqlcvid);
    $r = mysql_fetch_array($rz);
    $lastcvid = $r['0'];
    $cvid = $lastcvid + 1;

    // find last ont ID:
    $rz = mysql_query($sqlontid);
    $r = mysql_fetch_array($rz, MYSQL_ASSOC);
    echo "<pre>";
    print_r("ont id=$sqlontid");
    print_r($r);
    echo "</pre>";
    // check if this slot/port is new & find new ONT ID
    if ($r['max_ontid'] < 50) {
        $lastontid = 50;
    } else {
        $lastontid = $r['max_ontid'];
    }
    $ontid = $lastontid + 1;
    echo "<pre><br>max ont id=" . $lastontid;
    echo "<br>";
    echo "new ont id=" . $ontid;
    echo "<br>";
    // start main part
//    if ($_GET['slot'] == '0' || !empty($_GET['slot']) && !empty($_GET['port']) && !empty($_GET['fio']) && !empty($_GET['pass'])) {
    // generating write command
    $sql = "INSERT INTO `huawei`.`$rb` (`slot`, `port`, `fio` ,`pass`, `cvid`,`srvport`,`iptvsrvport`,`desc`, `ontid`) VALUES ('{$slot}', '{$port}', '{$fio}', '{$pass}', '{$cvid}','{$srv_port}','{$srv_port_iptv}','{$desc}', '{$ontid}')";
    echo $sql;
    // writing to database "huawei"
    $rz = mysql_query($sql);
    echo "Подождите...<br>";
    echo "41<br>";
    echo "addr=" . $addr;
    echo "<br>";
    echo "slot=" . $slot;
    echo "<br>";
    echo "port=" . $port;
    echo "<br>";
    echo "fio=" . $fio;
    echo "<br>";
    echo "pass=" . $pass;
    echo "<br>";
    echo "cvid=" . $cvid;
    echo "<br>";
    echo "ontid=" . $ontid;
    echo "<br>";
    echo "svid=" . $svid;
    echo "<br>";
    // execute:
    echo "./ont.pl {$slot} {$port} {$fio} {$pass} {$cvid} {$ontid} {$svid} {$addr} {$srv_port} {$srv_port_iptv} {$desc} {$iptv_vlan} {$mc_vlan} > {$fnm}";
    passthru("./ont.pl {$slot} {$port} {$fio} {$pass} {$cvid} {$ontid} {$svid} {$addr} {$srv_port} {$srv_port_iptv} {$desc} {$iptv_vlan} {$mc_vlan} > {$fnm}");
//    }
//    else {
//	echo "slot=".$slot;echo "<br>";
//	echo "port=".$port;echo "<br>";
//	echo "fio=".$fio;echo "<br>";
//	echo "pass=".$pass;echo "<br>";
//	echo "Параметр не задан.";
//	die();
//    }
    $log = str_replace("\n", "<br>", htmlspecialchars(implode("\n", file("{$fnm}"))));
    echo $log;
    unset($slot);
    unset($port);
    unset($fio);
    unset($pass);
    unset($log);
    unset($ontid);
    unset($sqlontid);
    unset($cvid);
    unset($rb);
    ?> <input type="button" value="Назад" onclick="location.href='index.php?'"><?
    echo "<meta http-equiv=\"Refresh\" content=\"120; URL='index.php?'\"/></pre>";

//}
    /*
     */
    ?>
</html>
