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

    document.getElementById('confirmSubmit').addEventListener('click', function () {
        // Submit the form after confirmation
        document.getElementById('myForm').submit();
    });
    
    
    document.getElementById('openModalD').addEventListener('click', function () {
        // Open the modal
        const modal = new bootstrap.Modal(document.getElementById('confirmationModalD'));
        modal.show();
    });

    document.getElementById('confirmDelete').addEventListener('click', function () {
        // Submit the form after confirmation
        document.getElementById('deleteBook').submit();
    });