<script>
</script>

<form role="form" method="POST" action="{{ url('sendMessage') }}">
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
	<div class="newRequest" style="margin-bottom: 10px">
		<h5>Name or id of coin you want to trade with</h5>
		<input type="text" name="ownedCoin" size="30" class="form-control col-sm-4 ownedCoin" placeholder="Please enter coin name or id you own">
		<div id="suggestions"></div>
	</div>
	<button type="button" class="btn btn-primary">Add Request</button>
	<button type="submit" class="btn btn-primary">Send</button>
</form>