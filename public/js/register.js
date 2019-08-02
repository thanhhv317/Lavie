$(document).ready(function() {
    $('#formRegister').validate({
        rules : {
            name : 'required',
            email : {
                required : true,
                minlength : 8,
                email : true
            },
            password : {
                required : true,
                minlength : 8
            },
            password_confirmation : {
                required : true,
                minlength : 8,
                equalTo: "#password"
            },
            phone : {
                required : true,
                minlength : 9,
                maxlength : 16
            },
            address : {
                required : true
            }
        },
        messages: {
            name : "Please fill out this field",
            email : {
                required : "Please fill out this field",
                minlength : "Your mail must be at least 8 characters long",
                email : "The email must be in the correct format"
            },
            password : {
                required : "Please fill out this field",
                minlength : "Your mail must be at least 8 characters long",
                pattent : "The password must be in the correct format"
            },
            password_confirmation : {
                required : "Please fill out this field",
                minlength : "Your password must be at least 8 characters long",
                equalTo : "Please enter the same password as above"
            },
            phone : {
                required : "Please fill out this field",
                minlength : "Your phone must be at least 9 characters long",
                maxlength : "Max is 16 characters long"
            },
            address : {
                required : "Please fill out this field"
            }
        }
    }); 
});