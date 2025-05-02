
document.addEventListener('DOMContentLoaded', function () {
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




    document.getElementById('openModal').addEventListener('click', function () {
        // Open the modal
        const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        modal.show();
    });

    document.addEventListener('DOMContentLoaded', () => {
        let isSubmitting = false;
    
        const form = document.getElementById('myForm');
        const confirmSubmit = document.getElementById('confirmSubmit');
        const btnCancelModal = document.getElementById('btnCancelModal');
    
        if (confirmSubmit && form) {
            confirmSubmit.addEventListener('click', function () {
                console.log("Confirm submit button clicked"); // Log the click event
                if (!isSubmitting) {
                    isSubmitting = true;
                    // Disable the submit button and show a spinner
                    btnCancelModal.setAttribute('disabled', true);
                    
                    confirmSubmit.setAttribute('disabled', true);
                    confirmSubmit.innerHTML = `
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...
                    `;
                    form.submit(); // Submit the form after setting the flag and UI
                }
            });
        }
    });
    
    
    document.getElementById('openModalD').addEventListener('click', function () {
        // Open the modal
        const modal = new bootstrap.Modal(document.getElementById('confirmationModalD'));
        modal.show();
    });

    
    document.addEventListener('DOMContentLoaded', () => {
        let isSubmitting = false;
    
        const form = document.getElementById('deleteBook');
        const confirmDelete = document.getElementById('confirmDelete');
        const btnCancelModal = document.getElementById('btnCancelModal');
    
        if (confirmDelete && form) {
            confirmDelete.addEventListener('click', function () {
                if (!isSubmitting) {
                    isSubmitting = true;
                    // Disable the submit button and show a spinner
                    btnCancelModal.setAttribute('disabled', 'disabled');

                    confirmDelete.setAttribute('disabled', 'disabled');
                    confirmDelete.innerHTML = `
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deleting...
                    `;
                    form.submit(); // Submit the form after setting the flag and UI
                }
            });
        }
    });

    