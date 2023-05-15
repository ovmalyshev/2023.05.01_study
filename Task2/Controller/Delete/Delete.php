<?php
//
//namespace Speroteck\Task2\Controller\Delete;
//
//use Magento\Framework\App\Action\HttpGetActionInterface;
//use Magento\Framework\App\ResourceConnection;
//use \Magento\Framework\App\Action\Action;
//use Magento\Framework\Controller\ResultFactory;
//use Magento\Framework\Registry;
//use \Magento\Framework\View\Result\PageFactory;
//use \Magento\Framework\App\Action\Context;
//use Speroteck\Task2\Controller\Post\View as ViewAction;
//
//class Delete extends Action implements HttpGetActionInterface
//{
//	const QUOTE_TABLE = 'speroteck_task2_post';
//	private $resourceConnection;
//    protected $resultPageFactory;
//    protected $_coreRegistry;
////    protected $request;
//
//    /** @var PostFactory */
//    private $postFactory;
//
//	public function __construct(
//     	Context $context,
//        PageFactory $resultPageFactory,
//        Registry $coreRegistry,
//        ResourceConnection $resourceConnection,
////        \Magento\Framework\App\Request\Http $request
//        PostFactory $postFactory
//
//
//    ) {
//    	$this->resourceConnection = $resourceConnection;
//        $this->_coreRegistry = $coreRegistry;
////        $this->request = $request;
//        $this->postFactory = $postFactory;
//
//    	parent::__construct(
//    	    $context
//        );
//        $this->resultPageFactory = $resultPageFactory;
//	}
//
//	public function execute()
//	{
////    	$connection  = $this->resourceConnection->getConnection();
////    	$tableName = $connection->getTableName(self::QUOTE_TABLE);
////        $postId = $this->_request->getParam("postId");
////        $whereConditions = [
////            $connection->quoteInto('post_id = ?', $postId),
////        ];
//
//        $this->postFactory->create()->load($this->context->getRequest()->getParam('id'))->delete();
////    	if ($postId) {
////            $deleteRows = $connection->delete($tableName, $whereConditions);
////        } else {
////            $deleteRows = $connection->delete($tableName);
////        }
//
//
////        $resultRedirect = $this->resultRedirectFactory->create();
////        $resultRedirect->setPath('task2/index/index');
////        return $resultRedirect;
//        return $this->context
//            ->getResultFactory()
//            ->create(ResultFactory::TYPE_REDIRECT)
//            ->setUrl('/task2/index/index');
//	}
//
////	protected function _getPostId()
////    {
////        return (int) $this->_coreRegistry->registry(
////            ViewAction::REGISTRY_KEY_POST_ID
////        );
////    }
//}


namespace Speroteck\Task2\Controller\Delete;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use \Magento\Framework\App\Action\Context;
use Speroteck\Task2\Model\Post;
use Speroteck\Task2\Model\PostFactory;
use Speroteck\Task2\Model\ResourceModel\Post\Collection;
use Magento\Framework\App\ResourceConnection;

class Delete implements HttpGetActionInterface
{
    /** @var ResourceConnection */
    private $resourceConnection;

    /** @var Context */
    private $context;

    /** @var Post */
    protected $post;

    /** @var Collection */
    private $postCollection;

    public function __construct(
        Context $context,
        PostFactory $postFactory,
        Collection $postCollection,
        ResourceConnection $resourceConnection
    ) {
        $this->postFactory = $postFactory;
        $this->context = $context;
        $this->postCollection = $postCollection;
        $this->resourceConnection = $resourceConnection;
    }

    public function execute()
    {
        $postId = $this->context->getRequest()->getParam('postId');

        $postId
            ? $this->postFactory->create()->load($postId)->delete()
            : $this->resourceConnection->getConnection()->delete('speroteck_task2_post');

        return $this->context
            ->getResultFactory()
            ->create(ResultFactory::TYPE_REDIRECT)
            ->setUrl('/task2/index/index');
    }
}