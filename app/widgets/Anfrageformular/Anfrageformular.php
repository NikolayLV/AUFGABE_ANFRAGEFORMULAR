<?php

	namespace app\widgets\Anfrageformular;

	use wfm\App;

	class Anfrageformular
	{

		/**
		 * @var array<int, string> Associative array of months
		 */
		protected $monate = [
			1 => "Januar", 2 => "Februar", 3 => "März",
			4 => "April", 5 => "Mai", 6 => "Juni",
			7 => "Juli", 8 => "August", 9 => "September",
			10 => "Oktober", 11 => "November", 12 => "Dezember"
		];

		/**
		 * @var string Path to the Anfrageformular template
		 */
		protected $tpl;

		/**
		 * Initializes the template path and triggers rendering
		 */
		public function __construct()
		{
			$this->tpl = __DIR__ . '/anfrageformular_tpl.php';
			$this->run();
		}

		/**
		 * Outputs the rendered HTML to the page
		 */
		protected function run()
		{
			echo $this->getHtml();
		}

		/**
		 * Returns the page's HTML
		 *
		 * @return string
		 */
		protected function getHtml(): string
		{
			ob_start();
			require_once $this->tpl;
			return ob_get_clean();
		}

		/**
		 * Generates an HTML <input> element with given attributes
		 *
		 * @param array $attributes - Attributes for input
		 * @return string
		 */
		protected function getInput(array $attributes = [])
		{
			$html = '<input';

			foreach ($attributes as $key => $value) {
				if (is_bool($value)) {
					if ($value) {
						$html .= ' ' . htmlspecialchars($key);
					}
				} else {
					$html .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($value) . '"';
				}
			}

			$html .= '>';

			return $html;
		}

		/**
		 * Returns Dropdown List
		 *
		 * @param array $attributes - Attributes for Select
		 * @param array $options - Options for Option
		 * @return string
		 */
		protected function getDropdownList(array $attributes = [], array $options = [])
		{

			$html = '<select';

			foreach ($attributes as $key => $value) {
				if (is_bool($value)) {
					if ($value) {
						$html .= ' ' . htmlspecialchars($key);
					}
				} else {
					$html .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($value) . '"';
				}
			}

			$html .= '>';
			$html .= '<option value="" disabled selected>Auswählen</option>';


			foreach ($options as $value => $label) {
				$html .= '<option value="' . htmlspecialchars($value) . '">' . htmlspecialchars($label) . '</option>';
			}

			$html .= '</select>';

			return $html;
		}

		/**
		 * Returns Dropdown List with countries
		 *
		 * @return void
		 */
		protected function getCountriesDropdownList()
		{
			$json = file_get_contents(__DIR__ . '/countries.json');
			$countries = json_decode($json, true);

			$priorityCodes = ['AT', 'DE', 'CH'];

			$priorityCountries = [];
			$otherCountries = [];

			foreach ($countries as $country) {
				if (in_array($country['code'], $priorityCodes)) {
					$priorityCountries[] = $country;
				} else {
					$otherCountries[] = $country;
				}
			}

			usort($otherCountries, function ($a, $b) {
				return strcmp($a['name'], $b['name']);
			});

			$html = '<select name="Landes" id="land" class="default_input icon-arrow" required>';
			$html .= '<option value="" disabled selected>Auswählen</option>';
			foreach ($priorityCountries as $country) {
				$html .= '<option value="' . htmlspecialchars($country['code']) . '">' . htmlspecialchars($country['name']) . '</option>';
			}

			$html .= '<option disabled>------------------------------</option>';

			foreach ($otherCountries as $country) {
				$html .= '<option value="' . htmlspecialchars($country['code']) . '">' . htmlspecialchars($country['name']) . '</option>';
			}

			$html .= '</select>';
			echo $html;
		}

		/**
		 * Returns Form with Dropdown lists for Birth date
		 *
		 * @param array $attributes - Attributes for Select
		 * @param int $type 1 = Day, 2 = Month, 3 = Year
		 * @return string
		 */
		protected function getBirthdayForm($attributes, $type)
		{
			$html = '<select';

			foreach ($attributes as $key => $value) {
				if (is_bool($value)) {
					if ($value) {
						$html .= ' ' . htmlspecialchars($key);
					}
				} else {
					$html .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($value) . '"';
				}
			}

			$html .= '>';

			switch ($type) {
				case 1:
					$html .= '<option value="" disabled selected>Tag</option>';
					for ($i = 1; $i <= 31; $i++) {
						$html .= "<option value=\"$i\">$i</option>\n";
					}
					break;

				case 2:
					$html .= '<option value="" disabled selected>Monat</option>';
					foreach ($this->monate as $num => $name) {
						$html .= "<option value=\"$num\">$name</option>\n";
					}
					break;

				case 3:
					$html .= '<option value="" disabled selected>Jahr</option>';
					$end = date("Y");
					for ($y = $end; $y >= 1900; $y--) {
						$html .= "<option value=\"$y\">$y</option>\n";
					}
					break;
			}

			$html .= '</select>';

			return $html;
		}

		/**
		 * Generates a <input type="text"> field with given ID and name
		 *
		 * @param string $id - Input's ID
		 * @param string $name - Input's Name
		 * @return string
		 */
		protected function getTextInput($id, $name)
		{
			$html = '<input type="text" class="default_input"';

			$html .= ' id="' . $id . '" name="' . $name . '"';
			$html .= 'required="" maxlength="50"';

			$html .= '>';

			return $html;
		}

		/**
		 * Generates a tooltip span element
		 *
		 * @param string $id - Tooltips's ID
		 * @param string $tooltipText - Text for tooltip
		 * @return string
		 */
		protected function getTooltip($id, $tooltipText)
		{
			return '<span class="tooltip" id="tooltip_' . $id . '">' . $tooltipText . '</span>';
		}
	}