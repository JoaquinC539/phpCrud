"use strict";
import { index,tableBuilder,getTemplate,del } from "/scripts/functions/functions.js";

async function getTableAndBuild(params={max:100,offset:0}){
    document.getElementById("app-table").innerHTML="";
    const data =await index("/vendedor",params);
    const headerTemplate=await getTemplate("tableHeader.html");
    const rowTemplate=await getTemplate("vendedorRow.html");
    document.getElementById("app-table").innerHTML=tableBuilder(data,headerTemplate,rowTemplate,"vendedor",true);
    const deleteButtons=document.querySelectorAll(".vendedores_delete");
    deleteButtons.forEach((deleteButton)=>{
        deleteButton.addEventListener("click",(event)=>{
            window.deleteRow(event,deleteButton)
        });
    })
}
getTableAndBuild();

window.filterTable=(e)=>{
    e.preventDefault();
    const form=document.querySelector('#vendedores_filter');
    const formData=new FormData(form);
    const formObject = Object.fromEntries(formData.entries());
    getTableAndBuild(formObject)
    
}
window.deleteRow=(e,element)=>{
    e.preventDefault();
    const idVendedor=element.getAttribute("data-id");
    del("/vendedor?_id="+idVendedor)
    .then((response)=>response.json())
    .then((result) => {
        getTableAndBuild();
    })
    .catch((err) => {
        
    });
}
document.addEventListener("DOMContentLoaded",(event)=>{
    const form=document.querySelector('#vendedores_filter');
    form.addEventListener('submit',window.filterTable);
    

});





