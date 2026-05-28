
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("loginForm");

    if(form){
        form.addEventListener("submit", (e) => {
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            if(email === "" || password === ""){
                e.preventDefault();
                alert("Tous les champs sont obligatoires");
            }
        });
    }
});
