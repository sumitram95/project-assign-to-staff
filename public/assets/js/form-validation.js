(function () {
    "use strict";

    // SELECT2
    $(".select2").select2({
        minimumResultsForSearch: Infinity,
    });

    window.addEventListener(
        "load",
        function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName("needs-validation");
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(
                forms,
                function (form) {
                    form.addEventListener(
                        "submit",
                        function (event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();

                                // Create a new div element
                                // var newElement = document.createElement("div");

                                // Customize the div (add classes, set attributes, etc.)
                                // newElement.className =
                                //     "shadow-lg d-flex align-items-center justify-content-center bg-white top-0 left-0 p-6";
                                // newElement.textContent =
                                //     "All input field is required";
                                // newElement.id = "validationDiv";

                                // newElement.style.zIndex = "9999";
                                // newElement.style.position = "fixed";
                                // newElement.style.marginTop = "100px";
                                // newElement.style.marginLeft = "200px";
                                // newElement.style.fontSize = "22px";

                                // Append the div to the body of the HTML document
                                // document.body.appendChild(newElement);
                                // let validationDiv = document.getElementById("validationDiv");
                                // Set a timer to close the div after 2 seconds
                                // setTimeout(function () {
                                //     newElement.remove();
                                // }, 2000);
                            }
                            form.classList.add("was-validated");
                        },
                        false
                    );
                }
            );
        },
        false
    );
})();
