<div id = 'form' >
	<div id = 'step1'>
	<div id = 'signup' name = 'signup'><h1>Sign up For a new account</h1>
		<div class='inner_signup'>
			<form action = 'test.html' type='POST' id = 'signup_form'>
			<field><span class = 'label'>First Name : </span>
				<span class = 'input'>
					<input type = 'text' id='first_name' name = 'first_name' class='required' size='30' />
				</span>
			</field>
			<field>
				<span class = 'label'>Last Name : </span>
				<span class = 'input'>
					<input type = 'text' id='last_name' name = 'last_name' class='required' size = '30' />
				</span>
			</field>
			<field>
				<span class = 'label'>User Name : </span>
				<span class = 'input'>
					<input type = 'text' id='username' name = 'username' class='required' size='30' />
				</span>
			</field>
			<field>
				<span class = 'label'>Email : </span>
				<span class = 'input'>
					<input type = 'text' id = 'email' name = 'email' class="required" id = "email" size = '40' />
				</span>
			</field>
			<field>
				<span class = 'label'>Password : </span>
				<span class = 'input'>
					<input type = 'password' id = 'password1' name = 'password1' class = 'required' size = '30' />
				</span>
			</field>
			<field>
				<span class = 'label'>Confirm Password : </span>
				<span class = 'input'>
					<input type = 'password' id = 'password2' name = 'password2' class = 'required' size = '30' />
				</span>
			</field>
			<input type = 'submit' class ='signup_btn' />
			</form>
		</div>
		<div id = 'selectors'>
			<span class = 'selector one'></span>
			<span class = 'selector'></span>
			<span class = 'selector'></span>
		</div>
	</div>
</div>


<div id = 'step2' class = 'rotate_right_90'>
	<div id = 'signup' name = 'signup'><h1>Pick a name for your first list</h1>
		<div class='inner_signup'>
			<form action = '#' type='POST'>
			<field>
				<span class = 'label'>Gift List : </span>
				<span class = 'input'>
					<input type = 'text' name = 'list_title' id = 'list_title' size = '30' />
				</span>
			</field>
			<input type = 'submit' class ='signup_btn' />
			</form>
		</div>
		<div id = 'selectors'>
			<span class = 'selector'></span>
			<span class = 'selector one'></span>
			<span class = 'selector'></span>
		</div>
	</div>
</div>

<div id = 'step3' class = 'rotate_right_90'>
	<div id = 'signup' name = 'signup'><h1>Confirm the data</h1>
		<div class='inner_signup'>
				<form id = "conf_submit" action = "dashboard/submit_new_account" type = 'POST'>
				<field>
				<span class = 'label'>First Name : </span>
				<span class = 'input'>
					<input type = 'text' id = 'conf_first_name' readonly />
				</span>
				</field>
				<field>
				<span class = 'label'>Last Name : </span>
				<span class = 'input'>
					<input type = 'text' id = 'conf_last_name' readonly />
				</span>
			</field>
			<field>
				<span class = 'label'>UserName : </span>
				<span class = 'input'>
					<input type = 'text' id = 'conf_username' readonly />
				</span>
			</field>
			<field>
				<span class = 'label'>Email : </span>
				<span class = 'input'>
					<input type = 'text' id = 'conf_email' readonly />
				</span>
			</field>
			<field>
				<span class = 'label'>List Title : </span>
				<span class = 'input'>
					<input type = 'text' id = 'conf_list_title' readonly />
				</span>
			</field>

				<input type = 'submit' class ='conf_submit' />
			</form>
		</div>
		<div id = 'selectors'>
			<span class = 'selector'></span>
			<span class = 'selector'></span>
			<span class = 'selector one'></span>
		</div>

	</div>
</div>
</div>