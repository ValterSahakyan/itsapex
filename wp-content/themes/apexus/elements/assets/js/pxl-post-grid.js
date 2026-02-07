( function( $ ) {
    $( window ).on( 'elementor/frontend/init', function() {
        $('.pxl-grid').each(function(index, element) { 
            var $grid_scope = $(this); 
            $grid_scope.on('click', '.grid-filter-wrap .filter-item', function(e) {
                    
                var $this = $(this);
                var term_slug = $this.attr('data-filter');  

                $this.siblings('.filter-item.active').removeClass('active');
                $this.addClass('active');
                
                 
                var loadmore = $grid_scope.data('loadmore');
                 
                if( typeof loadmore !== 'undefined'){
                    loadmore.term_slug = term_slug;
                    apexus_grid_ajax_handler( $this, $grid_scope, 
                        { action: 'apexus_load_more_post_grid', loadmore: loadmore, handler_click: 'filter', scrolltop: 0, wpnonce: grid_data.wpnonce }
                    );
                }
                 
            });

            $grid_scope.on('click', '.pxl-grid-pagination .ajax a.page-numbers', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var $this = $(this);
                var loadmore = $grid_scope.data('loadmore');
                var paged = $this.attr('href');
                paged = paged.replace('?', '');
                loadmore.paged = parseInt(paged);

                apexus_grid_ajax_handler( $this, $grid_scope, 
                    { action: 'apexus_load_more_post_grid', loadmore: loadmore, handler_click: 'pagination', scrolltop: 1, wpnonce: grid_data.wpnonce }
                );
            });

            $grid_scope.on('click', '.btn-grid-loadmore', function(e) {
                e.preventDefault();
                var $this = $(this);
                var loadmore = $grid_scope.data('loadmore');
                loadmore.paged = parseInt($grid_scope.data('start-page')) + 1; 
                apexus_grid_ajax_handler( $this, $grid_scope, 
                    { action: 'apexus_load_more_post_grid', loadmore: loadmore, handler_click: 'loadmore', scrolltop: 0, wpnonce: grid_data.wpnonce }
                );
            });
            $grid_scope.on('change', '.orderby', function(e) {
                e.preventDefault();
                var $this = $(this);
                var loadmore = $grid_scope.data('loadmore');
                loadmore.orderby = $this.val(); 
                 
                apexus_grid_ajax_handler( $this, $grid_scope, 
                    { action: 'apexus_load_more_post_grid', loadmore: loadmore, handler_click: 'select_orderby', scrolltop: 0, wpnonce: grid_data.wpnonce }
                );
            });
        });

        function apexus_grid_ajax_handler($this, $grid_scope, args = {}){
            var settings = $.extend( true, {}, {
                action: '',
                loadmore: '',
                handler_click: '',
                scrolltop: 0,
                wpnonce: ''
            }, args );


            var offset_top = $grid_scope.offset().top; 

            if( settings.handler_click == 'loadmore' ){
                var loadmore_text  = $this.closest('.pxl-load-more').data('loadmore-text');
                var loading_text  = $this.closest('.pxl-load-more').data('loading-text');
                var curoffsettop = $this.offset().top;
            }
             
            $.ajax({
                url: grid_data.ajax_url,
                type: 'POST',
                data: {
                    action: settings.action,
                    settings: settings.loadmore,
                    handler_click: settings.handler_click,
                    wpnonce: settings.wpnonce
                },
                success: function( res ) {   
                    if(res.status == true){  

                        if( settings.handler_click == 'loadmore' ){
                            $grid_scope.find('.pxl-grid-inner .grid-item').removeClass('ajax-item');
                            $(res.data.html).each(function(index, el) {
                                el = $(el).addClass('ajax-item');
                                $grid_scope.find('.pxl-grid-inner').append(el);
                            });
                        }else{
                            $grid_scope.find('.pxl-grid-inner .grid-item').remove();
                            $(res.data.html).each(function(index, el) {
                                el = $(el).addClass('ajax-item');
                                $grid_scope.find('.pxl-grid-inner').append(el);
                            });
                        }
 
                        $grid_scope.data('start-page', res.data.paged);
 
                        if( settings.loadmore['pagination_type'] == 'loadmore'){
                            if(res.data.paged >= res.data.max){
                                $grid_scope.find('.pxl-load-more').hide();
                            }else{
                                $grid_scope.find('.pxl-load-more').show();
                            } 
                        } 
                        if( settings.loadmore['pagination_type'] == 'pagination'){
                            $grid_scope.find(".pxl-grid-pagination").html(res.data.pagin_html);
                        }

                        if( $grid_scope.find('.result-count').length > 0 ){
                            $grid_scope.find(".result-count").html(res.data.result_count);
                        }
                    }      
                },
                beforeSend: function() {  
                    if( settings.handler_click == 'loadmore' ){
                        $this.removeClass( 'loaded' ).addClass( 'loading' );
                        $this.find('.btn-text').text(loading_text);
                    }else{
                        $( 'body' ).removeClass( 'loaded' ).addClass( 'loading' );
                    }
                },
                complete: function(res) {
                    if( settings.handler_click == 'loadmore' ){
                        $this.removeClass( 'loading' ).addClass( 'loaded' );
                        $this.find('.btn-text').text(loadmore_text);
                        $( 'html, body' ).animate( { scrollTop: curoffsettop - 200 }, 0 );
                    }else{
                        $( 'body' ).removeClass( 'loading' ).addClass( 'loaded' );
                        if ( settings.scrolltop ) {
                            $( 'html, body' ).animate( { scrollTop: offset_top - 100 }, 0 );
                        }
                    }
                    $( document.body ).trigger( 'pxl_effect_refreshed', [$grid_scope] ); 
                }
            });
        }
    });
    function sep_grid_refresh($scope){
        $scope.find('.pxl-grid-masonry').each(function () {
            var iso = new Isotope(this, {
                itemSelector: '.grid-item',
                layoutMode: $(this).closest('.pxl-grid').attr('data-layout-mode'),
                fitRows: {
                    gutter: 0
                },
                percentPosition: true,
                masonry: {
                    columnWidth: '.grid-sizer',
                },
                containerStyle: null,
                stagger: 30,
                sortBy : 'name',
            });

            var filtersElem = $(this).closest('.pxl-grid').find('.grid-filter-wrap');
            filtersElem.on('click', function (event) {
                var filterValue = event.target.getAttribute('data-filter');
                iso.arrange({filter: filterValue});
            });

            var filterItem = $(this).closest('.pxl-grid').find('.filter-item');
            filterItem.on('click', function (e) {
                filterItem.removeClass('active');
                $(this).addClass('active');
                $(this).closest('.pxl-grid').find('.grid-item').removeClass('animated');
            });

            var filtersSelect = $(this).closest('.pxl-grid').find('.select-filter-wrap');
            filtersSelect.change(function() {
                var filters = $(this).val();
                iso.arrange({filter: filters});
            });

        });
        // pxl_update_grid_layout_height();
    }
    var widget_post_masonry_handler = function( $scope, $ ) {
            $scope.find('.pxl-post-grid .pxl-grid-masonry').imagesLoaded(function(){
                if($(document).find('.elementor-editor-active').length > 0){
                    let oldHTMLElement = HTMLElement;
                    window.HTMLElement = window.parent.HTMLElement;
                    sep_grid_refresh($scope);
                    window.HTMLElement = oldHTMLElement;
                }else{
                    sep_grid_refresh($scope);
                }
            });
        };


    $( window ).on( 'elementor/frontend/init', function() {
        // elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_galleries.default', widget_post_masonry_handler );
    } );
} )( jQuery );