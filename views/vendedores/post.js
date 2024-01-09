'use strict';
import { post } from "/scripts/functions/functions.js";
window.submitPost=(e)=>{
    e.preventDefault();
    const form=document.querySelector("#vendedores_post");
    const formData=new FormData(form);
    const formObject = Object.fromEntries(formData.entries());
    post("/vendedor",formObject)
    .then((response) => {response.json()})
    .then((result)=>{
        document.querySelector(".message").textContent="Vendedor registrado exitosamente";
    }).catch((err) => {
        document.querySelector(".message").textContent=err;
    });
    document.querySelector(".message-container").removeAttribute("hidden");
    
    
}

document.addEventListener("DOMContentLoaded",(event)=>{
    const form=document.querySelector("#vendedores_post");
    form.addEventListener("submit",window.submitPost)
})