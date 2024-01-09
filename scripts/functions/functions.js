"use strict";
export const index=async (endpoint,params={max:15,offset:0})=>{
    if(!params["max"] ){
        params["max"]=15;
    }
    if(!params["offset"]){
        params["offset"]=0;
    }
    let response=(await getData(endpoint,params));
    let data=await response.json()
    return data;
}
export const getData=(endpoint,params={})=>{
    let paramsGetData=new URLSearchParams(params);
    return fetch(endpoint+"?"+paramsGetData,{
        method:"GET",
        headers:{
            "Content-Type":"application/json"
        }
    });
}
export const tableBuilder=(data,headerTemplate,rowTemplate,link,action=false)=>{
    const colTemplate=Handlebars.compile(headerTemplate);
    const dataTemplate=Handlebars.compile(rowTemplate);
    const headers={cols:Object.keys(data["results"][0])};
    if(action){
        headers.cols.unshift("Acciones");
    }
    let table="";
    table+=colTemplate(headers);
    let rows={}
    rows={data:data["results"],action:action};
    table+=dataTemplate(rows);
    return table;
}

export const getTemplate=async (fileName)=>{
    const fetchPromise=await fetch("/template?file="+fileName,{
        headers:{
            "Content-Type":"application/template"
        }
    });
    const template=await fetchPromise.text();
    return template;
}
export const sayHello=()=>{
    return "Hello!";
}

export function post(endpoint,data){
    try {
        const response=fetch(endpoint,{
            method:"POST",
            headers:{
                "Content-Type":"application/json"
            },
            body:JSON.stringify(data)
        })
        return response;
    } catch (error) {
        return new Promise((resolve,reject)=>{
            reject(error);
        })
    }
}
export function put(endpoint,data){
    try {
        const response=fetch(endpoint,{
            method:"PUT",
            headers:{
                "Content-Type":"application/json"
            },
            body:JSON.stringify(data)
        })
        return response;
    } catch (error) {
        return new Promise((resolve,reject)=>{
            reject(error);
        })
    }
}
export async function del(endpoint){
        try {
           const request= fetch(endpoint,{
                method:"DELETE",
                headers:{
                    "Content-Type":"application/json"
                }
            })
            return request;
        } catch (error) {
            return new Promise((resolve,reject)=>{
                reject(error);
            })
        }
}