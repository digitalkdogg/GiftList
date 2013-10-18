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
					<input type = 'text' id = 'email' name = 'email' class="required" id = "email" size = '30' />
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
			<button class ='next_btn'>Next</button>
			</form>
		</div>
		<div id = 'selectors'>
			<span class = 'selector one'></span>
			<span class = 'selector'></span>
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
			<button class ='prev_btn'>Back</button>
			<button class ='next_btn'>Next</button>
			</form>
		</div>
		<div id = 'selectors'>
			<span class = 'selector'></span>
			<span class = 'selector one'></span>
			<span class = 'selector'></span>
			<span class = 'selector'></span>
		</div>
	</div>
</div>

<div id = 'step3' class = 'rotate_right_90'>
	<div id = 'signup' name = 'signup'><h1>Pick A Gift List Admin</h1>
		<div class='inner_signup'>
				<form action = "#" type = 'POST'>
				<field>
				<span class = 'label'>List Admin Name: </span>
				<span class = 'input'>
					<input type = 'text' name = 'gift_admin_name' id = 'gift_admin_name'  size = '40' />
				</span>
				</field>
				<field>
				<span class = 'label'>List Admin Email : </span>
				<span class = 'input'>
					<input type = 'text' name='gift_admin_email' id = 'gift_admin_email' size='40' />
				</span>
			</field>
				<button class ='prev_btn'>Back</button>
				<button class ='next_btn'>Next</button>
			</form>
		</div>
		<div id = 'selectors'>
			<span class = 'selector'></span>
			<span class = 'selector'></span>
			<span class = 'selector one'></span>
			<span class = 'selector'></span>
		</div>

	</div>
</div>

<div id = 'step4' class = 'rotate_right_90'>
	<div id = 'signup' name = 'signup'><h1>Confirm the data</h1>
		<div class='inner_signup'>
				<form id = "conf_submit" action = "dashboard/submit_new_account" type = 'POST'>
				<field>
				<span class = 'label'>First Name : </span>
				<span class = 'input'>
					<span id = 'conf_first_name'></span>
				</span>
				</field>
				<field>
				<span class = 'label'>Last Name : </span>
				<span class = 'input'>
					<span id = 'conf_last_name'></span
				</span>
			</field>
			<field>
				<span class = 'label'>UserName : </span>
				<span class = 'input'>
					<span id = 'conf_username'></span
				</span>
			</field>
			<field>
				<span class = 'label'>Email : </span>
				<span class = 'input'>
					<span id = 'conf_email'></span>
				</span>
			</field>
			<field>
				<span class = 'label'>List Title : </span>
				<span class = 'input'>
					<span id = 'conf_list_title'></span>
				</span>
			</field>
			<field>
				<span class = 'label'>List Name : </span>
				<span class = 'input'>
					<span id = 'conf_gift_admin_name'></span>
				</span>
			</field>
			<field>
				<span class = 'label'>List Title : </span>
				<span class = 'input'>
					<span id = 'conf_gift_admin_email'></span>
				</span>
			</field>
				<button class ='prev_btn'>Back</button>
				<input type = 'submit' class ='conf_submit' />
			</form>
		</div>
		<div id = 'selectors'>
			<span class = 'selector'></span>
			<span class = 'selector'></span>
			<span class = 'selector'></span>
			<span class = 'selector one'></span>
		</div>

	</div>
</div>
</div>