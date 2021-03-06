<?php declare(strict_types=1);
/**
 * DISCLAIMER
 * Do not edit or add to this file if you wish to upgrade the modules
 * in the Darkstar Magento 2 Suite to newer versions in the future.
 *
 * @category  Iods
 * @package   Iods_Core
 * @version   1.1.1
 * @author    Rye Miller <rye@drkstr.dev>
 * @copyright Copyright (c) 2020, Rye Miller (http://ryemiller.io)
 * @license   MIT (https://en.wikipedia.org/wiki/MIT_License)
 */

namespace Iods\Core\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Component\ComponentRegistrarInterface;

/**
 * Class Data
 * @package Iods\Core\Helper
 */
class Data extends AbstractHelper
{
    /** @var ComponentRegistrarInterface */
    private $componentRegistrarInterface;

    /**
     * @param Context $context
     * @param ComponentRegistrarInterface $componentRegistrarInterface
     */
    public function __construct(
        Context $context,
        ComponentRegistrarInterface $componentRegistrarInterface
    ) {
        parent::__construct($context);

        $this->componentRegistrarInterface = $componentRegistrarInterface;
    }

    /**
     * @return string
     */
    public function getModuleVersion(): string
    {
        $dir = $this->componentRegistrarInterface->getPath(
            ComponentRegistrar::MODULE,
            'Iods_Core'
        );

        $data = file_get_contents($dir . '/composer.json');
        $data = json_decode($data, true);

        if (empty($data['version'])) {
            return "Currently developing a new version. Stay tuned.";
        }

        return $data['version'];
    }
}
