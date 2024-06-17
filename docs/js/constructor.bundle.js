!function(){"use strict";const e=document.querySelectorAll(".material_field__value"),t=document.querySelectorAll(".fixed_size_btn"),n=document.getElementById("yourSizeBtn"),i=document.querySelector(".size_field__control"),l=document.querySelectorAll(".fixed_quantity_btn"),o=document.getElementById("yourQuantityBtn"),a=document.querySelector(".quantity_field__control"),c=document.getElementById("yourQuantityBtn"),r=document.getElementById("yourSizeBtn"),u=document.querySelector(".quantity_field__control"),d=document.querySelector(".size_field__control"),s=document.querySelectorAll(".fixed_size_btn"),_=document.querySelectorAll(".fixed_quantity_btn");document.addEventListener("DOMContentLoaded",(function(){!function(){var e=window.location.pathname;console.log("Current Path:",e);var t=e.substring(e.lastIndexOf("/")+1);console.log("Current Page:",t),document.querySelectorAll(".navbar__links li a").forEach((function(e){e.parentElement.classList.remove("active");var n=e.getAttribute("href"),i=n.substring(n.lastIndexOf("/")+1);console.log("Link Path:",n,"Link Page:",i),i===t&&(e.classList.add("active"),console.log("Active link found:",e))}))}(),function(){const e=document.querySelector(".navbar__toggle_btn"),t=document.querySelector(".dropdown_navbar"),n=document.getElementById("overlay");e.addEventListener("click",(function(){t.classList.toggle("dropdown_navbar_active"),n.style.display=t.classList.contains("dropdown_navbar_active")?"block":"none"})),document.querySelector(".dropdown_navbar__toggle_btn").addEventListener("click",(function(){t.classList.remove("dropdown_navbar_active"),n.style.display="none"}))}(),function(){function c(){e.forEach((e=>e.classList.remove("material_field__value--active"))),this.classList.add("material_field__value--active")}function r(){t.forEach((e=>e.classList.remove("size_field__value--active"))),this.classList.add("size_field__value--active"),i.classList.remove("size_field__control--active"),n.style.display="flex"}function u(){l.forEach((e=>e.classList.remove("quantity_field__value--active"))),this.classList.add("quantity_field__value--active"),a.classList.remove("quantity_field__control--active"),o.style.display="grid"}e.forEach((e=>{e.addEventListener("click",c)})),t.forEach((e=>{e.addEventListener("click",r)})),l.forEach((e=>{e.addEventListener("click",u)}))}(),c.addEventListener("click",(function(){c.style.display="none",u.classList.add("quantity_field__control--active"),_.forEach((e=>{e.classList.remove("quantity_field__value--active")}))})),r.addEventListener("click",(function(){r.style.display="none",d.classList.add("size_field__control--active"),s.forEach((e=>{e.classList.remove("size_field__value--active")}))})),function(){const e=document.querySelector(".material_field"),t=document.querySelector(".size_field"),n=document.querySelector(".quantity_field"),i=document.querySelector("#input_number_width"),l=document.querySelector("#input_number_height"),o=document.querySelector("#input_number__quantity"),a=document.getElementById("total-price"),c=document.getElementById("yourQuantityBtn"),r=document.querySelector("input[name='material']"),u=document.querySelector("input[name='size']"),d=document.querySelector("input[name='quantity']"),s=document.querySelector("input[name='price']"),_=[];document.querySelectorAll(".material_field__value").forEach((function(e){const t=e.querySelector(".material_name").textContent,n=e.getAttribute("data-coefficient");_.push({materialName:t,materialCoefficient:parseFloat(n)})}));const f=[];function y(){let a="",c=0,s=0;e.querySelectorAll(".material_field__value").forEach((e=>{e.classList.contains("material_field__value--active")&&(a=e.querySelector("p").textContent,r.value=a)})),t.querySelectorAll(".size_field__value").forEach((e=>{if(e.classList.contains("size_field__value--active")){const t=e.querySelector("p").textContent.split("x");c=parseFloat(t[0]),s=parseFloat(t[1]),u.value=e.querySelector("p").textContent}})),c&&s||(c=parseFloat(i.value)||0,s=parseFloat(l.value)||0,u.value=c+"x"+s);const y=Array.from(n.querySelectorAll(".temp_price")).slice(1);if(n.querySelectorAll(".fixed_quantity_btn").forEach(((e,t)=>{const n=parseInt(e.querySelector("p").textContent),i=f.find((e=>e.quantity===n));let l=_.find((e=>e.materialName===a)).materialCoefficient*(c*s)*n;l*=1-i.sale/100,l=Math.round(l);const o=l.toLocaleString()+" ₽";y[t].textContent=o})),o){const e=parseInt(o.value);if(d.value=e,isNaN(e))return void(o.parentNode.querySelector(".temp_price").textContent="");let t=null;for(let n=f.length-1;n>=0;n--)if(f[n].quantity<=e){t=f[n];break}let n=0;t&&(n=t.sale);let i=_.find((e=>e.materialName===a)).materialCoefficient*(c*s)*e;n&&(i*=1-n/100),i=Math.round(i);const l=i.toLocaleString()+" ₽";o.parentNode.querySelector(".temp_price").textContent=l}m()}function m(){const e=n.querySelector(".quantity_field__value--active");if(e){const t=e.querySelector(".temp_price");a.textContent=t.textContent,d.value=e.querySelector("p").textContent,s.value=a.textContent.replace(/\D/g,"")}}function v(){const e=o.parentNode.querySelector(".temp_price");a.textContent=e.textContent,s.value=a.textContent.replace(/\D/g,"")}document.querySelectorAll(".fixed_quantity_btn").forEach((function(e){const t=e.querySelector(".quantity_option").textContent,n=e.getAttribute("data-sale");f.push({quantity:parseInt(t),sale:parseFloat(n)})})),e.querySelectorAll(".material_field__value").forEach((e=>{e.addEventListener("click",(function(){y(),o&&v(),m()}))})),n.querySelectorAll(".fixed_quantity_btn").forEach((e=>{e.addEventListener("click",(function(){y(),m()}))})),o&&o.addEventListener("input",(function(){y(),v()})),c&&c.addEventListener("click",(function(){y(),v()})),t.querySelectorAll(".size_field__value").forEach((e=>{e.addEventListener("click",(function(){y(),o&&v(),m()}))})),i.addEventListener("input",(function(){y(),o&&v(),m()})),l.addEventListener("input",(function(){y(),o&&v(),m()})),y()}()}))}();