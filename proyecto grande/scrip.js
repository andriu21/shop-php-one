let closses = document.querySelector(".closes")
let userBox = document.querySelector(".user-box");
let userBtn = document.querySelector("#user-btn");
let navbar = document.querySelector(".navbar");
let btnMenu = document.getElementById("menu-btn");


if(closses){
    closses.addEventListener("click",e =>{
        e.target.parentElement.remove();
    })
    
}

userBtn.addEventListener("click",e =>{
    userBox.classList.toggle("active");
    navbar.classList.remove("active");
});

btnMenu.addEventListener("click",e =>{
    navbar.classList.toggle("active");
    userBox.classList.remove("active");
});

window.addEventListener("scroll",() => {
userBox.classList.remove("active");
navbar.classList.remove("active");

window.scrollY > 10 ?
                    document.querySelector(".header .header-2").classList.add("active")
                    :
                    document.querySelector(".header .header-2").classList.remove("active");
});



