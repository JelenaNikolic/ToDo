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
		<!--<input class='title' type='text' value=''>-->
		<input class='id' type='hidden' name='id' value=''>
		<input class='submit' type='submit' name='submit'>
	</form>
</div>

	<script src="jquery.js"></script>
	<script>
		$(document).ready(function(){
			var id = ".id";
			var text = ".text";//isto za popup edit
			var title = ".title";
			
			var toDo = function( id, text, title ){
				this.id = id;
				this.text = text;
				this.title = title;
			}
			var toDoArr = [];
			var cToDo = '';
			
			var clickedObject = function(toDoArr,id){
				for( i = 0; i < toDoArr.length; i++ ){
					if( toDoArr[i].id == id ){
						return toDoArr[i];
					}
				}
			};
			
			var clickedObjectIndex = function(toDoArr,id){
				for( i = 0; i < toDoArr.length; i++ ){
					if( toDoArr[i].id == id ){
						return i;
					}
				}
			};
			
			var template = function(toDoArr){
				$('.toDoList').html('');
				for( i = 0; i < toDoArr.length; i++){
					$(".toDoList").append("<div class='todo'><span class='title_html'>" + toDoArr[i].title + "</span> <span class='text_html'>" + toDoArr[i].text + "</span><a class='delete' data-id='" + toDoArr[i].id + "'>Delete</a> <a class='edit' data-id='" + toDoArr[i].id + "'>Edit</a></div> ");
				}	
			};
			
			$.ajax({
				url: "toDoListAjax.php",
				method : "get"
			}).done(function(data){
				
				var toDoS = jQuery.parseJSON(data);//moze u toDoArr
				
				$(toDoS).each(function(){
					
					var newToDo = new toDo( this.id, this.text , this.title);
					toDoArr.push( newToDo );
                });
				
				template( toDoArr );
			});
			
			$(document).on("click", ".delete",function (e) {
					e.preventDefault();
					var doit = confirm("Sure??");
					
					if(!doit){
						return false;
					}
					
					var id = $(this).data("id");
					$.ajax({
						url: "delete.php",
						method : "get"
					}).done(function(data){
						var response = jQuery.parseJSON(data);
						
						if(response.error == false){
							todoArr.splice(clickedObjectIndex( toDoArr, id ), 1);
							template( toDoArr );
						}else{
							alert(response.message);
						}
				});
			});
			
			$(document).on("click", ".edit",function(e) {
				e.preventDefault();
				var id = $(this).data("id");
				cToDo = clickedObject( toDoArr, id );

				$(".popup_edit").css({
					display: "block"
				});
				$(text).attr("value", cToDo.text);
				$(id).attr("value", cToDo.id);
			});
			
			$(".submit").click(function(e){
				e.preventDefault();
				
				cToDo.text = $(text).val();
				cToDo.title = $(title).val();
					
				$.ajax({
					url: "update.php",
					method : "get",
					data : {id:cToDo.id, text:cToDo.text, title:cToDo.title} //levo kako hvatam u php, a desno vrednost
				}).done(function(data){
					var response = jQuery.parseJSON(data); 
					
					if(response.error == false){
						template( toDoArr );
					}else{
						alert(response.message);
					}
				});
			});
			
			//$('.todo[data-id="'+id+'"] .text_html').html(text);
		});
	</script>
</body>
</html>