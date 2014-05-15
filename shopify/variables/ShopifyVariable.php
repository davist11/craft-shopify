<?php

namespace Craft;

class ShopifyVariable
{
	public function getProducts($options = array())
	{
		return craft()->shopify->getProducts($options);
	}

	public function getProductById($options = array())
	{
		return craft()->shopify->getProductById($options);
	}

	public function getProductsVariants($options = array())
	{
		$products = craft()->shopify->getProducts($options);

		foreach ($products as $product) {
			$id = $product['id'];
			$variants = $product['variants'];
			$product_prices[$id]  = $variants;
		}

		return $product_prices;
	}
}