
document.addEventListener('DOMContentLoaded', function () {

    // Swal.fire({
    //     title: 'Hello SweetAlert!',
    //     text: 'This is a basic alert message.',
    //     icon: 'success', // Optional: 'success', 'error', 'warning', 'info', 'question'
    //   });


    const dropdownItems = document.querySelectorAll(".dropdown-menuCategory .dropdown-item");
    const selectedElement = document.querySelector(".dropdownCategory .selected");

    dropdownItems.forEach(item => {
        item.addEventListener("click", function (e) {
            e.preventDefault();
            const value = this.getAttribute("data-value");
            const label = this.textContent;

            // Update the selected label in the anchor tag
            selectedElement.innerHTML = `
                ${label}
                <input type="checkbox" class="dropdown-toggle check-boxA">
            `;

            // Optional: Set the value into a hidden input for form submission
            let hiddenInput = document.getElementById("selectedChefRole");
            if (!hiddenInput) {
                hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "recipeCategory"; // or any backend name expected
                hiddenInput.id = "selectedChefRole";
                selectedElement.parentElement.appendChild(hiddenInput);
            }
            hiddenInput.value = value;
            console.log("Selected value:", value); // Log the selected value
        });
    });

});

// const dropdownItemsB = document.querySelector(".dropdown-menuCategory");
// dropdownItemsB.addEventListener("click", function (e) {
//     e.preventDefault();
//     console.log("Dropdown item clicked:", e.target); // Log the clicked item
// });

document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        const alerts = document.querySelectorAll(".floating-alert");
        alerts.forEach(alert => alert.remove());
    }, 5000);
});


    //Title
    const sourceInput = document.getElementById('sourceInput');
    const targetInput = document.getElementById('targetInput');

    sourceInput.addEventListener('input', function () {
        targetInput.innerText = sourceInput.value;
    });



    const fileInput = document.getElementById('formFile');
    const imagePreview = document.getElementById('imagePreview');
    
    fileInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
    
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
            };
    
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = "{{ asset('assets/Images/default.jpg') }}";
        }
    });

    const imagePreviewRightSide = document.getElementById('imagePreviewRS');
    
    fileInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
    
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreviewRightSide.src = e.target.result;
            };
    
            reader.readAsDataURL(file);
        } else {
            imagePreviewRightSide.src = "{{ asset('assets/Images/default.jpg') }}";
        }
    });




    document.getElementById('openModal').addEventListener('click', function () {
        console.log("Publish Clicked")
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to publish this book?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, submit!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('myForm').submit();
            }
        });
    });
    
    document.getElementById('openModalD').addEventListener('click', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to delete this book?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            reverseButtons: true
        }),then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteBook').submit();
            }
        })
    })

