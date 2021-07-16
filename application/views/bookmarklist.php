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
    <div class="container-fluid">
        <button type="button" class="addBookmarkBtn" id="addBookmarkBtn" data-toggle="modal" data-target="#addBookmarkModal">Add Bookmark List</button>

        <div class="modal fade" id="addBookmarkModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Add New Bookmark</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="list-name" class="col-form-label">Bookmark Name:</label>
                                <input type="text" class="form-control" id="bookmarkName" required>
                                <small id="list-name-error" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="list-description" class="col-form-label">Description:</label>
                                <textarea class="form-control" id="bookmarkDescription"></textarea>
                                <small id="list-description-error" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="list-name" class="col-form-label">Bookmark Type:</label>
                                <input type="text" class="form-control" id="bookmarkType">
                            </div>
                            <div class="form-group">
                                <label id="wishListError" class="form-text text-danger"></label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="addBookmarkModalBtn">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editBookmarkModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Edit Bookmark List</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="hidden" class="form-control" id="bookmarkId">
                            <div class="form-group">
                                <label for="list-name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" id="editBookmarkName">
                                <small id="list-name-error" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="list-description" class="col-form-label">Description:</label>
                                <textarea class="form-control" id="editBookmarkDescription"></textarea>
                                <small id="list-description-error" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="list-name" class="col-form-label">Bookmark Type:</label>
                                <input type="text" class="form-control" id="editBookmarkType">
                            </div>
                            <div class="form-group">
                                <label id="wishListError" class="form-text text-danger"></label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="updateBookmarkListBtn">Update</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bookmark-lists">
            <h2>Your Bookmark List ❤️: </h2>
            <div class="panel panel-default">
                <div class="row">
                    <div class="col-12" id="bookMarkListTable">
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    <script type="text/javascript" lang="javascript">
        var isBookmarkDeleted = true;

        //Book Mark model
        var Bookmark = Backbone.Model.extend({
            url: '/w1673746cw2/index.php/?/api/Bookmark/bookmarks',
            idAttribute: 'bookmarkId',
            defaults: {
                "bookmarkId": null,
                "name": "",
                "description": "",
                "type": "",
                "userId": null
            },

            //delete item method
            delete: function() {
                let self = this;
                this.destroy({
                    async: false,
                    data: $.param({
                        bookmarkId: this.get('bookmarkId')
                    }),
                    success: function(bookmarkList, response) {
                        console.log("Book Mark Deleted!");
                        isBookmarkDeleted = true;
                    },
                    error: function(bookmarkList, response) {
                        alert("This Bookmark cannot be deleted, because it contains some bookmark items!");
                        console.log("Book Mark not Deleted!");
                        isBookmarkDeleted = false;
                    }
                })
            }

        });
        //Book Mark collection
        var BookMarks = Backbone.Collection.extend({
            model: Bookmark,
            url: '/w1673746cw2/index.php/?/api/Bookmark/bookmarks'
        })

        var bookMarkCollection = new BookMarks();

        var isAddBookMarkFormValid = true;
        var isEditBookMarkFormValid = true;

        $(document).ready(function() {
            $(".username").html(localStorage.getItem("username"));

            //Add bookmark modal validation
            $('#addBookmarkModalBtn').click(function(e) {
                e.preventDefault();
                var bookmarkName = $('#bookmarkName').val();
                var bookmarkDescription = $('#bookmarkDescription').val();
                var bookmarkType = $('#bookmarkType').val();

                var isBookmarkListNameValid, isBookmarkListDescriptionValid, isBookmarkListTypeValid;
                isBookmarkListNameValid = isBookmarkListDescriptionValid = isBookmarkListTypeValid = true;

                $("span.errorText").remove();

                if (bookmarkName === "") {
                    $('#bookmarkName').after('<span style="color: #ff5349" class="errorText"><b>Please enter the bookmark list name!</b></span>');
                    isBookmarkListNameValid = false;
                }
                if (bookmarkDescription === "") {
                    $('#bookmarkDescription').after('<span style="color: #ff5349" class="errorText"><b>Please enter the bookmark list description!</b></span>');
                    isBookmarkListDescriptionValid = false;
                }
                if (bookmarkType === "") {
                    $('#bookmarkType').after('<span style="color: #ff5349" class="errorText"><b>Please enter the bookmark list type!</b></span>');
                    isBookmarkListTypeValid = false;
                }

                isAddBookMarkFormValid = !(isBookmarkListNameValid === false || isBookmarkListDescriptionValid === false || isBookmarkListTypeValid === false);
                console.log(isAddBookMarkFormValid);

                if (isAddBookMarkFormValid) {
                    let name = $('#bookmarkName').val();
                    let description = $('#bookmarkDescription').val();
                    let type = $('#bookmarkType').val();

                    var bookmarkList = new Bookmark();
                    bookmarkList.set("name", name);
                    bookmarkList.set("description", description);
                    bookmarkList.set("type", type);

                    bookmarkList.save(null, {
                        success: function(bookmarkList, response) {
                            console.log("Bookmark added!");
                            bookmarkList.set("bookmarkId", response.bookmarkId);
                            bookMarkCollection.add(bookmarkList);
                            $('#addBookmarkModal').modal('toggle');
                            $('#bookmarkName').val("");
                            $('#bookmarkDescription').val("");
                            $('#bookmarkType').val("");
                        },
                        error: function(bookmarkList, response) {
                            console.log("bookmark List not Saved!");
                            $('#bookmarkType').after('<span style="color: #ff5349" class="errorText"><b>Please try again, bookmark list not created!</b></span>');
                        }
                    })

                }

            });
            //Update bookmark list modal verify
            $('#updateBookmarkListBtn').click(function(e) {
                e.preventDefault();
                var editBookmarkName = $('#editBookmarkName').val();
                var editBookmarkDescription = $('#editBookmarkDescription').val();
                var editBookmarkType = $('#editBookmarkType').val();

                var isBookmarkListNameValid, isBookmarkListDescriptionValid, isBookmarkListTypeValid;
                isBookmarkListNameValid = isBookmarkListDescriptionValid = isBookmarkListTypeValid = true;

                $("span.errorText").remove();

                if (editBookmarkName === "") {
                    $('#editBookmarkName').after('<span style="color: #ff5349" class="errorText"><b>Please enter the bookmark list name!</b></span>');
                    isBookmarkListNameValid = false;
                }
                if (editBookmarkDescription === "") {
                    $('#editBookmarkDescription').after('<span style="color: #ff5349" class="errorText"><b>Please enter the bookmark list description!</b></span>');
                    isBookmarkListDescriptionValid = false;
                }
                if (editBookmarkType === "") {
                    $('#editBookmarkType').after('<span style="color: #ff5349" class="errorText"><b>Please enter the bookmark list type!</b></span>');
                    isBookmarkListTypeValid = false;
                }

                isEditBookMarkFormValid = !(isBookmarkListNameValid === false || isBookmarkListDescriptionValid === false || isBookmarkListTypeValid === false);
                console.log(isEditBookMarkFormValid);
            });

            $('#viewBtn').click(function(e) {
                let bookmarkId = $(e.currentTarget).attr('bookmarkId');
                windows.location = "index.php/BookmarkManager";
                console.log("View btn clicked!");
            });

            //Bookmark Lists view
            let BookmarkListView = Backbone.View.extend({
                el: "#bookMarkListTable",
                model: bookMarkCollection,
                initialize: function() {
                    bookMarkCollection.fetch({
                        async: false
                    });
                    this.render();
                    this.listenTo(bookMarkCollection, 'add remove change sort', this.render);
                },
                events: {
                    "click #viewBtn": "viewBookMarkListItems",
                    "click #editBtn": "editBookmarkList",
                    "click #deleteBtn": "deleteBookmark"
                },
                deleteBookmark: function(e) {
                    let bookmarkId = $(e.currentTarget).attr('bookmarkId');
                    let bookmark = new Bookmark({
                        bookmarkId: bookmarkId
                    });
                    bookmark.delete();
                    if (isBookmarkDeleted) {
                        bookMarkCollection.remove(bookmark);
                    }
                },
                editBookmarkList: function(e) {
                    let bookmarkId = $(e.currentTarget).attr('bookmarkId');
                    let bookmarkList = bookMarkCollection.get({
                        bookmarkId: bookmarkId
                    });

                    $('#bookmarkId').val(bookmarkId);
                    $('#editBookmarkName').val(bookmarkList.get('name'));
                    $('#editBookmarkDescription').val(bookmarkList.get('description'));
                    $('#editBookmarkType').val(bookmarkList.get('type'));

                    console.log("Clicked Update btn: " + bookmarkId);
                    console.log("Selected bookmark list: " + bookmarkList);
                },
                viewBookMarkListItems: function(e) {
                    let bookmarkId = $(e.currentTarget).attr('bookmarkId');
                    window.location = window.location.href + "/bookmarkItem/id/" + bookmarkId;
                    console.log("Clicked view btn: " + window.location.href + "/bookmarkItem/id/" + bookmarkId);
                },
                render: function() {
                    $("#bookMarkListTable").html("");
                    let output = this;
                    if (bookMarkCollection.length !== 0) {
                        $("p.error-text").remove();
                        let content = "<div class='space'></div><table class='table table-bordered'><thead><tr><th scope='col'>Name</th><th scope='col'>Description</th>" +
                            "<th scope='col'>type</th><th scope='col' style='width: 175px'>Actions</th></tr></thead><tbody>";
                        bookMarkCollection.each(function(c) {
                            let name = c.get('name');
                            if (name != null) {
                                content += "<tr><td>" + c.get('name') + "</td><td>" + c.get('description') + "</td><td>" + c.get('type') + "</td>" +
                                    "<td><button type='button' class='btn viewBtn' id='viewBtn' bookmarkId='" + c.get('bookmarkId') + "'><span class='material-icons'>assignment</span>\n</button>\n" +
                                    "<button type='button' class='btn editBtn' id='editBtn' bookmarkId='" + c.get('bookmarkId') + "' data-toggle='modal' data-target='#editBookmarkModal'><span class='material-icons'>edit</span></button>\n" +
                                    "<button type='button' class='btn deleteBtn' id='deleteBtn' bookmarkId='" + c.get('bookmarkId') + "'><span class='material-icons'>delete</span></button></td></tr>";
                            }
                        });
                        content += "</tbody></table>";
                        output.$el.append(content);
                    } else {
                        let content = "<p class='error-text'>Please add a book mark to view here!</p>";
                        output.$el.append(content);
                    }
                }
            });

            var bookmarkListView = new BookmarkListView();

            //Update Bookmark List Button
            let UpdateBookmarkListBtn = Backbone.View.extend({
                el: "#editBookmarkModal",
                initialize: function() {

                },
                render: function() {
                    return this;
                },
                events: {
                    "click #updateBookmarkListBtn": "updateBookmarkList"
                },
                updateBookmarkList: function() {
                    let bookmarkId = $('#bookmarkId').val();
                    let updatedBookmarkName = $('#editBookmarkName').val();
                    let updatedBookmarkDescription = $('#editBookmarkDescription').val();
                    let updatedBookmarkType = $('#editBookmarkType').val();

                    if (isEditBookMarkFormValid) {
                        let bookmarkList = new Bookmark();
                        bookmarkList.set("bookmarkId", bookmarkId);
                        bookmarkList.set("name", updatedBookmarkName);
                        bookmarkList.set("description", updatedBookmarkDescription);
                        bookmarkList.set("type", updatedBookmarkType);
                        bookmarkList.save(null, {
                            success: function(bookmarkList, response) {
                                console.log("Bookmark List Updated!");
                                let updatedBookmarkList = bookMarkCollection.get({
                                    bookmarkId: bookmarkId
                                });
                                updatedBookmarkList.set("bookmarkId", bookmarkId);
                                updatedBookmarkList.set("name", updatedBookmarkName);
                                updatedBookmarkList.set("description", updatedBookmarkDescription);
                                updatedBookmarkList.set("type", updatedBookmarkType);
                                $('#editBookmarkModal').modal('toggle');
                            },
                            error: function(bookmarkList, response) {
                                console.log("bookmark List not Updated!");
                                $('#editBookmarkType').after('<span style="color: #ff5349" class="errorText"><b>Please try again, bookmark list not updated!</b></span>');
                            }
                        });
                    }
                }
            });

            var updateBookmarkListBtn = new UpdateBookmarkListBtn();
        });
    </script>
</body>

</html>