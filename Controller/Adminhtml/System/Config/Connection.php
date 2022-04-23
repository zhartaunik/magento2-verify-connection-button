<?php

declare(strict_types=1);

namespace PerfectCode\ConnectionButton\Controller\Adminhtml\System\Config;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;
use PerfectCode\ConnectionButton\Api\AdapterInterface;

class Connection extends Action implements HttpPostActionInterface
{
    /**
     * @var AdapterInterface
     */
    private AdapterInterface $adapter;

    /**
     * @inheritDoc
     */
    public function __construct(Context $context, AdapterInterface $adapter)
    {
        parent::__construct($context);
        $this->adapter = $adapter;
    }

    /**
     * @inheritDoc
     */
    public function execute(): Json
    {
        $connection = $this->adapter->authenticate();
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData([
            'success' => $connection,
            'message' => $connection ? __('Connection Successful') : __('Connection Failed'),
        ]);
    }
}
