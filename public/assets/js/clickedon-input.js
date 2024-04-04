let email = document.getElementById("email");
let mobileNo = document.getElementById("mobile");
let toastShowFade = document.getElementById("liveToast");
let toastBodyMsg = document.getElementById("toast-body");

mobileNo.addEventListener("click", function (e) {
    // toastShowFade.classList.remove("toast show fade"); // Remove the original class
    // toastShowFade.classList.add("toast fade hide"); //add new class
    toastShowFade.className = "toast show fade bg-white shadow-sm";
    toastBodyMsg.innerText =
        "Please, Typing valid Mobile No . in this Number we will contact.";

    setTimeout(function () {
        toastShowFade.remove();
    }, 3000);
});
