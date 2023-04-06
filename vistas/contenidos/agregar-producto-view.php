<?php
if ($_SESSION['privilegio_SDR'] == 0) {
    echo $inst_loginControlador->forzar_cierre_sesion_controlador();
    exit();
}

if ($peticionAjax) {
    require_once "../modelos/reservasModelo.php";
} else {
    require_once "./modelos/reservasModelo.php";
}

require 'config/database.php';

$nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image = "";

if (!empty($_POST)) {
    $name               = checkInput($_POST['name']);
    $description        = checkInput($_POST['description']);
    $price              = checkInput($_POST['price']);
    $category           = checkInput($_POST['category']);
    $image              = checkInput($_FILES["image"]["name"]);
    $imagePath          = "images" . basename($image);
    $imageExtension     = PATHINFO($imagePath, PATHINFO_EXTENSION);
    $isSuccess          = true;
    $isUploadSuccess    = false;

    if (empty($name)) {
        $nameError = 'Este campo no puede estar vacío';
        $isSuccess = false;
    }
    if (empty($description)) {
        $descriptionError = 'Este campo no puede estar vacío';
        $isSuccess = false;
    }
    if (empty($price)) {
        $priceError = 'Este campo no puede estar vacío';
        $isSuccess = false;
    }
    if (empty($category)) {
        $categoryError = 'Este campo no puede estar vacío';
        $isSuccess = false;
    }
    if (empty($image)) {
        $imageError = 'Este campo no puede estar vacío';
        $isSuccess = false;
    } else {
        $isUploadSuccess = true;
        if ($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif") {
            $imageError = "Los archivos permitidos son: .jpg, .jpeg, .png, .gif";
            $isUploadSuccess = false;
        }
        if (file_exists($imagePath)) {
            $imageError = "El archivo ya existe";
            $isUploadSuccess = false;
        }
        if ($_FILES["image"]["size"] > 500000) {
            $imageError = "El archivo no debe exceder el 500 KB";
            $isUploadSuccess = false;
        }
        if ($isUploadSuccess) {
            if (!copy($_FILES["image"]["tmp_name"], $imagePath)) {
                $imageError = "Se ha producido un error al subir el archivo";
                $isUploadSuccess = false;
            }
        }
    }

    if ($isSuccess && $isUploadSuccess) {
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO items (name,description,price,image,category) values(?, ?, ?, ?, ?)");
        $statement->execute(array($name, $description, $price, $image,$category));
        echo "<script>alert('Producto agregado al Sistema');</script>";
        Database::disconnect();
        
    }
}

function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<div class="container-fluid">
    <div class="row">
        <div class="container-fluid">
            <h1 class="text-center text-logo"><strong>Agregar producto</strong></h1>
            <br>
            <form class="form" action="<?php echo SERVERURL; ?>agregar-producto/" role="form" method="post" enctype="multipart/form-data">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="<?php echo $name; ?>">
                        <span class="help-inline"><?php echo $nameError; ?></span>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Descripción" value="<?php echo $description; ?>">
                        <span class="help-inline"><?php echo $descriptionError; ?></span>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="price">Precio: (CLP)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Precio" value="<?php echo $price; ?>">
                        <span class="help-inline"><?php echo $priceError; ?></span>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="category">Categoría:</label>
                        <select class="form-control" id="category" name="category">
                            <?php
                            $db = Database::connect();
                            foreach ($db->query('SELECT * FROM categories') as $row) {
                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';;
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <span class="help-inline"><?php echo $categoryError; ?></span>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="image">Selecciona una imagen:</label>
                        <input type="file" id="image" name="image">
                        <span class="help-inline"><?php echo $imageError; ?></span>
                    </div>
                </div>
                <br>
                <div class="col-12 col-md-4">
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Agregar</button>
                        <a class="btn btn-primary" href="<?php echo SERVERURL; ?>home-trabajador"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>