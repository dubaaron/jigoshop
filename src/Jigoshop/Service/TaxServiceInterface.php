<?php
namespace Jigoshop\Service;

use Jigoshop\Entity\Customer;
use Jigoshop\Entity\Product\Attributes;
use Jigoshop\Shipping\Method;


/**
 * Service calculating tax value for products.
 *
 * @package Jigoshop\Service
 */
interface TaxServiceInterface
{
	/**
	 * @param $product Attributes\Taxable|Attributes\Purchasable Product to calculate tax for.
	 * @return float Overall tax value.
	 */
	public function calculate(Attributes\Taxable $product);

	/**
	 * @param $product Attributes\Purchasable Product to calculate tax for.
	 * @param $taxClass string Tax class.
	 * @throws Exception When tax class is not found.
	 * @return float Tax value for selected tax class.
	 */
	public function get(Attributes\Purchasable $product, $taxClass);

	/**
	 * @param $product Attributes\Taxable|Attributes\Purchasable Product to calculate tax for.
	 * @param int $quantity Quantity of the product.
	 * @param Customer|null $customer Customer to calculate taxes for.
	 * @return array List of tax values per tax class.
	 */
	public function getAll(Attributes\Taxable $product, $quantity = 1, Customer $customer = null);

	/**
	 * @param Method $method Method to calculate tax for.
	 * @param $price float Price calculated for current cart.
	 * @param Customer $customer Customer to fetch shipping for.
	 * @return float Overall tax value.
	 */
	public function calculateShipping(Method $method, $price, Customer $customer = null);

	/**
	 * @param Method $method Method to calculate tax for.
	 * @param $price float Price calculated for current cart.
	 * @param $taxClass string Tax class.
	 * @param Customer $customer Customer to fetch shipping for.
	 * @return float Tax value for selected tax class.
	 */
	public function getShipping(Method $method, $price, $taxClass, Customer $customer = null);

	/**
	 * @return array List of available tax classes.
	 */
	public function getClasses();

	/**
	 * @param $taxClass string Tax class to get label for.
	 * @param Customer|null $customer Customer to calculate taxes for.
	 * @return string Tax class label
	 * @throws Exception When tax class is not found.
	 */
	public function getLabel($taxClass, $customer = null);

	/**
	 * Fetches and returns properly formatted list of tax rules.
	 *
	 * @return array List of rules.
	 */
	public function getRules();

	/**
	 * @param $rule array Rule to save.
	 * @return array Saved rule.
	 */
	public function save(array $rule);

	/**
	 * @param $ids array IDs to preserve.
	 */
	public function removeAllExcept($ids);
}
