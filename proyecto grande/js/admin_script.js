let btnMenu = document.getElementById("menu-btn");
let navbar = document.querySelector(".navbar");
let userBtn = document.getElementById("user-btn");
let acountSection = document.querySelector(".account-box");
let closeUpdate = document.getElementById("close-update");
let closess = document.querySelector(".closes");
let updates  = document.querySelector("#update");
let editProduct = document.querySelector(".edit-product-form");

btnMenu.addEventListener("click", () => navbar.classList.toggle("active"));

userBtn.addEventListener("click",()=> acountSection.classList.toggle("active"));

window.addEventListener("scroll" , () =>{
    acountSection.classList.remove("active");
    navbar.classList.remove("active");
})

if(closess){
    closess.addEventListener("click",e =>{
    e.target.parentElement.remove();
})

}

if(closeUpdate){
    
closeUpdate.addEventListener("click",e => {
  document.querySelector(".edit-product-form").style.display = "none";
  window.location.href = 'admin_products.php';
});

}

if(editProduct){
  if(editProduct.children.length <= 0){
    editProduct.style.display = "none";
  }else{
    editProduct.style.display = "flex";
  }
}



let file = document.querySelector("file");

file.addEventListener("change",e=>{
  
});


