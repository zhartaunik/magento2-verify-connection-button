<?php

declare(strict_types=1);

namespace PerfectCode\ConnectionButton\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use PerfectCode\ConnectionButton\Api\AdapterInterface;

/**
 * Integration with Stamped.IO test connection block
 *
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class TestConnection extends Field
{
    /**
     * Path to validation controller.
     */
    private const TEST_CONNECTION_PATH = 'validator/system_config/connection';

    /**
     * Path to template file in theme.
     *
     * @var string
     */
    protected $_template = 'PerfectCode_ConnectionButton::system/config/connection.phtml';

    /**
     * @var AdapterInterface
     */
    private AdapterInterface $adapter;

    /**
     * @var string module/controller/action
     */
    private string $controllerPath;

    /**
     * Connection constructor.
     *
     * @param Context $context
     * @param AdapterInterface $adapter
     * @param string $controllerPath
     * @param array $data
     */
    public function __construct(
        Context $context,
        AdapterInterface $adapter,
        string $controllerPath = self::TEST_CONNECTION_PATH,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->adapter = $adapter;
        $this->controllerPath = $controllerPath;
    }

    /**
     * Remove element scope and render form element as HTML.
     *
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element): string
    {
        $element->setData('scope', null);
        return parent::render($element);
    }

    /**
     * Get the button and scripts contents.
     *
     * @param AbstractElement $element
     * @return string
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _getElementHtml(AbstractElement $element): string
    {
        $this->addData(
            [
                'button_label' => __($element->getOriginalData()['button_label']),
            ]
        );

        return $this->_toHtml();
    }

    /**
     * Check connection for the current api key saved value.
     *
     * @return bool
     */
    public function isConnectionSuccessful(): bool
    {
        return $this->adapter->authenticate();
    }

    /**
     * Get test connection url.
     *
     * @return string
     */
    public function getAjaxUrl(): string
    {
        return $this->_urlBuilder->getUrl(
            $this->controllerPath,
            [
                'form_key' => $this->getFormKey(),
            ]
        );
    }
}
