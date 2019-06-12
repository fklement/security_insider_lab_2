<?php
$alv_image='alv.jpg';

$venice=base64_decode('MTY3OC0wMy0wNA==');
$vienna=base64_decode('MTc0MS0wNy0yOA==');

$cookie_name='le_quattro_stagioni';
$flag_file='flag.php';

if(isset($_COOKIE[$cookie_name])) $cookie_file = $_COOKIE[$cookie_name];
else {
	$cookie_file = 'l_estro_armonico.txt';
	setcookie($cookie_name, $cookie_file);
}

function eae($param, $value) {
	return isset($_GET[$param]) && $_GET[$param] === $value; 
}

if(strpos($cookie_file, $flag_file) !== false) {
	if(eae('venice', $venice) && eae('vienna', $vienna)) {
		switch($cookie_file){
			case 'l_estro_armonico.txt':
				include('l_estro_armonico.txt');
			case 'success.txt':
				include('success.txt');
			case 'not_authorized.txt':
				include('not_autorized.txt');
			default:
				break;

		}
		$cookie_file = 'success.txt';
	} else $cookie_file = 'not_authorized.txt';
}
?>

<head>
	<title>Antonio Lucio Vivaldi - Fanpage</title>
	<style>
		.page {
			width: 800px;
			height: 500px;
			margin:auto;
			background-image: url(/<?php echo $alv_image;?>);
			background-repeat: no-repeat;
	
		}
		.content {
			padding: 20px;
			width: 760px;
			background-color: rgba(250, 250, 250, 0.85);	
			display: none;
		}
		.tabs {
			height: 50px;
			overflow: hidden;
			background-color: rgba(10, 10, 10, 0.8);
		}
		.tab {
			background-color: transparent;
			float: left;
			border: none;
			outline: none;
			cursor: pointer;
			padding: 14px 16px;
			transition: 0.3s;
			font-size: 18;
			color: #fafafa;
		}
	</style>
	<script>
		function change_tab(id) {
			var tab_contents = document.getElementsByClassName("content");
			for (i = 0; i < tab_contents.length; ++i) {
				tab_contents[i].style.display = "none";
			}
			document.getElementById(id).style.display = "block";
		}
	</script>
</head>

<body style="background-color: black;">
	<div class="page">
		<div class="tabs">
			<button class="tab" onclick="change_tab('main')">Main</button>
			<button class="tab" onclick="change_tab('alv')">About the great composer</button>
			<button class="tab" onclick="change_tab('about')">About us</button>
			<button class="tab" onclick="change_tab('password_here')">Our top ten</button>
		</div>
		<div class="content" id="main" style="display: block; text-align: center; color:#fafafa; background-color: rgba(10,10,10, 0.5);">
			<h1> Antonio Lucio Vivaldi </h1>
			<h2> Fan page of one of the greatest composers ever! </h2>

		</div>
		<div class="content" id="alv">
			<h1>Antonio Lucio Vivaldi</h1>
			<p>Antonio Lucio Vivaldi (4 March 1678 – 28 July 1741) was an Italian Baroque musical composer, virtuoso violinist, teacher, and priest. Born in Venice, the capital of the Venetian Republic, he is regarded as one of the greatest Baroque composers, and his influence during his lifetime was widespread across Europe. He composed many instrumental concertos, for the violin and a variety of other instruments, as well as sacred choral works and more than forty operas. His best-known work is a series of violin concertos known as the Four Seasons.</p>
			<p>Source: https://en.wikipedia.org/wiki/Antonio_Vivaldi<p>
			<p>I mean seriously you should no that guy and if not look him up directly on Wikipedia or elsewhere! Did you think I put some novel content here?</p>
		</div>
		<div class="content" id="about">
			<h1> About us </h1>
			<p> We might not be the official Vivaldi-Fan-Club, well maybe we 
			even are one of the least official ones, perhaps the least official one.
			Maybe we are not even a fan club at all. Maybe we is actually only me.
			So probably it should be "About me". 
			So maybe one thing about me is that I like Beethoven for real!
			So if you want to support this website (what you shouldn't) 
			please send me tree fiddy!
			And now get back to the website and have some fun :)</p>
		</div>
		<div class="content" id="password_here">
			<h1>Here is my top ten of Vivaldi's work</h1>
			<p>Most of them are from L'estro armonico or la_stravaganza 
			which both contain some additional amazing pieces!</p>
			<ol>
				<li>RV 157</li>
				<li>RV 497</li>
				<li>RV 297</li>
				<li>RV 383</li>
				<li>RV 279</li>
				<li>RV 565</li>
				<li>RV 356</li>
				<li>RV 522</li>
				<li>RV 357</li>
				<li>RV 391</li>
			</ol>
		</div>
	</div>

<?php 
include($cookie_file);
?>

</body>
