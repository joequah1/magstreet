<style>
    .text-autosize
    {
        resize:none;
        height: 100px !important;
    }
    
    #nijisteps section
    {
        display: none;
        height: 400px;
    }
    
    #nijisteps section#first
    {
        display: block;
    }
    
    #nijisteps .content
    {
        width: 500px;
        display: table-cell;
        height: 260px;
        vertical-align: middle;
        text-align: center;
    }
    
    .input-container
    {
        position: relative;
        width: 500px;
        height: 250px;
    }
    
    .input-image
    {
        width: 500px;
        height: 250px;
        opacity: 0 !important;
        overflow: hidden !important;
    }
    
    .input-file
    {
        width: 500px;
        height: 250px;
        background: #EBF4FA;
        overflow: hidden;
        -moz-box-shadow:    inset 0 0 10px #2B65EC;
       -webkit-box-shadow: inset 0 0 10px #2B65EC;
       box-shadow:         inset 0 0 10px #2B65EC;
    }
    
    .input-file:hover
    {
    
        -moz-box-shadow:    inset 0 0 10px #000080;
        -webkit-box-shadow: inset 0 0 10px #000080;
        box-shadow:         inset 0 0 10px #000080;
    }
    
    .input-image-preview
    {
        position: absolute;
        top: 5%;
        left: 35%;
        z-index: 2;
    }
    
    .recommendedImages
    {
        width: 500px;
        height: 250px;
        overflow: scroll;
    }
    
    .recommendedImages img
    {
        width: 140px;
        height: 140px;
    }

    .modal-waiting-spinner {
        display:    none;
        position:   absolute;
        top:        0;
        left:       0;
        height:     100%;
        width:      100%;
        background: rgba( 255, 255, 255, .8 ) 
                    url('http://sampsonresume.com/labs/pIkfp.gif') 
                    50% 50% 
                    no-repeat;
    }

    
</style>

<!-- Modal -->
<div class="modal fade" id="addBlockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="padding-top:100px;">
    <div class="modal-content">
      

        <div id="nijisteps">
            {{ Form::open($form_options) }}
            
            <!-- First Step-->
            <section id="first" class="sec">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title  class="font-nexa-bold"" id="myModalLabel">Status</h4>  
                </div>
                
                <div class="content">
                    <div class="form-group">
                        {{ Categories::getDropDownList(); }}
                    </div>
                    
                    <div class="form-group">
                        <textarea name="caption" class='form-control text-autosize caption' placeholder="Enter Your Status Here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn btn-primary nijisteps-next">next</div>
                </div>
                
            </section>
            
            <!-- second Step-->
            <section class="sec">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title font-nexa-bold" id="myModalLabel">How</h4>
                </div>
                
                <div class="content">
                    <div class="btn btn-lg btn-info next-upload">Upload a Photo</div>
                
                    <div class="btn btn-lg btn-warning next-get">Get Recommendation</div>
                </div>
                
            </section>
            
            <!-- Upload Step-->
            <section id="uploadphoto">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title font-nexa-bold" id="myModalLabel">Upload Your Photo</h4>
                </div>
                
                <div class="form-group input-container">
                    
                    <div class="input-file">
                    
                        {{ Form::file('image', array('src'=>'#', 'id'=>'BlockImageInput', 'class'=>'input-image','data-toggle'=>'image', 'data-target'=>'#BlockImagePreview')) }}
                        
                       
                    </div>
                    
                    <div class="input-file-overlay">
                    
                    </div>
                    
                    <img id="BlockImagePreview" alt="Image Preview" style="display: none;" class="input-image-preview" />
                    
                </div>
                
                
            
            
                <div class="form-group">
                    <img id="BlockImagePreview" alt="Image Preview" style="display: none;"  />
                </div>
                    
                <div class="modal-footer">
                    <div class="btn btn-primary nijisteps-previous">previous</div>
                    {{ Form::submit('Upload', array('class'=>'btn btn-primary'))}}
                </div>
            </section>
            
            <!-- Get Recommendations Step -->
            <section id="getrecommendation">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title font-nexa-bold" id="myModalLabel">Select Photo</h4>
                </div>
                
                <div class="recommendedImages">
                    <div class="modal-waiting-spinner"></div>
                </div>
                
                <div class="modal-footer">
                    <div class="btn btn-primary nijisteps-previous">previous</div>
                    {{ Form::submit('Upload', array('class'=>'btn btn-primary'))}}
                </div>
            </section>
            
    
            {{ Form::close() }}
        </div>
         
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $('.nijisteps-next').on('click', function() {
        $(this).parent().parent().next('.sec').show('slide',{direction:'left'},1500);
        $(this).parent().parent().hide('slide',{direction:'right'},500);
    });
    
    $('.nijisteps-previous').on('click', function() {
        $(this).parent().parent().prev('.sec').show('slide',{direction:'right'},1500);
        $(this).parent().parent().hide('slide',{direction:'left'},500);
    });
    
    $('.next-upload').on('click', function() {
        $('#uploadphoto').show('slide',{direction:'left'},1500);
        $(this).parent().parent().hide();
    });
    
    $('.next-get').on('click', function() {
        $('.modal-waiting-spinner').show();
        $('#getrecommendation').show('slide',{direction:'left'},1500);
        $(this).parent().parent().hide();
        
        var query = $('textarea.caption').val();
        
        var url = '/bing/image/recommendation/'+query;
        
        $.get( url, function(data) {
            $('.modal-waiting-spinner').show();
            $('.recommendedImages').html(data);
        }).fail(function(){
            $('.modal').show();
            alert('recommendations error');
        })
    });
    

    

    
    
    /*
    * Get the extension 
    */
	function getExtension(filename) {
		var parts = filename.split('.');
		return parts[parts.length - 1];
	}

    /*
    * Validate Input File
    */
	function isImage(filename) {

		var ext = getExtension(filename);
		switch (ext.toLowerCase()) {
                
            case 'jpeg':
			case 'jpg':
			case 'gif':
			case 'bmp':
			case 'png':
		
			return true;
		}
		return false;
	}

    /*
    * Read Input
    */
	function readURL(input)
	{
        var target = $(input).data("target");
        var id = $(input).attr("id");
        
		if (input.files && input.files[0])
		{
			var image = $('#'+id).val();

			if(!isImage(image))
			{
				alert('not image');
			}
			else{

				var reader = new FileReader();

				reader.onload = function (e)
				{	
					$(target)
					.attr('src',e.target.result)
					.show()
					.width(150)
					.height(200);

					//$('#'+id).hide();
				};

				reader.readAsDataURL(input.files[0]);
			}
		}
	}

    /*
    * Toggle Preview Image
    */
	$('[data-toggle="image"]').on('change',function(){ 
            readURL(this);
        });

    
    /*
    * textarea autosize
    */
	$(document).ready(function(){
        $('textarea').autosize();   
    });
    
    /*!
	Autosize v1.18.1 - 2013-11-05
	Automatically adjust textarea height based on user input.
	(c) 2013 Jack Moore - http://www.jacklmoore.com/autosize
	license: http://www.opensource.org/licenses/mit-license.php
    */
    (function ($) {
        var
        defaults = {
            className: 'autosizejs',
            append: '',
            callback: false,
            resizeDelay: 10
        },
    
        // border:0 is unnecessary, but avoids a bug in Firefox on OSX
        copy = '<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',
    
        // line-height is conditionally included because IE7/IE8/old Opera do not return the correct value.
        typographyStyles = [
            'fontFamily',
            'fontSize',
            'fontWeight',
            'fontStyle',
            'letterSpacing',
            'textTransform',
            'wordSpacing',
            'textIndent'
        ],
    
        // to keep track which textarea is being mirrored when adjust() is called.
        mirrored,
    
        // the mirror element, which is used to calculate what size the mirrored element should be.
        mirror = $(copy).data('autosize', true)[0];
    
        // test that line-height can be accurately copied.
        mirror.style.lineHeight = '99px';
        if ($(mirror).css('lineHeight') === '99px') {
            typographyStyles.push('lineHeight');
        }
        mirror.style.lineHeight = '';
    
        $.fn.autosize = function (options) {
            if (!this.length) {
                return this;
            }
    
            options = $.extend({}, defaults, options || {});
    
            if (mirror.parentNode !== document.body) {
                $(document.body).append(mirror);
            }
    
            return this.each(function () {
                var
                ta = this,
                $ta = $(ta),
                maxHeight,
                minHeight,
                boxOffset = 0,
                callback = $.isFunction(options.callback),
                originalStyles = {
                    height: ta.style.height,
                    overflow: ta.style.overflow,
                    overflowY: ta.style.overflowY,
                    wordWrap: ta.style.wordWrap,
                    resize: ta.style.resize
                },
                timeout,
                width = $ta.width();
    
                if ($ta.data('autosize')) {
                    // exit if autosize has already been applied, or if the textarea is the mirror element.
                    return;
                }
                $ta.data('autosize', true);
    
                if ($ta.css('box-sizing') === 'border-box' || $ta.css('-moz-box-sizing') === 'border-box' || $ta.css('-webkit-box-sizing') === 'border-box'){
                    boxOffset = $ta.outerHeight() - $ta.height();
                }
    
                // IE8 and lower return 'auto', which parses to NaN, if no min-height is set.
                minHeight = Math.max(parseInt($ta.css('minHeight'), 10) - boxOffset || 0, $ta.height());
    
                $ta.css({
                    overflow: 'hidden',
                    overflowY: 'hidden',
                    wordWrap: 'break-word', // horizontal overflow is hidden, so break-word is necessary for handling words longer than the textarea width
                    resize: ($ta.css('resize') === 'none' || $ta.css('resize') === 'vertical') ? 'none' : 'horizontal'
                });
    
                // The mirror width must exactly match the textarea width, so using getBoundingClientRect because it doesn't round the sub-pixel value.
                function setWidth() {
                    var style, width;
                    
                    if ('getComputedStyle' in window) {
                        style = window.getComputedStyle(ta, null);
                        width = ta.getBoundingClientRect().width;
    
                        $.each(['paddingLeft', 'paddingRight', 'borderLeftWidth', 'borderRightWidth'], function(i,val){
                            width -= parseInt(style[val],10);
                        });
    
                        mirror.style.width = width + 'px';
                    }
                    else {
                        // window.getComputedStyle, getBoundingClientRect returning a width are unsupported and unneeded in IE8 and lower.
                        mirror.style.width = Math.max($ta.width(), 0) + 'px';
                    }
                }
    
                function initMirror() {
                    var styles = {};
    
                    mirrored = ta;
                    mirror.className = options.className;
                    maxHeight = parseInt($ta.css('maxHeight'), 10);
    
                    // mirror is a duplicate textarea located off-screen that
                    // is automatically updated to contain the same text as the
                    // original textarea.  mirror always has a height of 0.
                    // This gives a cross-browser supported way getting the actual
                    // height of the text, through the scrollTop property.
                    $.each(typographyStyles, function(i,val){
                        styles[val] = $ta.css(val);
                    });
                    $(mirror).css(styles);
    
                    setWidth();
    
                    // Chrome-specific fix:
                    // When the textarea y-overflow is hidden, Chrome doesn't reflow the text to account for the space
                    // made available by removing the scrollbar. This workaround triggers the reflow for Chrome.
                    if (window.chrome) {
                        var width = ta.style.width;
                        ta.style.width = '0px';
                        var ignore = ta.offsetWidth;
                        ta.style.width = width;
                    }
                }
    
                // Using mainly bare JS in this function because it is going
                // to fire very often while typing, and needs to very efficient.
                function adjust() {
                    var height, original;
    
                    if (mirrored !== ta) {
                        initMirror();
                    } else {
                        setWidth();
                    }
    
                    mirror.value = ta.value + options.append;
                    mirror.style.overflowY = ta.style.overflowY;
                    original = parseInt(ta.style.height,10);
    
                    // Setting scrollTop to zero is needed in IE8 and lower for the next step to be accurately applied
                    mirror.scrollTop = 0;
    
                    mirror.scrollTop = 9e4;
    
                    // Using scrollTop rather than scrollHeight because scrollHeight is non-standard and includes padding.
                    height = mirror.scrollTop;
    
                    if (maxHeight && height > maxHeight) {
                        ta.style.overflowY = 'scroll';
                        height = maxHeight;
                    } else {
                        ta.style.overflowY = 'hidden';
                        if (height < minHeight) {
                            height = minHeight;
                        }
                    }
    
                    height += boxOffset;
    
                    if (original !== height) {
                        ta.style.height = height + 'px';
                        if (callback) {
                            options.callback.call(ta,ta);
                        }
                    }
                }
    
                function resize () {
                    clearTimeout(timeout);
                    timeout = setTimeout(function(){
                        var newWidth = $ta.width();
    
                        if (newWidth !== width) {
                            width = newWidth;
                            adjust();
                        }
                    }, parseInt(options.resizeDelay,10));
                }
    
                if ('onpropertychange' in ta) {
                    if ('oninput' in ta) {
                        // Detects IE9.  IE9 does not fire onpropertychange or oninput for deletions,
                        // so binding to onkeyup to catch most of those occasions.  There is no way that I
                        // know of to detect something like 'cut' in IE9.
                        $ta.on('input.autosize keyup.autosize', adjust);
                    } else {
                        // IE7 / IE8
                        $ta.on('propertychange.autosize', function(){
                            if(event.propertyName === 'value'){
                                adjust();
                            }
                        });
                    }
                } else {
                    // Modern Browsers
                    $ta.on('input.autosize', adjust);
                }
    
                // Set options.resizeDelay to false if using fixed-width textarea elements.
                // Uses a timeout and width check to reduce the amount of times adjust needs to be called after window resize.
    
                if (options.resizeDelay !== false) {
                    $(window).on('resize.autosize', resize);
                }
    
                // Event for manual triggering if needed.
                // Should only be needed when the value of the textarea is changed through JavaScript rather than user input.
                $ta.on('autosize.resize', adjust);
    
                // Event for manual triggering that also forces the styles to update as well.
                // Should only be needed if one of typography styles of the textarea change, and the textarea is already the target of the adjust method.
                $ta.on('autosize.resizeIncludeStyle', function() {
                    mirrored = null;
                    adjust();
                });
    
                $ta.on('autosize.destroy', function(){
                    mirrored = null;
                    clearTimeout(timeout);
                    $(window).off('resize', resize);
                    $ta
                        .off('autosize')
                        .off('.autosize')
                        .css(originalStyles)
                        .removeData('autosize');
                });
    
                // Call adjust in case the textarea already contains text.
                adjust();
            });
        };
    }(window.jQuery || window.$)); // jQuery or jQuery-like library, such as Zepto
</script>
