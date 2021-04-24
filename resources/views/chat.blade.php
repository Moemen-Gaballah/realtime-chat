<!DOCTYPE html>
<html>
<head>
	<title>Chat App</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<style type="text/css">
		.list-group{
			overflow-y: scroll;
			height: 200px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row" id="app">
			<div class="offset-md-3 col-md-6">
				<li class="list-group-item active">Chat Room
					<span class="badge badge-pill badge-warning" style="position: relative;">@{{ numberOfUsers }}</span>
					<span @click.prevent="deleteSession" class="btn btn-danger btn-sm" style="position: absolute;right: 20px;">Delete</span>
				</li>
				<div class="badge badge-pill badge-primary">@{{ typing }}</div>
				<ul class="list-group" v-chat-scroll>
					<message v-for="value,index in chat.message" 
						:key="value.index" 
						:color=chat.color[index]
						:user=chat.user[index]
						:time=chat.time[index]
						>@{{value}}</message>
					
				</ul>
				<input v-model="message" @keyup.enter="send" type="text" class="form-control" placeholder="Type your message here...">
			</div>
		</div>
	</div>

<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript">

	Echo.private('chat')
	    .listen('ChatEvent', (e) => {
	        console.log('ChatEvent: ' + e.message)
	    });

</script>


</body>
</html>