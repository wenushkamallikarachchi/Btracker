<?php


class BookmarkItemModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    /**
     * Save bookmark list item to the DB
     */
    public function addBookmarkItem($bookmarkId, $title, $url, $tag)
    {
        $bookmarkItem = array(
            'title' => $title,
            'url' => $url,
            'tag' => $tag,
            'bookmarkId' => $bookmarkId
        );
        $this->db->insert('bookmarkItems', $bookmarkItem);
        log_message('debug', "Successfully Inserted the bookmark list item!");
        return  $this->db->insert_id();
    }

    /**
     * Fetch all the bookmark list item data from the DB,
     * based on the bookmark list id
     */
    public function getBookmarkItems($bookmarkId)
    {
        $result = $this->db->get_where('bookmarkItems', array('bookmarkId' => $bookmarkId));

        if ($result->num_rows() == 0) {
            log_message('debug', "Failed to fetch the bookmark list items!");
            return false;
        } else {
            log_message('debug', "Successfully fetched the bookmark list items!");
            return $result;
        }
    }

    /**
     * Update the bookmark list item
     */
    public function updateBookmarkItem($id, $title, $url, $tag)
    {
        $bookmarkItem = array(
            'title' => $title,
            'url' => $url,
            'tag' => $tag
        );

        $this->db->where('bookmarkItemId', $id);
        return $this->db->update('bookmarkItems', $bookmarkItem);
    }

    /**
     * Delete the bookmark list item from the DB,
     * based on the bookmark id
     */
    public function deleteBookmarkItem($id)
    {
        return $this->db->delete('bookmarkItems', array('bookmarkItemId' => $id));
    }
    /**
     * search the bookmark tags from the DB 
     * based on the bookmark id and searchValues
     */
    public function searchBookmarkTags($bookmarkId, $searchValue)
    {
        $result = $this->db->where('bookmarkId', $bookmarkId)
            ->like('tag', $searchValue)
            ->get('bookmarkItems');

        return $result;
    }
}
