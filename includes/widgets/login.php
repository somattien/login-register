<!--gui require POST-->
<div class="widget">
  <h2>Log in/Register</h2>
  <div class="inner">
  	<form action="login.php" method="post">
    <ul id="login">
    	<li>
            	<label>username</label>
        		<input type="text" name="username" />
        </li>
        <li>
            	<label>password</label>
        		<input type="password" name="password" />
        </li>
        <li>
        		<input type="submit" value="Login"/>
        </li>
        <li>
        	<a href="register.php">Register</a>
        </li>
        <li>
            Forgotten your <a href="recover.php?mode=username">username</a> or <a href="recover.php?mode=password">password</a>
        </li>
    </ul>
    </form>
  </div>
</div>
