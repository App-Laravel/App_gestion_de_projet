// Get team members by Fetch
const fetchTeamMembers = async function(projectValue) {

    // empty the old items
    document.querySelector('.dropdown-content').innerHTML = '';

    let url = window.location.origin + "/user/tasks/api";

    if (/^[0-9]{1,}$/.test(projectValue) && ((+projectValue) > 0)) {
        // fetch the data - an array of project's members
        const response = await fetch(url, {
                                method: "POST", // *GET, POST, PUT, DELETE, etc.
                                cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
                                credentials: "same-origin", // include, *same-origin, omit
                                headers: {
                                    "Content-Type": "application/json",
                                },
                                // redirect: "follow", // manual, *follow, error
                                body: JSON.stringify( {projectID : projectValue} ),
                            });
        const membersArray = await response.json();         //  membersArray = [ [memberID], [memberName]];
        
        if (Array.isArray(membersArray[1]) && membersArray[1].length > 0) {
            let count = 0;
            membersArray[1].forEach(member => {                
                let dropdownItem = createDropdownItem(membersArray[0][count], member, projectValue);
                document.querySelector('.dropdown-content').appendChild(dropdownItem);
                count++;
            });

        } else {
            document.querySelector('.dropdown-content').innerHTML = "<div class='dropdown-item'> No Member </div>";
        }
    }    
}


// Get available members (array of IDs) of the selected project if there are (for Modify the task)
const getAvailableMembers = function() {
    let teamArray = [];
    if (document.querySelectorAll('.team-infos') != null) {
        const teamElement = document.querySelectorAll('.team-infos');        
        teamElement.forEach(item => {
            teamArray.push(+item.value);        
        });        
    }
    return teamArray;
}


// Handle the team members
if (document.querySelector('#project_id') != null) {
    
    // get team members for original project 
    const projectInitialValue = document.querySelector('#project_id').value;
    localStorage.setItem('projectInitialValue', +projectInitialValue)
    if (/^[0-9]{1,}$/.test(projectInitialValue) && ((+projectInitialValue) > 0)) {        
        fetchTeamMembers(projectInitialValue);
    }

    // get team members when change the project
    document.querySelector('#project_id').onchange = async () => {
        let projectNewValue = document.querySelector('#project_id').value;
        await fetchTeamMembers(projectNewValue);   
    }
}


// create a dropdown's item for team's members
const createDropdownItem = function(memberID, memberName, projectValue) {
    let divContainer = document.createElement('div');
    divContainer.setAttribute('class', 'dropdown-item');

    // input checkbox element
    let checkboxInput = document.createElement('input');
    checkboxInput.setAttribute('type', 'checkbox');
    checkboxInput.setAttribute('name', 'members[]');
    checkboxInput.setAttribute('value', memberID);
    checkboxInput.setAttribute('class', 'item-checkbox');

        // check if the actual member's ID is in the array of member's IDs for the initial project
        // if yes then set "checked"
    if (getAvailableMembers().includes(memberID) && (projectValue == localStorage.getItem('projectInitialValue'))) {
        checkboxInput.setAttribute('checked', 'checked');
    }
    divContainer.appendChild(checkboxInput);

    // label element
    let itemLabel = document.createElement('span');
    itemLabel.setAttribute('class', 'item-label');            
    itemLabel.innerHTML = memberName.replace(/\b\w/g, x => x.toUpperCase()); // match all first letters and change to uppercase
    divContainer.appendChild(itemLabel);

    return divContainer;
}