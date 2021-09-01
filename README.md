# api-rest

<h5>USER actions</h5>
<ul>
<li>GET    <b>localhost/api_rest/user</b> returns all users </li>
<li>GET    <b>localhost/api_rest/user/:id</b> takes one particular user (by id) </li>
<li>POST   <b>localhost/api_rest/user/</b> insert a new user. Needed form data(keys):
	<ul>
	<li>email</li>
	<li>first_name</li>
	<li>last_name</li>
	<li>type (0 or 1)</li>
	<li>workplace_id only if type = 1</li>
	</ul>
</li>
<li>PUT    <b>localhost/api_rest/user/:id</b> updates one particular user. Any of these fields (as form data)(keys):
	<ul>
	<li>email</li>
	<li>first_name</li>
	<li>last_name</li>
	</ul>
</li>
<li>DELETE <b>localhost/api_rest/user/:id</b> deletes one particular user (by id)</li>
</ul>

<h5>HOSPITAL actions</h5>
<ul>
<li>GET    <b>localhost/api_rest/hospital</b> returns all hospitals </li>
<li>GET    <b>localhost/api_rest/hospital/:id</b> takes one particular hospital (by id) </li>
<li>POST   <b>localhost/api_rest/hospital</b> insert a new hospital. Needed form data (keys):
	<ul>
	<li>name</li>
	<li>address</li>
	<li>phone</li>
	</ul>
</li>
<li>PUT    <b>localhost/api_rest/hospital/:id</b> updates one particular hospital. Any of these fields (as form data) (keys):
	<ul>
	<li>name</li>
	<li>address</li>
	<li>phone</li>
	</ul>
</li>
<li>DELETE <b>localhost/api_rest/hospital/:id</b> deletes one particular hospital (by id)</li>
</ul>


<h5>SEARCH/LISTING actions</h5>
<ul>
<li>GET    <b>localhost/api_rest/filter/users/:string</b> returns all users
	<ul>
	<li>If the string is only a number -> then search by the id of the hospital</li>
	<li>If the string is only a string -> then search by the name of the hospital</li>
	</ul>
</li>
<li>GET    <b>localhost/api_rest/filter/hospitals/:order</b> takes one particular user (by id). Order could be 'desc' or 'asc'.</li>
</ul>
