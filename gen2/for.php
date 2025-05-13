<?php
//ARCHIVO ACTUALIZADO 2 ENERO 2025
// Establecer el directorio raíz de tu aplicación
$rootDir = '/home/movie.angelcampos.xyz/public_html/testgen/gen2/';

// Función para listar archivos y su contenido
function listFilesAndContents($dir) {
    $files = scandir($dir);
    $output = ""; // Variable para almacenar el contenido a copiar
    $copyOutput = ""; // Inicializamos sin texto adicional

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue; // Ignorar directorios especiales
        }
        
        $filePath = "$dir/$file";

        // Excluir la carpeta "vendor"
        if (is_dir($filePath) && basename($filePath) === 'vendor') {
            continue; // Ignorar la carpeta 'vendor' y su contenido
        }

        if (is_dir($filePath)) {
            // Si es un directorio, llamarse a sí mismo recursivamente
            $result = listFilesAndContents($filePath);
            $output .= $result['output'];
            $copyOutput .= $result['copyOutput'];
        } else {
            // Verificar si el archivo es .php o .html
            if (pathinfo($file, PATHINFO_EXTENSION) === 'php' || pathinfo($file, PATHINFO_EXTENSION) === 'html') {
                // Leer el contenido del archivo
                $content = file_get_contents($filePath);
                $output .= "<h3>ESTE ES MI \"$file\"</h3>";
                $output .= "<pre>" . htmlspecialchars($content) . "</pre>";
                // Mostrar la ruta del archivo
                $output .= "<p><strong>Ruta:</strong> $filePath</p>";
                
                // Agregar al texto a copiar con un formato más claro
                $copyOutput .= "ESTE ES MI \"$file\"\n" . htmlspecialchars($content) . "\nRuta: $filePath

";
            }
        }
    }

    return ['output' => $output, 'copyOutput' => $copyOutput]; // Devolver el contenido generado
}

// Iniciar la lista de archivos desde el directorio raíz
$fileList = listFilesAndContents($rootDir);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Archivos y Contenidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h3 {
            color: #4CAF50;
        }
        pre {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            overflow-x: auto;
        }
        .input-container {
            margin: 20px 0;
        }
    </style>
    <script>
        function copyText() {
            const inputField = document.getElementById("textInput");
            inputField.select();
            document.execCommand("copy");
            alert("Texto copiado: " + inputField.value);
        }
    </script>
</head>
<body>
    <h1>Listado de Archivos y Contenidos</h1>
    <div class="input-container">
        <label for="additionalText">Texto adicional antes del contenido:</label>
        <input type="text" id="additionalText" value="" placeholder="Escribe aquí tu texto adicional">
    </div>
    <div class="input-container">
        <input type="text" id="textInput" value="<?php echo htmlspecialchars($fileList['copyOutput']); ?>" readonly>
        <button onclick="copyText()">Copiar Texto</button>
    </div>
    <div>
        <?php
            // Mostrar archivos y contenido
            echo $fileList['output'];
        ?>
    </div>

    <script>
        // Actualiza el campo de texto copiado con el texto adicional
        document.getElementById('additionalText').addEventListener('input', function() {
            const additionalText = this.value;
            const currentOutput = "<?php echo addslashes($fileList['copyOutput']); ?>";
            const finalOutput = additionalText + '\n' + currentOutput;
            document.getElementById('textInput').value = finalOutput;
        });
    </script>
</body>
</html>
