<form role="form" method="POST" action="{{ route('chat/sendMessage') }}">
	{{ csrf_field() }}
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
</form>