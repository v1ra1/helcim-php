<?php
/**
 * User: Viral
 * Date: 4/13/2019
 */

class Helcim_Inventory
{

    private $xml;

    public function __construct(Helcim $master)
    {
        $this->master = $master;
    }

    /**
     * @reference https://www.helcim.com/support/article/626-helcim-commerce-api-view-a-product/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  productId	            Integer	    Yes (or)	You can provide either product ID or product SKU to retrieve a product.
        sku	                    String	    Yes (or)	You can provide either product ID or product SKU to retrieve a product.
     * @return $this
     */
    public function viewProduct($productId = null, $sku = null, $params = array())
    {

        if(!isset($productId) && !isset($sku)) {
            $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> \$productId or \$sku is required");
        }

        if(is_null($productId)) {
            $required_array['productId'] = $productId;
        } else {
            $required_array['sku'] = $sku;
        }
        if(is_array($params) && !empty($params)) {
            $params = array_merge($params, $required_array);
        } else {
            $params = $required_array;
        }

        $this->xml = $this->master->call('productView', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/639-helcim-commerce-api-add-or-edit-a-product/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  name	                String	    Yes	        The product name.
        productId	            Integer	    No	        If you do not enter a product ID, you will add a product.  If you do enter a product ID, you will edit an existing product
        categoryId	            Integer	    No	        The category ID.
        brandId	                Integer	    No	        The brand ID.
        description	            String 	    No	        The product description.
        sku	                    Integer	    No	        The product sku.
        barcode	                String	    No	        The product barcode.
        availability	        Integer	    No	        1 or 0 - Whether the product is available for sale.
        availabilityOnline	    Integer	    No	        1 or 0 - Whether the product is available for sale online.
        featured	            Integer	    No	        1 or 0 - Whether the product is featured (front page) item online.
        price	                Decimal	    No	        The product price.
        salePrice	            Decimal	    No	        The product sale price.
        weight	                Decimal	    No	        The product weight - based on Helcim Commerce Unit of Measurement (UoM) account settings.
        dimensionW	            Decimal	    No	        The product width- based on Helcim Commerce Unit of Measurement (UoM) account settings.
        dimensionL	            Decimal	    No	        The product length - based on Helcim Commerce Unit of Measurement (UoM) account settings.
        dimensionH	            Decimal	    No	        The product height - based on Helcim Commerce Unit of Measurement (UoM) account settings.
        shippingExempt	        Integer	    No	        1 or 0 - Whether the product is exempt from shipping fees.
        taxExempt	            Integer	    No	        1 or 0 - Whether the product is exempt from taxes.
        unitOfMeasure	        String	    No	        The unit of measurement.
        commodityCode	        String	    No	        The commodity code.
        seoURL	                String	    No	        The SEO URL location.
        seoDescription	        String	    No	        The SEO description.
        seoTags	                String	    No	        The SEO tags.
     *
     * @return $this
     */
    public function addOrEditProduct($name, $params = array())
    {
        $required_array = array(
            'name' => $name
        );
        foreach($required_array AS $k => $required) {
            if(!isset($required)) {
                $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> \$$k is required");
            }
        }

        if(is_array($params) && !empty($params)) {
            $params = array_merge($params, $required_array);
        } else {
            $params = $required_array;
        }

        $this->xml = $this->master->call('productEdit', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/641-helcim-commerce-api-update-product-inventory/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  productId	            Integer	    Yes	        The product ID.
        stockChange	            Integer	    Yes	        The amount of units the inventory is changing by (- for decrease).
        note	                String	    Yes	        The description of the inventory change
     *
     * @return $this
     */
    public function updateProduct($productId, $stockChange, $note, $params = array())
    {
        $required_array = array(
            'productId' => $productId,
            'stockChange' => $stockChange,
            'note' => $note
        );
        foreach($required_array AS $k => $required) {
            if(!isset($required)) {
                $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> \$$k is required");
            }
        }

        if(is_array($params) && !empty($params)) {
            $params = array_merge($params, $required_array);
        } else {
            $params = $required_array;
        }

        $this->xml = $this->master->call('inventoryUpdate', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/642-helcim-commerce-api-list-products/
     *
     * @return $this
     */
    public function listProducts($params = array())
    {
        $this->xml = $this->master->call('productView', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/643-helcim-commerce-api-list-detailed-products/
     *
     * @return $this
     */
    public function listDetailedProducts($params = array())
    {
        $this->xml = $this->master->call('productSearchDetail', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/644-helcim-commerce-api-view-a-category/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  categoryId	            Integer	    Yes 	    The category ID you wish to view.
     *
     * @return $this
     */
    public function viewCategory($categoryId, $params = array())
    {
        $required_array = array(
            'categoryId' => $categoryId
        );
        foreach($required_array AS $k => $required) {
            if(!isset($required)) {
                $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> \$$k is required");
            }
        }

        if(is_array($params) && !empty($params)) {
            $params = array_merge($params, $required_array);
        } else {
            $params = $required_array;
        }

        $this->xml = $this->master->call('categoryView', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/645-helcim-commerce-api-list-categories/
     *
     * @return $this
     */
    public function listCategories($params = array())
    {
        $this->xml = $this->master->call('categoriesView', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/646-helcim-commerce-api-view-a-brand/
     *
     *  FIELD NAME              TYPE        REQUIRED    DESCRIPTION
     *  brandId	                Integer	    Yes 	    The brand ID you wish to view.
     *
     * @return $this
     */
    public function viewBrand($brandId, $params = array())
    {
        $required_array = array(
            'brandId' => $brandId
        );
        foreach($required_array AS $k => $required) {
            if(!isset($required)) {
                $this->master->castError(__CLASS__." Error: ".__FUNCTION__." -> \$$k is required");
            }
        }

        if(is_array($params) && !empty($params)) {
            $params = array_merge($params, $required_array);
        } else {
            $params = $required_array;
        }

        $this->xml = $this->master->call('brandView', $params);
        return $this;
    }

    /**
     * @reference https://www.helcim.com/support/article/647-helcim-commerce-api-list-brands/
     *
     * @return $this
     */
    public function listBrands($params = array())
    {
        $this->xml = $this->master->call('brandsView', $params);
        return $this;
    }

    public function getData()
    {
        return $this->xml;
    }
}