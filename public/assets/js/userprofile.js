

function Cpass() {
    var passA = document.getElementById("exPassword");
    var c1 = document.getElementById("checkbox1");
    var toggleText = document.getElementById("toggleText");

    if (passA.type === "password") {
        passA.type = "text";
        toggleText.textContent = "Hide Password";
        c1.checked = true;
    } else {
        passA.type = "password";
        toggleText.textContent = "Show Password";
        c1.checked = false;
    }
}

function C1pass() {
    var passB = document.getElementById("conPassword");
    var c2 = document.getElementById("checkbox2");
    var toggleTextF = document.getElementById("toggleTextF");

    if (passB.type === "password") {
        passB.type = "text";
        toggleTextF.textContent = "Hide Password";
        c2.checked = true;
    } else {
        passB.type = "password";
        toggleTextF.textContent = "Show Password";
        c2.checked = false;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        const alerts = document.querySelectorAll(".floating-alert");
        alerts.forEach(alert => alert.remove());
    }, 5000);
}); // Ensure this matches an earlier opening brace or parenthesis


function checkPass() {
    var passA = document.getElementById("exPassword").value;
    var passB = document.getElementById("conPassword").value;
    var textEr = document.getElementById("invalid-feedback");
    var textEr1 = document.getElementById("invalid-feedback1");
    if (passA.length > 0) {
        if ((passA.length < 8 && passA.length > 0) || (passB.length < 8 && passB.length > 0)) {
            textEr.innerText = "Passwords must be 8-20 characters long.";
            textEr1.innerText = "Passwords must be 8-20 characters long.";
            textEr.style.display = "block";
            textEr1.style.display = "block";
            return false;
        }
        if (passA !== passB) {
            textEr.innerText = "Passwords didn't match";
            textEr1.innerText = "Passwords didn't match";
            textEr.style.display = "block";
            textEr1.style.display = "block";
            return false;
        }

        var pattern = /[A-Z]/g;
        if (!passA.match(pattern) || !passB.match(pattern)) {
            textEr.innerText = "Passwords must contain at least one uppercase letter.";
            textEr1.innerText = "Passwords must contain at least one uppercase letter.";
            textEr.style.display = "block";
            textEr1.style.display = "block";
            return false;
        }

        var pattern = /[a-z]/g;
        if (!passA.match(pattern) || !passB.match(pattern)) {
            textEr.innerText = "Passwords must contain at least one lowercase letter.";
            textEr1.innerText = "Passwords must contain at least one lowercase letter.";
            textEr.style.display = "block";
            textEr1.style.display = "block";
            return false;
        }

        var pattern = /[0-9]/g;
        if (!passA.match(pattern) || !passB.match(pattern)) {
            textEr.innerText = "Passwords must contain at least one number.";
            textEr1.innerText = "Passwords must contain at least one number.";
            textEr.style.display = "block";
            textEr1.style.display = "block";
            return false;
        }

        var pattern = /[!@#$%^&*()_+\-=\[\]{}':"\\|,.<>\/?]+/g;
        if (!passA.match(pattern) || !passB.match(pattern)) {
            textEr.innerText = "Passwords must contain at least one special charater.";
            textEr1.innerText = "Passwords must contain at least one special charater.";
            textEr.style.display = "block";
            textEr1.style.display = "block";
            return false;
        }
    }

    textEr.style.display = "none";
    textEr1.style.display = "none";
    return true;
}





function showSwal(options, onConfirm) {
    const ft = document.getElementById('ft');
    ft.classList.add('d-none'); // hide footer

    Swal.fire({
        ...options,
        didClose: () => {
            ft.classList.remove('d-none'); // show footer when modal closes
        }
    }).then((result) => {
        if (result.isConfirmed && typeof onConfirm === 'function') {
            onConfirm(result);
        }
    });
}

// document.getElementById('openModal').addEventListener('click', function () {
//     console.log("Publish Clicked")

//     Swal.fire({
//         title: 'Save Changes?',
//         text: "Do you want to save changes to this account?",
//         icon: 'question',
//         showCancelButton: true,
//         confirmButtonText: 'Yes, submit!',
//         reverseButtons: true
//     }).then((result) => {
//         if (result.isConfirmed) {
//             document.getElementById('update-form').submit();
//         }
//     });
// });

// document.getElementById('openModalD').addEventListener('click', function () {
//     Swal.fire({
//         title: 'Are you sure?',
//         text: 'Do you want to delete this account?',
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonText: 'Yes',
//         reverseButtons: true
//     }).then((result) => {
//         if (result.isConfirmed) {
//             document.getElementById('myFormD').submit();
//         }
//     })
// })

document.getElementById('openModal').addEventListener('click', function () {
    if (checkPass()) {
        showSwal({
            title: 'Save Changes?',
            text: "Do you want to save changes to this account?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, submit!',
            reverseButtons: true
        }, () => {
            document.getElementById('update-form').submit();
        });
    }
});



document.getElementById('openModalD').addEventListener('click', function () {
    showSwal({
        title: 'Are you sure?',
        text: 'Do you want to delete this account?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        reverseButtons: true
    }, () => {
        document.getElementById('myFormD').submit();
    });
});


const chefs_level_toggle = document.getElementById('chefs_toggle');
const chefs_input = document.getElementById('input_chefs_level');
const dataVal = document.getElementById('dataVal');
document.querySelector('.dropdown-menuChefCategory').addEventListener('click', function (e) {
    if (e.target.classList.contains('dropdown-item')) {
        e.preventDefault;
        const val = e.target.getAttribute('data-value');

        chefs_input.value = val;
        dataVal.innerText = val;
        // chefs_level_toggle.style.padding = 0;
    }

});

let cropper;
document.getElementById('edit-pic').addEventListener('click', function (e) {
    showSwal({
        title: 'Upload Image',
        html: ` <!-- Content -->
                <form action="{{url('/userprofile/' . $get_userId)}}" method="POST" id="update-form">
                    <div class="">
                        <div class="container-main-img">
                            <div class="col-big">
                                <!-- <h3>Demo:</h3> -->
                                <div class="img-container">
                                <img id="image" src="" alt="Picture">
                                </div>
                            </div>
                            <div class="col-sm">
                                <!-- <h3>Preview:</h3> -->
                                <div class="docs-preview clearfix">
                                    <div name="profilepic" class="img-preview preview-lg"></div>
                                </div>

                                <!-- <h3>Data:</h3> -->
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 mt-1">
                        <label class="input-field" for="inputImage" title="Upload image file">
                            <input type="file" class="" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Import image with Blob URLs">
                            <span class="fa fa-upload d-none"></span>
                            </span>
                        </label>
                    </div>
                </form>
            `,
        didOpen: () => {
            const input = document.getElementById('inputImage');
            const img = document.getElementById('image');

            input.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file && /^image\/\w+/.test(file.type)) {
                    const url = URL.createObjectURL(file);
                    img.src = url;

                    if (cropper) cropper.destroy(); // reset previous cropper
                    cropper = new Cropper(img, {
                        aspectRatio: 1,
                        viewMode: 1,
                        preview: '.img-preview'
                    });
                }
            });
        },
        customClass: 'swal-wide',
        showCancelButton: true,
        confirmButtonText: 'Submit',
        reverseButtons: true,
        preConfirm: () => {
            return new Promise((resolve) => {
                if (!cropper) {
                    Swal.showValidationMessage('Please upload and crop an image.');
                    resolve(false);
                }

                const canvas = cropper.getCroppedCanvas({
                    width: 300, // optional: set desired output size
                    height: 300
                });

                canvas.toBlob((blob) => {
                    if (!blob) {
                        Swal.showValidationMessage('Failed to create image blob.');
                        resolve(false);
                    } else {
                        resolve(blob); // return the Blob
                    }
                }, 'image/jpeg', 0.9); // image type and quality
            });
        }
    }, (result) => {
        if (!(result.value instanceof Blob)) {
            console.error('No Blob returned for upload.');
            return;
        }

        if (result.isConfirmed && result.value instanceof Blob) {
            const formData = new FormData();
            formData.append('profilepic', result.value, 'cropped.jpg');

            const previewImg = document.getElementById('profile-pic-img');
            const imageUrl = URL.createObjectURL(result.value);

            if (previewImg) {
                previewImg.src = imageUrl;
                previewImg.style.display = 'block';
            }

            // Optional: remove icon fallback if needed
            const fallbackIcon = document.querySelector('.profile-pic .fa-circle-user');
            if (fallbackIcon) fallbackIcon.remove();

            // Upload the formData using fetch or Axios
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
            formData.append('_method', 'PUT'); // Laravel will treat this as PUT
            // formData.append('croppedImage', result.value, 'cropped.jpg');

            console.log(ADD_UPDATE_URL);

            fetch(ADD_UPDATE_URL, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.text(); // <-- Change this
            })
            .then(() => {
                // Preview the cropped image immediately
                const reader = new FileReader();
                reader.onload = () => {
                    document.getElementById('current-profile-pic').src = reader.result;
                };
                reader.readAsDataURL(result.value);
                // const fileInput = document.getElementById('inputImage');
                // if (!fileInput.files.length) {
                //     console.error('No file selected');
                //     return;
                // }
                Swal.fire('Updated!', 'Your profile image has been updated.', 'success');
            })
        }
    })

})
