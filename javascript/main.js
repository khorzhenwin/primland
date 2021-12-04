$(document).ready(function () {
    $('#profile').hover(function () {
            $('#dropdown-profile').show();
            
            $('#dropdown-profile').hover(function () {
                    $(this).show();
                    
                }, function () {
                    $(this).hide();
                }
            );
        }, function () {
            $('#dropdown-profile').hide();
        }
    );

    $('#rooms').hover(function () {
            $('#dropdown-rooms').show();
            
            $('#dropdown-rooms').hover(function () {
                    $(this).show();
                    
                }, function () {
                    $(this).hide();
                }
            );
        }, function () {
            $('#dropdown-rooms').hide();
        }
    );
    
});