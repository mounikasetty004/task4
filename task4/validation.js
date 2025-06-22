function validateForm() {
    const username = document.querySelector("[name='username']").value;
    const password = document.querySelector("[name='password']").value;

    if (username.length < 3 || password.length < 6) {
        alert("Username must be at least 3 characters, password at least 6.");
        return false;
    }
    return true;
}