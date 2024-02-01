<?php
session_start();
include("connect.php");
?>

<!DOCTYPE html>

<html>

<head>


	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<header>
			<span class="navSpan" onclick = "openNav()">&#9776;</span>
			<div class="logo">
			  <img src="placeHolder.PNG" alt="Collab Nexus Logo">
			  <h1>Task Troopers: Home</h1>
			</div>
			<div class="profile">
			  <img src="placeHolder.PNG" alt="Profile Picture" class="profile-picture">
			</div>
		</header>

<body class="unset">

	<div id="main">


		<div id="sidenavbar" class="sidenav" style="display:none">


			<a href="index.php">Home</a>
			<a href="Profile.html" class="split">My Profile</a>
			<a href="Settings.html" class="split">Settings</a>
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		</div>

		<section>
			<div id="annheader" class="announcements">
				<span> <h3>Recent announcements</h3> <button type="button" onclick="appearModal('modalAnnouncement')"> Make New Announcement </button> </span>
			</div>
			<div id="annbody" class="announcements">
				<?php
				$groupid = $_GET['groupid'];
				$sql = "SELECT announcementtext, sender, timesent FROM announcements WHERE groupid = '$groupid' ORDER BY timesent DESC LIMIT 3";
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($result)) {
					$text = $row['announcementtext'];
					$displayedtext = substr($text, 0, 150) . "...";
					$sender = $row['sender'];
					$time = $row['timesent'];
					echo "
					<div class='announcement'>
					<p>" . $sender . "<br>" . $displayedtext . "<br>" . $time . "</p>
					</div>
					";
				}
				?>
			</div>
		</section>

	</div>

	<section id="groupsection">

		<div id="groupdisplaybar" class="groupdisplay">

			<div id="groupheader" class="groupdisplay">
				<span style="font-size:30px;">
					<h3>Groups</h3> <a href="javascript:void(0)" class="addgroup" onclick="">&plus;</a>
				</span>
			</div>

			<div id="groups" class="groupdisplay">

				<ul>
					<?php
					$sql = "SELECT discussionName FROM discussions WHERE groupid = '$groupid'";
					$result = mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_assoc($result)) {
						$name = $row['discussionName'];
						echo " <a href='discussion.php?groupid=" . $groupid . "&name=" . $name . "'>
						<li><h3>" . $name . "</h3></li>
						</a>
						";
					}
					?>
				</ul>


			</div>
		</div>
	</section>

	<section id="chatsection">
			<div id="chatboxdisplay" class="chatbox">
				<div id="chatheader" class="chatbox">
					<h1>Group1 Preview</h1>
				</div>
				<div id="chatcontent" class="chatbox">
					<ul>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
						<li><h3>message1</h3></li>
					
					</ul>
				</div>
			</div>	
		</section>

	<dialog id="modalAnnouncement">
		<button onclick="disappearModal('modalAnnouncement')">X</button><br>
		<?php
		$groupid = $_GET['groupid'];
		echo "
            <Form action='createAnnouncement.php?groupid=" . $groupid . "' method='post'>
				<input type = 'text' placeholder = 'Announcement' id='announcementBox' name='announcementText' maxnumber='100'>
				<input type='submit'>
			</Form>
			"
		?>
	</dialog>

	<dialog id="modalDiscussion">
		<button onclick="disappearModal('modalDiscussion')">X</button><br>
		<?php
		$groupid = $_GET['groupid'];
		echo "
            <Form action='createDiscussion.php?groupid=" . $groupid . "' method='post'>
				<input type = 'text' placeholder = 'Discussion Name' name='discussionName' maxnumber='100'>
				<input type='submit'>
			</Form>
			"
		?>
	</dialog>

	<script>
		window.onload = closeNav();

		function openNav() {
			document.getElementById("sidenavbar").style.width = "250px";
			document.getElementById("sidenavbar").style.display = "block";
			document.getElementById("main").style.marginLeft = "250px";

		}

		function closeNav() {
			document.getElementById("sidenavbar").style.width = "0";
			document.getElementById("sidenavbar").style.display = "none";
			document.getElementById("main").style.marginLeft = "0";
		}

		function appearModal(modal) {
			document.getElementById(modal).showModal();
		}

		function disappearModal(modal) {
			document.getElementById(modal).close();
		}
	</script>
	</div>
</body>



</html>