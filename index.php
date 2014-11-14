
<html>
<head>
	<title>Welcome to the HOSPITAL</title>
	<style type="text/css">
	body{background-color:  #DDEFD4;
		margin: 0px;}
	.header{
		height: 100px;
		background-color:rgb(77, 205, 117);
		back
		width: 100%;
		margin: 0px;
		font-size: 50px;
	}
	.table {
		font-size: 20px;
		font-family: sans-serif ;
		margin-top: 100px;
		color: #35514B;

	}
	.right {
		text-align: right;
		padding-bottom: 10px;

	}
	</style>
	</head>
	<body >
	<div class="header">
	<p style="margin-top:22px;margin-right: 40px;float:right;color: #35514B">DBIS</p>
	</div>
	<form action="orch.php" method="POST" >
	<center><table  class="table" >
		<tr><td class="right">
			Name: 
		</td>
		<td class="right"><input type="text" name="name" placeholder="darshan"></td>
		</tr>
		<tr><td class="right">
			Contact Number: 
		</td>
		<td class="right"><input type="text" name="contact" placeholder="08888888888"></td>
		</tr>
		<tr><td class="right">
			Bloodgroup: 
		</td>
		<td class="right"><input type="text" name="bloodgroup" placeholder="B+"></td>
		</tr>
		<tr><td class="right">
			disease: 
		</td>
		<td class="right"><input type="text" name="disease" placeholder="fever"></td>
		</tr>
		<tr><td class="right">
			disease strength: 
		</td>
		<!--<td class="right"><input type="text" name="strength" placeholder="mild/severe/medium"></td> -->
		<td>
		<select name ="strength">
			<option value="mild">mild</option>
			<option value="normal">normal</option>
			<option value="severe">severe</option>
		</select>
		</td>
		</tr>
		
	</table>
	<br><br>
	<input type="image" src="img/submit.png" width="135px" value="submit" />
	</center>
	</form>
	</body>
	</html>