<?php
/**
 * OpenMage
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available at https://opensource.org/license/osl-3-0-php
 *
 * @category   Mage
 * @package    Mage_Core
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://www.magento.com)
 * @copyright  Copyright (c) 2017-2022 The OpenMage Contributors (https://www.openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * @category   Mage
 * @package    Mage_Core
 */
class Mage_Core_Model_Design_Source_Design extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    protected $_isFullLabel = false;

    /**
     * Setter
     * Add package name to label
     *
     * @param bool $isFullLabel
     * @return $this
     */
    public function setIsFullLabel($isFullLabel)
    {
        $this->_isFullLabel = $isFullLabel;
        return $this;
    }

    /**
     * Getter
     *
     * @return bool
     */
    public function getIsFullLabel()
    {
        return $this->_isFullLabel;
    }

    /**
     * Retrieve All Design Theme Options
     *
     * @param bool $withEmpty add empty (please select) values to result
     * @return array
     */
    public function getAllOptions($withEmpty = true)
    {
        if (is_null($this->_options)) {
            $design = Mage::getModel('core/design_package')->getThemeList();
            $options = [];
            foreach ($design as $package => $themes) {
                $packageOption = ['label' => $package];
                $themeOptions = [];
                foreach ($themes as $theme) {
                    $themeOptions[] = [
                        'label' => ($this->getIsFullLabel() ? $package . ' / ' : '') . $theme,
                        'value' => $package . '/' . $theme
                    ];
                }
                asort($themeOptions);
                $packageOption['value'] = $themeOptions;
                $options[] = $packageOption;
            }
            $this->_options = $options;
        }
        $options = $this->_options;
        asort($options);

        if ($withEmpty) {
            array_unshift($options, [
                'value' => '',
                'label' => Mage::helper('core')->__('-- Please Select --')]);
        }
        return $options;
    }

    /**
     * Get a text for option value
     *
     * @param string|int $value
     * @return string
     */
    public function getOptionText($value)
    {
        $options = $this->getAllOptions(false);

        return $value;
    }
}
