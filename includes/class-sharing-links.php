<?php
class Sharing_Links {
	private $title;
	private $link;
	private $services = array();

	public function __construct() {
		$this->addService('email', 		'mailto:?subject={title}&body={permalink}');
		$this->addService('facebook', 	'https://www.facebook.com/sharer/sharer.php?u={permalink}');
		$this->addService('twitter', 	'https://twitter.com/home?status={title} {permalink}');
		$this->addService('plus', 		'https://plus.google.com/share?url={permalink}');
		$this->addService('linkedin', 	'https://www.linkedin.com/shareArticle?mini=true&url={permalink}&title={title}');
	}

	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}

	public function setLink($link) {
		$this->link = $link;
		return $this;
	}

	public function addService($name, $url) {
		$this->services[$name] = $url;
	}

	public function getService($name) {
		return isset($this->services[$name]) ? $this->applyReplacement($this->services[$name]) : null;
	}

	public function getNonService($url, $name = '', $add = false) {
		if (true === $add && $name != '') {
			$this->addService($name, $url);
			$service = $this->applyReplacement($this->services[$name]);
		} else {
			$service = $this->applyReplacement($url);
		}

		return $service;
	}

	public function getServices() {
		$services = $this->services;

		foreach ($services as &$service) {
			$service = $this->applyReplacement($service);
		}

		return (object) $services;
	}

	private function applyReplacement($url) {
		return str_replace(array('{title}', '{permalink}'), array($this->title, $this->link), $url);
	}
}