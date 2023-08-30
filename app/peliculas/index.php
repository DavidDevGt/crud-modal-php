<!-- PHP CONNECTION -->
<?php

require '../config/database.php';

$sqlPeliculas = "SELECT p.id, p.nombre, p.descripcion, g.nombre AS genero FROM pelicula AS p INNER JOIN genero AS g ON p.id_genero=g.id";
$peliculas = $conn->query($sqlPeliculas);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP-MYSQL-BOOTSTRAP 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>



    <div class="container py-3"> 
        <h3 class="text-center mt-4">Peliculas</h3>

        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="#" data-bs-toggle="modal" data-bs-target="#nuevoModal" class="btn btn-primary p-2"><i class="fa-solid fa-circle-plus"></i>Nuevo registro</a>
            </div>
        </div>

        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Género</th>
                    <th>Poster</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row_pelicula = $peliculas->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row_pelicula['id']; ?></td>
                    <td><?= $row_pelicula['nombre']; ?></td>
                    <td><?= $row_pelicula['descripcion']; ?></td>
                    <td><?= $row_pelicula['genero']; ?></td>
                    <td></td>
                    <td>
                        
                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-id="<?= $row_pelicula['id']; ?>" data-bs-target="#editarModal"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                        <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> Eliminar</a>

                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- PHP SCRIPTS -->

    <?php
        $sqlGenero = "SELECT id, nombre FROM genero";
        $generos = $conn->query($sqlGenero);
    ?>
    
    <?php include 'nuevoModal.php'; ?>
    <?php $generos->data_seek(0); ?>
    <?php include 'editarModal.php'; ?>

    <!-- JS SCRIPTS -->

    <script type="text/javascript">
        let editarModal = document.getElementById('editarModal')

        editarModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')

            let inputId = editarModal.querySelector('.modal-body #id')
            let inputNombre = editarModal.querySelector('.modal-body #nombre')
            let inputDescripcion = editarModal.querySelector('.modal-body #descripcion')
            let inputGenero = editarModal.querySelector('.modal-body #genero')

            let url = "getPelicula.php"
            let formData = new FormData()
            formData.append('id', id)

            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {

                inputId.value = data.id
                inputNombre.value = data.nombre
                inputDescripcion.value = data.descripcion
                inputGenero.value = data.genero


            }).catch(err => console.log(err))
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>