@extends('layouts.app')

@section('content')

<script>
$(function(){
    $('.chatSent').click(function(){
        $('.chatTitle').text('Messages - Sent Items');
        $('.chatDiv').empty();

        $('.chatDiv').load('chat/sent');
    });

    $('.chatInbox').click(function(){
        $('.chatTitle').text('Messages - Inbox');
        $('.chatDiv').empty();

        $('.chatDiv').load('chat/inbox');
    });

    $('.chatNewButton').click(function(){
        $('.chatTitle').text('New Message');
        $('.chatDiv').empty();

        $('.chatDiv').load('chat/newMessage');
    });
});
</script>

<div class="container">
    <div class="col-sm-3">
        <div class="row">
            <div class="col-sm-8">
            	<div class="row" style="border-bottom: black 1px solid; padding-bottom: 10px; padding-left: -20px">
            		<button type="button" class="btn btn-outline-warning chatNewButton">New Message</button>
            	</div>
                <div class="row">
                	<h5 class="chatSelection chatInbox">Inbox</h5>
                	<h5 class="chatSelection chatSent">Sent items</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
    	<div class="row" style="border-bottom: black 1px solid;">
    		<h2 class="chatTitle">Messages</h2>
    	</div>
    	<div class="row chatDiv">
    		<table class="table table-striped">
    			<thead class="thead-default">
    				<tr>
    					<th>#</th>
    					<th>Sender</th>
    					<th>Subject</th>
                        <th>Message</th>
    					<th>Time</th>
    				</tr>
    			</thead>
    			<tbody>
                    @foreach($chatMessages as $chatMessage)
                        <?php $chat_counter = 1 ?>
                        <tr>
                            <th scope="row"><?php echo ($chat_counter); ?></th>
                            <td>{{ $chatMessage->sender_name }}</td>
                            <td>{{ $chatMessage->subject }}</td>
                            <td>{{ $chatMessage->message }}</td>
                            <td>{{ $chatMessage->sent_at }}</td>
                        </tr>
                        <?php $chat_counter += 1 ?>
                    @endforeach
    			</tbody>
    		</table>
    	</div>
    </div>
</div>

@endsection