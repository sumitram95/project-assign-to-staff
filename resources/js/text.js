let input_btn_click = document.getElementById("input_btn_click");
let add_input_inside = document.getElementById("add_input_inside");

input_btn_click.addEventListener("click", function (e) {
    add_input_inside.innerHTML = `<input class="form-control" type="file" name="profile_img" required>`;
});
