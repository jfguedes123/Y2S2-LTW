// Add click event listener to the dropdown toggle for Active Tickets
document.querySelector('.activeticket .dropdown-toggle').addEventListener('click', function() {
    var dropdownList = this.nextElementSibling;
    if (dropdownList.style.display === 'none') {
        dropdownList.style.display = 'block';
    } else {
        dropdownList.style.display = 'none';
    }
});

// Add click event listener to the dropdown toggle for Solved Tickets
document.querySelector('.solvedticket .dropdown-toggle').addEventListener('click', function() {
    var dropdownList = this.nextElementSibling;
    if (dropdownList.style.display === 'none') {
        dropdownList.style.display = 'block';
    } else {
        dropdownList.style.display = 'none';
    }
});

// Add click event listener to the dropdown toggle for Assigned Tickets
document.querySelector('.assignedticket .dropdown-toggle').addEventListener('click', function() {
    var dropdownList = this.nextElementSibling;
    if (dropdownList.style.display === 'none') {
        dropdownList.style.display = 'block';
    } else {
        dropdownList.style.display = 'none';
    }
});

// Add click event listener to the dropdown toggle for Department Tickets
document.querySelector('.departmentticket .dropdown-toggle').addEventListener('click', function() {
    var dropdownList = this.nextElementSibling;
    if (dropdownList.style.display === 'none') {
        dropdownList.style.display = 'block';
    } else {
        dropdownList.style.display = 'none';
    }
});