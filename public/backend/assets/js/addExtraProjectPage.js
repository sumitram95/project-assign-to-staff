$("#new_create").click(function () {
    newRowAdd =
        '<div id="row"> <div class="input-group mt-2">' +
        '<div class="input-group-prepend">' +
        '<i class="icon icon-minus text-danger me-2 p-0 fs-16" id="DeleteRow"></i></div>' +
        '<input type="text" class="form-control mt-2" name="extra_pages[]" placeholder="Extra Project Name" required> </div> </div>';

    $("#newinput").append(newRowAdd);
});
$("body").on("click", "#DeleteRow", function () {
    $(this).parents("#row").remove();
});
