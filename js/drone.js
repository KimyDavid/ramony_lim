(function($) {

	/// DETECT MOBILE
	var $doc = $(document),
	Modernizr = window.Modernizr;

	/// VARS
	var loaded = true;

	if(history.replaceState) {
		history.replaceState({"id":1}, document.title, document.location.href);
	}

	/// BACK BUTTONS ACTIVE
	$(window).on("popstate", function(e) {
		var dlink = document.URL;
		dlink = dlink.split('#');

		if (typeof dlink[1] == 'undefined' || typeof dlink[1] == '') {
			if (!e.originalEvent.state) {
				return;
			}

			window.location = document.URL;
		}

		loaded = true;
	});


	var bid = 1;

	function updatelinks(m) {
		if(history.pushState && history.replaceState) {
			bid++;
			history.pushState({"id":bid}, '', m);
		}
	}


	/// LOAD SOCIAL SHARING PLUGINS
	function socialRevive() {
		$.ajax({ url: 'http://platform.twitter.com/widgets.js', dataType: 'script', cache:true});
		$.ajax({ url: 'http://platform.tumblr.com/v1/share.js', dataType: 'script', cache:true});
		$.ajax({ url: 'http://assets.pinterest.com/js/pinit.js', dataType: 'script', cache:true});
		$.ajax({ url: 'https://apis.google.com/js/plusone.js', dataType: 'script', cache:true});
	}


	/// SCROLL TO
	function goToByScroll(id){
     	$('html,body').animate({scrollTop: $("#"+id).offset().top},'slow');
	}

	/// CLOSE MOBILE MENU
	var menuclosed = true;
	function closeMobileMenu() {
		$('.mobilemenu-wrapper').removeClass('open');
	    //$('a.navbarbutton').find('i').removeClass('fa-times');
	    //$('a.navbarbutton').find('i').addClass('fa-bars');
		menuclosed = true;
	}

	/// RESPONSIVE IMG
	function responsiveIMG() {
			$('#post-list img').each(function() {
				var smalls = $(this).attr('data-small');
				var large = $(this).attr('data-large');
				if($(window).width() < 767) {
					$(this).attr('src',large);
				}else{
					$(this).attr('src',smalls);
				}
			});
	}


	/// POST COMMENT AJAX
	function postCommentAjax() {
        var commentform=$('#commentform'); // find the comment form
        $('<div class="statusmsg alert hidden" style="width:90%"><a href="#" class="closealert"><i class="icon-remove"></i></a><span></span></div>').insertBefore('#commentform p.form-submit'); // add info panel before the form to provide feedback or errors
        var statusdivmain=$('#commentform .statusmsg');
        var statusdiv=$('#commentform .statusmsg span'); // define the infopanel
        statusdivmain.hide();

        commentform.submit(function(){
        //serialize and store form data in a variable
        var formdata=commentform.serialize();
        //Add a status message
        statusdivmain.fadeIn();
        statusdiv.html('Processing...');
        //Extract action URL from commentform
        var formurl=commentform.attr('action');
        //Post Form with data
            $.ajax({
            type: 'post',
            url: formurl,
            data: formdata,
            error: function(XMLHttpRequest, textStatus, errorThrown){
            statusdiv.html('You might have left one of the fields blank, or be posting too quickly');
            statusdivmain.removeClass('alert-green');
            statusdivmain.addClass('alert-red');
            },
                success: function(data, textStatus){
                    if(data=="success") {
                        statusdiv.html('Thanks for your comment. We appreciate your response.');
                        statusdivmain.removeClass('alert-red');
                        statusdivmain.addClass('alert-green');
                        setTimeout('location.reload(true)',2200);
                    }else{
                        statusdiv.html('Please wait a while before posting your next comment');
                        statusdivmain.removeClass('alert-green');
                        statusdivmain.addClass('alert-red');
                    }
                }
            });
        return false;

        });
	}



    $(function() {
            /// TRIGGER RESPONSIVE IMG ONLOAD
            responsiveIMG()

            /// RESIZE EVENTS
            var wwidth = $(window).width();
            $(window).resize(function() {
                if(wwidth != $(window).width()) {
                    closeMobileMenu();
                    responsiveIMG();
                    wwidth = $(window).width();
                }
            });

            /// CLOSE ALERT
            $('body').on('click', '.closealert', function(e) {
                $(this).parent().slideUp();
                e.preventDefault();
            })

            ///	BACK TO TOP
            $(window).scroll(function() {
                if($(this).scrollTop() > 800) {
                    if (!Modernizr.touch) {
                        $('a.backtotop').fadeIn();
                    }
                } else {
                    if (!Modernizr.touch) {
                    $('a.backtotop').fadeOut();
                    }
                }
            });
            $('body').on('click','a.backtotop',function(e) {
                $('html, body').animate({scrollTop:0}, 1000, "easeInOutExpo");
                e.preventDefault();
            });


            /// WORKS ROLLOVER EFFECT
            $('#post-list .project-item .imgdiv a').hover(function() {
                $('span',this).stop().animate({"opacity": .4});
            },function() {
                $('span',this).stop().animate({"opacity": 0});
            });


            if(mdajaxurl.withajax!=1) {

                $('body').on('click','a.gohome',function(e) {
                var token = $(this).attr('data-token');
                var type = $(this).attr('data-type');
                var murl = $(this).attr('href');

                $('.ajaxloader').fadeIn();
                $.post(mdajaxurl.ajax,{action:'md_work_all_post',token:token, type:type},function(data) {
                    if(data!=0) {
                    $('#singlecontent').fadeOut('normal',function() {
                        updatelinks(murl);
                        $('#singlecontent').html(data).fadeIn('normal');
                        $(".fitvids").fitVids();
                        $('.ajaxloader').fadeOut();
                        socialRevive();
                        responsiveIMG();
                    });
                    }
                });
                e.preventDefault();
                });

            }

            $('body').on('mouseenter', 'a.getworks-showmsg', function(e) {
                var title = $(this).attr('title');
                if($(window).width() > 500) {
                    $(this).parent().find('span.pname').html(title);
                }
            });

            $('body').on('mouseleave', 'a.getworks-showmsg', function(e) {
                $(this).parent().find('span.pname').html('');
            });


            /// POST FILTER
            const postsList = $('#post-list');
            if (postsList.length > 0) {
                $('body').on('click','#portfolio-cats a',function(e) {
                    var cat = $(this).attr('data-rel');
                    var murl = $(this).attr('href');
                    var th = $(this).attr('data-th');
        
                    $('br.rowseperator').remove();
                    $('#portfolio-cats a').removeClass('selected');
                    $('#post-list div.project-item').stop(true, true).hide();
        
                    if (cat=="all") {
                        var wh = 'project-item';
                    } else{
                        var wh = cat;
                    }
        
                    var s=1;
                    if (Modernizr.touch) {
                        $('#post-list div.'+wh).show();
                    } else {
                        $('#post-list div.'+wh).each(function(index) {
                            $(this).delay(250*index).fadeIn(300);
                            if(s==th) {
                                $('<br class="clear rowseperator" />').insertAfter(this);
                                s=0;
                            }
                            s++;
                        });
                    }
        
                    $(this).addClass('selected');
                    if(murl) {
                        updatelinks(murl);
                    }
                    e.preventDefault();
                    return false;
                });
            }

            $('body').on('change','select.reschangeblog',function(e) {
                window.location= $(this).val();
            });

            $('body').on('change','select.reschange',function(e) {
                var cat = $(this).val();
                var th = 0

                $('br.rowseperator').remove();
                $('#portfolio-cats a').removeClass('selected');
                $('#post-list div.project-item').stop(true, true).hide();
                    if(cat=="all") {
                        var wh = 'project-item';
                    }else{
                        var wh = cat;
                    }
                        var s=1;
                        if (Modernizr.touch) {
                        $('#post-list div.'+wh).show();
                        }else{
                        $('#post-list div.'+wh).each(function(index) {
                            $(this).delay(250*index).fadeIn(300);
                            if(s==th) {
                            $('<br class="clear rowseperator" />').insertAfter(this);
                            s=0;
                            }
                            s++;
                        });
                        }

                e.preventDefault();
                return false;
            });



            /// HOME FILTER
            const all_list = $('#main_portfolio');
            if (all_list.length > 0) {
                $('body').on('click','.portfolio-filter',function(e) {
                    e.preventDefault();
        
                    all_list.addClass('disabled');
        
                    var cat = $(this).attr('data-rel');
                    var url = $(this).attr('href');
        
                    $('.portfolio-filter').removeClass('portfolio-filter--active');
        
                    const oldFilteredList = $('#filtered_portfolio');
                    oldFilteredList.remove();
        
                    if(cat=="all") {
                        all_list.removeClass('disabled');
        
                        setTimeout(function() {
                            $('html').scrollTo('#main_portfolio');
                        }, 500);
                    } else{
                        filterPortfolio(cat);
        
                        setTimeout(function() {
                            $('html').scrollTo('#filtered_portfolio');
                        }, 500);
                    }
        
                    $(this).addClass('portfolio-filter--active');
                });
            }

            $('.portfolio-filter-back').on('click', () => {
                $('html,body').animate({scrollTop: 1000},'slow');
            });

            function filterPortfolio(category) {
                const projects = $('.portfolio-project.' + category);
                const filteredList = $('<div class="portfolio-projects" id="filtered_portfolio"></div>');

                let index = 1;
                let group = 1;

                let parent = filteredList;
                projects.each(function() {
                    let classname = 1;

                    if (index == 1) {
                        const newGroup = $('<div class="portfolio-projects-group"></div>');
                        filteredList.append(newGroup);
                        parent = newGroup;
                    }

                    const clone = $(this).clone();
                    clone.removeClass('square square-sibling large large-sibling');
                    
                    if (group % 2 == 0) {
                        switch (index) {
                                case 1:
                                    classname = 'large';
                                    break;
                                case 2:
                                    classname = 'large-sibling';
                                    break;
                                case 3:
                                    classname = 'square-sibling';
                                    break;
                                case 4:
                                    classname = 'square';
                                    break;
                        }
                    } else {
                        switch (index) {
                            case 1:
                                classname = 'square';
                                break;
                            case 2:
                                classname = 'square-sibling';
                                break;
                            case 3:
                                classname = 'large-sibling';
                                break;
                            case 4:
                                classname = 'large';
                                break;
                        }
                    }

                    clone.addClass(classname);
                    clone.appendTo(parent);

                    if (index == 4) {
                        parent = filteredList;
                    }

                    if (index == 5) {
                        index = 0;
                        group++;
                    }

                    index++;
                });

                filteredList.insertAfter(all_list);
            }


            /// POST COMMENT
            postCommentAjax();


            /// RESPONSIVE VIDEO
            $(".fitvids").fitVids();


            $('body').on('click', 'a.navbarbutton',
                function(e) {
                    if(menuclosed) {
                        $('.mobilemenu-wrapper').addClass('open');
                        menuclosed = false;
                    }else{
                        $('.mobilemenu-wrapper').removeClass('open');
                        menuclosed = true;
                    }
                    e.preventDefault();
                });

            $('.mobilemenu-overlay, .mobilemenu-close').on('click', function() {
                closeMobileMenu();
            });

            $(window).on('scroll', function() {
                var scrollTrigger = 100;
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('.works-nav').addClass("scrolling");
                } else {
                    $('.works-nav').removeClass("scrolling");
                }
            });

            $(window).trigger('scroll');

    });

})(jQuery);
