<?php

namespace Craft;

class Shopify_ProductFieldType extends BaseFieldType
{
	public function getName()
	{
		return Craft::t('Shopify Product');
	}

	/**
	 * Get products from Shopify
	 *
	 * @return array Array of Shopify Products
	 */
	public function getInputHtml($name, $value)
	{
		$products = craft()->shopify->getProducts();

		foreach ($products as $product) {
			$options[] = array(
							'label' => $product['title'],
							'value' => $product['id']
						);
		}

		return craft()->templates->render('shopify/_select', array(
			'name' => $name,
			'value' => $value,
			'options' => $options
		));
	}
}