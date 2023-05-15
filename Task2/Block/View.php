<?php

namespace Speroteck\Task2\Block;

use Magento\Framework\App\RequestInterface;
use \Magento\Framework\Exception\LocalizedException;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\Registry;
use \Speroteck\Task2\Model\Post;
use \Speroteck\Task2\Model\PostFactory;

class View extends Template
{
    /** @var Post */
    protected $post;

    /** @var PostFactory */
    protected $postFactory;

    /** @var RequestInterface */
    private $request;

    /**
     * Constructor
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PostFactory $postCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        RequestInterface $request,
        PostFactory $postFactory,
        array $data = []
    ) {
        $this->postFactory = $postFactory;
        $this->request = $request;

        parent::__construct($context, $data);

    }

    /**
     * Lazy loads the requested post
     * @return Post
     * @throws LocalizedException
     */
    public function getPost()
    {
        if ($this->post === null) {
            $post = $this->postFactory->create();
            $post->load($this->getPostId());

            if (!$post->getId()) {
                throw new LocalizedException(__('Post not found'));
            }
            $this->post = $post;
        }
        return $this->post;
    }

    /**
     * @return int
     */
    protected function getPostId()
    {
        return (int) $this->request->getParam('id');
    }

    /**
     * @param $postId
     * @return string
     */
    public function delCurrentPostUrl($postId) {
        return '/task2/delete/delete?postId=' . $postId;
    }
}
