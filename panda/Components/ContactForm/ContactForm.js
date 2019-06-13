//Document ready
$(function() {
	fakePlaceholder();
});

//Fake placeholder
function fakePlaceholder() {
	var formInputs = document.querySelectorAll(".contact-form-top input"),
		i;

	for (i = 0; i < formInputs.length; ++i) {
		formInputs[i].addEventListener(
			"focusin",
			function() {
				placeholderSetActive(this);
			},
			false
		);

		formInputs[i].addEventListener(
			"focusout",
			function() {
				placeholderSetPassive(this);
			},
			false
		);
	}
}

//Placeholder set active
function placeholderSetActive(input) {
	input.parentNode.querySelector(".fake-placeholder").classList.add("js-active");
}

//Placeholder set passive
function placeholderSetPassive(input) {
	if (input.value === "") {
		input.parentNode.querySelector(".fake-placeholder").classList.remove("js-active");
	}
}
