$(document).ready(function(){
    //check admin password 
    $("#current_password").keyup(function(){
        var current_password=$("#current_password").val();
        
        $.ajax({
            
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url: '/admin/check_current_password',
            data: {current_password:current_password},
            sucess:function(resp){
                    if(resp =="false"){
                        $("#verifycurrentpassword").html("Current Password is Incorrect");
                    }else if(resp=="true"){
                        $("#verifycurrentpassword").html("Current Password is Correct");
                    }
                   
                    
            },error:function(){
                alert("Error");
            },

            
        });
        
    });
});