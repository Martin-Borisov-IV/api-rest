<?php
header('Content-Type: application/json');

echo "<h5>USER actions</h5>";
echo "<ul>";
echo "<li>GET    <b>localhost/api_rest/user</b> returns all users </li>";
echo "<li>GET    <b>localhost/api_rest/user/:id</b> takes one particular user (by id) </li>";
echo "<li>POST   <b>localhost/api_rest/user/</b> insert a new user. Needed form data(keys):";
	echo "<ul>";
	echo "<li>email</li>";
	echo "<li>first_name</li>";
	echo "<li>last_name</li>";
	echo "<li>type (0 or 1)</li>";
	echo "<li>workplace_id only if type = 1</li>";
	echo "</ul>";
echo "</li>";
echo "<li>PUT    <b>localhost/api_rest/user/:id</b> updates one particular user. Any of these fields (as form data)(keys):";
	echo "<ul>";
	echo "<li>email</li>";
	echo "<li>first_name</li>";
	echo "<li>last_name</li>";
	echo "</ul>";
echo "</li>";
echo "<li>DELETE <b>localhost/api_rest/user/:id</b> deletes one particular user (by id)</li>";
echo "</ul>";

echo "<h5>HOSPITAL actions</h5>";
echo "<ul>";
echo "<li>GET    <b>localhost/api_rest/hospital</b> returns all hospitals </li>";
echo "<li>GET    <b>localhost/api_rest/hospital/:id</b> takes one particular hospital (by id) </li>";
echo "<li>POST   <b>localhost/api_rest/hospital</b> insert a new hospital. Needed form data (keys):";
	echo "<ul>";
	echo "<li>name</li>";
	echo "<li>address</li>";
	echo "<li>phone</li>";
	echo "</ul>";
echo "</li>";
echo "<li>PUT    <b>localhost/api_rest/hospital/:id</b> updates one particular hospital. Any of these fields (as form data) (keys):";
	echo "<ul>";
	echo "<li>name</li>";
	echo "<li>address</li>";
	echo "<li>phone</li>";
	echo "</ul>";
echo "</li>";
echo "<li>DELETE <b>localhost/api_rest/hospital/:id</b> deletes one particular hospital (by id)</li>";
echo "</ul>";


echo "<h5>SEARCH/LISTING actions</h5>";
echo "<ul>";
echo "<li>GET    <b>localhost/api_rest/filter/users/:string</b> returns all users";
	echo "<ul>";
	echo "<li>If the string is only a number -> then search by the id of the hospital</li>";
	echo "<li>If the string is only a string -> then search by the name of the hospital</li>";
	echo "</ul>";
echo "</li>";
echo "<li>GET    <b>localhost/api_rest/filter/hospitals/:order</b> takes one particular user (by id). Order could be 'desc' or 'asc'.</li>";
echo "</ul>";