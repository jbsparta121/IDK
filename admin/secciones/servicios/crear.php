<?php 
include("../../bd.php");
if($_POST) {

    $icono = (isset($_POST['icono']))?$_POST['icono']:"";
    $titulo = (isset($_POST['titulo']))?$_POST['titulo']:"";
    $descripcion = (isset($_POST['descripcion']))?$_POST['descripcion']:"";

    $sentencia = $conexion->prepare("INSERT INTO `tbl_servicios` (`id`, `icono`, `titulo`, `descripcion`) VALUES (NULL, :icono, :titulo, :descripcion);");

    $sentencia->bindParam(":icono",$icono);
    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":descripcion",$descripcion);

    $sentencia->execute();
    $mensaje = "Registro agregado con éxito.";
    header("Location:index.php?mensaje=".$mensaje);
}
include("../../templates/header.php"); 

?>

    <div class="card">
        <div class="card-header">Crear servicios</div>
        <div class="card-body">
            <form class="row g-3 needs-validation" enctype="multipart/form-data" method="post" novalidate>
                <div class="mb-3">
                  <label for="icono" class="form-label">Icono:</label>
                  <input type="text" class="form-control" name="icono" id="icono" aria-describedby="helpId" placeholder="Icono" required />
                </div>

                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input
                        type="text"
                        class="form-control"
                        name="titulo"
                        id="titulo"
                        aria-describedby="helpId"
                        placeholder="Título"
                        required
                    />
                    <div class="invalid-feedback">
                        Proporciona una ciudad válida.
                    </div>

                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input
                        type="text"
                        class="form-control"
                        name="descripcion"
                        id="descripcion"
                        aria-describedby="helpId"
                        placeholder="Descripción"
                        required
                    />
                </div>
                
                <button
                    type="submit"
                    class="btn btn-success"
                >
                    Agregar
                </button>
                
                <a
                    name=""
                    id=""
                    class="btn btn-primary"
                    href="index.php"
                    role="button"
                    >Cancelar</a
                >
                
                
            </form>
        </div>
        <div class="card-footer text-muted"></div>
    </div>
    
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'
  
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')
  
        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
              if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
              }
  
              form.classList.add('was-validated')
            }, false)
        })
    })()
    </script>
<?php include("../../templates/footer.php") ?>