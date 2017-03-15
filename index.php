<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>
            Добавление Huawei ONT
        </title> 
        <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    </head>
    Активация Huawei ONT
  
    <form method="get" action="out.php">
        MA5600T АТС-41 &nbsp;&nbsp;&nbsp;&nbsp;<input name="r_button" type="radio" value="olt41"><input type="button" value="Найти новые ONT" onclick="location.href='express.php?pse=41'"><br>
        МА5603T ПСЭ-422 &nbsp;<input name="r_button" type="radio" value="olt422" ><input type="button" value="Найти новые ONT" onclick="location.href='express.php?pse=422'"><br>
        MA5603T ПСЭ-420 <input name="r_button" type="radio" value="olt420"> <input type="button" value ="Найти новые ONT" onclick="location.href='express.php?pse=420'"><br>
        MA5603T ПСЭ-467 <input name="r_button" type="radio" value="olt467"> <input type="button" value ="Найти новые ONT" onclick="location.href='express.php?pse=467'"><br>        
        MA5603T ПСЭ-261 <input name="r_button" type="radio" value="olt261"> <input type="button" value ="Найти новые ONT" onclick="location.href='express.php?pse=261'"><br>
        MA5603T ПСЭ-43 <input name="r_button" type="radio" value="olt43"> <input type="button" value ="Найти новые ONT" onclick="location.href='express.php?pse=43'"><br>
        MA5603T Гусинка <input name="r_button" type="radio" value="oltgusinka"> <input type="button" value ="Найти новые ONT" onclick="location.href='express.php?pse=gusinka'"><br>
        <table border="1"> 
            <tr>
                <td>Карта (слот) №</td><td><input type="text" name="slot"> Пример: 2</td>
            </tr>
        	<td>Порт №</td><td><input type="text" name="port"> Пример: 1</td>
            <tr>
                <td>Фамилия латинскими буквами</td><td><input type="text" name="fio"> Пример: Zambalova</td>
            </tr>
            <tr>
                <td>Номер линии (ONT Authentification) - 10 цифр</td><td><input type="text" name="pass" maxlength="10" value="30175"> Пример: 3017501234</td>
            </tr>
            <tr>
                <td>Абонент IPTV</td><td><input type="checkbox" name ="iptv" value="checked">(Ометить если есть IPTV)</td>
        </table>
        <input type="submit" name="fire" value="Забить">
    </form>


</html>
