$(window).ready(function() {

    var ancho = $(window).width();
    var alto = $(window).height();

    

    $('#mask').css({
       height : alto,
       width : ancho
       });

    $('footer').css({
       width : ancho
       });
    
    if (ancho <= 768) {
        console.log("xs");
        $("#menu").addClass("xs");
        $("#menu").removeClass("off");
    } else{

         window.addEventListener('scroll', function(e){
            var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                shrinkOn = alto,
                header = document.querySelector("#menu");
            if (distanceY > shrinkOn) {
                classie.add(header,"on");
                classie.remove(header,"off");
            } else {
                if (classie.has(header,"on")) {
                    classie.add(header,"up");
                    classie.remove(header,"on");
                    
                }
            }
        });

    };

    $(window).resize(function() {

        var ancho = $(window).width();
        var alto = $(window).height();

        if (ancho <= 768) {
            console.log("xs");
            $("#menu").addClass("xs");
            $("#menu").removeClass("on");
            $("#menu").removeClass("off");
            $("#menu").removeClass("up");
        } else{
            

        };
            
        $('.vegas-background, .vegas-overlay, .vegas-loading').css({
            height : alto,
            width : ancho
           });
          
         $('#mask').css({
            height : alto,
            width : ancho
            });

         $('footer').css({
            width : ancho
            });

         var headerTop = $('#menu').offset().top; 
         var headerBottom = headerTop + (alto/2); // Sub-menu should appear after this distance from top.

    });



    $(window).resize();
	
	//new WOW().init();
    

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
    
    $('#contactForm').formValidation({
        framework: 'bootstrap',
        message: 'Por favor introduce la información solicitada.',                        
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            message: {
                validators: {
                    notEmpty: {
                        message: 'Por favor introduce tu duda o comentario.'
                    }
                }
            },
            name: {
                validators: {
                    notEmpty: {
                        message: 'Por favor introduce tu nombre.'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Por favor introduce tu email.'
                    },
                    emailAddress: {
                        message: 'Por favor verifíca tu email.'
                    }
                }
            }
        }
    })
    .on('success.form.fv', function(e) {
        // Prevent form submission
        e.preventDefault();
        //$('.notification-block').hide();    
        // Get the form instance
        var $form = $(e.target);            

        // Get the Form Validator instance
        var bv = $form.data('formValidation');
        
        // Use Ajax to submit form data
        $.post($form.attr('action'), $form.serialize(), function(result) {                        

            if(result.status == 'ok'){             

                $('#formSuccess').fadeIn();
                $('.form-control').val('');
                $('#contactForm').fadeOut();                                    
                //$('.notification-block').delay(4000).fadeOut();                                   

            }else{                                    
                
                 $('#formFail').fadeIn();
                //$('#error-notification-block').fadeIn();                    
            }

            $('#contactForm').formValidation('destroy');
                //contactFormValidation();

        }, 'json');
	});


});