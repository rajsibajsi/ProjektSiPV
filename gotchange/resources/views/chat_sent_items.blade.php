<table class="table table-striped">
 <thead class="thead-default">
    <tr>
       <th>#</th>
       <th>Reciever</th>
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
            <td>{{ $chatMessage->reciever_name }}</td>
            <td>{{ $chatMessage->subject }}</td>
            <td>{{ $chatMessage->message }}</td>
            <td>{{ $chatMessage->sent_at }}</td>
        </tr>
        <?php $chat_counter += 1 ?>
    @endforeach
</tbody>
</table>