<!DOCTYPE html>
<html>
<head>
	<title>Rank Word's by Intersection!</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<style>
		body {
			padding: 40px 120px;
		}
	</style>

</head>
<body>

<div class="panel panel-primary text-center">
	<div class="panel-heading">
        <h1>Rank By Intersection!</h1></div>
	<div class="panel-body">
        <form action="generate_view.php" method="post">
        <p>Enter your words here (one per line).</p>
        <textarea name="words" rows="10" cols="100"></textarea><br>
        <button type="submit" onclick="goBack()" class="btn btn-primary btn-lg">Find Intersections</button>

    </form>
    </div>
</div>



</body>
</html>