<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div class="toDoList">
	
</div>

<a class="add_new">Add new</a>

<div class="popup_add_new" style="display: none">
	<form>Text: 
		<input class='text_add' type='text' value=''>
		<!--<input class='title' type='text' value=''>-->
		<input class='submit_add' type='submit' name='submit'>
	</form>
</div>

<div class="popup_edit" style="display: none">
	<form>Text: 
		<input class='text' type='text' value=''>
		<!--<input class='title' type='text' value=''>-->
		<input class='id' type='hidden' name='id' value=''>
		<input class='submit_edit' type='submit' name='submit'>
	</form>
</div>

	<script src="jquery.js"></script>
	<script>
		$(document).ready( function(){
			var id = ".id";
			var text = ".text";//isto za popup edit
			var title = ".title";
			var textAdd = ".text_add";
			
			var toDo = function( id, text, title ){
				this.id = id;
				this.text = text;
				this.title = title;
			}
			var toDoArr = [];
			var cToDo = '';
			
			var clickedObject = function( toDoArr, id ){
				for( i = 0; i < toDoArr.length; i++ ){
					if( toDoArr[i].id == id ){
						return toDoArr[i];
					}
				}
			};
			
			var clickedObjectIndex = function( toDoArr, id ){
				for( i = 0; i < toDoArr.length; i++ ){
					if( toDoArr[i].id == id ){
						return i;
					}
				}
			};
			
			var template = function( toDoArr ){
				$('.toDoList').html('');
				for( i = 0; i < toDoArr.length; i++){
					$(".toDoList").append("<div class='todo'><span class='title_html'>" + toDoArr[i].title + "</span> <span class='text_html'>" + toDoArr[i].text + "</span><a class='delete' data-id='" + toDoArr[i].id + "'>Delete</a> <a class='edit' data-id='" + toDoArr[i].id + "'>Edit</a></div> ");
				}	
			};
			
			$.ajax({
				url: "toDoListAjax.php",
				method : "get"
			}).done( function( data ){
				
				var toDoS = jQuery.parseJSON( data );//moze u toDoArr
				
				$(toDoS).each( function(){
					
					var newToDo = new toDo( this.id, this.text , this.title);
					toDoArr.push( newToDo );
                });
				
				template( toDoArr );
			});
			
			$(document).on("click", ".delete", function(e) {
					e.preventDefault();
					var doit = confirm( "Are you sure you want to delete?" );
					
					if(!doit){
						return false;
					}
					
					var id = $(this).data("id");
					$.ajax({
						url: "delete.php",
						method : "get",
						data : {"id" : id}
					}).done( function( data ){
						var response = jQuery.parseJSON( data );
						
						if(response.error == false){
							toDoArr.splice( clickedObjectIndex( toDoArr, id ), 1 );
							template( toDoArr );
						}else{
							alert( response.message );
						}
				});
			});
			
			$(document).on("click", ".edit", function(e) {
				e.preventDefault();
				var id = $(this).data("id");
				cToDo = clickedObject( toDoArr, id );

				$(".popup_edit").css({
					display: "block"
				});
				$(text).attr("value", cToDo.text);
				$(id).attr("value", cToDo.id);
			});
			
			$(".submit_edit").click( function(e){
				e.preventDefault();
				
				cToDo.text = $(text).val();
				//cToDo.title = $(title).val();
				cToDo.title = "Neki odgovarajuci title";
					
				$.ajax({
					url: "update.php",
					method : "get",
					data : {id:cToDo.id, text:cToDo.text, title:cToDo.title} //levo kako hvatam u php, a desno vrednost
				}).done( function( data ){
					var response = jQuery.parseJSON( data ); 
					
					if(response.error == false){
						$(".popup_edit").css({
							display: "none"
						});
						template( toDoArr );
					}else{
						alert( response.message );
					}
				});
			});
			
			$(document).on("click", ".add_new", function(e){
				e.preventDefault();
				$(".popup_add_new").css({
					display: "block"
				});
			});
			
			$(".submit_add").click(function(e){
				e.preventDefault();
				
				var text = $(".text_add").val();
				//alert(text);
				
				$.ajax({
					url : "add_new.php",
					method : "post",
					data : {"text" : text}
				}).done( function( data ){
					var response = jQuery.parseJSON( data );
					alert( data );
					
					var id = response.id;
					var title = "odgovarajuci title";
					//alert(id);
					if(response.error == false){
						//alert(id);
						var newToDo = new toDo(id, text, title);
						toDoArr.push( newToDo );
						$(".popup_add_new").css({
							display: "none"
						});
						template( toDoArr );
					}else{
						alert( response.message );
					}
				});
				
			});
		});
	</script>
</body>
</html>