const init = () => {
    const contactForm = document.querySelector("#cf");
    contactForm.addEventListener("submit", handleFormSubmit);
    setValidationMessages();
};

const setValidationMessages = () => {
    const validations = {
        fname: "Please enter your first name (letters only)",
        lname: "Please enter your last name (letters only)",
        email: "Please enter a valid email address",
        subject: "Please enter a subject (numbers, letters, spaces, underscores and dashes only)",
        message: "Please enter a message (numbers, letters, spaces, underscores and dashes only)"
    };

    for (const [key, value] of Object.entries(validations)) {
        const inputField = document.getElementById(key);
        inputField.addEventListener("input", function(e){
            inputField.setCustomValidity("");
        });
        inputField.addEventListener("invalid", function(e){
            inputField.setCustomValidity(value);
        });
    }
}

const handleFormSubmit = async (e) => {
    e.preventDefault();

    const form = e.currentTarget;
    const url = "/tools/ajax/";
    const formStatusDisplay = form.querySelector(".form-status");
    const formStatusMessage = formStatusDisplay.querySelector("p");

    formStatusDisplay.classList.add("form-status--busy");

    try {
        const formData = new FormData(form);
		const response = await postFormData({ url, formData });
        form.reset();
        formStatusMessage.textContent = response.data;
        formStatusDisplay.classList.remove("form-status--busy");
        formStatusDisplay.classList.add("form-status--active");

        const hideStatus = setTimeout(() => {
            formStatusDisplay.classList.remove("form-status--active");
            clearTimeout(hideStatus);
          }, 3000);

	} catch (error) {
		console.error(error);
	}

};

const postFormData = async ({ url, formData }) => {
    const plainFormData = Object.fromEntries(formData.entries());
    const formDataUrlEncoded = new URLSearchParams(plainFormData);
    const fetchOptions = {
		method: "POST",
		headers: {
			"X-Requested-With": "XMLHttpRequest"
		},
		body: formDataUrlEncoded,
	};
    const response = await fetch(url, fetchOptions);

    if (!response.ok) {
		const errorMessage = await response.text();
		throw new Error(errorMessage);
	}
    return response.json();
}

export const footer = {
    init: init
}