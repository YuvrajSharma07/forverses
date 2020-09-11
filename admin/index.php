<?php
//session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Admin Panel</title>
        <link rel="icon" href="../lib/favicon.png">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@100;200;300;400&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="../lib/fonts.css">
    </head>
    <body>
        <header>
            <h1 class="display-4">Welcome back, Admin</h1>
            <p class="text-muted">Choose an action</p>
        </header>
        <div class="container">
            <div class="modal fade" id="console" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Console</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-times-rectangle"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="submissions_tab" data-toggle="list" href="#submissions" role="tab">View Submissions</a>
                        <a class="list-group-item list-group-item-action" id="events_tab" data-toggle="list" href="#events" role="tab">Add Events</a>
                        <a class="list-group-item list-group-item-action" id="messages_tab" data-toggle="list" href="#messages" role="tab">View Messages</a>
                        <a class="list-group-item list-group-item-action" id="journal_tab" data-toggle="list" href="#journal" role="tab">Edit Journal</a>
                        <a class="list-group-item list-group-item-action" id="team_tab" data-toggle="list" href="#team" role="tab">Edit Team</a>
                        <a class="list-group-item list-group-item-action" id="collabs_tab" data-toggle="list" href="#collabs" role="tab">Edit Collaborations</a>
                        <a class="list-group-item list-group-item-action" id="web_tab" data-toggle="list" href="#web" role="tab">Edit Website</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="submissions" role="tabpanel" aria-labelledby="submissions_tab">
                            <div class="container p-5">
                                <h1>Journal Submissions</h1>
                                <div class="btn-group w-100 my-5" role="group" id="submissions_sort">
                                    <button type="button" class="btn btn-outline-dark">All</button>
                                    <button type="button" class="btn btn-outline-dark">Visual Art</button>
                                    <button type="button" class="btn btn-outline-dark">Photography</button>
                                    <button type="button" class="btn btn-outline-dark">Poetry</button>
                                    <button type="button" class="btn btn-outline-dark">Comic Strip</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 10%">Sr. No.</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Category</th>
                                                <th scope="col" style="width: 10%">URL</th>
                                                <th scope="col" style="width: 10%">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="submissions_result"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="events" role="tabpanel" aria-labelledby="events_tab">
                            <div class="container p-5">
                                <h1>Your Events</h1>
                                <div class="btn-group w-100 my-5" role="group" id="">
                                    <button type="button" class="btn btn-outline-dark"><i class="fa fa-plus"></i> Add</button>
                                    <button type="button" class="btn btn-outline-dark"></button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 10%">Sr. No.</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Description</th>
                                                <th scope="col" style="width: 10%">URL</th>
                                            </tr>
                                        </thead>
                                        <tbody id="current_events"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages_tab">
                            <div class="container p-5">
                                <h1>Visitor Messages</h1>
                                <button class="btn btn-outline-dark btn-lg my-5" id="refresh_messages"><i class="fa fa-refresh"></i></button>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Message</th>
                                            </tr>
                                        </thead>
                                        <tbody id="messages_result"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="journal" role="tabpanel" aria-labelledby="journal_tab">
                            <div class="container p-5">
                                <h1>Edit the Journal</h1>
                                <div class="btn-group w-100 my-5" role="group" id="journal_editor">
                                    <button type="button" class="btn btn-outline-dark">Color Scheme</button>
                                    <button type="button" class="btn btn-outline-dark">Posts</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="team" role="tabpanel" aria-labelledby="team_tab">
                            <div class="container p-5">
                                <h1>The Team</h1>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-outline-primary" type="button" id="edit_team"><i class="fa fa-pencil"></i> Edit</button>
                                    <button class="btn btn-outline-primary" type="button" id="edit_team_assets"><i class="fa fa-image"></i> Manage Assets</button>
                                </div>
                                <div class="team_members d-flex flex-wrap mt-5"></div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="collabs" role="tabpanel" aria-labelledby="collabs_tab">
                            <div class="container p-5">
                                <h1>Your Collaborations</h1>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-primary"><i class="fa fa-pencil"></i> Edit</button>
                                </div>
                                
                            </div>
                        </div>
                        <div class="tab-pane fade" id="web" role="tabpanel" aria-labelledby="web_tab">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="webaesth" data-toggle="pill" href="#web_aesth" role="tab" aria-controls="web_aesth" aria-selected="true">Aesthetics</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="webassets" data-toggle="pill" href="#web_assets" role="tab" aria-controls="web_assets" aria-selected="false">Assets</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="web_aesth" role="tabpanel" aria-labelledby="webaesth">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-outline-primary"><i class="fa fa-paint-brush"></i> Colours</button>
                                        <button type="button" class="btn btn-outline-primary"><i class="fa fa-font"></i> Fonts</button>
                                    </div>
                                    <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                                        <i class="fa fa-info"></i> Website changes take some time to show even in the console, so once saving changes, please wait after clearing caches and reopening the browser.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <table class="table mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">Variable name</th>
                                                <th scope="col">Value</th>
                                                <th scope="col">Preview</th>
                                            </tr>
                                        </thead>
                                        <tbody id="web_aesth_items"></tbody>
                                        <tfoot>
                                            <td class="border-0"><button type="button" class="btn btn-outline-success"><i class="fa fa-save"></i> Save Changes</button></td>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="web_assets" role="tabpanel" aria-labelledby="webassets">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="index.js"></script>
    </body>
</html>