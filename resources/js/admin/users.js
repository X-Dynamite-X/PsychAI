import $ from "jquery";
window.openEditModel = function (userId) {
    $(`#editModal-${userId}`).removeClass("hidden");
};
$(document).ready(function () {
    // Close modal handlers
    $(document).on("click", "#closeEditModal, .closeEditModal", function () {
        $("#editModal-" + $(this).closest(".modal").data("user-id")).fadeOut(
            300
        );
    });

    $(document).on("click", "#closeEditModal, .closeEditModal", function () {
        // $(".editModal").fadeOut(300);
        $(".editModal").addClass("hidden");

        // console.log("Modal closing");
    });

    $(window).on("click", function (e) {
        if ($(e.target).is(".editModal")) {
            // $(".editModal").fadeOut(300);
            $(".editModal").addClass("hidden");
        }
    });

    $(".modal-content").on("click", function (e) {
        e.stopPropagation();
    });
    $(document).on("keydown", function (e) {
        if (e.key === "Escape" && $(".editModal").is(":visible")) {
            // $(".editModal").fadeOut(300);
            $(".editModal").addClass("hidden");
        }
    });
});

window.openDeleteModel = function (userId) {
    $(`#deleteModal-${userId}`).removeClass("hidden");
};
$(document).ready(function () {
    $(document).on("click", "#closeDeleteModal, .closeDeleteModal", function () {
        $("#deleteModal-" + $(this).closest(".modal").data("user-id")).fadeOut(
            300
        );
    });

    $(document).on("click", "#closeDeleteModal, .closeDeleteModal", function () {
        // $(".editModal").fadeOut(300);
        $(".deleteModal").addClass("hidden");

        // console.log("Modal closing");
    });

    $(window).on("click", function (e) {
        if ($(e.target).is(".deleteModal")) {
            // $(".deleteModal").fadeOut(300);
            $(".deleteModal").addClass("hidden");
        }
    });

    $(".modal-content").on("click", function (e) {
        e.stopPropagation();
    });
    $(document).on("keydown", function (e) {
        if (e.key === "Escape" && $(".deleteModal").is(":visible")) {
            // $(".deleteModal").fadeOut(300);
            $(".deleteModal").addClass("hidden");
        }
    });
});





