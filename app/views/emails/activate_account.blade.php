<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Thank you for registering in ROSECO Marketing Venture!</h2>

		<hr>

		<div>
			To activate your account, please follow this link: <a href="{{ URL::to('user/activate/'.$activation_token.'') }}">{{ URL::to('user/activate/'.$activation_token.'') }}</a>
		</div>

		<hr>
		<p style="font-size: 10px; font-style: italic;">This is a system generated email. Please do not reply.</p>
	</body>
</html>
