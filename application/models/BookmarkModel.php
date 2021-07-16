<?php


class bookmarkModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function  addBookmark($name, $description, $type)
    {
        $userId = $this->session->userdata("userId");
        $bookmarkList = array(
            'name' => $name,
            'description' => $description,
            'type' => $type,
            'userId' => $userId
        );
        $this->db->insert('bookmarks', $bookmarkList);
        log_message('debug', "Successfully Inserted the bookmark list!");
        return  $this->db->insert_id();
    }


     /**
     * Fetch all the bookmarks data from the DB,
     * based on the  user id
     */
    public function getBookmark()
    {
        $userId = $this->session->userdata("userId");
        $result = $this->db->get_where('bookmarks', array('userId' => $userId));

        if($result->num_rows() == 0) {
            log_message('debug', "Failed to fetch the bookmark lists!");
            return false;
        }
        else {
            log_message('debug', "Successfully fetched the bookmark lists!");
            return $result;
        }
    }

    /**
     * Update the bookmark list
     */
    public function updateBookmark($id, $name, $description, $type)
    {
        $bookmarkList = array(
            'name' => $name,
            'description' => $description,
            'type' => $type
        );

        $this->db->where('bookmarkId', $id);
        return $this->db->update('bookmarks', $bookmarkList);
    }

    /**
     * Delete the Book Marks from the DB,
     * based on the book mark id
     */
    public function deleteBookmark($id)
    {
        return $this->db->delete('bookmarks', array('bookmarkId' => $id));;
    }
}
