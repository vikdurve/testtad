(function($) {
    
    $(document).ready(function(){
        
        $('.btnLogin').click(function(){
            $('.user-login-wrap').toggle();
            $('.user-login-form').show();
            $('.user-pass-reset-form').hide();
        });
        
        $('.frg-pass-link').click(function(){
            $('.user-login-form').hide();
            $('.user-pass-reset-form').show();
        });
        
        $('.login-link').click(function(){
            $('.user-login-form').show();
            $('.user-pass-reset-form').hide();
        });
        
        $('.btnProfile').click(function(){
            $('.user-profile-info-wrap').toggle();
            
        });
        

    });    
    
}(jQuery));