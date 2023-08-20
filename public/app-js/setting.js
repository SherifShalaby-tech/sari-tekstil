$(() => {
    let usrCfg = {
        height: "200",
        toolbar: [
            ["style", ["bold", "italic", "underline", "clear"]],
            ["font", ["strikethrough", "superscript", "subscript"]],
            ["fontsize", ["fontsize"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["height", ["height"]],
            ["table", ["table"]],
            ["insert", ["link", "picture", "video"]],
            ["view", ["fullscreen", "codeview", "help"]],
        ],
        width: "inherit",
    };
    $("#help_page_content").summernote(usrCfg);
});
$("#submit-btn").on("click", function (e) {
    e.preventDefault();
    setTimeout(() => {
        getHeaderImages();
        getFooterImages();
        getLogoImages();
        $("#setting_form").submit();
    }, 1000);
});

$(document).on("click", ".remove_image", function () {
    var type = $(this).data("type");
    $.ajax({
        url: "/settings/remove-image/" + type,
        type: "POST",
        success: function (response) {
            if (response.success) {
                location.reload();
            }
        },
    });
})
//crop logo
var fileLogoInput = document.querySelector("#file-input-logo");
var previewLogoContainer = document.querySelector(".preview-logo-container");
var croppieLogoModal = document.querySelector("#croppie-logo-modal");
var croppieLogoContainer = document.querySelector("#croppie-logo-container");
var croppieLogoCancelBtn = document.querySelector("#croppie-logo-cancel-btn");
var croppieLogoSubmitBtn = document.querySelector("#croppie-logo-submit-btn");
// let currentFiles = [];
fileLogoInput.addEventListener("change", () => {
    previewLogoContainer.innerHTML = "";
    let files = Array.from(fileLogoInput.files);
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        let fileType = file.type.slice(file.type.indexOf("/") + 1);
        let FileAccept = [
            "jpg",
            "JPG",
            "jpeg",
            "JPEG",
            "png",
            "PNG",
            "BMP",
            "bmp",
        ];
        // if (file.type.match('image.*')) {
        if (FileAccept.includes(fileType)) {
            const reader = new FileReader();
            reader.addEventListener("load", () => {
                const preview = document.createElement("div");
                preview.classList.add("preview");
                const img = document.createElement("img");
                const actions = document.createElement("div");
                actions.classList.add("action_div");
                img.src = reader.result;
                preview.appendChild(img);
                preview.appendChild(actions);
                const container = document.createElement("div");
                const deleteBtn = document.createElement("span");
                deleteBtn.classList.add("delete-btn");
                deleteBtn.innerHTML =
                    '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                deleteBtn.addEventListener("click", () => {
                    swal({
                        title: LANG.are_you_sure,
                        text: LANG.you_wont_be_able_to_delete,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!",
                    }).then((result) => {
                        if (result) {
                            swal(
                                "Deleted!",
                                LANG.your_image_has_been_deleted,
                                "success"
                            );
                            files.splice(file, 1);
                            preview.remove();
                            getLogoImages();
                        }
                    });
                });
                preview.appendChild(deleteBtn);
                const cropBtn = document.createElement("span");
                cropBtn.setAttribute("data-toggle", "modal");
                cropBtn.setAttribute("data-target", "#logoModal");
                cropBtn.classList.add("crop-btn");
                cropBtn.innerHTML =
                    '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                cropBtn.addEventListener("click", () => {
                    setTimeout(() => {
                        launchLogoCropTool(img);
                    }, 500);
                });
                preview.appendChild(cropBtn);
                previewLogoContainer.appendChild(preview);
            });
            reader.readAsDataURL(file);
        } else {
            swal({
                icon: "error",
                title: '{{ __("Oops...") }}',
                text: '{{ __("Sorry , You Should Upload Valid Image") }}',
            });
        }
    }

    getLogoImages();
});
function launchLogoCropTool(img) {
    // Set up Croppie options
    const croppieOptions = {
        viewport: {
            width: 200,
            height: 200,
            type: "square", // or 'square'
        },
        boundary: {
            width: 300,
            height: 300,
        },
        enableOrientation: true,
    };

    // Create a new Croppie instance with the selected image and options
    var croppie = new Croppie(croppieLogoContainer, croppieOptions);
    croppie.bind({
        url: img.src,
        orientation: 1,
    });

    // Show the Croppie modal
    croppieLogoModal.style.display = "block";

    // When the user clicks the "Cancel" button, hide the modal
    croppieLogoCancelBtn.addEventListener("click", () => {
        croppieLogoModal.style.display = "none";
        $("#logoModal").modal("hide");
        croppie.destroy();
    });

    // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
    croppieLogoSubmitBtn.addEventListener("click", () => {
        croppie
            .result({
                type: "canvas",
                size: {
                    width: 800,
                    height: 600,
                },
                quality: 1, // Set quality to 1 for maximum quality
            })
            .then((croppedImg) => {
                img.src = croppedImg;
                croppieLogoModal.style.display = "none";
                $("#logoModal").modal("hide");
                croppie.destroy();
                getLogoImages();
            });
    });
}

function getLogoImages() {
    setTimeout(() => {
        const container = document.querySelectorAll(".preview-logo-container");
        let images = [];
        $("#cropped_logo_images").empty();
        for (let i = 0; i < container[0].children.length; i++) {
            images.push(container[0].children[i].children[0].src);
            var newInput = $("<input>")
                .attr("type", "hidden")
                .attr("name", "logo")
                .val(container[0].children[i].children[0].src);
            $("#cropped_logo_images").append(newInput);
        }
        return images;
    }, 300);
}
//crop logo
