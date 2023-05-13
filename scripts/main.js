const passwordInput = document.getElementById("password");
const togglePassword = document.getElementById("toggle-password");
const iconPassword = document.getElementById("icon-password");

togglePassword.addEventListener("click", () => {
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    iconPassword.classList.remove("bi-eye");
    iconPassword.classList.add("bi-eye-slash");
  } else {
    passwordInput.type = "password";
    iconPassword.classList.remove("bi-eye-slash");
    iconPassword.classList.add("bi-eye");
  }
});

