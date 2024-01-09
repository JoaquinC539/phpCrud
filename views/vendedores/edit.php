
<title>Vendedores</title>

<body class="dark">
    <?php $queryData=$queryData[0]?>
    <div class="card w-100">
        <div class="card-title text-center mb-2">
            Vendedores
        </div>
        <div class="card-subtitle mb-2 text-body-secondary text-center">
            Edit
        </div>
        <div class="card-subtitle">
            <div class="d-flex justify-content-center">
                <a href="/vendedor" class="btn btn-primary" type="button">Ir a pagina principal</a>
            </div>
        </div>
        <br>
        <div class="row message-container" hidden>
            <div class="d-flex justify-content-center">
                <div class="col-12 bg-info message"></div>
            </div>
            
        </div>
        <br>
        <div class="card-subtitle">
            <form class="form" id="vendedores_edit" >
                <div class="row">
                        <div class="col-6 col-md-4 form-box">
                            <input class="form-control " type="number" placeholder="ID" name="_id" aria-label="nombre" value="<?php echo $id?>" disabled>
                        </div>
                        <div class="col-6 col-md-4 form-box">
                            <input class="form-control " type="text" placeholder="Nombre" name="nombre" aria-label="nombre" value="<?php echo $queryData['nombre']; ?>" required>
                        </div>
                        <div class="col-6 col-md-4 form-box">
                            <input class="form-control " type="text" placeholder="Apellido" name="apellido" aria-label="apellido" value="<?php echo $queryData['apellido']; ?>" required>
                        </div>
                        <div class="col-6 col-md-4 form-box">
                            <input class="form-control " type="number" placeholder="Edad" name="edad" aria-label="edad" value="<?php echo $queryData['edad']; ?>" required>
                        </div>
                        <div class="col-6 col-md-4 form-box">
                            <input class="form-control " type="email" placeholder="Email" name="correo_electronico" aria-label="email" value="<?php echo $queryData['correo_electronico']; ?>" required>
                        </div>

                </div>
                
            <br>
            <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Editar vendedor">
        </form>
        </div>

        
    </div>

<script type="module" >
    'use strict';
import { put } from "/scripts/functions/functions.js";
window.submitPost=(e)=>{
    e.preventDefault();
    const form=document.querySelector("#vendedores_edit");
    const formData=new FormData(form);
    const formObject = Object.fromEntries(formData.entries());
    put("/vendedor?_id=<?php echo $id?>",formObject)
    .then((response) => {response.json()})
    .then((result)=>{
        console.log(result);
        document.querySelector(".message").textContent="Vendedor editado exitosamente";
    }).catch((err) => {
        document.querySelector(".message").textContent=err;
    });
    document.querySelector(".message-container").removeAttribute("hidden");
}

document.addEventListener("DOMContentLoaded",(event)=>{
    const form=document.querySelector("#vendedores_edit");
    form.addEventListener("submit",window.submitPost)
})
</script>

</body>

