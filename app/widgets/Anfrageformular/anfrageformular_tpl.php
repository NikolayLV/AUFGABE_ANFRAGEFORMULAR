<div class="request_form">
	<form class="request_form_container" id="anfrageForm">
		<div class="vacation_block">
			<h1 class="form_headline">Ihre Urlaubsdaten</h1>

			<div class="flatpickr input_section">
				<p class="form_bodytext thin">Reisezeitraum *</p>
				<?php
					echo $this->getInput([
						'type' => 'number',
						'name' => 'Reisezeitraum',
						'id' => 'reisezeitraum',
						'class' => 'default_input icon-calendar',
						'required' => true,
						'maxlength' => 50
					]);
					echo $this->getTooltip($id = 'reisezeitraum', $tooltipText = 'Gegeben Sie einen Reisedatum ein.');
				?>
				<script>
					/**
					 * For the mobile version - a single calendar, for the desktop version - a double calendar.
					 */
					const showMonths = window.innerWidth < 768 ? 1 : 2;

					flatpickr("#reisezeitraum", {
						mode: "range",
						showMonths: showMonths,
						dateFormat: "d. M Y",
						locale: {
							firstDayOfWeek: 1,
							rangeSeparator: " bis ",
						}
					});
				</script>
			</div>

			<div class="input_section">
				<p class="form_bodytext">Anzahl Erwachsene *</p>
				<?php
					echo $this->getInput([
						'type' => 'number',
						'name' => 'Anzahl Erwachsene',
						'id' => 'anzahl_erwachsene',
						'class' => 'default_input',
						'required' => true,
						'maxlength' => 50,
						'data-tooltip' => 'Fülle dieses Feld aus'
					]);
					echo $this->getTooltip($id = 'anzahl_erwachsene', $tooltipText = 'Gegeben Sie eine Positiv Zahl ein.');
				?>
			</div>

		</div>
		<div class="children_block">
			<h1 class="form_headline">Kinder</h1>
			<p class="children_bodytext">Als Familienspezialist ist es uns wichtig, Ihnen ein maßgeschneidertes Angebot
				zu übermitteln. Bitte
				geben Sie uns daher Vornamen und das Alter ihrer Kinder/ihren Kindes an.</p>
			<div id="children_container">
				<div class="input_section">
					<p class="form_bodytext">Name des Kindes *</p>
					<?php
						echo $this->getInput([
							'type' => 'text',
							'name' => 'Name des Kindes',
							'id' => 'name_kindes',
							'class' => 'default_input',
							'required' => true,
							'maxlength' => 50,
							'data-tooltip' => 'Fülle dieses Feld aus'
						]);
						echo $this->getTooltip($id = 'name_kindes', $tooltipText = 'Gegeben Sie einen gültigen Namen ein.');
					?>
				</div>
				<div class="input_section">
					<p class="form_bodytext">Geburtstag *</p>
					<div class="birthday_block" id="children_container">
						<?php
							$attributes = [
								'id' => 'birthday_input',
								'name' => 'Geburtstag',
								'class' => 'birthday_input icon-arrow',
								'required' => true,
							];

							echo $this->getBirthdayForm($attributes, 1); ?>
						<?php
							$attributes = [
								'id' => 'birthday_input',
								'name' => 'Geburtstag',
								'class' => 'birthday_input icon-arrow',
								'required' => true,
							];

							echo $this->getBirthdayForm($attributes, 2); ?>
						<?php
							$attributes = [
								'id' => 'birthday_input',
								'name' => 'Geburtstag',
								'class' => 'birthday_input icon-arrow',
								'required' => true,
							];

							echo $this->getBirthdayForm($attributes, 3); ?>
					</div>
				</div>
			</div>
			<div class="actions_child_block">
				<button type="button" class="add_child_button" onclick="addChildFields()">KIND HINZUFÜGEN</button>
				<svg width="20px" height="26px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg"
					 stroke="#e00000">
					<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
					<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC"
					   stroke-width="0.24000000000000005"></g>
					<g id="SVGRepo_iconCarrier">
						<path d="M6 12H18M18 12L13 7M18 12L13 17" stroke="#AA2E24" stroke-width="1.176"
							  stroke-linecap="round" stroke-linejoin="round"></path>
					</g>
				</svg>
				<button type="button" class="remove_child_button" onclick="removeChildFields()">Kind entfernen</button>
			</div>

		</div>
		<div class="contact_block">
			<h1 class="form_headline">Ihre Kontaktdaten</h1>
			<div class="input_section">
				<p class="form_bodytext">Vorname *</p>
				<?php
					echo $this->getTextInput($id = 'vorname', $name = 'Vorname');
					echo $this->getTooltip($id = 'vorname', $tooltipText = 'Gegeben Sie eine gültige Vorname ein.');
				?>
			</div>
			<div class="input_section">
				<p class="form_bodytext">Nachname *</p>
				<?php
					echo $this->getTextInput($id = 'nachname', $name = 'Nachname',);
					echo $this->getTooltip($id = 'nachname', $tooltipText = 'Gegeben Sie eine gültige Nachname ein.');
				?>
			</div>
			<div class="input_section">
				<p class="form_bodytext">Geschlecht *</p>
				<?php
					$attributes = [
						'id' => 'geschlecht',
						'name' => 'Geschlecht',
						'class' => 'default_input icon-arrow',
						'required' => true,
					];

					$options = [
						'1' => 'Männlich',
						'2' => 'Weiblich'
					];

					echo $this->getDropdownList($attributes, $options);
					echo $this->getTooltip($id = 'geschlecht', $tooltipText = 'Wählen Sie eine Geschlecht aus.');
				?>
			</div>
			<div class="input_section">
				<p class="form_bodytext">Email *</p>
				<?php
					echo $this->getInput([
						'type' => 'Email',
						'name' => 'Email',
						'id' => 'email',
						'class' => 'default_input',
						'required' => true,
						'maxlength' => 50,
						'data-tooltip' => 'Fülle dieses Feld aus'
					]);
					echo $this->getTooltip($id = 'email', $tooltipText = 'Gegeben Sie eine gültige Email ein.');
				?>
			</div>
			<div class="input_section">
				<p class="form_bodytext">Land *</p>
				<?php
					echo $this->getCountriesDropdownList();
					echo $this->getTooltip($id = 'land', $tooltipText = 'Wählen Sie eine Land aus.');
				?>
			</div>
			<div class="input_section">
				<p class="form_bodytext">PLZ *</p>
				<?php
					echo $this->getInput([
						'type' => 'number',
						'name' => 'PLZ',
						'id' => 'plz',
						'class' => 'default_input',
						'required' => true,
						'maxlength' => 5,
						'data-tooltip' => 'Fülle dieses Feld aus'
					]);
					echo $this->getTooltip($id = 'plz', $tooltipText = 'Gegeben Sie einen gültigen PLZ ein.');
				?>
			</div>
			<div class="input_section">
				<p class="form_bodytext">Stadt *</p>
				<?php
					echo $this->getTextInput($id = 'stadt', $name = 'Stadt');
					echo $this->getTooltip($id = 'stadt', $tooltipText = 'Gegeben Sie eine gültige Stadt ein.');
				?>
			</div>
			<div class="input_section">
				<p class="form_bodytext">Straße *</p>
				<?php
					echo $this->getTextInput($id = 'strasse', $name = 'Strasse');
					echo $this->getTooltip($id = 'strasse', $tooltipText = 'Gegeben Sie eine gültige Straße ein.');
				?>
			</div>
			<div class="input_section">
				<p class="form_bodytext thin">Telefon </p>
				<?php
					echo $this->getInput([
						'type' => 'tel',
						'name' => 'Telefon',
						'id' => 'telefon',
						'class' => 'default_input',
						'maxlength' => 14,
						'data-tooltip' => 'Fülle dieses Feld aus'
					]);

				?>
			</div>
			<div class="input_section">
				<p class="form_bodytext thin">Fragen oder Wünsche </p>
				<textarea class="default_textarea" id="fragen" name="Fragen oder Wünsche" rows="5"
						  maxlength="1000"></textarea>
			</div>
		</div>

		<div class="error_block">
			<h1>Beim Senden des Formulars ist ein Fehler aufgetreten!</h1>
			<p>Die ungültigen Felder wurden hervorgehoben.</p>
		</div>
		<div class="submit_block">
			<button class="submit_button" type="submit">ANFRAGE ABSENDEN</button>
		</div>
	</form>
</div>