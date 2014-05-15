# Craft Shopify Plugin

Craft plugin to integrate with the Shopify API

## Installation

1. Move the ```shopify``` folder into your ```craft/plugins``` directory
2. Install the plugin in the Control Panel
3. Enter your Shopify Credentials in the Plugin settings

## Usage

### craft.shopify.getProducts

Retrieve all products from Shopify. You can pass in any parameters that are noted in the [products enpoint](http://docs.shopify.com/api/product#index). Example:

```
{% for product in craft.shopify.getProducts({ fields: 'title,variants', limit: 5 }) %}
	<div class="product">
		<h2>{{ product.title }}</h2>
		<ul>
			{% for variant in product.variants %}
				<li>{{ variant.title }} - ${{ variant.price }}</li>
			{% endfor %}
		</ul>
	</div>
{% endfor %}
```

### craft.shopify.getProductsVariants

This is just a slightly modified version of the getProducts method where the array keys are the product ID. So if you have a field named ```shopifyProduct``` which stores the Shopify product ID, you can access all the products' variants with a single API call.

```
{% set shopifyProducts = craft.shopify.getProductsVariants() %}

{% for entry in craft.entries({ section: 'product' }) %}
	<div class="product">
		<h2><a href="{{ entry.url }}">{{ entry.title }}</a></h2>

		{% if entry.shopifyProduct and shopifyProducts[entry.shopifyProduct] %}
			<ul>
				{% for variant in shopifyProducts[entry.shopifyProduct] %}
					<li>{{ variant.title }} - ${{ variant.price }}</li>
				{% endfor %}
			</ul>
		{% endif %}
	</div>
{% endfor %}
```

### craft.shopify.getProductById

Useful on product show pages to access Shopify product information. Useful to get a product price or create an [add to cart form](http://docs.shopify.com/manual/configuration/store-customization/page-specific/cart-page/adding-to-the-cart-from-a-remote-website#html). This hits the [single product endpoint](http://docs.shopify.com/api/product#show).

```
{% set shopify = craft.shopify.getProductById({ id: entry.shopifyProduct, fields: 'variants' }) %}

<form action="http://your.shopify.url/cart/add" method="post">
	<select name="id">
		{% for variant in shopify.variants %}
			<option value="{{ variant.id }}">{{ variant.title }} - ${{ variant.price }}</option>
		{% endfor %}
	</select>
	<input type="hidden" name="return_to" value="back">
	<button type="submit">Add to Cart</button>
</form>
```