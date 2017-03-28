@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-sm-3">
        <div class="row">
            <div class="col-sm-8">
            	<div class="row" style="border-bottom: black 1px solid; padding-bottom: 10px; padding-left: -20px">
            		<button type="button" class="btn btn-outline-warning">New Message</button>
            	</div>
                <div class="row">
                	<h5 class="chatSelection">Inbox</h5>
                	<h5 class="chatSelection">Sent items</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
    	<div class="row" style="border-bottom: black 1px solid;">
    		<h2>Messages</h2>
    	</div>
    	<div class="row">
    		<table class="table table-striped">
    			<thead class="thead-default">
    				<tr>
    					<th>#</th>
    					<th>Sender</th>
    					<th>Subject</th>
    					<th>Time</th>
    				</tr>
    			</thead>
    			<tbody>
    				<tr>
    					<th scope="row">1</th>
    					<td>Mark</td>
    					<td>Otto</td>
    					<td>@mdo</td>
    				</tr>
    				<tr>
    					<th scope="row">2</th>
    					<td>Jacob</td>
    					<td>Thornton</td>
    					<td>@fat</td>
    				</tr>
    				<tr>
    					<th scope="row">3</th>
    					<td>Larry</td>
    					<td>the Bird</td>
    					<td>@twitter</td>
    				</tr>
    			</tbody>
    		</table>
    	</div>
    </div>
</div>

@endsection