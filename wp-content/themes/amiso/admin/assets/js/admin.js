(function($) {
    "use strict";


    /**
     * For Widget Area media file upload button
     */
    /**
     * @author Chris Baldelomar
     * @website http://webplantmedia.com/
     * var fetchSelection
     */
    var $body = $("body"), file_frame = [], media = wp.media;

    //fetch preExisting selection of galleries. change the gallery state based on wheter we got a selection or not to "Edit gallery" or "AAdd gallery"
    var fetchSelection = function(ids, options) {
        if(typeof ids === 'undefined') {
            return; //<--happens on multi_image insert for modal group
        }
    
        var id_array = ids.split(','),
            args = {orderby: "post__in", order: "ASC", type: "image", perPage: -1, post__in:id_array},
            attachments = wp.media.query( args ),
            selection = new wp.media.model.Selection( attachments.models, {
                props:    attachments.props.toJSON(),
                multiple: true
            });
            
            
        if(options.state === 'gallery-library' && id_array.length &&  !isNaN(parseInt(id_array[0],10))) {
            options.state = 'gallery-edit';
        }
        return selection;
    };

    $body.on('click', '.tm-widget-image-upload', function( event ) {
        event.preventDefault();
        
        var clicked = $(this),
            options = clicked.data(),
            parent = clicked.parent(),
            target = parent.find(options.target),
            preview = parent.find(options.preview), // will not find <div> tag inside of <p>
            prefill = fetchSelection(target.val(), options),
            frame_key = _.random(0, 999999999999999999);
            //set vars so we know that an editor is open

        // If the media frame already exists, reopen it.
        if ( file_frame[frame_key] ) {
            file_frame[frame_key].open();
            return;
        }
        
        // Create the media frame.
        file_frame[frame_key]  = wp.media({
            frame: options.frame,
            state: options.state,
            library: { type: '*' },
            button: { text: options.button },
            className: options['class'],
            selection: prefill
        });

        if ( 'wpc_widgets_insert_single' === options.state ) {
            // add the single insert state
            file_frame[frame_key].states.add([
                // Main states.
                new media.controller.Library({
                    id:         'wpc_widgets_insert_single',
                    title: clicked.data( 'title' ),
                    priority:   20,
                    toolbar:    'select',
                    filterable: 'uploaded',
                    library:    media.query( file_frame[frame_key].options.library ),
                    multiple:   false,
                    editable:   true,
                    displayUserSettings: false,
                    displaySettings: true,
                    allowLocalEdits: true
                    // AttachmentView: media.view.Attachment.Library
                })
            ]);
        }
        else if ( 'wpc_widgets_insert_multi' === options.state ) {
            // add the single insert state
            file_frame[frame_key].states.add([
                new media.controller.Library({
                    id:         'wpc_widgets_insert_multi',
                    title: clicked.data( 'title' ),
                    priority:   20,
                    toolbar:    'select',
                    filterable: 'uploaded',
                    library:    media.query( file_frame[frame_key].options.library ),
                    multiple:   'add',
                    editable:   true,
                    displayUserSettings: false,
                    displaySettings: false,
                    allowLocalEdits: true
                    // AttachmentView: media.view.Attachment.Library
                })
            ]);
        }

        // When an image is selected, run a callback. 
        // Bind to various events since single insert and multiple trigger on different events and work with different data
        file_frame[frame_key].on( 'select update insert', function(e) {
            var selection, state = file_frame[frame_key].state();
            
            // multiple items
            if(typeof e !== 'undefined') {
                selection = e;
            }
            // single item
            else {
                selection = state.get('selection');
            }
            
            var values , display, element, preview_html= "", preview_img;
                
            values = selection.map( function( attachment ) {
                element = attachment.toJSON();
                
                if ( 'url' === options.fetch ) {
                    display = state.display( attachment ).toJSON();
                    
                    if ( 'undefined' === typeof element.sizes ) {
                        preview_img = element.url;
                        preview_html += "<img src='"+preview_img+"' />";
                    }
                    else if ( ( 'string' === typeof options.imgsize ) && ( 'object' === typeof element.sizes[ options.imgsize ] ) ) {
                        preview_img = element.sizes[ options.imgsize ].url;
                        preview_html += "<img src='"+preview_img+"' />";
                    }
                    else {
                        preview_img = element.sizes[display.size].url;
                        preview_html += "<img src='"+preview_img+"' />";
                    }
                    
                    return preview_img;
                }
                else if(options.fetch === 'id') {
                    preview_img = typeof element.sizes.thumbnail !== 'undefined'  ? element.sizes.thumbnail.url : element.url ;
                    preview_html += "<img src='"+preview_img+"' />";
                    
                    return element[options.fetch];
                }
                else {
                    return element.url;
                }
            });
            
            if ( target.length ) {
                target.val( values.join(',') ).trigger('change');

                // triggers change in customizer
                target.keyup();
            }
            
            if ( preview.length ) {
                preview.html( preview_html ).show();
            }
        });

        // Finally, open the modal
        file_frame[frame_key].open();
    })
    .on('click', '.tm-widget-restore-image', function( e ) {
        e.preventDefault();

        var clicked = $(this),
            options = clicked.data(),
            parent  = clicked.parent(),
            target  = parent.find(options.target),
            preview = parent.find(options.preview);

        $(target).val(options.restore);

        if ( preview.length && options.restore.length ) {
            $(preview).html('<img src="'+options.restore+'" />').show();
        }
        else {
            $(preview).html("").hide();
        }

        $(target).keyup();
    })
    .on('click', '.tm-widget-delete-image', function( e ) {
        e.preventDefault();

        var clicked = $(this),
            options = clicked.data(),
            parent  = clicked.parent(),
            target  = parent.find(options.target),
            preview = parent.find(options.preview);

        $(target).val('');

        if ( preview.length ) {
            $(preview).html("").hide();
        }

        $(target).keyup();
    });



    /**
     * For Widget Area Put icon class into text field on Click
     */
    $( 'body' ).on( 'click', '.js-selectable-icon', function ( e ) {
        e.preventDefault();
        var $this = $( this );
        console.log('#'+$this.parent().data( 'target' ));
        $( '#'+$this.parent().data( 'target' ) ).val( $this.data( 'key' ) ).change();
    } );



    /**
     * For Wordpress Menus Megamenu
     */
    $( document ).on( 'mouseup', '.menu-item-bar', function( event, ui ) {
        setTimeout( update_menus_megamenu_fields, 400 );
    });

    $( document ).on( 'click', '.edit-menu-item-mascot-megamenu-status', function() {
        var parent_menu_item = $( this ).parents( '.menu-item:eq( 0 )' );
        if( $( this ).is( ':checked' ) ) {
            parent_menu_item.addClass( 'mascot-megamenu' );
        } else  {
            parent_menu_item.removeClass( 'mascot-megamenu' );
        }
        update_menus_megamenu_fields();
    });

    function update_menus_megamenu_fields() {
        var menu_items = $( '.menu .menu-item');
        menu_items.each( function( i ) {
            var megamenu_status = $( '.edit-menu-item-mascot-megamenu-status', this );
            if( ! $( this ).is( '.menu-item-depth-0' ) ) {
                var check_against = menu_items.filter( ':eq(' + (i-1) + ')' );
                if( check_against.is( '.mascot-megamenu' ) ) {
                    megamenu_status.attr( 'checked', 'checked' );
                    $( this ).addClass( 'mascot-megamenu' );
                } else {
                    megamenu_status.attr( 'checked', '' );
                    $( this ).removeClass( 'mascot-megamenu' );
                }
            } else {
                if( megamenu_status.attr( 'checked' ) ) {
                    $( this ).addClass( 'mascot-megamenu' );
                }
            }
        });
    }

    $body.on('click', '.mascot-megamenu-upload-bgimage', function( event ) {
        event.preventDefault();

        var clicked = $(this),
            options = clicked.data(),
            parent = clicked.parent(),
            target = parent.find(options.target),
            preview = parent.find(options.preview), // will not find <div> tag inside of <p>
            prefill = fetchSelection(target.val(), options),
            frame_key = _.random(0, 999999999999999999);
            //set vars so we know that an editor is open

        // If the media frame already exists, reopen it. 
        if ( file_frame[frame_key] ) {
            file_frame[frame_key].open();
            return;
        }
        
        // Create the media frame. 
        file_frame[frame_key]  = wp.media({
            frame: options.frame,
            state: options.state,
            library: { type: '*' },
            button: { text: options.button },
            className: options['class'],
            selection: prefill
        });

        if ( 'wpc_widgets_insert_single' === options.state ) {
            // add the single insert state
            file_frame[frame_key].states.add([
                // Main states.
                new media.controller.Library({
                    id:         'wpc_widgets_insert_single',
                    title: clicked.data( 'title' ),
                    priority:   20,
                    toolbar:    'select',
                    filterable: 'uploaded',
                    library:    media.query( file_frame[frame_key].options.library ),
                    multiple:   false,
                    editable:   true,
                    displayUserSettings: false,
                    displaySettings: true,
                    allowLocalEdits: true
                    // AttachmentView: media.view.Attachment.Library
                })
            ]);
        }
        else if ( 'wpc_widgets_insert_multi' === options.state ) {
            // add the single insert state
            file_frame[frame_key].states.add([
                new media.controller.Library({
                    id:         'wpc_widgets_insert_multi',
                    title: clicked.data( 'title' ),
                    priority:   20,
                    toolbar:    'select',
                    filterable: 'uploaded',
                    library:    media.query( file_frame[frame_key].options.library ),
                    multiple:   'add',
                    editable:   true,
                    displayUserSettings: false,
                    displaySettings: false,
                    allowLocalEdits: true
                    // AttachmentView: media.view.Attachment.Library
                })
            ]);
        }

        // When an image is selected, run a callback. 
        // Bind to various events since single insert and multiple trigger on different events and work with different data
        file_frame[frame_key].on( 'select update insert', function(e) {
            var selection, state = file_frame[frame_key].state();
            
            // multiple items
            if(typeof e !== 'undefined') {
                selection = e;
            }
            // single item
            else {
                selection = state.get('selection');
            }
            
            var values , display, element, preview_html= "", preview_img;
                
            values = selection.map( function( attachment ) {
                element = attachment.toJSON();
                
                if ( 'url' === options.fetch ) {
                    display = state.display( attachment ).toJSON();
                    
                    if ( 'undefined' === typeof element.sizes ) {
                        preview_img = element.url;
                        preview_html += "<img src='"+preview_img+"' />";
                    }
                    else if ( ( 'string' === typeof options.imgsize ) && ( 'object' === typeof element.sizes[ options.imgsize ] ) ) {
                        preview_img = element.sizes[ options.imgsize ].url;
                        preview_html += "<img src='"+preview_img+"' />";
                    }
                    else {
                        preview_img = element.sizes[display.size].url;
                        preview_html += "<img src='"+preview_img+"' />";
                    }
                    
                    return preview_img;
                }
                else if(options.fetch === 'id') {
                    preview_img = typeof element.sizes.thumbnail !== 'undefined'  ? element.sizes.thumbnail.url : element.url ;
                    preview_html += "<img src='"+preview_img+"' />";
                    
                    return element[options.fetch];
                }
                else {
                    return element.url;
                }
            });
            
            if ( target.length ) {
                target.val( values.join(',') ).trigger('change');

                // triggers change in customizer
                target.keyup();
            }
            
            if ( preview.length ) {
                preview.attr("src", preview_img).show().css("display", "block");
            }
        });

        // Finally, open the modal
        file_frame[frame_key].open();
    })
    .on('click', '.remove-mascot-megamenu-bgimage', function( e ) {
        e.preventDefault();

        var clicked = $(this),
            options = clicked.data(),
            parent  = clicked.parent(),
            target  = parent.find(options.target),
            preview = parent.find(options.preview);

        $(target).val('');

        if ( preview.length ) {
            $(preview).attr("src", "").hide();
        }

        $(target).keyup();
    });

})(jQuery);