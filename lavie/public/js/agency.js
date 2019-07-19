if (tmp == 1) {
	$('.delete-me').hide();
}
function deleteMe(id, url) {
	var _token = $('input[name="_token"]').val();
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
	if (result.value) {
		$.ajax({
			url : '' + url,
			type : 'POST',
			data : {id : id, _token : _token},
			success : function(data) {
				tmp--;
				Swal.fire(
				    'Deleted!',
				    'Your file has been deleted.',
				    'success'
				);
				$('#'+id).hide();
				if(tmp == 1){
					$('.delete-me').hide(1000);
				}
			}
		});
	}
	})		 
}
$(document).ready(function() {
    $(".js-example-placeholder-single").select2({
	  placeholder: "Select a state",
	  allowClear: true
	});
});


function addAgency(category) {
	var i, cate_size = category.length;
	var content = ''; 
	for (i = 0; i<cate_size; ++i) {
		content += '<option value="' + category[i].id + '">' + category[i].name + '</option>';
	}

	$('.main-agency').append(`
		<div class="form-group">
	    <label for="formGroupExampleInput2"><b>New Agency:</b></label>
	    <select class="form-control" name="new_agency[]">
	    	${content}
	    </select>
	  </div>
	  <div class="row">
	  	<div class="col">
		  <div class="form-group">
		    <label for="formGroupExampleInput2">Quantity:</label>
		    <input type="text" class="form-control" name="new_quantity[]" required="">
		  </div>
		  </div>
		  <div class="col">
		  <div class="form-group">
		    <label for="formGroupExampleInput2">Discount rate:</label>
		    <input type="text" class="form-control" name="new_discount_rate[]" required="">
		  </div>
		  </div>
		</div>
	`);
}

function deleteAgency(id) {
	// alert(id);
	var _token = $('input[name="_token"]').val();
	$.ajax({
		url: '/seller/product/delAgencyProduct',
		type: 'POST',
		data: {id : id, _token: _token},
		success: function(data) {
			if(data == 1) {
				Swal.fire(
				    'Deleted!',
				    'Your file has been deleted.',
				    'success'
				);
				$(".agency-content-"+id).hide(1000);
			}
		}
	});
}

$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});