/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/global.css';


// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

const autosize = require('./autosize.min.js');

autosize(document.querySelectorAll('textarea'));

console.log('Loaded app.js')

if (/*@cc_on!@*/!!document.documentMode) alert('L\'utilisation du navigateur Google Chrome est recommandé pour l\'utilisation de cet outil.')

document.getElementById('loading').style.display = 'none';

let checkboxes = Array.prototype.slice.call(document.getElementsByClassName('checkbox'));

checkboxes.forEach(element => {
    element.style.display = 'none';

    let custCheckbox = document.createElement('img');

    let attr = document.createAttribute('src');
    attr.value = 'build/images/circle-24px.svg';

    let attr2 = document.createAttribute('class');
    attr2.value = 'cust-checkbox';

    custCheckbox.setAttributeNode(attr);
    custCheckbox.setAttributeNode(attr2);

    element.addEventListener('change', () => {
        if(element.checked) {
            custCheckbox.src = 'build/images/check_circle-24px.svg';
        } else {
            custCheckbox.src = 'build/images/circle-24px.svg';
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
})

let passwordVisible = document.getElementById('password-visible');
let passwordField = document.getElementById('password');

if(document.getElementById('password-visible')) {
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

function showInfo(text) {
    document.getElementById('info').style.display = 'flex';
    document.getElementById('info-text').textContent = text;
}

function hideInfo() {
    document.getElementById('info').style.display = 'none';
}

// tezs