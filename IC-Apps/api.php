<?php
	function get_mysql()
	{
		$mysql = new mysqli("localhost", "root", "", "applications");
		
		if($mysql->connect_error)
		{
			return false;
		}
		
		return $mysql;
	}
	
	function get_app($id)
	{
		return get_mysql()->query("select * from apps where id='".get_mysql()->real_escape_string($id)."'")->fetch_assoc();
	}
	
	function get_state($id)
	{
		return get_mysql()->query("select state from apps where id='".$id."'")->fetch_assoc();
	}
	
	function outline_accepted($id)
	{
		$state = get_state($id);
		
		if($state == "Accepted")
		{
			return "active";
		}
		else
		{
			return "";
		}
	}
	
	function outline_denied($id)
	{
		$state = get_state($id);
	
		if($state == "Denied")
		{
			return "active";
		}
		else
		{
			return "";
		}
	}
	
	function outline_pending($id)
	{
		$state = get_state($id);
	
		if($state == "Pending")
		{
			return "active";
		}
		else
		{
			return "";
		}
	}
	
	function is_restricted($name)
	{
		$count = get_mysql()->query("select username from restrictions where username='".$_POST['username']."'")->num_rows;
		
		if($count == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function hide($switch, $value)
	{
		if($value == "f")
		{
			return $switch ? "t" : "<span class=\"glyphicon glyphicon-minus-sign\" aria-hidden=\"true\"></span> Hide";
		}
		else
		{
			return $switch ? "f" : "<span class=\"glyphicon glyphicon-plus-sign\" aria-hidden=\"true\"></span> Show";
		}
	}
	
	function get_score($id)
	{
		return get_mysql()->query("select score from apps where id=".$id)->fetch_assoc()['score'];
	}
	
	function get_votes($id)
	{
		return get_mysql()->query("select votes from apps where id=".$id)->fetch_assoc()['votes'];
	}
	
	function format_score($id)
	{
		$value = get_score($id);
		
		if($value == 0)
		{
			return "&#177;0";
		}
		else if($value > 0)
		{
			return "+".$value;
		}
		else
		{
			return $value;
		}
	}
	
	function has_voted($username, $id)
	{
		$value = get_mysql()->query("select username from votedOn where username='".$username."' and id=".$id)->num_rows;
		
		if($value > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function is_admin($username)
	{
		return get_mysql()->query("select admin from users where username='".$username."'")->fetch_assoc()['admin'] == 1 ? true : false;
	}
	
	function can_register($input)
	{
		$state = get_mysql()->query("select state from register")->fetch_assoc()['state'];
		
		if($input)
		{
			return $state == 0 ? 1 : 0;
		}
		else
		{
			return $state == 1 ? "Disable" : "Enable";
		}
	}
?>