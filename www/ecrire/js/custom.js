$(document).ready(function(){
	
	$(".summernote").summernote({
		height:300,
	});

	$(".product-image-item").on("click", function(){
		var mainImageClass = 'product-main-image';
		var pId = $(this).data('id');

		$.ajax({
			url:"",
			type:"POST",
			data:{action:'change-main-image', pictureId:pId},
			success:function(data){
				if (data.status == true){
					$(".product-image-item").each(function(){
						$(this).removeClass(mainImageClass);
						if ($(this).data('id') == pId){
							$(this).addClass(mainImageClass);
						}
					})
				}
			}
		})
	})


	$(".product-image-item-delete").on("click", function(){
		var mainImageClass = 'product-main-image';
		var pId = $(this).data('id');
		$.ajax({
			url:"",
			type:"POST",
			data:{action:'delete-product-image', pictureId:pId},
			success:function(data){
				if (data.status == true){
					$("#product-image-"+pId).hide();
				}
			}
		})
	})


})