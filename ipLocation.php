<?php
class ipLocation {

	/* ------------------------------------- *\
			private
	\* ------------------------------------- */

	/* --- Var ---*/

	private $dir_name;
	private $filename;

	private $url_api;

	private $RPM; // requests per minute
	private $TBR; // smallest interval Time Between 2 Request in seconde
	private $ErrorOrNot = [
		"status" => false,
		"message" => ""
	];

	/* --- function  --- */

	/**
	 * fetch
	 * Fetch all raw informations form the api
	 * @return void
	 */
	private function fetch() {
		if ($this->ErrorOrNot["status"]) {
			file_put_contents($this->dir_name.$this->filename, time());
			$curl = curl_init($this->url_api);
			curl_setopt_array($curl, [
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_TIMEOUT => 1
			]);
			$data = curl_exec($curl);
			if (curl_getinfo($curl)["http_code"] != 200) {
				$this->ErrorOrNot = [
					"status" => false,
					"message" => "Curl Error: ".curl_getinfo($curl)["http_code"],
					"curl" => curl_getinfo($curl)
				];
				return false;
			} else {
				return $data;
			}
			curl_close($curl);
		}
	}

	/* ------------------------------------- *\
			public
	\* ------------------------------------- */

	/* --- Var ---*/

	/* --- function  --- */

	/**
	 * __construct
	 *
	 * @param  mixed $ip
	 * @param  mixed $requestPerMinute
	 *
	 * @var $ip -- an ip
	 * @var $requestPerMinute -- by default : 150 secondes
	 * 
	 * @return void
	 */
	public function __construct($ip = string, $requestPerMinute = null) {

		$this->dir_name = dirname(__FILE__).'/iplocation_tmp/'; // defined a temp dir
		if (!file_exists($this->dir_name)) { // if it doesn't exist, create it
			mkdir($this->dir_name);
		}

		$this->filename = 'last_query.tmp'; // defined the temp file
		if (!file_exists($this->dir_name.$this->filename)) { // if it doesn't exist, create it
			file_put_contents($this->dir_name.$this->filename, time()-1);
		}

		$this->RPM = is_null($requestPerMinute) ? 150 : $requestPerMinute; // defined how many request per minute 
		$this->TBR = $this->RPM/60; // defined the number between two request

		$ip = !empty($ip) ? $ip : ""; // defined the ip
		$this->url_api = "http://ip-api.com/json/".$ip;

		$last_query = file_get_contents($this->dir_name.$this->filename); // fetch the time of the last query

		if ((time() - $last_query) > $this->TBR) { // condition for the rpm
			$this->ErrorOrNot = [
				"status" => true,
				"message" => ""
			];
				return true;
		} else {
			$this->ErrorOrNot = [
				"status" => false,
				"message" => "150 request per minute"
			];
			return false;
		}
	}

	/**
	 * Return an array with the status (true/false) and if it's false, there is a message
	 * @return array 
	 */
	public function status() {
		return $this->ErrorOrNot;
	}

	/**
	 * Return api informations in an array
	 * @return array
	 */
	public function array() {
		$Answer = $this->fetch() ? json_decode($this->fetch(), 1) : false;
		return $Answer;
	}

	/**
	 * Return api informations in an object
	 * @return object
	 */
	public function object() {
		$Answer = $this->fetch() ? json_decode($this->fetch(), 0) : false;
		return $Answer;
	}

	/**
	 * Return api informations in JSON
	 * @return string
	 */
	public function json() {
		$Answer = $this->fetch() ? $this->fetch() : false;
		return $Answer;
	}

	/**
	 * Return api informations in XML
	 * @return string
	 */
	public function xml() {
		$Answer = $this->fetch() ? xmlrpc_encode($this->array()) : false;
		return $Answer;
	}

	/**
	 * Return api informations serialized
	 * @return string
	 */
	public function serialized() {
		$Answer = $this->fetch() ? serialize($this->array()) : false;
		return $Answer;
	}
}
?>