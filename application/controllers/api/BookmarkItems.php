<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class BookmarkItems extends \Restserver\Libraries\REST_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        //load User Model
        $this->load->model('BookmarkItemModel');

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    /**
     * Add the bookmark list item to the system
     */
    public function bookmarkItem_post()
    {
        $bookmarkItemId = $this->post('bookmarkId');
        $bookmarkItemTitle = $this->post('title');
        $bookmarkItemUrl = $this->post('url');
        $bookmarkItemTag = $this->post('tag');

        $id = $this->BookmarkItemModel->addBookmarkItem($bookmarkItemId, $bookmarkItemTitle, $bookmarkItemUrl, $bookmarkItemTag);

        if ($id !== null) {
            $message = array('bookmarkItemId' => $id);
            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response("Error", \Restserver\Libraries\REST_Controller::HTTP_FORBIDDEN);
        }
    }

    /**
     * Get the saved bookmark list items from the system
     */
    public function bookmarkItem_get()
    {

        $bookmarkId = $this->uri->segment(5);
        $searchValue = $this->uri->segment(7);
      
        if ($searchValue === 'undefined' || $searchValue === null) {
            $response = $this->BookmarkItemModel->getBookmarkItems($bookmarkId);
        } else {
            //log_message('debug', $searchValue );
            $response = $this->BookmarkItemModel->searchBookmarkTags($bookmarkId, $searchValue);
        }

        if ($response) {
            $this->set_response($response->result_array(), \Restserver\Libraries\REST_Controller::HTTP_OK);
            
        } else {
            $this->set_response("Error", \Restserver\Libraries\REST_Controller::HTTP_FORBIDDEN);
        }
    }

    /**
     * Update the saved bookmark list item with the new values
     */
    public function bookmarkItem_put()
    {
        $bookmarkItemId = $this->put('bookmarkItemId');
        $bookmarkItemTitle = $this->put('title');
        $bookmarkItemUrl = $this->put('url');
        $bookmarkItemPrice = $this->put('tag');

        $response = $this->BookmarkItemModel->updateBookmarkItem($bookmarkItemId, $bookmarkItemTitle, $bookmarkItemUrl, $bookmarkItemPrice);

        if ($response === true) {
            $this->set_response("Success", \Restserver\Libraries\REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response("Error", \Restserver\Libraries\REST_Controller::HTTP_FORBIDDEN);
        }
    }

    /**
     * Delete a bookmark list from database
     */
    public function bookmarkItem_delete()
    {
        $bookmarkItemId = $this->delete('bookmarkItemId');;

        $response = $this->BookmarkItemModel->deleteBookmarkItem($bookmarkItemId);

        if ($response === true) {
            $this->set_response("Success", \Restserver\Libraries\REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response("Error", \Restserver\Libraries\REST_Controller::HTTP_FORBIDDEN);
        }
    }
}
