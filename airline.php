<html>
	<body>LOGIN TO AIRLINE WORKS!<br>
		Logged in by user with license:
	<?php
		if(isset($_GET['li_num'])){
			$li_num = $_GET['li_num'];
			echo $li_num;
		}
	?>
	</body>
</html>