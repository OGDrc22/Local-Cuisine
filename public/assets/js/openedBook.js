import { toPng } from 'https://cdn.jsdelivr.net/npm/html-to-image/+esm';
console.log(toPng);
document.addEventListener('DOMContentLoaded', () => {
    

    // Alerts
    setTimeout(() => {
        const alerts = document.querySelectorAll(".floating-alert");
        alerts.forEach(alert => alert.remove());
    }, 5000);



    const openModalButton = document.getElementById('openModal');
    const downloadContentModal = document.getElementById('downloadContentModal')
    const modal = new bootstrap.Modal(downloadContentModal);
    
    if (openModalButton && downloadContentModal) {
        openModalButton.addEventListener('click', function () {
            // Open the modal
            modal.show();
            console.log("Modal opened"); // Log when the modal is opened
        });
    }

    const checkBox = document.getElementById('hide_comments');
    const commentsSection = document.querySelector('.commentSection');


    const button = document.getElementById('downloadBtn');
    const content = document.querySelector('.body');
    const rawBookname = document.querySelector('.Title').innerText;
    const authorName = document.querySelector('.author').innerText;
    const rawFilename = `${rawBookname} by ${authorName}`; // Get the book name and author name
    const filename = rawFilename.replace(/[^a-z0-9]/gi, '_').toLowerCase(); // Replace non-alphanumeric characters with underscores
    
    if (button && content) {
        
        let downloadRequested = false; // Track if download should happen

        button.addEventListener('click', () => {
            if (checkBox.checked) {
                console.log("Checkbox is checked");
                if (commentsSection) {
                    commentsSection.classList.add('d-none');
                }
            }

            downloadRequested = true; // Mark that download was requested
            modal.hide(); // Hide the modal
        });

        // Only add this ONCE
        downloadContentModal.addEventListener('hidden.bs.modal', function handleAfterHide() {
            if (!downloadRequested) return; // If no download requested, do nothing

            downloadRequested = false; // Reset flag

            toPng(content)
                .then((dataUrl) => {
                    const link = document.createElement('a');
                    // var filename = {!! json_encode($recipe->title) !!};
                    // filename = filename.replace(/[^a-z0-9]/gi, '_').toLowerCase();
                    link.download = filename + '.png';
                    link.href = dataUrl;
                    link.addEventListener('click', function () {
                        setTimeout(() => {
                            commentsSection.classList.remove('d-none'); // Show comments section again
                            console.log("Comments section shown again"); // Log when comments section is shown again
                        }, 1000); // Delay to ensure the download is initiated before showing comments again
                    })
                    link.click();
                    
                    link.remove(); // Remove the link after clicking
                })
                .catch((error) => {
                    console.error('Error generating image:', error);
                });
        });

    }



    const replyToBtn = document.querySelectorAll('.replyTo');
    replyToBtn.forEach(btn => {
        btn.addEventListener('click', function () {
            const comment_card = this.closest('.comment_card');
            const comment_container = comment_card.querySelector('.addComment_container');
            const commentId = comment_card.querySelector('.parent').innerText;
            const replyTo = comment_card.querySelector('.replyToInput');
            const replyingToUser = comment_card.querySelector('.comment_Title').innerText;
            const parent_id_input = comment_card.querySelector('.parent_id_input');
            console.log("Reply button clicked" ); // Log when the reply button is clicked
            console.log("Comment ID: ", commentId); // Log the comment ID]

            replyTo.value = `@ ${replyingToUser}: `; // Set the reply input value to the replying user
    
            if (comment_container.classList.contains('d-none')) {
                comment_container.classList.remove('d-none'); // Show the comment container if it's hidden
            } else {
                comment_container.classList.add('d-none'); // Hide the comment container if it's already shown
            }
            
            if (parent_id_input) {
                parent_id_input.value = commentId; // Set the parent ID input value to the comment ID
            }
            
        });
    });


    const showRepliesBtn = document.querySelectorAll('.viewReplies');
    showRepliesBtn.forEach(btn => {
        btn.addEventListener('click', function () {
            console.log("Show replies button clicked"); // Log when the show replies button is clicked
            const commentConnection = this.closest('.comment_connection');
            const commentReplies = commentConnection.nextElementSibling;
            if (commentReplies && commentReplies.classList.contains('comment_replies')) {
                const replies = Array.from(commentReplies.children).filter(child => child.classList.contains('comment_container'));
                replies.forEach(reply => {
                    if ( reply.classList.contains('d-none')) {
                        reply.classList.remove('d-none')
                    } else {
                        reply.classList.add('d-none')
                    }
                });
            }
        });
    });


    function auto_grow(element) {
        element.style.height = "52px"; // Reset height to auto to calculate scrollHeight correctly
        element.style.height = (element.scrollHeight) + "px"; // Set height to scrollHeight
    }

    const replyToInput = document.getElementById('replyToInput');
    if (replyToInput) {
        replyToInput.addEventListener('input', function () {
            auto_grow(this); // Call the auto_grow function on input event
        });
    }

});


