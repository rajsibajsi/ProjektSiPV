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
    <?php $chat_counter = 1 ?>
    @foreach($chatMessages as $chatMessage)
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