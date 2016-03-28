<?php
	require("api.php");

	$mysql = get_mysql();

	if($mysql == false)
	{
		echo "Something went wrong, please save your application and try again later.";
	}
	
	if(!isset($_POST['username']))
	{
		header("Location: accessDenied.html");
	}
	
	$timestamp = time();
	$username = $_POST['username'];
	$age = $_POST['age'];
	$servertime = $_POST['servertime'];
	$experience = $_POST['experience'];
	$why = $_POST['why'];
	$additionalInfo = $_POST['additionalInfo'];
	$apps = $mysql->query("select * from apps where username='".$username."' and timestamp >= '".($timestamp - 2629746)."'"); //get all apps in the past month from this user
	
	if(is_restricted($username))
	{
		echo "Sorry, you have reached your maximum amount of submitted applications.";
		return;
	}
	
	$latestApp = $apps->fetch_assoc();
	
	while($app = $apps->fetch_assoc())
	{
		if($app['timestamp'] > $latestApp['timestamp'])
		{
			$latestApp = $app;
		}
	}

	$state = get_state($latestApp['id'])['state'];
	
	if($state == "Pending")
	{
		echo "You already have a pending application.";
	}
	else if($state == "Accepted")
	{
		echo "You already have an accepted application.";
	}
	else if($state == "Denied")
	{
		echo "Please wait a few weeks before submitting another application.";
	}
	else if(!$latestApp)
	{
		$mysql->query("insert into apps (timestamp, username, age, servertime, experience, why, additionalInfo, state, hidden, score, votes) values ('".$mysql->real_escape_string($timestamp)."', '".$mysql->real_escape_string($username)."', '".$mysql->real_escape_string($age)."', '".$mysql->real_escape_string($servertime)."', '".$mysql->real_escape_string($experience)."', '".$mysql->real_escape_string($why)."', '".$mysql->real_escape_string($additionalInfo)."', 'Pending', 0, 0, 0)");
		notify_irc();
	}
	
	function notify_irc()
	{
		set_time_limit(0);
		ini_set('display_errors', 'on');
		
		$config = array(
				'server' => 'irc.esper.net',
				'port' => 6667,
				'nick' => 'ModAppNotifier',
				'name' => 'ModAppNotifier'
		);
		
		new IRCBot($config);
	}
	
	class IRCBot
	{
		var $socket;
		var $ex = array();
		var $said = 0;
		
		function __construct($config)
		{
			$this->socket = fsockopen($config['server'], $config['port']);
			$this->send_data('USER', $config['nick'].' IgneousCraftStaff '.$config['nick'].' :'.$config['name']);
			$this->send_data('NICK', $config['nick']);
			$this->main();
		}
		
		function main()
		{
			$data = fgets($this->socket, 128);
			flush();
			$this->ex = explode(' ', $data);
			
			if($this->ex[0] == 'PING')
			{
				$this->send_data('PONG', $this->ex[1]);
				
				if($this->said == 0)
				{
					$this->said = 1;
				}
			}
			
			if($this->said == 1)
			{
				$this->send_data('JOIN', '#IgneousCraftStaff');
				$this->said = 2;
			}
			else if($this->said == 2)
			{
				$this->send_data('PRIVMSG', '#IgneousCraftStaff :allicstaff, new moderator application by '.$_POST['username'].'! http://INSERTLINKHERE/app.php?id='.get_mysql()->query("select id from apps where username='".$_POST['username']."' order by timestamp asc")->fetch_assoc()['id']."&sort=down");
				$this->said = 3;
			}
			else if($this->said == 3)
			{
				$this->send_data('QUIT', 'Bye');
				echo true;
				return;
			}

			$this->main();
		}
		
		function send_data($cmd, $msg = null)
		{
			if($msg == null)
			{
				fputs($this->socket, $cmd."\r\n");
			}
			else
			{
				fputs($this->socket, $cmd.' '.$msg."\r\n");
			}
		}
	}
?>