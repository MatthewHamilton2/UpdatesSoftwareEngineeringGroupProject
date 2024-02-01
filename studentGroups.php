<?php
  include("connect.php");
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>student-group-page</title>
  <link rel="stylesheet" href="style.css">
</head>
<body id="studentGroupBody">
  <div id="nav-bar">
    <button class="backButton" onclick="goto('index.php')">&larr;</button>
    <div id="nav-bar-header">
    <?php
        $groupid = $_GET['groupid'];
        $sql = "SELECT groupname FROM chatgroup WHERE groupid = '$groupid'";
        $result = mysqli_query($conn, $sql);
        $groupname = mysqli_fetch_assoc($result)['groupname'];
        echo "<h3>".$groupname."</h3>";
      ?>
      <button id="settings-button">Settings</button>
    </div>
    <div id="channels">
      <h4>Text Channels</h4>
      <button class="channelButton">#general</button>
      <button class="channelButton">#random</button>
    </div>
  </div>
  <div id="chat">
    <div id ="chatdiv">
      <?php
      $groupid = $_GET['groupid'];
        $sql = "SELECT * FROM (SELECT * FROM message WHERE groupid = ".$groupid." ORDER BY timeSent DESC LIMIT 10) AS subquery ORDER BY subquery.timeSent ASC";
        $result = mysqli_query($conn, $sql);
        echo"<div class = 'chatcontainer'>";
        while($row = mysqli_fetch_assoc($result)){
            $message = $row['messageText'];
            $sender = $row['user'];
            echo "
            <div class='chatmessage'>
            <p class='messagesender'>$sender"."<br>"."</p>
            <p>$message"."<br>"."</p>
            </div>
            ";
        }
        echo"</div>";
      ?>
    </div>
    <div id="inputContainer">
      <?php
      $groupid = $_GET['groupid'];
      echo"
      <form id='chatform' method='post' action='sendMessage.php?groupid=".$groupid."'>
        <input type='text' id='messageInput' placeholder='Type your message...' name = 'message'>
      </form>
      ";
      ?>
    </div>
  </div>
  <div id="members-bar">
    <div id="members">
      <h4>Members</h4>
    </div>
    <div id="members-list">
      <ul>
        <?php
          $sql = "SELECT user FROM groups2users WHERE groupid='$groupid'";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
            $username = $row['user'];
            echo"
              <li class='users'>".$username."</li>
            ";
          }
        ?>
      </ul>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <?php
  $groupid = $_GET['groupid'];
  echo"
  <script>
    $(document).ready(function(){
      setInterval(function(){
        $('#chatdiv').load('studentGroups.php?groupid=".$groupid." #chatdiv');
      }, 3000);
    });
  </script>
  "
  ?>
  <script>
    function goto(destination){
        location.href = destination;
    }
  </script>
</body>
</html>