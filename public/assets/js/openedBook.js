import { toPng } from 'https://cdn.jsdelivr.net/npm/html-to-image/+esm';
import Swal from 'https://cdn.jsdelivr.net/npm/sweetalert2@11/+esm';
console.log(toPng);
document.addEventListener('DOMContentLoaded', () => {


    // Alerts
    setTimeout(() => {
        const alerts = document.querySelectorAll(".floating-alert");
        alerts.forEach(alert => alert.remove());
    }, 5000);



    const replyToBtn = document.querySelectorAll('.replyTo');
    replyToBtn.forEach(btn => {
        btn.addEventListener('click', function () {
            const comment_card = this.closest('.comment_card');
            const comment_container = comment_card.querySelector('.addComment_container');
            const commentId = comment_card.querySelector('.parent').innerText;
            const replyTo = comment_card.querySelector('.replyToInput');
            const replyingToUser = comment_card.querySelector('.comment_Title').innerText;
            const parent_id_input = comment_card.querySelector('.parent_id_input');
            console.log("Reply button clicked"); // Log when the reply button is clicked
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
                    if (reply.classList.contains('d-none')) {
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



    const openDLBtn = document.getElementById('openDownloadAlert');
    const commentsSection = document.querySelector('.commentSection');
    const content = document.querySelector('.body');
    const rawBookname = document.querySelector('.Title').innerText;
    const authorName = document.querySelector('.author').innerText;
    const rawFilename = `${rawBookname} by ${authorName}`;
    const filename = rawFilename.replace(/[^a-z0-9]/gi, '_').toLowerCase();

    if (openDLBtn) {
        openDLBtn.addEventListener('click', () => {
            Swal.fire({
                title: `Download ${rawBookname} Recipe?`,
                text: 'Do you want to hide comments before downloading?',
                input: 'checkbox',
                inputPlaceholder: 'Hide Comments',
                iconHtml: '<i class="fa-solid fa-download Icon action-icon"></i>',
                customClass: {
                    icon: 'no-border'
                },
                showCancelButton: true,
                confirmButtonText: 'Download',
                reverseButtons: true
            }).then((result) => {
                if (!result.isConfirmed) return;
                const hideComments = result.value;

                if (hideComments && commentsSection) {
                    commentsSection.classList.add('d-none');
                }

                setTimeout(() => {
                    toPng(content)
                        .then((dataUrl) => {
                            const link = document.createElement('a');
                            link.download = `${filename}.png`;
                            link.href = dataUrl;
                            link.click();

                            setTimeout(() => {
                                if (hideComments && commentsSection) {
                                    commentsSection.classList.remove('d-none');
                                }
                            }, 1000);
                        })
                        .catch((err) => {
                            console.error('Error generating image:', err);
                        });
                }, 300);
            });
        });
    }


    const rateBtn = document.getElementById('rateAction');
    rateBtn.addEventListener('click', () => {
        Swal.fire({
            title: 'Rate this book',
            icon: 'info',
            html:
                ' <form id="ratingForm"> <input type="hidden" name="userId" value="{{ $get_userId }}"> <input type="hidden" name="bookId" value="{{ $book->id }}"> <div class="rating d-flex justify-content-center"> <input type="radio" id="BStar5" name="rating" class="star" value="5" /> <label for="BStar5" title="5 stars" class="fa-solid fa-star"></label> <input type="radio" id="BStar4" name="rating" class="star" value="4" /> <label for="BStar4" title="4 stars" class="fa-solid fa-star"></label> <input type="radio" id="BStar3" name="rating" class="star" value="3" /> <label for="BStar3" title="3 stars" class="fa-solid fa-star"></label> <input type="radio" id="BStar2" name="rating" class="star" value="2" /> <label for="BStar2" title="2 stars" class="fa-solid fa-star"></label> <input type="radio" id="BStar1" name="rating" class="star" value="1" /> <label for="BStar1" title="1 star" class="fa-solid fa-star"></label> </div> </form> ',
            showCancelButton: true,
            confirmButtonText: 'Rate',
            reverseButtons: true,
            preConfirm: () => {
                const form = document.getElementById('ratingForm');
                const selected = document.querySelector('input[name="rating"]:checked');
                const userId = document.querySelector('input[name="userId"]');
                const bookId = document.querySelector('input[name="bookId"]');
                if (!selected) {
                    Swal.showValidationMessage('Please select a rating');
                    return false;
                }

                const formData = new FormData(form);
                formData.append('rating', selected.value);
                formData.append('userId', userId.value);
                formData.append('bookId', bookId.value);

                // Debug the URL
                console.log("{{ url('/add-rating') }}");

                return fetch(ADD_RATING_URL, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: formData
                })
                .then(res => {
                    if (!res.ok) throw new Error('Network Error');
                    return res.json();
                }).then(data => {
                    // Save message in sessionStorage
                    sessionStorage.setItem("ratingMessage", data.message);
                    // Reload page
                    window.location.reload();
                })
                .catch(err => {
                    Swal.showValidationMessage('Failed to submit rating.');
                });

            }

        }).then((result) => {
            if (result.isConfirmed) {
                console.log('Rated with:', result.value);
                // Optional: POST rating to server
            }
        });
    })

});


