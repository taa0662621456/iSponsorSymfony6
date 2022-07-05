
function genPassword (){

    let password = document.getElementById("password")
    let chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    let passwordLength = 12;

    for (let i = 0; i <= passwordLength; i++) {
        let randomNumber = Math.floor(Math.random() * chars.length);
        password += chars.substring(randomNumber, randomNumber +1);
    }

    document.getElementById("password").value = password;

}

function copyPassword() {
    //TODO: создать кнопку и повесить функцию в генерации пароля в форме регистрации
    let copyText = document.getElementById("password");
    copyText.select();
    document.execCommand("copy");
}
