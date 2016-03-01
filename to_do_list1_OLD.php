<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div class="toDoList">
</div>

<div class="popup_edit" style="display: none">
	<form>Text: 
		<input class='text' type='text' value=''>
		<input class='id' type='hidden' name='id' value=''>
		<input class='submit' type='submit' name='submit'>
	</form>
</div>

	<script src="jquery.js"></script>
	<script>
		$(document).ready(function(){
			$.ajax({
				url: "toDoListAjax.php",
				method : "get"
			}).done(function(data){
				
				var toDoS = jQuery.parseJSON(data);
				//alert(toDoS[1].text);
				
				$(toDoS).each(function(){
                    //alert(this.text);
					//$(this.text);
					$(".toDoList").append("<div class='todo' data-id='" + this.id + "' data-text='" + this.text + "'><span class='text_html'>" + this.text + "</span><a class='delete'>Delete</a> <a class='edit'>Edit</a></div> ");
                });
			});
			
			$(document).on("click", ".delete",function (e) {
					e.preventDefault();
					var doit = confirm("Sure??");
					
					if(!doit){
						return false;
					}
					
					var itemToDelete = $(this).parent();
					var id = $(this).parent().data("id");
					//alert(id);
					$.ajax({
						url: "delete.php",
						method : "get"
					}).done(function(data){
						var response = jQuery.parseJSON(data);
						//alert(response.error);
						if(response.error == false){
							itemToDelete.remove();
						}else{
							alert(response.message);
						}
				});
			});
			
			$(document).on("click", ".edit",function(e) {
				e.preventDefault();
				var id = $(this).parent().data("id");
				var text = $(this).parent().data("text");
				$(".popup_edit").css({
					display: "block"
				});
				$(".text").attr("value", text);
				$(".id").attr("value", id);
				//alert(text);
			});
			
			$(".submit").click(function(e){
				e.preventDefault();
				var id = $(".id").val();
				var text = $(".text").val();
				//alert(text);
					
				$.ajax({
					url: "update.php",
					method : "get",
					data : {id:id, text:text} //levo kako hvatam u php, a desno vrednost
				}).done(function(data){
					var response = jQuery.parseJSON(data); 
					
					if(response.error == false){
						$('.todo[data-id="' + id + '"] .text_html').html(text);
						//alert(response.message);
					}else{
						alert(response.message);
					}
				});
			});
			
			$('.todo[data-id="'+id+'"] .text_html').html(text);
		});
	</script>
</body>
</html>