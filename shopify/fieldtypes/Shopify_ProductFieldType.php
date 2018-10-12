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
	    $limit = 250;
	    $page = 1;
	    $fields = 'id,title';

		$productOptions = array('limit' => $limit, 'page' => $page, 'fields' => $fields);
		$getProducts = craft()->shopify->getProducts($productOptions);
		$products = $getProducts;

        if (count($getProducts) == $limit) {
            while (count($getProducts) > 0) {
                $page++;
                $productOptions = array('limit' => $limit, 'page' => $page, 'fields' => $fields);
                $getProducts = craft()->shopify->getProducts($productOptions);
                $products = array_merge($products, $getProducts);
            }
        }

		$options = array();
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