<?php

namespace Craft;

class ShopifyService extends BaseApplicationComponent
{
	protected $apiKey;
	protected $password;
	protected $secret;
	protected $hostname;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$settings = craft()->plugins->getPlugin('shopify')->getSettings();

		$this->apiKey = $settings->apiKey;
		$this->password = $settings->password;
		$this->secret = $settings->secret;
		$this->hostname = $settings->hostname;
	}

	/**
	 * Get products from Shopify
	 *
	 * @return array Array of Shopify Products
	 */
	public function getProducts($options = array())
	{
		$query = http_build_query($options);
		$url = $this->_getShopifyUrl('admin/products.json?' . $query);

		return $this->_getShopifyResponse($url, 'products');
	}

	/**
	 * Get specific product from Shopify
	 *
	 * @param array $options Array of options: id, fields
	 * @return array Shopify Product
	 */
	public function getProductById($options = array())
	{
		$id = $options['id'];
		$fields = isset($options['fields']) ? '?fields=' . $options['fields'] : '';
		$url = $this->_getShopifyUrl('admin/products/' . $id . '.json' . $fields);

		return $this->_getShopifyResponse($url, 'product');
	}

	/**
	 * Get specific product from Shopify
	 *
	 * @param string $endpoint API endpoint
	 * @return string Full URL to make Shopify Request
	 */
	private function _getShopifyUrl($endpoint)
	{
		return 'https://' . $this->apiKey . ':' . $this->password . '@' . $this->hostname . '/' . $endpoint;
	}


	/**
	 * Get response from Shopify API endpoint
	 *
	 * @param string $url URL to request from Shopify
	 * @param string $key Key to pluck from json response
	 * @return array Shopify response at $key index
	 */
	priate function _getShopifyResponse($url, $key)
	{
		try {
			$client = new \Guzzle\Http\Client();
			$request = $client->get($url);
			$response = $request->send();

			if (!$response->isSuccessful()) {
				return;
			}

			$items = $response->json();

			return $items[$key];
		} catch(\Exception $e) {
			return;
		}
	}
}