<?php 
	$bgColor = "#e2e7b9";
	$color = "#444";
	$accentColor1 = "#4f4f4f";
	$accentColor2 = "#c9cea5";


	$uiMode = $_POST['uiMode'];

	if ($uiMode === 'dark') {
		$bgColor = "#444";
		$color = "#e2e7b9";
		$accentColor1 = "#c9cea5";
		$accentColor2 = "#4f4f4f";
	}

	$display = "SELECT * FROM userdata WHERE username='$username'";
	$sqlQuery = mysqli_query($connect, $display);

	$i=0;
	$j=0;

	$noteCount = 0;
	$todoCount = 0;

	$contentData = null;
	$dataDisplay = null;

	if(mysqli_num_rows($sqlQuery) != 0) {
		while ($gago = mysqli_fetch_array($sqlQuery)) {
			$content[$i]['type'] = $gago['type'];
			$content[$i]['title'] = $gago['title'];
			$content[$i]['content'] = $gago['content'];

			if ($content[$i]['type'] == 1) {
				$noteCount++;
			} else if ($content[$i]['type'] == 0) {
				$todoCount++;
			};
			
			$i++;
		}
	}

	$laman = null;


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/css/materialize/css/materialize.css">
	<link rel="stylesheet" type="text/css" href="/css/materialize/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="/css/home.css">
	<style type="text/css">

/*		UI FOR PC*/
		body {
			overflow-y: hidden;
		}

		.accPage {
			display: flex;
		}

		.accPage .topMenu {
			display: none;
		}
			
		.leftMenu {
			box-shadow: 2px 0px 5px black;
			padding-top: 1rem;
			position: relative;
			float: left;
			height: 100vh;
			width: 250px;
		}

		.leftMenu h5 {
			padding-top: 1rem;
			font-size: 1.75rem;
			margin-bottom: 2.5rem;
		}

		.leftMenu .selections {
			background: <?php echo $accentColor1; ?>;
			height: 100vh;
			padding-top: 2rem;
		}

		.leftMenu .selections div{
			height: 2.5rem;
			font-size: 1rem;
			padding: 0.5rem;
			cursor: pointer;
		}

		.leftMenu .botInfo {
			position: absolute;
			width: 100%;
			height: 3rem;
			bottom: 0;
		}

		.startSelect {
			background-color: <?php echo $accentColor2; ?>;
			color: <?php echo $color; ?>;
		}

		.userdataContents {
			margin-top: 2rem;
			height: 103vh;
			width: 80%;
			padding-left: 2rem;
		}

		.userdataContents div ul{
			height: 73vh;
			padding: 0.5rem;
			overflow-y: auto;
			-ms-overflow-style: none;
			scrollbar-width: none;
		}

		.userdataContents div ul::-webkit-scrollbar{
			display: none;
		}

		.userdataContents div ul div {
			margin-bottom: 1rem;
		}

		.userdataContents div ul div li{
			background-color: <?php echo $color; ?>;
			color: <?php echo $bgColor ?>;
			border-radius: 5px;
			padding: 5px;
			overflow: auto;
			white-space: nowrap;
			cursor: pointer;
		}

		.userdataContents .contentData {
			background-color: <?php echo $color; ?> !important;
			height: 80vh;
			padding: 7px;
			border-radius: 5px;
		}

		.userdataContents .contentData form textarea {
			background-color: <?php echo $bgColor; ?>;
			color: <?php echo $color; ?> !important;
			height: 25rem !important;
			padding: 5px;
 			color: #444;
 			overflow-wrap: break-word;
 			overflow-y: auto;
		}

		.userdataContents .contentData .titleArea {
			color: <?php echo $bgColor; ?> !important;
			overflow: auto;
			white-space: nowrap;
		}

		.userdataContents .contentData .contentSubmit {
			background-color: <?php echo $bgColor ?> !important;
			color: <?php echo $color ?> !important;
		}

		.warning2 {
			text-align: center;
			width: 100vw;
			position: absolute;
			background-color: red !important;
		}
			

		.contentClose {
			cursor: pointer;
		}

		.contentClose i {
			font-size: 2.5rem;
		}

		.deletionForm {
			box-shadow: 3px 3px 5px black;
			border-radius: 5px;
			background-color: <?php echo $color ?>;
			color: <?php echo $bgColor ?>;
			padding: 3rem;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		.deletionForm .btn {
			background-color: <?php echo $bgColor ?> !important	;
			color: <?php echo $color ?> !important	;
			margin-top: 1rem;
			width: 5rem;
			text-align: center;
		}

		.optionsCreate {
			position: absolute;
			bottom: 0;
			right: 0;
			margin:	1rem;
		}

		@media screen and (max-width: 700px) {
			.leftMenu {
				display: none;
			}

			.accPage {
				width: 100%;
				position: absolute;
				display: flex;
				flex-direction: column;
			}

			.accPage .topMenu {
				display: block;
				box-shadow: 2px 0px 5px black;
				background-color: <?php echo $color; ?>;
			}

			.accPage .topMenu .selections {
				display: flex;
				background: <?php echo $accentColor1; ?>;
				cursor: pointer;
			}

			.accPage .topMenu .selections div {
				text-align: center;
				width: 33.33333333333333333333%;
			}

			.userdataContents {
				margin-top: 0px;
				padding: 20px;
				width: 100%;
			}

			.userdataContents .contentData {
				height: 75%;
			}

			.userdataContents .contentData form textarea {
				height: 53vh !important;
			}

			.userdataContents div ul {
				height: 66vh;
			}

			.deletionForm {
				padding: 1.25rem;
				width: 80%;
			}

			.deletionForm div h5 {
				font-size: 1.25rem;
			}

			.deletionForm div p {
				font-size: 1rem;
			}
		}

</style>
	<title></title>
</head>
<body>



	<!-- Navigation Menu -->
	<div class="accPage">
	<div class="topMenu navbar">
		<h5 class="center">Jotting.com</h5>
		<div class="selections">
			<div class="startSelect">Welcome</div>
			<div class="noteSelect">Notebook</div>
			<div class="todoSelect">Todo List</div>
		</div>
	</div>

	<div class="leftMenu">
		<h5 class="center">Jotting.com</h5>

		<div class="selections">
			<div class="startSelect">Welcome to Jotting</div>
			<div class="noteSelect">My Notebook</div>
			<div class="todoSelect">My Todo List</div>
		</div>
	</div>

	<div class="userdataContents">
		<div class="welcome">
			
			<h5>Jotting.com</h5>
			<p>An cross-platform web note taking app</p>

		</div>

		<div class="contentClose hide right"><i class="material-icons red-text">close</i></div>
		<h5 id="typeTitle"></h5>
		<div class="notes hide">

			<ul> 
				<?php if (mysqli_num_rows($sqlQuery) != 0) { ?>
					<?php foreach ($content as $contentt ) { ?>
						<?php if($contentt['type'] == 1) { 

								$contentContent = preg_replace("/\r\n/m", '\n', $contentt['content']);
							?>
							<div>
							<li class="z-depth-1" id="<?php echo $j; ?>" onclick="displayContent('<?php echo $j; ?>', '<?php echo $contentt['title']; ?>', '<?php echo $contentContent; ?>')"><p><?php echo $contentt['title']; $j++;?></p>
							</li>
							</div>
						<?php } ?>
					<?php } ?>
				<?php } 
				
				if($noteCount == 0){?>

					<p class="grey-text center" style="font-size: 1.25rem;">No notes yet</p>

				<?php } ?>
			</ul>
		</div>		

		<div class="todo hide">
			<ul> 
				<?php if (mysqli_num_rows($sqlQuery) != 0) { ?>
					<?php foreach ($content as $contentt ) { ?>
						<?php if($contentt['type'] == 0) { 

								$contentContent = preg_replace("/\r\n/m", '\n', $contentt['content']);
							?>
							<input type="hidden" name="delete" value="<?php echo $title; ?>">

							<div>
							<li class="z-depth-1" id="<?php echo $j ?>" onclick="displayContent('<?php echo $j; ?>', '<?php echo $contentt['title']; ?>', '<?php echo $contentContent; ?>')"><p><?php echo $contentt['title']; $j++;?></p></li>
							</div>
						<?php } ?>
					<?php } ?>
				<?php } 

				if($todoCount == 0){?>

					<p class="grey-text center" style="font-size: 1.25rem;">No todos yet</p>

				<?php } ?>
			</ul>
		</div>	


		<!-- Writes and Updates Contents in Database -->
		<div class="contentData hide input-field">
			<form action="index.php" method="POST">
				<input class="dataType" name="dataType" type="hidden" value="">
				<input type="hidden" name="username" value="<?php print_r($username); ?>">
				<input name="uiMode" type="hidden" value="<?php echo $uiMode; ?>">

				<input class="selectedTitle" type="hidden" name="selectedTitle">

				<input class="titleArea" type="text" name="title" placeholder="Title" style="color: #444" id="theTitle">
				<textarea class="contentArea materialize-textarea" name="dataContent" placeholder="Content" name="<?php echo $type; ?>" id="theContent"></textarea>

				<input class="contentSubmit btn" name="contentSubmit" type="submit" value="">
			</form>
		</div>	
	</div>
	</div>


	<!-- Deletes Contents in Database -->
	<form class="deletionForm hide" action="index.php" method="POST">
			<input class="dataType" name="dataType" type="hidden" value="">
			<input type="hidden" name="username" value="<?php print_r($username); ?>">
			<input name="uiMode" type="hidden" value="<?php echo $uiMode; ?>">

			<div>
				<h5>Confirm Deletion</h5>
				<p>Are you sure you want to delete the selected items?</p>
			</div>

			<input class="deleteConfirm  btn" type="submit" name="deleteItems" value="Yes">
			<div class="deleteDeny btn">No</div>
	</form>
	
		
	<!-- OPTION BUTTONS -->
	<div class="optionsCreate">
		<div class="delBtn hide  disabled btn">Delete</div>
		<div class="editBtn hide  btn" id="editBtn">Edit Mode</div>
		<div class="noteBtn hide  btn">Create a Note</div>
		<div class="todoBtn hide  btn">Create a To-do List</div>
	</div>


<script type="text/javascript" src="/css/materialize/js/materialize.js"></script>
<script type="text/javascript" src="/css/materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="/css/materialize/js/jquery.js"></script>
<script type="text/javascript">
	var bgColor = "<?php echo $bgColor; ?>";
	var color = "<?php echo $color; ?>";

	$('body, .userdataContents div').css({'background-color': bgColor, 'color': color});
	$('.btn, .editBtnMobile, .leftMenu, .topMenu').css({'background-color': color, 'color': bgColor});

	var editTitle = null;
	var editContent = null;
	var checkMode = null;


	$(".contentClose").click(function() {
		$(".contentData").addClass("hide");
		$(".userdataContents").removeClass("hide");
		$(".contentClose").addClass("hide");
		document.getElementById("theContent").value = null;
		$(".contentSubmit").attr("name", "contentSubmit");
		$(".contentSubmit").val("Save "+checkMode);
		$(".titleArea").val(null);
		$(".editBtn").removeClass("hide");
		$(".delBtn").addClass("hide");

		switch(checkMode) {
		case "note":
			$(".notes").removeClass("hide");
			$(".noteBtn").removeClass("hide");
			break;
		case "todo":
			$(".todo").removeClass("hide");
			$(".todoBtn").removeClass("hide");
			break;
		}
	})

	$(".startSelect").click(function() {
		$(this).css({"background-color": "<?php echo $accentColor2; ?>", "color" : "<?php echo $color; ?>"});
		$(".noteSelect, .todoSelect").css({"background-color": "<?php echo $accentColor1; ?>", "color" : "<?php echo $bgColor; ?>"});
		$(".welcome").removeClass("hide");
		$(".notes").addClass("hide");
		$(".todo").addClass("hide");
		$(".contentData").addClass("hide");
		document.getElementById("typeTitle").innerHTML = null;
		checkMode = "start";
		$(".contentClose").addClass("hide");
		document.getElementById("theContent").value = null;
		$(".noteBtn").addClass("hide");
		$(".todoBtn").addClass("hide");
		$(".dataType").val(null);
		$(".editBtn").addClass("hide");
		$(".delBtn").addClass("hide");
	})

	$(".noteSelect").click(function() {
		$(this).css({"background-color": "<?php echo $accentColor2; ?>", "color" : "<?php echo $color; ?>"})
		$(".startSelect, .todoSelect").css({"background-color": "<?php echo $accentColor1; ?>", "color" : "<?php echo $bgColor; ?>"})
		$(".welcome").addClass("hide");
		$(".notes").removeClass("hide");
		$(".todo").addClass("hide");
		$(".contentData").addClass("hide");
		document.getElementById("typeTitle").innerHTML = "<?php echo $username ?>'s notebook:";
		checkMode = "note";
		$(".contentClose").addClass("hide");
		document.getElementById("theContent").value = null;
		$(".noteBtn").removeClass("hide");
		$(".todoBtn").addClass("hide");
		$(".dataType").val(1);
		$(".editBtn").removeClass("hide");
		$(".delBtn").addClass("hide");
	})

	$(".todoSelect").click(function() {
		$(this).css({"background-color": "<?php echo $accentColor2; ?>", "color" : "<?php echo $color; ?>"})
		$(".noteSelect, .startSelect").css({"background-color": "<?php echo $accentColor1; ?>", "color" : "<?php echo $bgColor; ?>"})
		$(".welcome").addClass("hide");
		$(".notes").addClass("hide");
		$(".todo").removeClass("hide");
		$(".contentData").addClass("hide");
		document.getElementById("typeTitle").innerHTML = "<?php echo $username ?>'s todo list:";
		checkMode = "todo";
		$(".contentClose").addClass("hide");
		document.getElementById("theContent").value = null;
		$(".noteBtn").addClass("hide");
		$(".todoBtn").removeClass("hide");
		$(".dataType").val(0);
		$(".editBtn").removeClass("hide");
		$(".delBtn").addClass("hide");
	})

	$(".noteBtn").click(function() {
		$(".welcome").addClass("hide");
		$(".notes").addClass("hide");
		$(".todo").addClass("hide");
		$(".contentData").removeClass("hide");
		$(".noteBtn").addClass("hide");
		$(".contentClose").removeClass("hide");
		$(".contentSubmit").attr("name", "contentSubmit");
		$(".contentSubmit").val("Save "+checkMode);
		$(".editBtn").addClass("hide");
		$(".delBtn").addClass("hide");
	});

	$(".todoBtn").click(function() {
		$(".welcome").addClass("hide");
		$(".notes").addClass("hide");
		$(".todo").addClass("hide");
		$(".contentData").removeClass("hide");
		$(".todoBtn").addClass("hide");
		$(".contentClose").removeClass("hide");
		$(".contentSubmit").attr("name", "contentSubmit");
		$(".contentSubmit").val("Save "+checkMode);
		$(".editBtn").addClass("hide");
		$(".delBtn").addClass("hide");
	});


	var tapCount = 0;

	$(".editBtnMobile").click(function() {
		tapCount++;

		if (tapCount == 1) {
			$(".editMobile").removeClass("hide");
		} else if (tapCount == 2) {
			tapCount = 0;
		} 

		if (tapCount == 0) {
			$(".editMobile").addClass("hide");
		}
	})

	var contentMode = "edit";
	var clicked = [];

	var	editTapCount = 0
	$(".editBtn").click(function() {
		editTapCount ++;

		if (editTapCount == 1) {
			contentMode = "delete";
			document.getElementById("editBtn").innerHTML = "Creation Mode";
			$(".editBtn").removeClass("hide");
			$(".delBtn").removeClass("hide");
			
			switch(checkMode) {
				case "note":
					$(".noteBtn").addClass("hide");
					break;
				case "todo":
					$(".todoBtn").addClass("hide");
					break;
			}

		} else if (editTapCount == 2) {
			editTapCount = 0
		}

		if (editTapCount == 0) {
			contentMode = "edit";
			document.getElementById("editBtn").innerHTML = "Edit Mode";
			$(".userdataContents div ul div li").css({"background-color": "<?php echo $color; ?>", "border" : "none", "color": "<?php echo $bgColor ?>"});
			clicked = [];
			$(".deletionForm input[class='deleteQuery']").remove();
			$(".editBtn").removeClass("hide");
			$(".delBtn").addClass("hide");
			
			switch(checkMode) {
				case "note":
					$(".noteBtn").removeClass("hide");
					break;
				case "todo":
					$(".todoBtn").removeClass("hide");
					break;
			}

		}
	})

	$(".delBtn").click(function () {
		$(".deletionForm").removeClass("hide");
	})

	$(".deleteDeny").click(function() {
		$(".deletionForm").addClass("hide");
		$(".userdataContents div ul div li").css({"background-color": "<?php echo $color; ?>", "border" : "none", "color": "<?php echo $bgColor ?>"});
		clicked = [];
		$(".deletionForm input[class='deleteQuery']").remove();
		if (clicked.length != 0) {
			$(".delBtn").removeClass("disabled");
		} else {
			$(".delBtn").addClass("disabled");
		}
	})

	var item = 0;
	var delQuery;

	function displayContent(id, title, content) {

		editContent = content;

		$(".selectedTitle").val(title);

		switch (contentMode) {
		case "edit":
			var contentBr = content.replace(/\n/g, "\n");
			$(".titleArea").val(title);
			document.getElementById("theContent").value = contentBr;
			$(".notes").addClass("hide");
			$(".todo").addClass("hide");
			$(".contentClose").removeClass("hide");
			$(".contentData").removeClass("hide");
			$(".noteBtn").addClass("hide");
			$(".todoBtn").addClass("hide");
			$(".contentSubmit").attr("name", "contentUpdate");
			$(".contentSubmit").val("Update " + checkMode);
			$(".editBtn").addClass("hide");
			$(".delBtn").addClass("hide");
			break;
		case "delete":
			var isItClicked = clicked.includes(title);
			delQuery = '<input class="deleteQuery" name="deleteQuery[]" type="hidden" value="' + title + '">';

			if (!isItClicked) {
				$("#"+id).css({"background-color": "<?php echo $bgColor; ?>", "border" : "3px solid <?php echo $color; ?>", "color": "<?php echo $color ?>"});
				clicked.push(title);
				$($(".deletionForm")).append(delQuery);
			} else {
				$("#"+id).css({"background-color": "<?php echo $color; ?>", "border" : "none", "color": "<?php echo $bgColor ?>"});
				$(".deletionForm input[value='"+title+"']").remove();
				clicked.pop(title);
			}

			$(".editBtn").removeClass("hide");
			$(".delBtn").removeClass("hide");

			if (clicked.length != 0) {
				$(".delBtn").removeClass("disabled");
			} else {
				$(".delBtn").addClass("disabled");
			}

			break;
		}
	}
</script>
</body>
</html>
