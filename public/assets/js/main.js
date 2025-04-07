/**
 * Handles form validation, tooltips, and dynamic child input fields for the Anfrageformular.
 */
document.addEventListener('DOMContentLoaded', function () {
	const form = document.getElementById('anfrageForm');
	const errorBlock = document.querySelector('.error_block');
	const tooltips = form.querySelectorAll('.tooltip');

	form.setAttribute('novalidate', 'true');

	form.addEventListener('submit', function (e) {
		e.preventDefault();

		const fields = form.querySelectorAll('[required]');
		let formIsValid = true;
		let firstInvalidField = null;

		fields.forEach(field => {
			field.addEventListener('input', () => {
				if (field.checkValidity()) {
					field.classList.remove('invalid');
					let tooltipId = `tooltip_${field.id}`;
					let tooltip = document.getElementById(`${tooltipId}`);
					tooltip.style.opacity = '0';
				}
			});
		});

		fields.forEach(field => {
			field.classList.remove('invalid');

			if (!field.value && field.required) {
				formIsValid = false;
				field.classList.add('invalid');
				let tooltipId = `tooltip_${field.id}`;
				let tooltip = document.getElementById(`${tooltipId}`);
				field.addEventListener('mouseover', () => {
					if (tooltip && !field.value) {
						tooltip.style.opacity = '1';
					}
				});

				field.addEventListener('mouseout', () => {
					if (tooltip && !field.value) {
						tooltip.style.opacity = '0';
					}
				});

				if (!firstInvalidField) {
					firstInvalidField = field;
				}
			}

		});

		if (!formIsValid) {
			errorBlock.style.display = 'block';

			if (firstInvalidField) {
				firstInvalidField.reportValidity();
				firstInvalidField.focus();
			}

			scrollToError();
		} else {
			errorBlock.style.display = 'none';
			form.submit();
		}

	});

	/**
	 * Smoothly scrolls to the first invalid field in the form.
	 *
	 * @return {void}
	 */
	function scrollToError() {
		const firstInvalid = form.querySelector('.invalid');
		if (firstInvalid) {
			window.scrollTo({
				top: firstInvalid.offsetTop - 100,
				behavior: 'smooth'
			});
		}
	}
});


let childIndex = 1;

/**
 * Adds child fields for Kinder form
 *
 * @return {void}
 */
function addChildFields() {
	const container = document.getElementById('children_container');

	const childHTML = `
		<div class="input_section">
			<p class="form_bodytext">Name des Kindes *</p>
			<input type="text"
				   name="name_kindes_${childIndex}"
				   id="name_kindes_${childIndex}"
				   class="default_input"
				   required
				   maxlength="50">
			<span class="tooltip" id="tooltip_name_kindes_${childIndex}" style="opacity: 0;">Gegeben Sie einen gültigen Namen ein.</span>
		</div>

		<div class="input_section">
			<p class="form_bodytext">Geburtstag *</p>
			<div class="birthday_block">
				<select name="child_day_${childIndex}" class="birthday_input" required>
					<option value="" disabled selected>Tag</option>
					${generateOptions(1, 31)}
				</select>
				<select name="child_month_${childIndex}" class="birthday_input" required>
					<option value="" disabled selected>Monat</option>
					${generateMonthOptions()}
				</select>
				<select name="child_year_${childIndex}" class="birthday_input" required>
					<option value="" disabled selected>Jahr</option>
					${generateOptions(new Date().getFullYear(), 1900)}
				</select>
			</div>
		</div>
	`;

	container.insertAdjacentHTML('beforeend', childHTML);
	childIndex++;
}

/**
 * Removes child fields of Kinder form
 *
 * @return {void}
 */
function removeChildFields() {
	const container = document.getElementById('children_container');
	const children = container.querySelectorAll('.input_section');

	if (children.length < 2) return;

	container.removeChild(children[children.length - 1]);
	container.removeChild(children[children.length - 2]);

	childIndex = Math.max(0, childIndex - 1);
}

/**
 * Generates days for option at Dropdown List
 *
 * @param {string} start The starting day (e.g., 1).
 * @param {string} end The ending day (e.g., 31).
 * @return {string}
 */
function generateOptions(start, end) {
	let html = '';
	const step = start < end ? 1 : -1;
	for (let i = start; step > 0 ? i <= end : i >= end; i += step) {
		html += `<option value="${i}">${i}</option>`;
	}
	return html;
}

/**
 * Generates months for Option
 *
 * @return {string}
 */
function generateMonthOptions() {
	const months = [
		'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
		'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
	];
	return months.map((name, index) => `<option value="${index + 1}">${name}</option>`).join('');
}