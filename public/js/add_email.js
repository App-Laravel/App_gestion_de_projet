/******************************************** Add coworker emails *********************************************/

// Alert email error
const emailAlert = function(logic, text){
    if (!logic) {
            text.classList.remove('border-success');
            text.classList.add('border-danger');
        } else {
            text.classList.remove('border-danger');
            text.classList.add('border-success');
        }
}

// Email validation 
const emailPattern = /^[A-z][A-z0-9_\.\-]{2,}@[A-z0-9\-]{2,}(\.[A-z]{2,}){1,2}$/;
const checkEmails = function(textArray) {
    let check = true;
    textArray.forEach(text=>{
        check*=emailPattern.test(text.value);
        if (text.value != '') {
            emailAlert(emailPattern.test(text.value), text);
        }
        
    });
    return check;
}

//
const checkEmail = function() {
    let inviteInputs = document.querySelectorAll('.invite');
    inviteInputs.forEach(inviteInput => {
        inviteInput.onchange = () => {
            emailAlert(emailPattern.test(inviteInput.value), inviteInput);
        }
    });
}
checkEmail();


// create an input element 
const createInputItem = function(count) {
    let input = document.createElement('input')
    input.setAttribute('id', 'invite_'+count);
    input.setAttribute('type', 'email');
    input.setAttribute('class', 'form-control mt-1 invite');
    input.setAttribute('name', 'email[]');
    input.setAttribute('placeholder', 'Email of coworkers...');
    input.setAttribute('autocomplete', 'email');
    return input;
}

const addEmail = document.querySelector('.add-email');
let count = 1;
// Add un email input if emails are correct
addEmail.onclick = () => {
    let inviteInputs = document.querySelectorAll('.invite');
    if (checkEmails(inviteInputs)) {
        document.querySelector('.invites').appendChild(createInputItem(count));
        count++;

        // check email
        checkEmail();
    }
}
/**************************************************************************************************************/