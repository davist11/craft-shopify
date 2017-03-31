<?php
namespace Craft;

class Shopify_ProductModel extends BaseModel
{

	public function __toString()
	{
		return (string) $this->productId;
	}

	protected function defineAttributes()
	{
		return array(
			'productId' => AttributeType::Number,
		);
	}

	/**
	 * Get the product details
	 *
	 * @return string
	 */
	public function details($fields = '')
	{
		$options = array(
			'id' => $this->productId,
			'fields' => $fields
		);
		$product = craft()->shopify->getProductById($options);
		return $product;
	}

}