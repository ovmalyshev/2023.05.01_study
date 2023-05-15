<?php

namespace Speroteck\Task2\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Speroteck\Task2\Model\ResourceModel\Post\Collection as PostCollection;
use \Speroteck\Task2\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use \Speroteck\Task2\Model\Post;

class Posts extends Template
{
    /** @var null|PostCollectionFactory */
    protected $_postCollectionFactory = null;

    /**
     * Posts constructor.
     *
     * @param Context $context
     * @param PostCollectionFactory $postCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        PostCollectionFactory $postCollectionFactory,
        array $data = []
    )
    {
        $this->_postCollectionFactory = $postCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return PostCollection
     */
    public function getPosts()
    {
        return $this->_postCollectionFactory->create();
    }

    /**
     * For a given post, returns its url
     *
     * @param Post $post
     * @return string
     */
    public function getPostUrl(Post $post)
    {
        return '/task2/post/view/id/' . $post->getId();
    }

    public function getDelPostUrl()
    {
        return '/task2/delete/delete';
    }

    public function getAddPostUrl()
    {
        return '/task2/newpost/add';
    }
}

