
const deleteActions = document.querySelectorAll('.delete-action');
const deleteForm = document.querySelector('.delete-form');

deleteActions.forEach(deleteAction => {
    deleteAction.onclick = function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure to delete it ?',
            text: "All tasks of this project will also be deleted. You won't be able to revert this! ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
                deleteForm.action = deleteAction.href;
                deleteForm.submit();
            }
          })
    }
});