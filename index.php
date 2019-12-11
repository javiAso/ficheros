<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$ficheroLecturaFalse = fopen("ficherillo.txt", "r");
$ficheroLectura = fopen("ficherico.txt", "r");
while (!feof($ficheroLectura)) {
    $linea .= fgets($ficheroLectura) . "<br>";
}
fclose($ficheroLectura);

$fp = fopen("ficherico.txt", "r");

while ($caracter = fgetc($fp)) {
    if ($caracter == "\n") {
        $lineac .= "<br>";
    }
    $lineac .= "$caracter ";
}
fclose($fp);

$cadena = <<<HEY
<html>
<h1>Perfil de <?php echo "Nombre de usuario";?></h1>
</html>
HEY;

$file = "miArchivo.txt";
file_put_contents($file, $cadena); //Esta funcion, abre, escribe y cierra
$gestor = fopen($file, "r");

while (!feof($gestor)) {
    $buffer .= fgetss($gestor);
}
fclose($gestor);
$ficheroLectura = fopen($file, "r");
while ($caracter = fgetc($ficheroLectura)) {
    if ($caracter == "\n") {
        $buffer2 .= "<br>";
    }
    $buffer2 .= "$caracter ";
}
fclose($ficheroLectura);
$ficheroLectura = fopen($file, "r");
while ($caracter = fgetc($ficheroLectura)) {
    if ($caracter == "\n") {
        $buffer3 .= "<br>";
    }
    $buffer3 .= $caracter;
}
fclose($ficheroLectura);

$array = file("ficherico.txt");
$array2 = file("ficherico.txt", FILE_IGNORE_NEW_LINES);
$array3 = file("ficherico.txt", FILE_SKIP_EMPTY_LINES);

$msj = file_get_contents("ficherico.txt", false, null, 0, 24);
$msj2 = file_get_contents("ficherico.txt");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <h3>Resultado de la lectura (fopen) de ficherillo.txt: <?= $ficheroLecturaFalse ? "true" : "false" ?></h3>
        <span style="color: red">Si no existe el fichero, fopen nos devuelve false.</span>
        <h3>Resultado de la lectura (fopen) de ficherico.txt: <?= $ficheroLectura ? "true" : "false" ?></h3>
        <span style="color: blueviolet">Si existe el fichero, fopen nos devuelve un <b>resource</b>.</span>
        <h4>Ahora muestro aquí abajo el contenido de el fichero con distintos tipos de métodos de lectura:<br />
            RECUERDA QUE AL ABRIR EL ARCHIVO PARA LEER SE SITUA EL PUNTERO AL PPIO DEL MISMO</h4>


        <hr>
        <h5><span style="color: red">fgetc: </span>Obtiene sólo un carácter desde un puntero de un archivo. Devuelve el string con el único carácter. Devuelve false si es EOF.<br>
            Sólo lee un caracter, en alguna situación puede ser útil:</h5>
        <?= "<i>" . $lineac . "</i>" ?>
        <hr>
        <hr>
        <h5><span style="color: red">fgets: </span>Obtiene una línea desde el puntero de un archivo. La lectura termina cuando se llegue a $length, se llegue a una nueva línea o se alcance el final del archivo.<br>
            Por lo tanto parece una buena manera de leer y separar el contenido en saltos de linea:</h5>
        <?= "<i>" . $linea . "</i>" ?>
        <hr>
        <h5><span style="color: red">fgetss: </span>Es igual que fgets() pero elimina cualquier null, etiquetas HTML y PHP del texto. Se puede especificar un parámetro opcional _$allowabletags para especificar etiquetas que se permiten.<br>
        </h5>
        <?= "<i>" . $buffer . "</i>" ?>
        <h5>Esto es lo que hay realmente en el fichero:<br><?= "<i>" . $buffer2 . "</i>" ?>
        </h5>
        <h5>Y esto si lo leyeramos sin fgetss: <br><?= "<i>" . $buffer3 . "</i>" ?>
        </h5>
        <hr>
        <hr>
        <h5><span style="color: red">fread: </span>Lectura de un fichero en modo binario. Se puede incluir un parámetro opcional $length para limitar lo que devuelva..<br>
            En construccion
        </h5>
        <hr>
        <hr>
        <h5><span style="color: red">file_get_contents()</span>Transmite un fichero completo a una cadena. Devuelve un archivo entero a una cadena. <br>
            <?php var_dump($msj2) ?>
        </h5>
        <h5><span style="color: red">file_get_contents()</span>Se puede especificar el comienzo desde $offset hasta $maxlen: <br>
            <?php var_dump($msj) ?>
        </h5>
        <hr>
        <hr>
        <h5><span style="color: red">file: </span>Transfiere un archivo a un array. Función similar a _file_getcontents() pero devuelve los contenidos en un array, donde cada elemento es una línea del archivo.<br>
            <?php var_dump($array) ?>
        </h5>
        <h5><span style="color: red">FILE_IGNORE_NEW_LINES.</span>No se añade una nueva línea al final de cada elemento del array.<br>
            <?php var_dump($array2) ?>
        </h5>
        <h5><span style="color: red">FILE_SKIP_EMPTY_LINES.</span>FILE_SKIP_EMPTY_LINES. Salta las líneas vacías.<br>
            <?php var_dump($array3) ?>
        </h5>
        <hr>


    </body>
</html>
