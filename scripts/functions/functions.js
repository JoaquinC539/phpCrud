"use strict";
export const index=async (endpoint,max=15,offset=0)=>{
    let response=(await getData(endpoint,max,offset));
    let data=await response.json()
    return data;
}
export const getData=(endpoint,params={})=>{
    const params=new URLSearchParams(params);
    return fetch(endpoint+"?"+params);
}
export const tableBuilder=(data,headerTemplate,rowTemplate)=>{
    const colTemplate=Handlebars.compile(headerTemplate);
    const dataTemplate=Handlebars.compile(rowTemplate);
    const headers={cols:Object.keys(data[0])};
    let table="";
    table+=colTemplate(headers);
    const rows={data:data}
    table+=dataTemplate(rows);
    return table;
}

export const getTemplate=async (route)=>{
    const fetchPromise=await fetch(route);
    const template=await fetchPromise.text();
    return template;
}