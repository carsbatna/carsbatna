document.addEventListener("DOMContentLoaded", function() {
    const bookingForm = document.getElementById("booking-form");

    bookingForm.addEventListener("submit", function(event) {
        let isValid = true;
        // Example validation: check if the name field is empty
        const nameInput = document.getElementById("name");
        if (!nameInput.value.trim()) {
            alert("Please enter your name.");
            isValid = false;
        }

        // Add more validation checks as needed...

        if (!isValid) {
            event.preventDefault(); // Prevent form from submitting
        }
    });
});
function loadSpecialOffers() {
    fetch("special-offers.json")
        .then(response => response.json())
        .then(data => {
            const offersContainer = document.getElementById("special-offers");
            data.offers.forEach(offer => {
                const offerElement = document.createElement("div");
                offerElement.textContent = offer.description;
                offersContainer.appendChild(offerElement);
            });
        })
        .catch(error => console.error("Failed to load special offers:", error));
}

// Call this function when the page loads or when needed
loadSpecialOffers();
