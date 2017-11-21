<?php

namespace Craft;

class SectionField_SectionFieldType extends BaseFieldType implements IPreviewableFieldType {

	public function getName() {
		return Craft::t('Section');
	}

	public function getSettingsHtml() {
		return craft()->templates->render('sectionField/settings', array(
			'settings' => $this->getSettings(),
			'sections' => $this->getSections(),
		));
	}

	public function defineContentAttribute() {
		return array(
			AttributeType::Mixed,
			'maxLength' => 2000, // Arbitrary value. Section IDs are stored as a json array of, and would require quite a few IDS to hit 2000 characters.
		);
	}

	public function getInputHtml($name, $value) {
		$settingsections = $this->getSettings()->sections; // Retrieve configured section whitelist.
		$settingsections = array_flip($settingsections); // Flip array so it is keyed by section ID.
		$settingsections[''] = true; // Add a blank valued entry in, in case the field's options make a 'None' selection available.
		$sections = $this->getSections();
		if (!$this->getSettings()->multiple && !$this->model->required) { // Add a 'None' option specifically for optional, single value fields.
			$sections = array_merge(array('' => 'None'), $sections);
		}
		$this->getSettings()->sections = array_intersect_key($sections, $settingsections); // Discard any sections not available within the whitelist.
		return craft()->templates->render('sectionField/input', array(
			'name' => $name,
			'value' => $value,
			'settings' => $this->getSettings(),
		));
	}

	protected function defineSettings() {
		return array(
			// Whitelisted sections that may be chosen by individual field instances.
			'sections' => array(
				AttributeType::Mixed,
				'default' => [],
			),
			// Whether or not multiple sections can be selected.
			'multiple' => array(
				AttributeType::Bool,
				'default' => false,
			),
		);
	}

	public function getTableAttributeHtml($value) {
		if (!isset($value) && !$value) { // If there is no value, or it is blank, simply display 'None'.
			return Craft::t('None');
		}

		// Otherwise, create a comma-delimited list of the sections.
		if (!is_array($value)) { // Single values need to be wrapped in an array.
			$value = array($value);
		}
		$out = array();
		foreach ($value as $val) {
			$section = craft()->sections->getSectionById($val);
			if ($section) {
				$out[] = $section->getAttribute('name');
			}
		}
		return implode(', ', $out);
	}

	/**
	 * Retrieve a set of all sections, id => name pairs.
	 */
	private function getSections() {
		$sections = array();
		foreach (craft()->sections->getAllSections() as $section) {
			$sections[$section->id] = $section->name;
		}
		return $sections;
	}
}
