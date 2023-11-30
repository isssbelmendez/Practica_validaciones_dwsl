<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios</title>
    <style>
        body {
            margin: 0 auto;
            max-width: 800px;
            font-family: Arial, sans-serif;
        }
        form {
            margin: 40px auto;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="email"] {
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 300;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Validación del campo nombre
            if (empty($_POST["nombre"])) {
                $nombre_error = "El nombre es obligatorio";
            } else {
                $nombre = test_input($_POST["nombre"]);
                if(!preg_match("/^[MmOoPpSs]/", $nombre)) {
                    $nombre_error = "El nombre debe iniciar con M, O, P o S";
                }
            }

            // Validación del campo dirección
            if (empty($_POST["direccion"])) {
                $direccion_error = "La dirección es obligatoria";
            } else {
                $direccion = test_input($_POST["direccion"]);
                if(!preg_match("/^(casa|apartamento)/i", $direccion)) {
                    $direccion_error = "La dirección debe iniciar con casa o apartamento";
                }
            }

            // Validación del campo correo
            if (empty($_POST["correo"])) {
                $correo_error = "El correo es obligatorio";
            } else {
                $correo = test_input($_POST["correo"]);
                if(!preg_match("/gmail\.com$/", $correo)) {
                    $correo_error = "El correo debe terminar en gmail.com";
                }
            }

            // Validación del campo texto
            if (empty($_POST["texto"])) {
                $texto_error = "El texto es obligatorio";
            } else {
                $texto = test_input($_POST["texto"]);
                $palabras = explode(" ", $texto);
                $contPalabras = 0;
                foreach ($palabras as $palabra) {
                    if(preg_match("/as$/i", $palabra)) {
                        $contPalabras++;
                    }
                }
            }

            // Validación del campo teléfono
            if (empty($_POST["telefono"])) {
                $telefono_error = "El teléfono es obligatorio";
            } else {
                $telefono = test_input($_POST["telefono"]);
                if(preg_match("/^2/", $telefono)) {
                    $tipo_telefono = "teléfono de casa";
                } elseif(preg_match("/^7/", $telefono)) {
                    $tipo_telefono = "teléfono celular";
                } else {
                    $telefono_error = "El teléfono debe iniciar con 2 (casa) o 7 (celular)";
                }
            }

            // Validación del campo compañía
            if (empty($_POST["compania"])) {
                $compania_error = "La compañía es obligatoria";
            } else {
                $compania = test_input($_POST["compania"]);
                if(preg_match("/^79|^72/", $compania)) {
                    $compania_telefono = "Tigo";
                } elseif(preg_match("/^77|^75/", $compania)) {
                    $compania_telefono = "Movistar";
                } elseif(preg_match("/^71|^73/", $compania)) {
                    $compania_telefono = "Digicel";
                } else {
                    $compania_error = "No se pudo determinar la compañía del teléfono";
                }
            }

            // Validación del campo género
            if (empty($_POST["genero"])) {
                $genero_error = "El género es obligatorio";
            } else {
                $genero = test_input($_POST["genero"]);
                if(preg_match("/^[1-2]$/", $genero)) {
                    $patron_genero = ($genero == "1") ? "Masculino" : "Femenino";
                } else {
                    $genero_error = "El patrón de género debe ser 1 (Masculino) o 2 (Femenino)";
                }
            }
        }

        // Función para limpiar y validar la entrada de datos
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nombre">Digite un nombre y evalúe si inicia con M, O, P ó S</label> <br>
        <input type="text" id="nombre" name="nombre"<?php if(isset($_POST['nombre'])) { echo ' value="'.$_POST['nombre'].'"'; } ?>> <br>
        <span class="error"><?php if(isset($nombre_error)) { echo $nombre_error; } ?></span>
        <hr>

        <label for="direccion">Digite una dirección e identifique si existe la palabra casa o apartamento al inicio de la cadena</label> <br>
        <input type="text" id="direccion" name="direccion"<?php if(isset($_POST['direccion'])) { echo ' value="'.$_POST['direccion'].'"'; } ?>> <br>
        <span class="error"><?php if(isset($direccion_error)) { echo $direccion_error; } ?></span>
        <hr>

        <label for="correo">Identifique al final de la cadena si el correo escrito es gmail.com</label> <br>
        <input type="email" id="correo" name="correo"<?php if(isset($_POST['correo'])) { echo ' value="'.$_POST['correo'].'"'; } ?>> <br>
        <span class="error"><?php if(isset($correo_error)) { echo $correo_error; } ?></span>
        <hr>

        <label for="texto">Escriba un texto cualquiera e identifique cuántas palabras finalizan con "as"</label> <br>
        <input type="text" id="texto" name="texto"<?php if(isset($_POST['texto'])) { echo ' value="'.$_POST['texto'].'"'; } ?>> <br>
        <span class="error"><?php if(isset($texto_error)) { echo $texto_error; } ?></span> <br>
        <span><?php if(isset($contPalabras)) { echo "Hay ".$contPalabras." palabras que finalizan en 'as'"; } ?></span>
        <hr>

        <label for="telefono">Identificar si el número de teléfono es de casa iniciando con 2 o celular iniciando con 7</label> <br>
        <input type="text" id="telefono" name="telefono"<?php if(isset($_POST['telefono'])) { echo ' value="'.$_POST['telefono'].'"'; } ?>> <br>
        <span class="error"><?php if(isset($telefono_error)) { echo $telefono_error; } ?></span> <br>
        <span><?php if(isset($tipo_telefono)) { echo "El número ingresado corresponde a un ".$tipo_telefono; } ?></span>
        <hr>

        <label for="compania">Identificar la compañía de celular suponiendo que 79 ó 72 es Tigo, 77 ó 75 es Movistar y 71 ó 73 es Digicel</label> <br>
        <input type="text" id="compania" name="compania"<?php if(isset($_POST['compania'])) { echo ' value="'.$_POST['compania'].'"'; } ?>> <br>
        <span class="error"><?php if(isset($compania_error)) { echo $compania_error; } ?></span> <br>
        <span><?php if(isset($compania_telefono)) { echo "El número corresponde a la compañía ".$compania_telefono; } ?></span>
        <hr>

        <label for="genero">Identificar el patrón de género digitado en mayúsculas o minúsculas, masculino = 1, femenino = 2</label> <br>
        <input type="text" id="genero" name="genero"<?php if(isset($_POST['genero'])) { echo ' value="'.$_POST['genero'].'"'; } ?>> <br>
        <span class="error"><?php if(isset($genero_error)) { echo $genero_error; } ?></span> <br>
        <span><?php if(isset($patron_genero)) { echo "El patrón de género digitado es ".$patron_genero; } ?></span>
        <hr>

        <input type="submit" value="EVALUAR">
    </form>
</body>
</html>

