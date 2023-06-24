
function sendmail(){

    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var subject = document.getElementById('subject').value;
    var message = document.getElementById('message').value;
    alert(name);

    // $.ajax({    
    //     window.location.href ="{{url('single_device')}} ->with (id)";              
//     // })

// var body =['name'=name , 'email'=email , 'subject'=subject , 'message'=message];
$.ajaxSetup({
    headers: {
        // 'X-CSRF-TOKEN': 'Qz1Tl7mkqSaUu7GsukDTbWiZPV29qT0hxvfjukt9'
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $.ajax({
        

            url:"http://127.0.0.1:8000/sendmail",
            method: 'post',
            contentType: "json",
            data: {
               name: name,
               email: email,
               subject: subject,
               message:message,
               csrf_token : 'Qz1Tl7mkqSaUu7GsukDTbWiZPV29qT0hxvfjukt9',
            },
            
            success: function(result){
                alert('success');
             },error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(errorThrown);
             }
            })
}