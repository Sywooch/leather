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
	// ------------------------------------------------

	// 
	window.materialsArray = [];
	window.tagsArray = [];

	// var materialsArray = [];
	// var tagsArray = [];

	// $('.kv-tree-root').hide();

	loadTags('materials')
	loadTags('tags')

	$('form').submit(function(){
		submitTags();
	})

	$('[name="create-tag"]').on("click", function(e){
		removeTagErrors();
		var input = $(this).parent().prev();
		var inputVal = $(input).val().trim();
		if (inputVal != ''){
			if( validateTag(inputVal) ) {
				createTag($(this).data('type'), inputVal);
				$(input).val('');
				e.stopPropagation();
			} else {
				showTagError();
			}
		}
	})

	
	// 


})


// Создание тега
	function createTag(type, string) {
		var tagClass = type == 'materials' ? '.materials-tags' : '.tags-tags';
		var tagArray = type == 'materials' ? window.materialsArray : window.tagsArray;
		var tag = '';

		if (string.indexOf(",") != -1) {
			tag = string.substring(0, string.indexOf(','));
			if (tag == '') {
				return false;
			}
		} else {
			tag = string;		
		}
		tagArray.push(tag);
		$(tagClass).append('<div onclick="deleteTag(this);" title="Delete tag" class="btn btn-link product-tag" data-type="'+type+'">'+tag+'</div>');	
	}

	// Удаление
	function deleteTag(context) {
		var tag = $(context).text();
		var tagArray = $(context).data('type') == 'materials' ? window.materialsArray : window.tagsArray;
		tagArray.splice( tagArray.indexOf(tag), 1 );
		$(context).hide();
	}

	// Отправка формы
	function submitTags() {
		$("#productinfo-materials").val(window.materialsArray.join(','))
		$("#productinfo-tags").val(window.tagsArray.join(','))
	}

	// При загрузке страницы
	function loadTags(type){
		var tagsInput = type == 'materials' ? $("#productinfo-materials") : $("#productinfo-tags");
		var tags = $(tagsInput).val();
		var array = [];
		if (tags != '') {
			array = tags.split(',');
		}
		if (array.length > 0) {
			for (var i = 0; i < array.length; i++) {
				createTag(type, array[i]+',')
			}
		}
		$(tagsInput).val('');
	}

	function validateTag(string) {
		$(".validation-explain").css('color', 'black');
		return string.match(/^[0-9A-Za-zА-Яа-я\s\-]+$/) !== null
	}

	function showTagError() {
		$(".validation-explain").css('color', 'red');
	}

	function removeTagErrors() {
		$('[name="materials"]').removeClass('input-error');
		$('[name="tags"]').removeClass('input-error');
	}