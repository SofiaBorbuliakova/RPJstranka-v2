function sendMail(event) {
    event.preventDefault(); // zabráni reloadu stránky

    let parms = {
        meno: document.getElementById("meno").value,
        email: document.getElementById("email").value,
        telcislo: document.getElementById("telcislo").value,
        sprava: document.getElementById("sprava").value
    };

    emailjs
        .send("service_k52q7b4", "template_o4qqwts", parms)
        .then(
            function () {
                alert("Správa bola úspešne odoslaná");
            },
            function (error) {
                alert("Chyba pri odosielaní");
                console.log(error);
            }
        );
}
