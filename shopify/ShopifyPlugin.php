<?php
namespace Craft;

class ShopifyPlugin extends BasePlugin
{
	public function getName()
	{
		 return Craft::t('Shopify');
	}

	public function getDescription()
	{
		return 'Integrate with the Shopify API.';
	}

	public function getVersion()
	{
		return '1.0.2';
	}

	public function getSchemaVersion()
	{
		return '1.0.0';
	}

	public function getDeveloper()
	{
		return 'Trevor Davis';
	}

	public function getDeveloperUrl()
	{
		return 'http://trevordavis.net';
	}

	public function getDocumentationUrl()
	{
		return 'https://github.com/davist11/craft-shopify';
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