<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class='container'>
	<div class='innerContainer'>
		<div class='  paddingAll20 size400px'>
			<form method='POST' action='' class='simpleForm'>
				<div  class='sectionTitle'>
					<h2>Login</h2>
				</div>
				<div class='fieldSimpleForm'>
					<label for='username'>Username</label>
					<input id='username' name='username' type='text' placeholder="Username"/>
				</div>
				<div class='fieldSimpleForm'>
					<label for='password'>Password</label>
					<input id='password' name='password' type='password' placeholder="Password"/>
				</div>
				<button type='submit' class='right primaryButton'>Login</button>
			</form>
		</div>
		
	</div>
</div>