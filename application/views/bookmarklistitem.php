<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<head>
    <title>Bookmark Tracker | Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Style Sheet -->
    <link rel="stylesheet" type="text/css" href="/w1673746cw2/assets/css/homestyle.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/w1673746cw2/assets/js/underscore.js"></script>
    <script type="text/javascript" src="/w1673746cw2/assets/js/backbone.js"></script>

</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="/w1673746cw2/index.php/BookmarkManager">
            <img src="/w1673746cw2/assets/img/cw1.png">
        </a>
        <ul class="nav navbar-nav navbar-right">
            <li class="username"></li>
            <li>
                <div class="btn-nav"><a class="btn btn-outline-danger navbar-btn" href="/w1673746cw2/index.php/UserManager/logout">Log out</a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- Container -->
    <div class="container-fluid">

        <div class="row">
            <!-- <div class="column">
                <div class="input-group">
                    <input type="search" class="form-control rounded searchbar" onfocus="this.value=''" id="search" placeholder="Search a Tag" aria-label="Search" aria-describedby="search-addon" />
                    &nbsp; <button type="button" id="searchBtn" class="btn searchBtn">Search</button>
                </div>

            </div> -->
            <div class="column">
                <button type="button" class="addBookmarkBtn" id="addBookmarkItemBtn" data-toggle="modal" data-target="#addBookmarkItemModal">Add Bookmark Item</button>
            </div>
        </div>




        <!-- Add bookmark list item modal -->
        <div class="modal fade" id="addBookmarkItemModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Add New Bookmark Item</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="list-name" class="col-form-label">Title:</label>
                                <input type="text" class="form-control" id="bookmarkItemTitle">
                                <small id="list-name-error" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="list-description" class="col-form-label">URL:</label>
                                <textarea class="form-control" id="bookmarkItemUrl"></textarea>
                                <small id="list-description-error" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="list-name" class="col-form-label">Tags:</label>
                                <input type="text" class="form-control" id="bookmarkItemTag">
                            </div>
                            <div class="form-group">
                                <label id="wishListError" class="form-text text-danger"></label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="addBookmarkItemModalBtn">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit bookmark list modal -->
        <div class="modal fade" id="editBookmarkItemModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Edit Bookmark Item</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="hidden" class="form-control" id="bookmarkItemId">
                            <div class="form-group">
                                <label for="list-name" class="col-form-label">Title:</label>
                                <input type="text" class="form-control" id="editBookmarkItemTitle">
                                <small id="list-name-error" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="list-description" class="col-form-label">URL:</label>
                                <textarea class="form-control" id="editBookmarkItemUrl"></textarea>
                                <small id="list-description-error" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="list-name" class="col-form-label">Tags:</label>
                                <input type="text" class="form-control" id="editBookmarkItemTag">
                            </div>
                            <div class="form-group">
                                <label id="wishListError" class="form-text text-danger"></label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="updateBookmarkItemBtn">Update</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bookmark-lists">
            <h2 class="main-heading"></h2>
            <div class="panel panel-default">
                <div class="row">
                    <br>
                    <div class="col-12" id="bookmarkItemTable">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript" lang="javascript">
        //bookmark list item model
        var BookmarkItem = Backbone.Model.extend({
            url: '/w1673746cw2/index.php/?/api/BookmarkItems/bookmarkItem',
            idAttribute: 'bookmarkItemId',
            defaults: {
                "bookmarkItemId": null,
                "title": "",
                "url": "",
                "tag": "",
                "bookmarkId": null
            },
            delete: function() {
                let self = this;
                this.destroy({
                    async: false,
                    data: $.param({
                        bookmarkItemId: this.get('bookmarkItemId')
                    }),
                    success: function(bookmark, response) {
                        console.log("bookmark Item Deleted!");
                    },
                    error: function(bookmark, response) {
                        console.log("bookmark Item not Deleted!");
                    }
                })
            }
        });

        //bookmark list item collection
        var BookmarkItems = Backbone.Collection.extend({
            model: BookmarkItem,
            url: '/w1673746cw2/index.php/?/api/BookmarkItems/bookmarkItem'
        });

        var bookmarkItemCollection = new BookmarkItems();


        var isSearchValid = true;
        var isAddBookmarkItemFormValid = true;
        var isEditBookmarkItemFormValid = true;

        var bookmarkId = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);

        var loc = window.location.href;
        var subString = loc.split("bookmarkItem");

        $(document).ready(function() {
            $(".username").html(localStorage.getItem("username"));
            $(".main-heading").html("Bookmark List #" + bookmarkId);

            //Add bookmark list item modal verify
            $('#addBookmarkItemModalBtn').click(function(e) {
                e.preventDefault();
                var bookmarkItemTitle = $('#bookmarkItemTitle').val();
                var bookmarkItemUrl = $('#bookmarkItemUrl').val();
                var bookmarkItemTag = $('#bookmarkItemTag').val();

                var isBookmarkItemTitleValid, isBookmarkItemUrlValid, isBookmarkItemTagValid;
                isBookmarkItemTitleValid = isBookmarkItemUrlValid = isBookmarkItemTagValid = true;

                $("span.errorText").remove();

                if (bookmarkItemTitle === "") {
                    $('#bookmarkItemTitle').after('<span style="color: #ff5349" class="errorText"><b>Please enter the bookmark list item title!</b></span>');
                    isBookmarkItemTitleValid = false;
                }
                if (bookmarkItemUrl === "") {
                    $('#bookmarkItemUrl').after('<span style="color: #ff5349" class="errorText"><b>Please enter the bookmark list item url!</b></span>');
                    isBookmarkItemUrlValid = false;
                }
                if (bookmarkItemTag === "") {
                    $('#bookmarkItemTag').after('<span style="color: #ff5349" class="errorText"><b>Please enter a valid bookmark list item tags!</b></span>');
                    isBookmarkItemTagValid = false;
                }

                isAddBookmarkItemFormValid = !(isBookmarkItemTitleValid === false || isBookmarkItemUrlValid === false || isBookmarkItemTagValid === false);
                console.log(isAddBookmarkItemFormValid);

                if (isAddBookmarkItemFormValid) {
                    let title = $('#bookmarkItemTitle').val();
                    let url = $('#bookmarkItemUrl').val();
                    let tag = $('#bookmarkItemTag').val();

                    var bookmarkItem = new BookmarkItem();
                    bookmarkItem.set("title", title);
                    bookmarkItem.set("url", url);
                    bookmarkItem.set("tag", tag);
                    bookmarkItem.set("bookmarkId", bookmarkId);

                    bookmarkItem.save(null, {
                        success: function(bookmarkItem, response) {
                            console.log("bookmark List Item Saved!");
                            bookmarkItem.set("bookmarkItemId", response.bookmarkItemId);
                            bookmarkItemCollection.add(bookmarkItem);
                            $('#addBookmarkItemModal').modal('toggle');
                            $('#bookmarkItemTitle').val("");
                            $('#bookmarkItemUrl').val("");
                            $('#bookmarkItemTag').val("");
                        },
                        error: function(bookmarkItem, response) {
                            console.log("bookmark List not Saved!");
                            $('#bookmarkItemTag').after('<span style="color: #ff5349" class="errorText"><b>Please try again, bookmark list item not created!</b></span>');
                        }
                    })

                }
            });

            //Update bookmark list item modal verify
            $('#updateBookmarkItemBtn').click(function(e) {
                e.preventDefault();
                var editBookmarkItemTitle = $('#editBookmarkItemTitle').val();
                var editBookmarkItemUrl = $('#editBookmarkItemUrl').val();
                var editBookmarkItemTag = $('#editBookmarkItemTag').val();

                var isBookmarkItemTitleValid, isBookmarkItemUrlValid, isBookmarkItemTagValid;
                isBookmarkItemTitleValid = isBookmarkItemUrlValid = isBookmarkItemTagValid = true;

                $("span.errorText").remove();

                if (editBookmarkItemTitle === "") {
                    $('#editBookmarkItemTitle').after('<span style="color: #ff5349" class="errorText"><b>Please enter the bookmark list item title!</b></span>');
                    isBookmarkItemTitleValid = false;
                }
                if (editBookmarkItemUrl === "") {
                    $('#editBookmarkItemUrl').after('<span style="color: #ff5349" class="errorText"><b>Please enter the bookmark list item url!</b></span>');
                    isBookmarkItemUrlValid = false;
                }
                if (editBookmarkItemTag === "") {
                    $('#editBookmarkItemTag').after('<span style="color: #ff5349" class="errorText"><b>Please enter a valid bookmark list item tag!</b></span>');
                    isBookmarkItemTagValid = false;
                }

                isEditBookmarkItemFormValid = !(isBookmarkItemTitleValid === false || isBookmarkItemUrlValid === false || isBookmarkItemTagValid === false);
                console.log(isEditBookmarkItemFormValid);
            });

            //Bookmark Lists view
            let BookmarkItemView = Backbone.View.extend({

                el: "#bookmarkItemTable",
                model: bookmarkItemCollection,
                initialize: function() {
                    bookmarkItemCollection.url = '/w1673746cw2/index.php/?/api/BookmarkItems/bookmarkItem/id/' + bookmarkId;
                    bookmarkItemCollection.fetch({
                        async: false
                    });
                    this.render();
                    this.listenTo(bookmarkItemCollection, 'add remove change sort', this.render);
                },
                events: {
                    "click #editBtn": "editBookmarkItem",
                    "click #deleteBtn": "deleteBookmarkItem",
                    "click #searchNow": "searchNowTags",
                    "click #reset": "resetNow"
                },
                //delete function
                deleteBookmarkItem: function(e) {
                    let bookmarkItemId = $(e.currentTarget).attr('bookmarkItemId');
                    let bookmarkItem = new BookmarkItem({
                        bookmarkItemId: bookmarkItemId
                    });
                    bookmarkItem.delete();
                    bookmarkItemCollection.remove(bookmarkItem);
                },
                //edit function
                editBookmarkItem: function(e) {

                    let bookmarkItemId = $(e.currentTarget).attr('bookmarkItemId');
                    let bookmarkItem = bookmarkItemCollection.get({
                        bookmarkItemId: bookmarkItemId
                    });

                    $('#bookmarkItemId').val(bookmarkItemId);
                    $('#editBookmarkItemTitle').val(bookmarkItem.get('title'));
                    $('#editBookmarkItemUrl').val(bookmarkItem.get('url'));
                    $('#editBookmarkItemTag').val(bookmarkItem.get('tag'));

                    console.log("Clicked Update btn: " + bookmarkItemId);
                    console.log("Selected bookmark list item: " + bookmarkItem);
                },

                // search function
                searchNowTags: function(e) {

                    let searchValues = $('#search').val();
                    console.log(searchValues);
                    bookmarkItemCollection.url = '/w1673746cw2/index.php/?/api/BookmarkItems/bookmarkItem/id/' + bookmarkId + '/search/' + searchValues;
                    bookmarkItemCollection.fetch({
                        async: false
                    });
                    if (bookmarkItemCollection.length === 0) {
                        isSearchValid = false;
                    }
                    this.render();
                },
                //reset function
                resetNow: function(e) {
                    bookmarkItemCollection.url = '/w1673746cw2/index.php/?/api/BookmarkItems/bookmarkItem/id/' + bookmarkId;
                    bookmarkItemCollection.fetch({
                        async: false
                    });
                    this.render();
                },

                render: function() {
                    $("#bookmarkItemTable").html("");
                    let output = this;
                    if (bookmarkItemCollection.length !== 0) {
                        $("p.error-text").remove();
                        let content = "<input type='search' class='form-control rounded searchbar' onfocus='this.value=''' id='search' placeholder='Search a Tag' aria-label='Search' aria-describedby='search-addon' /><button id='searchNow' class='btn searchBtn'>Search</button><button id='reset' class='resetBtn'>Reset</button><div class='space'></div><table class='table table-bordered'><thead><tr><th scope='col'>Title</th><th scope='col'>URL</th>" +
                            "<th scope='col'>Tags</th><th scope='col' style='width: 125px'>Actions</th></tr></thead><tbody>";
                        bookmarkItemCollection.each(function(c) {
                            let title = c.get('title');
                            if (title != null) {
                                content += "<tr><td>" + c.get('title') + "</td><td>" + c.get('url') + "</td><td>" + c.get('tag') + "</td><td>" +
                                    "<button type='button' class='btn editBtn' id='editBtn' bookmarkItemId='" + c.get('bookmarkItemId') + "' data-toggle='modal' data-target='#editBookmarkItemModal'><span class='material-icons'>edit</span></button>\n" +
                                    "<button type='button' class='btn deleteBtn' id='deleteBtn' bookmarkItemId='" + c.get('bookmarkItemId') + "'><span class='material-icons'>delete</span></button></td></tr>";
                            }
                        });
                        content += "</tbody></table>";
                        output.$el.append(content);
                    } else {
                        if (isSearchValid === false) {
                            let content = "<button id='reset' class='btn afterSearchResetBtn'>Reset</button><div class='space'></div>";
                            content += "<p class='error-text'>No Results found in our Database</p>";
                            output.$el.append(content);
                        } else {
                            let content = "<p class='error-text'>Please add a item to the bookmark list to view here!</p>";
                            output.$el.append(content);
                        }

                    }
                }

            });



            console.log(bookmarkItemCollection)
            var bookmarkItemView = new BookmarkItemView();

            //Update bookmark list Item Button
            let UpdateBookmarkItemBtn = Backbone.View.extend({
                el: "#editBookmarkItemModal",
                initialize: function() {

                },
                render: function() {
                    return this;
                },
                events: {
                    "click #updateBookmarkItemBtn": "updateBookmarkItem"
                },
                updateBookmarkItem: function() {
                    let bookmarkItemId = $('#bookmarkItemId').val();
                    let updatedBookmarkItemTitle = $('#editBookmarkItemTitle').val();
                    let updatedBookmarkItemUrl = $('#editBookmarkItemUrl').val();
                    let updatedBookmarkItemTag = $('#editBookmarkItemTag').val();

                    if (isEditBookmarkItemFormValid) {
                        let bookmarkItem = new BookmarkItem();
                        bookmarkItem.set("bookmarkItemId", bookmarkItemId);
                        bookmarkItem.set("title", updatedBookmarkItemTitle);
                        bookmarkItem.set("url", updatedBookmarkItemUrl);
                        bookmarkItem.set("tag", updatedBookmarkItemTag);

                        bookmarkItem.save(null, {
                            success: function(bookmarkItem, response) {
                                console.log("bookmark List  Item Updated!");
                                let updatedBookmarkItem = bookmarkItemCollection.get({
                                    bookmarkItemId: bookmarkItemId
                                });
                                updatedBookmarkItem.set("bookmarkItemId", bookmarkItemId);
                                updatedBookmarkItem.set("title", updatedBookmarkItemTitle);
                                updatedBookmarkItem.set("url", updatedBookmarkItemUrl);
                                updatedBookmarkItem.set("tag", updatedBookmarkItemTag);
                                $('#editBookmarkItemModal').modal('toggle');
                            },
                            error: function(bookmarkList, response) {
                                console.log("bookmark List Item not Updated!");
                                $('#editBookmarkItemTag').after('<span style="color: #ff5349" class="errorText"><b>Please try again, bookmark list item not updated!</b></span>');
                            }
                        });
                    }
                }
            });

            var updateBookmarkItemBtn = new UpdateBookmarkItemBtn();
        });
    </script>
</body>

</html>