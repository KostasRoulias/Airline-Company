//navbar appear - disappear
const body = document.querySelector("body");
const navbar = document.querySelector(".navbar");
const menu = document.querySelector(".menu-list");
const menuBtn = document.querySelector(".menu-btn");
const cancelBtn = document.querySelector(".cancel-btn");

menuBtn.onclick = () => {
    menu.classList.add("active");
    menuBtn.classList.add("hide");
    body.classList.add("disabledScroll");
}
cancelBtn.onclick = () => {
    menu.classList.remove("active");
    menuBtn.classList.remove("hide");
    body.classList.remove("disabledScroll");
}

window.onscroll = () => {
    window.scrollY > 20 ? navbar.classList.add("sticky") : navbar.classList.remove("sticky");
}


document.addEventListener("DOMContentLoaded", function() {
    const cancelBtn2 = document.querySelector(".cancel-btn2");
    const cancelBtn3 = document.querySelector(".cancel-btn3");
    const pop = document.getElementById("popupForm");
    // const link = document.querySelector(".registerLink");
    const registerForm = document.querySelector(".register");
    const registerBtn = document.getElementById("registBtn");
    const registerButton = document.getElementById("registerButton");
    const login = document.getElementById("loginBtn");

    login.onclick = (event) =>{
        event.stopPropagation();
        pop.classList.add("active");
        document.addEventListener("click", closeFormOnClickOutside);
    }
    function closeFormOnClickOutside(event) {
        const isClickInsideForm = pop.contains(event.target);

        if (!isClickInsideForm) {
            pop.classList.remove("active");
            // Remove the click event listener after the form is closed
            document.removeEventListener("click", closeFormOnClickOutside);   
        }
    }

    cancelBtn2.onclick = () => {
        pop.classList.remove("active");
    }

    cancelBtn3.onclick = () => {
        registerForm.classList.remove("active2");
    }

    registerBtn.onclick = (event) => {
        event.stopPropagation();
        registerForm.classList.add("active2");
        document.addEventListener("click", closeFormOnClickOutside2);
    }

    function closeFormOnClickOutside2(event) {
        const isClickInsideForm = registerForm.contains(event.target);

        if (!isClickInsideForm) {
            registerForm.classList.remove("active2");
            pop.classList.remove("active");
            // Remove the click event listener after the form is closed
            document.removeEventListener("click", closeFormOnClickOutside2);   
        }
    }
    
});

//function to dissappear the date label of departure when the trip is one way
// document.addEventListener("DOMContentLoaded", function() {
//     const oneway = document.querySelector(".oneway");
//     const roundtrip = document.querySelector(".roundtrip");
//     const departureDate = document.querySelector(".depDate");


//     if (!oneway.checked && !roundtrip.checked) {
//         departureDate.style.display = "block";
//     }

//     oneway.addEventListener("click", function() {
//         if (oneway.checked) {
//             departureDate.style.display = "none";
//         } else {
//             departureDate.style.display = "block";
//         }
        
//     });

//     departureDate.addEventListener("click", function(event) {
//         event.stopPropagation();
//     });


//     document.addEventListener("click", function(event) {
//         if (!departureDate.contains(event.target) && event.target !== oneway) {
//             departureDate.style.display = "block";
//         }
//     });

// });



    // Function to get URL parameter
//     function getUrlParameter(name) {
//         name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
//         var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
//         var results = regex.exec(location.search);
//         return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
//     };

//     // Check if success parameter is 'false' in the URL
//     if (getUrlParameter('success') === 'false') {
//         registerForm.classList.add("active2");
//     }
// });

//move to top of the page
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    });
}
