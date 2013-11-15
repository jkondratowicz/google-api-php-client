<?php

/**
 * Service definition for Google_WebmasterTools.
 *
 * <p>
 * The Google Webmaster Tools Developer API.
 * </p>
 *
 * <p>
 * For more information about this service, see the
 * <a href="https://developers.google.com/webmaster-tools/" target="_blank">API Documentation</a>
 * </p>
 *
 * @author Google, Inc.
 * @author Jan Kondratowicz
 */
class Google_WebmasterToolsService extends Google_Service {
	private $client;

	/**
	 * Constructs the internal representation of the Webmaster Tools service.
	 *
	 * @param Google_Client $client
	 */
	public function __construct(Google_Client $client) {
		$this->servicePath = 'webmasters/tools/feeds/';
		$this->version = 'v2';
		$this->serviceName = 'webmasterTools';
		
		$this->client = $client;
	}

	public function listWebsites() {
		$methodPath = 'sites';
		$servicePath = $this->servicePath;
		
		$url = Google_REST::createRequestUri($servicePath, $methodPath, array());
				
		$httpRequest = new Google_HttpRequest($url, 'GET', null, null);
		
		$val = $this->client->getIo()->authenticatedRequest($httpRequest);

		try {
			$response = simplexml_load_string($val->getResponseBody());
			$websites = array();
			$elements = $response->children();
			foreach($elements as $v) {
				if($v->getName() === 'entry') {
					$websites[] = $v;
				}
			}
			return $websites;
		} catch(Exception $e) {
			return array();
		}
	}
}