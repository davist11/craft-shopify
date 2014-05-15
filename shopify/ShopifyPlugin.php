<?php
namespace Craft;

class ShopifyPlugin extends BasePlugin
{
	function getName()
	{
		 return Craft::t('Shopify');
	}

	function getVersion()
	{
		return '1.0';
	}

	function getDeveloper()
	{
		return 'Trevor Davis';
	}

	function getDeveloperUrl()
	{
		return 'http://trevordavis.net';
	}

	protected function defineSettings()
	{
		return array(
			'apiKey' => array(AttributeType::String, 'required' => true, 'label' => 'API Key'),
			'password' => array(AttributeType::String, 'required' => true, 'label' => 'Password'),
			'secret' => array(AttributeType::String, 'required' => true, 'label' => 'Secret'),
			'hostname' => array(AttributeType::String, 'required' => true, 'label' => 'Hostname')
		);
	}

	public function getSettingsHtml()
	{
		return craft()->templates->render('shopify/_settings', array(
			'settings' => $this->getSettings()
		));
   }
}