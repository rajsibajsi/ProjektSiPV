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
        <div class="row" style="visibility: collapse; height: 0px">
            <div class="input-group" style="margin-top: 10px">
                <span class="input-group-addon" id="basic-addon1">Reciever</span>
                <input type="text" class="form-control" placeholder="Name and Surname" aria-describedby="basic-addon1" name="reciever">
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Subject</span>
                <input type="text" class="form-control" placeholder="Title" aria-describedby="basic-addon1" name="subject">
            </div>
            <br>
            <label for="basic-url">Message</label>
            <div class="input-group" style="width: 95%">
                <textarea type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" rows="5" placeholder="Write something" name="message"></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Send</button>
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
                            <th scope="row"><?php echo ($chat_counter); ?><input type="hidden" name="{{ $chatMessage->id }}"></th>
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