<?php

namespace Craft;

class Shopify_CustomCollectionFieldType extends BaseFieldType
{
	public function getName()
	{
		return Craft::t('Shopify Custom Collection');
	}

	/**
	 * Get collections from Shopify
	 *
	 * @return array Array of Shopify Collections
	 */
	public function getInputHtml($name, $value)
	{
		$customCollections = craft()->shopify->getCustomCollections();

		foreach ($customCollections as $collection) {
			$options[] = array(
							'label' => $collection['title'],
							'value' => $collection['id']
						);
		}

		return craft()->templates->render('shopify/_select', array(
			'name' => $name,
			'value' => $value,
			'options' => $options
		));
	}
}