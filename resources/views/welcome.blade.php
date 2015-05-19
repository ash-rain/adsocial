<html>
	<head>
		<title>Laravel</title>

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: sans-serif;
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
				margin-bottom: 40px;
			}

			.quote {
				font-size: 24px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title">AdSocial</div>
				<div class="quote">
					<a href="{!! action('Auth\AuthController@getLogin') !!}">{{ trans('app.login') }}</a>
					<a href="{!! action('Auth\AuthController@getRegister') !!}">{{ trans('app.register') }}</a>
				</div>
			</div>
		</div>
	</body>
</html>
