<html>
	<head>
	</head>
	<body>

	<style>
		table {
			width: 100%;
		}
		td {
			width: 100%;
		}
	</style>
</html>

<?php

	#start of script
	require 'header.php';

	if (!isset($_SESSION['username'])) {
		$end_url = "index.php";
		ob_start();
		header('Location: '.$end_url);
		ob_end_flush();
		die();
	}

	if ($_SERVER['REQUEST_METHOD'] != "POST") {
		echo '<form action="post.php" method="post" id="post_form">';
			echo '<table>';
				echo '<tr><td>';
					echo '<textarea name="content" form="post_form" cols="45" rows="10" placeholder="Post here, you can even use <b>HTML</b> styling! 256 character limit. Try and include at least 1 personal detail about your life, thanks."></textarea>';
				echo '</td></tr>';
				echo '<tr><td>';
					echo '<input type="submit" value="Post">';
				echo '</td></tr>';
			echo '</table>';
		echo '</form>';
		exit();
	}

	if(strlen($content) > 256) {
		echo '<font color="red">ERROR: Post is too long (256 character limit)</font>';
		exit();
	}

	#check to see if there are script tags
	if(preg_match("#</?[sS][cC][rR][iI][pP][tT].*?>#", $content)) {
		echo '<font color="red">ERROR: The use of JavaScript is not allowed!</font>';
		exit();
	}

	$username = $_SESSION['username'];
	$content = $_POST['content'];

	# add post
	require 'database.php';
	$query = "INSERT INTO Posts (posted_on, posted_by, content) VALUES (NOW(), '$username', '$content');";
	$result = mysqli_multi_query($connection, $query);

	if(!$result) {
		echo '<font color="red">ERROR: There was an error creating your post! Please contact SocialBook support and give them the following error message:<br>'.$connection->error.'</font>';
		exit();
	}

	#return to index
	$end_url = "index.php";
	ob_start();
	header('Location: '.$end_url);
	ob_end_flush();
	exit();
?>

</body>
</html>
