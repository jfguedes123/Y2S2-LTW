<?php
declare(strict_types=1);
require_once(dirname(__DIR__) . '/database/connection.php');
require_once(dirname(__DIR__) . '/classes/user.php');

function drawUserInfo($user, $mode, $viewer){
    if( $mode ) { ?> <!--  Editar Perfil   -->
      <form action="profile.php" method=post class="userChanges">
        
        <p><span>Username:</span></p>
        <textarea name="username" placeholder = "<?php echo $user->get_username();?>"></textarea><br>
        
        <p><span>Name:</span></p>
        <textarea name="name" placeholder = "<?php echo $user->get_name();?>"></textarea><br>
        
        <p><span>Email:</span></p>
        <textarea name="email" placeholder = "<?php echo $user->get_email();?>"></textarea><br>
        
        <p><span>Rank:</span></p>
        <p><?php echo $user->get_rank(); ?></p>
        
        <label class="password" for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        
        <label class="password" for="confirm-password">Repeat Password:</label>
        <input type="password" id="confirm-password" name="confirm-password"><br><br>
        
        <button type="submit">Send</button>
      </form>
      <?php } else { ?> <!-- Visão de Perfil -->
      
      <div class="profile-picture">   <!-- se calhar a profile picture devia estar dentro da class profile-details -->
      <img src="../docs/profile_picture.png" alt="Profile Picture">
      </div>
      
      <div class="profile-details">
          
          <p><span>Username:</span></p>
          <div class="usernames">
          <p><?php echo $user->get_username(); ?></p>
          </div>
          
          <?php if($user->get_username() == $viewer->get_username()){ ?> <!-- só mostra o nome real se for o user a ver a página -->
            <p><span>Name:</span></p>
            <div class="name">
            <p><?php echo $user->get_name(); ?></p>
          <?php } ?>
            </div>
          
          <p><span>Email:</span></p>
          <div class="email">
          <p><?php echo $user->get_email(); ?></p>
          </div>
          
          <p><span>Rank:</span></p>
          <div class="rank">
          <?php if($viewer->get_rank() == "admin"){ ?>
          <form action="profile.php?userToView=<?php $user->get_username();?>" method=post class="adminrankchange">
            <select name="adminrankchange">
            <option value=""> <?php echo "current: " . $user->get_rank(); ?> </option>
            <option value=client>client</option>
            <option value=agent>agent</option>
            <option value=admin>admin</option>
            </select>
            <button type="submit">Promote/Demote</button>
          </form>
          <?php } else { ?>
          <p><?php echo $user->get_rank();} ?></p>
          </div>

        </div>
    <?php };
}

function drawUserPage($user, $mode, $viewer, $error) { ?>
 <html>
    <head>
        <title>User Profile</title>
        <link rel="stylesheet" href="../css/profilestyle.css">
    </head>

    <body>
      <div class="profile">
        <h1>Personal Information</h1>
        <?php switch ($error) { //error messages
                case 1:
                    echo "<span class=error>Username must have between 1 and 10 characters and contain no special characters</span>";
                    break;
                case 2:
                    echo "<span class=error>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.</span>";
                    break;
                case 3:
                    echo "<span class=error>Password different from confirmation</span>";
                    break;
                case 4:
                    echo "<span class=error>Username already exists</span>";
                    break;
                case 5:
                    echo "<span class=error>Database error</span>";
                    break;
            }
            ?>
        <div class="personalinfo">
        <?php drawUserInfo($user, $mode, $viewer);
        if(!$mode && $user->get_username() == $viewer->get_username()){?>
          <form action="profile.php" method=post class="edit">
            <input type="hidden" name="edit" value="true">
            <button type="submit">Edit</button>
          </form> 
        <?php };?>
        </div>
      </div>
    </body>

    </html>
<?php
}

?>