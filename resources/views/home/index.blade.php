@extends('layouts.frontend')

@section('content')
    <div class="ui segment basic center aligned" style="background: #1b1c1d; padding: 100px 0;">
        <div class="ui container">
            <h1 class="ui inverted header" style="font-size: 3em; font-weight: 300">
                LARAVOLT
            </h1>
            <div class="ui divider"></div>
            <h2 class="ui inverted header" style=" font-weight: 300">
                Laravel base application template to speed up your development flow.
            </h2>
            <div class="ui header purple">10 ready for use components included, and counting...</div>
            <br>
            <br>
            <div class="ui huge violet button">Download <i class="right download icon"></i></div>
            <div class="ui huge inverted violet button">Get Started <i class="right arrow icon"></i></div>
        </div>
    </div>

    <div class="ui container center aligned">
        <h2 class="ui header">Features</h2>
        <div class="ui internally celled grid equal width stackable" style="border: 1px solid #ddd">
            <div class="column">
                <h3>Auth</h3>
            </div>
            <div class="column">
                <h3>User Management</h3>
            </div>
            <div class="equal width row">
                <div class="column">
                    <h3>Audit Trail</h3>
                </div>
                <div class="column">
                    <h3>Application Settings</h3>
                </div>
                <div class="column">
                    <h3>Media Manager</h3>
                </div>
            </div>
            <div class="equal width row">
                <div class="column">
                    <h3>Upvote/Downvote</h3>
                </div>
                <div class="column">
                    <h3>Comment Stream</h3>
                </div>
                <div class="column">
                    <h3>Messaging</h3>
                </div>
                <div class="column">
                    <h3>Notification</h3>
                </div>
            </div>
        </div>
    </div>

@endsection
