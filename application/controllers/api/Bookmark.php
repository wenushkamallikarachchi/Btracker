<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Bookmark extends \Restserver\Libraries\REST_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        //load User Model
        $this->load->model('BookmarkModel');

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
    }
    /**
     * Add the bookmark to the system
     */
    public function bookmarks_post()
    {
        $bookmarkName = $this->post('name');
        $description = $this->post('description');
        $bookmarkType = $this->post('type');

        $id = $this->BookmarkModel->addBookmark($bookmarkName, $description, $bookmarkType);

        if ($id !== null) {
            $message = array('bookmarkId' => $id);
            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response("Error", \Restserver\Libraries\REST_Controller::HTTP_FORBIDDEN);
        }
    }

    public function bookmarks_get()
    {
        $response = $this->BookmarkModel->getBookmark();
        if($response) {
            $this->set_response($response->result_array(), \Restserver\Libraries\REST_Controller::HTTP_OK);
        }
        else{
            $this->set_response("Error", \Restserver\Libraries\REST_Controller::HTTP_FORBIDDEN);
        }
     
    }

    /**
     * Update the saved bookmark list with the new values
     */
    public function bookmarks_put() {
        $bookmarkId = $this->put('bookmarkId');
        $updatedBookmarkName = $this->put('name');
        $updatedBookmarkDescription = $this->put('description');
        $updatedBookmarkType = $this->put('type');

        $response = $this->BookmarkModel->updateBookmark($bookmarkId, $updatedBookmarkName, $updatedBookmarkDescription, $updatedBookmarkType);

        if($response === true) {
            $this->set_response("Success", \Restserver\Libraries\REST_Controller::HTTP_CREATED);
        }
        else{
            $this->set_response("Error", \Restserver\Libraries\REST_Controller::HTTP_FORBIDDEN);
        }
    }

    /**
     * Delete a bookmark from database
     */
    public function bookmarks_delete() {
        $bookmarksId = $this->delete('bookmarkId');;

        $response = $this->BookmarkModel->deleteBookmark($bookmarksId);

        if($response === true) {
            $this->set_response("Success", \Restserver\Libraries\REST_Controller::HTTP_CREATED);
        }
        else{
            $this->set_response("Error", \Restserver\Libraries\REST_Controller::HTTP_FORBIDDEN);
        }

    }
}
