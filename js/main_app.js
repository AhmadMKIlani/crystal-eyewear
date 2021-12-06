//define html elements
const fullName = document.querySelector('#username');
const fullNameNew = document.querySelector('#full_name');
const password = document.querySelector('#password');
const email = document.querySelector('#email');
const passwordConfirmation = document.querySelector('#password_confirmation');
const btnRegister = document.querySelector('.btn-register');
const btnLogin = document.querySelector('.btn-login');
const signupForm = document.getElementById('form');
const loginForm = document.querySelector('.login_form');
const checkoutForm = document.querySelector('.checkout_form');
const userAdminForm=document.querySelector('.add_user_form_admin');



const renderError = function(msg, el, type) {


    const err = document.querySelector(`.${type}1`);
    if (err) return;
    const markup = `<span class="mt-2 ${type}1  text-danger text-bold">${msg}</span>`
    el.parentElement.insertAdjacentHTML("beforeend", markup)

}
const removeError = function(el, type) {
    const err = document.querySelector(`.${type}1`);
    if (!err) return;
    err.remove()
}

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validateMobile(num) {
    return (/^[077|079|078]+[0-9]{7}$/gm).test(num)
}

function validateCountry(country) {
    return (/^[a-zA-Z ]/gm).test(country)
}

function validateFullName(name) {
    return (/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*$/g).test(name)

}

function validatePassword(pass) {

    return (/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z])/).test(pass)
}

function validateUsername(username) {
    return /^[a-zA-Z0-9_.]{2,}[a-zA-Z]+[0-9]*$/.test(username);
}
let emailCheck = false;
let phoneCheck = false;
let passwordCheck = false;
let fullNameCheck = false;
let checkInputCheck = false;
let countryCheck = false;
let passwordConfirmationCheck = false;

const checkEmpty = function(type, el) {
    try {
        /* if(el===checkInput){
                if(!el.checked){
                    throw new Error(`The ${type} should be checked`)
    
                }
                else{
                    removeError(el,type);
                    checkInputCheck=true;
                }
    
            }*/

        if (el.value === "") {
            throw new Error(`The ${type} shouldn't be empty`)

        }
        if (el.value !== "") {
            removeError(el, type);

        }

        if (type === "emailAdmin") {
            if (!validateEmail(el.value)) {
                emailCheck = false;
                throw new Error('The email is not valid');

            } else {
                emailCheck = true;
            }
            const emails=document.querySelectorAll('.row-class-email');
            emails.forEach(email=>{
                
                
                if(email.innerText===el.value){
                    throw new Error("The email already used");
                }
            })
            

        }
        if (type === "email") {
            if (!validateEmail(el.value)) {
                emailCheck = false;
                throw new Error('The email is not valid');

            } else {
                emailCheck = true;
            }

        }
        if (type === "country") {
            if (!validateCountry(el.value)) {
                countryCheck = false;
                throw new Error('The country is not valid');

            } else {
                countryCheck = true;
            }

        }
        if (type === 'username') {
            if (!validateUsername(el.value)) {
                fullNameCheck = false;
                throw new Error('The name is not valid')
            } else {
                fullNameCheck = true;
            }

        }
        if (type === 'fullname') {
            if (!validateUsername(el.value)) {
                fullNameCheck = false;
                throw new Error('The name is not valid')
            } else {
                fullNameCheck = true;
            }

        }
        //?Orange Mobile check
        if (type === "mobile") {
            if (!validateMobile(el.value)) {
                phoneCheck = false;
                throw new Error('The mobile should be valid')
            } else {
                phoneCheck = true;
            }

        }
        if (type === "password") {
            if (!validatePassword(el.value)) {
                passwordCheck = false;
                throw new Error('A password contains at least eight characters,including at least one number and includes both lower and uppercase letters and special characters, for example')
            } else {
                passwordCheck = true
            }

        }
        if (type === "passwordConfirmation") {
            if (el.value === password.value) {
                passwordConfirmationCheck = true



            } else {
                passwordConfirmationCheck = false;
                throw new Error("password must match")
            }
        }
        return true;




    } catch (err)

    {


        renderError(err, el, type);

    }


}



function submitForm(form) {
    var submitFormFunction = Object.getPrototypeOf(form).submit;
    submitFormFunction.call(form);
}



function signupValidation() {


    fullNameNew.addEventListener('blur', () => {
        checkEmpty('fullname', fullNameNew);


    })
    fullName.addEventListener('blur', () => {
        checkEmpty('username', fullName);

    })
    password.addEventListener('blur', () => {
        checkEmpty('password', password);

    })
    email.addEventListener('blur', () => {
        checkEmpty('email', email);

    })
    passwordConfirmation.addEventListener('blur', () => {

        checkEmpty('passwordConfirmation', passwordConfirmation);
    })
    btnRegister.addEventListener('click', (e) => {

        const check1 = checkEmpty('username', fullName);
        const check2 = checkEmpty('fullname', fullNameNew);
        //const check2=checkEmpty('username',fullNameNew);
        const check3 = checkEmpty('password', password);
        const check4 = checkEmpty('email', email);
        const check5 = checkEmpty('passwordConfirmation', passwordConfirmation);
        const check = check1 && check2 && check4 && check3 && check5;
        console.log(check);
        if (!check) {
            e.preventDefault();
        } else {
            submitForm(signupForm);
        }

    })

}

//initiate the signup logic only when we are in signup page
const signupFormEl = document.querySelector('.signup_form');
if (signupFormEl) {
    signupValidation()
}
//?------------------------------END OF SIGNUP LOGIC-----------------------------------
function loginValidation() {
    fullName.addEventListener('blur', () => {

        if (fullName.value === "") {
            fullNameCheck = false;
            renderError("shouldn't be empty", fullName, 'username')
        } else {
            fullNameCheck = true
            removeError(fullName, 'username')
        }




    })
    password.addEventListener('blur', () => {
        checkEmpty('password', password);

    })

    btnLogin.addEventListener('click', (e) => {


        const validate = (emailCheck || fullNameCheck) && passwordCheck;

        if (!validate) {
            e.preventDefault();
            if (!passwordCheck) {
                checkEmpty('password', password);
            }
            if (!fullNameCheck) {
                renderError("shouldn't be empty", fullName, 'username')
            }



        } else {
            submitForm(signupForm);
        }

    })

}

if (loginForm) {
    loginValidation();
}
//---------------------------------------------------------------------------------
//?checkout validation
const checkoutPageValidation = () => {
    const phone = document.querySelector('#phone');
    const country = document.querySelector('#country');
    const city = document.querySelector('#city');
    const adressLine = document.querySelector('#address_line');
    const submitBtn = document.querySelector('[name=submit_order]');
    phone.addEventListener('blur', () => {
        checkEmpty("mobile", phone);
    })
    country.addEventListener('blur', () => {
        checkEmpty("country", country);

    })
    city.addEventListener('blur', () => {
        checkEmpty("city", city);
    })
    adressLine.addEventListener('blur', () => {
        checkEmpty("adressLine", adressLine);
    })
    submitBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const check1 = checkEmpty("mobile", phone);
        const check2 = checkEmpty("city", city);
        const check3 = checkEmpty("country", country);
        const check4 = checkEmpty("adressLine", adressLine);
        const check = check1 && check2 && check4 && check3
        if (check) {
            submitForm(checkoutForm)
        }



    })


}
const checkOutAdminUser=()=>{
    const fullName=document.querySelector('[name=user_name]');
    const email=document.querySelector('[name=user_email]');
    const password=document.querySelector('[name=password]');
    const btnSubmit=document.querySelector('[name=submit]');
    fullName.addEventListener('blur',()=>{
        checkEmpty("fullName",fullName);
        
    })
    email.addEventListener('blur',()=>{
        checkEmpty('emailAdmin',email);
    })
    password.addEventListener('blur',()=>{
        checkEmpty('password',password);
    })
    btnSubmit.addEventListener('click',(e)=>{
        const check1=checkEmpty("fullName",fullName);
        const check2=checkEmpty('emailAdmin',email);
        const check3=checkEmpty('password',password);
        const check=check1 && check2 &check3;
        if(!check){
            e.preventDefault();
        }
        if(check){
            submitForm(userAdminForm);
        }
    })
   
}

if (checkoutForm) {
    checkoutPageValidation();
}
if(userAdminForm){
    checkOutAdminUser();
    
   
}