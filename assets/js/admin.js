import '../css/admin.scss';
import '../css/components/post.scss';
import '../css/components/post-list.scss';
import Swal from 'sweetalert2';

const addPostDialog = document.getElementById("add-post-dialog");
const addPostDialogData = {
    title: addPostDialog.dataset.title,
    html: addPostDialog.innerHTML,
    confirm: addPostDialog.dataset.confirm,
    cancel: addPostDialog.dataset.cancel,
}
const addPostBtn = document.getElementById("add-post-btn");

addPostBtn.addEventListener("click", (e) => {
    Swal.fire({
        title: addPostDialogData.title,
        html: addPostDialogData.html,
        showCancelButton: true,
        cancelButtonText: addPostDialogData.cancel,
        confirmButtonText: addPostDialogData.confirm,
        reverseButtons: true,
        showLoaderOnConfirm: true,
        focusConfirm: false,
        preConfirm: () => {
            const htmlContainer = Swal.getHtmlContainer();
            const form = htmlContainer.querySelector('form');

            if (form.querySelector("#post_form_title").value === "") {
                Swal.showValidationMessage("Title required");
                return;
            }

            form.requestSubmit();
        }
    });
});