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
    </head>
    <body>
        <header>
            <h1 class="display-4">Welcome back, Admin</h1>
            <p class="text-muted">Choose an action</p>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="submissions_tab" data-toggle="list" href="#submissions" role="tab">View Submissions</a>
                        <a class="list-group-item list-group-item-action" id="events_tab" data-toggle="list" href="#events" role="tab">Add Events</a>
                        <a class="list-group-item list-group-item-action" id="messages_tab" data-toggle="list" href="#messages" role="tab">View Messages</a>
                        <a class="list-group-item list-group-item-action" id="journal_tab" data-toggle="list" href="#journal" role="tab">Edit Journal</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="submissions" role="tabpanel" aria-labelledby="submissions_tab">
                            <div class="container p-5">
                                <h1>Journal Submissions</h1>
                                <div class="btn-group w-100 my-5" role="group" id="submissions_sort">
                                    <button type="button" class="btn btn-outline-secondary">All</button>
                                    <button type="button" class="btn btn-outline-secondary">Visual Art</button>
                                    <button type="button" class="btn btn-outline-secondary">Photography</button>
                                    <button type="button" class="btn btn-outline-secondary">Poetry</button>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 10%">Sr. No.</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Category</th>
                                            <th scope="col" style="width: 10%">URL</th>
                                        </tr>
                                    </thead>
                                    <tbody id="submissions_result"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="events" role="tabpanel" aria-labelledby="events_tab"></div>
                        <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages_tab">
                            <div class="container p-5">
                                <h1>Visitor Messages</h1>
                                <button class="btn btn-outline-secondary btn-lg my-5" id="refresh_messages"><i class="fa fa-refresh"></i></button>
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
                        <div class="tab-pane fade" id="journal" role="tabpanel" aria-labelledby="journal_tab"></div>
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