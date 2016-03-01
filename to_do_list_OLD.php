<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="wrapper">
	<div class="memo">
		Title: Some Title <br />
		Text: Some Text 
		<a data-title="Some Title" data-text="Some Text" class="edit" href="#">Edit</a> <a class="delete" href="#">Delete</a>	  
	</div>
</div>

<a class="add_new_to_do" href="#">Add new</a>


<div class="popup_edit" style="display: none;">
	<a class='cancel' style='text-decoration:none' href='#'>X</a>
	<form>
		Title: <input type='text' class='title'><br />
		Text: <input type='text' class='text'>
	</form>
	<button class='save_edit' value='Save'>Save</button>
</div>

<div class="popup_add_new" style="display: none;">
	<a class="cancel" style="text-decoration:none" href="#">X</a>
	<form>
		Title: <input type="text" class="title"><br />
		Text: <input type="text" class="text">
	</form>
	<br />
	<button class="save_add_new" value="Save">Save</button>
</div>

	<script src="jquery.js"></script>
	<script>
	$(document).ready(function(){
		var currentMemo;
		
		$(".add_new_to_do").click(function(e){
			e.preventDefault();
			$(".popup_add_new").css({
				display: "block"
			});
		});
		
		$(".cancel").click(function(e){
			e.preventDefault();
			$(".popup_edit").css({
				display: "none"
			});
			$(".popup_add_new").css({
				display: "none"
			});
		});
		
		$(".edit").on("click",function(e){
			e.preventDefault();
			currentMemo = $(this);
			$(".popup_edit").css({
				display: "block"
			});
			var title = $(this).data("title");
			var text = $(this).data("text");
			
			$(".title").val(title);
			$(".text").val(text);
			
		});
		
		$(".save_edit").on("click", function(){
			title = currentMemo.data("title");
			text = currentMemo.data("text");
			
			$(".edit").val(title);
			$(".edit").val(text);
	
		});
		
		$(".save_add_new").on("click", function(e){
			e.preventDefault();
			var text = $(".text").val();
			var title = $(".title").val();
			alert(title);			
			$(".wrapper").append("<div class='memo'><br /> Title: " + title + "<br /> Text: " + text + "<a class='edit' href='#'>Edit</a> <a class='delete' href='#'>Delete</a></div>");
		});
		
		$(".delete").on("click", function(e){
			e.preventDefault();
			$(this).parent().remove();
		});
	});
	</script>
</body>
</html>