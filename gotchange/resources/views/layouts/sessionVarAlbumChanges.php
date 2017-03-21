<php
if(session('albumEditing') === 'false')
{
	session(['albumEditing', 'true']);
	return response('ok');
}
else if(session('albumEditing') === 'true')
{
	session(['albumEditing', 'false']);
	return response('ok');
}
?>