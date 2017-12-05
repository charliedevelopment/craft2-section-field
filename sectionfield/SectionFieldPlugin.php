<?php

namespace Craft;

class SectionFieldPlugin extends BasePlugin {

	public function getVersion() {
		return '1.0.1';
	}
	
	public function getSchemaVersion()
	{
		return '1.0.0';
	}

	public function getName() {
		return Craft::t('Section Field');
	}

	public function getDescription() {
		return Craft::t('Provides a field type that allows selection of sections.');
	}

	public function getDeveloper() {
		return 'Charlie Development';
	}

	public function getDeveloperUrl() {
		return 'http://charliedev.com/';
	}
	
	public function getDocumentationUrl()
	{
		return 'https://github.com/charliedevelopment/Craft2-Section-Field/blob/master/README.md';
	}
	
	public function getReleaseFeedUrl()
	{
		return 'https://raw.githubusercontent.com/charliedevelopment/Craft2-Section-Field/master/release.json';
	}	
}