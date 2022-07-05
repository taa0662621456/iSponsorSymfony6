/**
 * Show_me_password
 */
function showMePassword() {
    const x = document.getElementById('show_me_password');
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
