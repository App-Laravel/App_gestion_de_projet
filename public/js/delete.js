
const deleteActions = document.querySelectorAll('.delete-action');
const deleteForm = document.querySelector('.delete-form');

deleteActions.forEach(deleteAction => {
    deleteAction.onclick = function(e) {
        e.preventDefault();
        if (confirm('Are you sur to delete it ?')) {
            deleteForm.action = deleteAction.href;
            deleteForm.submit();
        }
    }
}); 