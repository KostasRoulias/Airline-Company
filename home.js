
//navbar appear - disappear
const body = document.querySelector("body");
const navbar = document.querySelector(".navbar");
const menu = document.querySelector(".menu-list");
const menuBtn = document.querySelector(".menu-btn");
const cancelBtn = document.querySelector(".cancel-btn");

menuBtn.onclick = ()=>{
    menu.classList.add("active");
    menuBtn.classList.add("hide");
    body.classList.add("disabledScroll");
}
cancelBtn.onclick = ()=>{
    menu.classList.remove("active");
    menuBtn.classList.remove("hide");
    body.classList.remove("disabledScroll");
}

window.onscroll = ()=>{
    window.scrollY > 20 ? navbar.classList.add("sticky") : navbar.classList.remove("sticky");
}

//popupForm login
document.getElementById("loginBtn").addEventListener("click", function(event) {
    event.stopPropagation();
    var popup = document.getElementById("popupForm");
    popup.classList.add("active");
});

document.addEventListener("click", function(event) {
    var popup = document.getElementById("popupForm");
    if (event.target !== popup && !popup.contains(event.target)) {
        popup.classList.remove("active");
    }
});
////cancel button for login and register form
//// document.addEventListener("DOMContentLoaded", function() {
////     const cancelBtn2 = document.querySelector(".cancel-btn2");
////   const cancelBtn3 = document.querySelector(".cancel-btn3");
///  const pop = document.getElementById("popupForm");
////     const link = document.querySelector(".registerLink");
////   const registerForm = document.querySelector(".register");
////     const registerBtn = document.getElementById("registerButton");

////     cancelBtn2.onclick = () => {
////         pop.classList.remove("active");
////     }

////     link.onclick = ()=>{
// //        pop.classList.remove("active");
////        registerForm.classList.add("active2");
// //    }

// //    cancelBtn3.onclick = () => {
// //        registerForm.classList.remove("active2");
// //    }


// });

document.addEventListener("DOMContentLoaded", function() {
    const cancelBtn2 = document.querySelector(".cancel-btn2");
    const cancelBtn3 = document.querySelector(".cancel-btn3");
    const pop = document.getElementById("popupForm");
    const link = document.querySelector(".registerLink");
    const registerForm = document.querySelector(".register");
    const registerBtn = document.getElementById("registerButton");

    cancelBtn2.onclick = () => {
        pop.classList.remove("active");
    }

    link.onclick = () => {
        pop.classList.remove("active");
        registerForm.classList.add("active2");
    }

    cancelBtn3.onclick = () => {
        registerForm.classList.remove("active2");
    }

    // Function to get URL parameter
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };

    // Check if success parameter is 'false' in the URL
    if(getUrlParameter('success') === 'false') {
        registerForm.classList.add("active2");
    }
});





//move to top of the page
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    });
}

