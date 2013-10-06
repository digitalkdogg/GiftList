<div id = 'signup'><h1>Sign up For a new account</h1>
		<div class='inner_signup'>
			Please fill out the information below to create your account
			<form action = 'test.html' type='POST' id = 'signup_form'>
			<field><span class = 'label'>First Name : </span>
				<span class = 'input'>
					<input type = 'text' id='first_name' name = 'first_name' class='required' />
				</span>
			</field>	
			<field>
				<span class = 'label'>Last Name : </span>
				<span class = 'input'>
					<input type = 'text' name = 'last_name' class='required' />
				</span>
			</field>
			<field>	
				<span class = 'label'>User Name : </span>
				<span class = 'input'>
					<input type = 'text' name = 'user_name' class='required' />
				</span>
			</field>
			<field>	
				<span class = 'label'>Email : </span>
				<span class = 'input'>
					<input type = 'text' name = 'email' class = 'required e-mail' />
				</span>
			</field>
			<field>	
				<span class = 'label'>Password : </span>
				<span class = 'input'>
					<input type = 'password' name = 'password1' class = 'required' />
				</span>
			</field>	
			<field>
				<span class = 'label'>Confirm Password : </span>
				<span class = 'input'>
					<input type = 'password' name = 'password2' class = 'required'/>
				</span>
			</field>
			<input type = 'submit' id ='signup1' />
			</form>
			<div id = 'selectors'>
			<span class = 'selector one'></span>
			<span class = 'selector'></span>
			<span class = 'selector'></span>
			</div>