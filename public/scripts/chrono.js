console.log('Loaded chrono.js')

document.getElementById('loading').style.display = 'none';

let checkboxes = Array.prototype.slice.call(document.getElementsByClassName('checkbox'));

checkboxes.forEach(element => {
    element.style.display = 'none';

    let custCheckbox = document.createElement('img');

    let attr = document.createAttribute('src');
    attr.value = 'icons/circle-24px.svg';

    let attr2 = document.createAttribute('class');
    attr2.value = 'cust-checkbox';

    custCheckbox.setAttributeNode(attr);
    custCheckbox.setAttributeNode(attr2);

    // custCheckbox.addEventListener('click', () => {
    //     if(element.checked) {
    //         element.click();
    //         custCheckbox.src = 'icons/circle-24px.svg';
    //     } else {
    //         element.click();
    //         custCheckbox.src = 'icons/check_circle-24px.svg';
    //     }
    // });

    element.addEventListener('change', () => {
        if(element.checked) {
            custCheckbox.src = 'icons/check_circle-24px.svg';
        } else {
            custCheckbox.src = 'icons/circle-24px.svg';
        }
    });

    element.parentElement.insertBefore(custCheckbox, element.nextSibling);
});

let checkboxContainers = Array.prototype.slice.call(document.getElementsByClassName('checkbox-container'));

checkboxContainers.forEach(element => {
    element.addEventListener('keyup', (event) => {
        if(event.keyCode === 13) {
            console.log(element.firstChild.nextSibling.click());
        }
    });
    // element.addEventListener('click', () => {
    //     element.firstChild.nextSibling.click();
    // })
})


let passwordVisible = document.getElementById('password-visible');
let passwordField = document.getElementById('password');

if(document.getElementById('passwordVisible')) {
    passwordVisible.addEventListener('change', () => {
        if(passwordField.type === 'password') {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    })
}

function link(page) {
    location.href = page;
}

function loadingPage() {
    document.getElementById('loading').style.display = 'flex';
}

function add(page) {
    document.getElementById('add').style.display = 'flex';
}

function cancelAdd() {
    document.getElementById('add').style.display = 'none';
    document.getElementById('add-form').reset();
    for (let index = 0; index < document.querySelectorAll('#add-form textarea').length; index++) {
        document.querySelectorAll('#add-form textarea')[index].style.height = 'auto';
        
    }
}