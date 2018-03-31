(function ($){
    /**
     * Opzioni del plugin
     * 
     * @param {type} options
     * @returns {lettore_videoL#1.$.fn}
     */
    $.fn.video = function (options){
        var settings = $.extend({
            autoplay : false,
            container: {
                id : 'video-container',
                "class" : "video-container"
            },
            video : {
                id : "video",
                "class" : "video"
            },
            controls : {
                id : "controls",
                "class" : "controls"
            }
        }, options||{});
        
        /**
         * Plugin
         */
        this.each(function (){
            var _this = this;
            
            //Nascondo i controlli originali
            hideControls(_this);
            //Aggiuno i controlli personalizzati
            addControls(_this, settings.controls);
            
            //AUTOPLAY
            if(settings.autoplay){
                autoplay(_this, settings.controls);
            }
            
            /**
             * PLAY
             */
            $('.play', _this).click(function (){
                play(_this, settings.controls);
            });
            
            /**
             * PAUSA
             */
            $('.pause', _this).click(function (){
                pause(_this, settings.controls);
            });
            
            /**
             * FULLSCREEN
             */
            $('.fullscreen', _this).click(function (){
                fullscreen(_this, settings.controls);
            });
        });
        
        return this;
    };
    
    
    /**
     * Avvia il video automaticamente
     * 
     * @parma {Object} el
     * @returns null
     */
    function autoplay(el, controls){
        $('video', el).attr('autoplay', 'autoplay');
        
        play_to_pause(el, controls);
    };
    
    /**
     * Nascondo i controlli originali
     * 
     * @param {Object} el
     * @returns {undefined}
     */
    function hideControls(el){
        $('video', el).removeAttr('controls');
    };
    
    /**
     * Aggiungo i controlli
     * @param {Object} el
     * @returns {undefined}
     */
    function addControls(el, option){
        var controls = "<div id='" + option.id + "' class='" + option.class + "'>\n\
                            <div class='play'></div>\n\
                            <div class='pause' style='display:none;'></div>\n\
                            <div class='fullscreen'></div>\n\
                            <div class='minimizescreen' style='display:none;'></div>\n\
                        </div>";
        
        $(el).append(controls);
    };
    
    /**
     * Visualizza il pulsante di pausa
     * 
     * @param {Object} el
     * @param {Object} controls
     * @returns {null}
     */
    function play_to_pause(el, controls){
        $("#"+controls.id + " .play", el).hide();
        $("#"+controls.id + " .pause", el).show();
    }
    
    /**
     * Visualizza il pulsante di play
     * 
     * @param {Object} el
     * @param {Object} controls
     * @returns {null}
     */
    function pause_to_play(el, controls){
        $("#"+controls.id + " .pause", el).hide();
        $("#"+controls.id + " .play", el).show();
    }
    
    /**
     * Visualizza il pulsante di minimize screen
     * 
     * @param {Object} el
     * @param {Object} controls
     * @returns {null}
     */
    function minimizescreen_to_fullscreen(el, controls){
        $("#"+controls.id + " .minimizescreen", el).hide();
        $("#"+controls.id + " .fullscreen", el).show();
    }
    
    /**
     * Visualizza il pulsante di minimize screen
     * 
     * @param {Object} el
     * @param {Object} controls
     * @returns {null}
     */
    function fullscreen_to_minimizescreen(el, controls){
        $("#"+controls.id + " .fullscreen", el).hide();
        $("#"+controls.id + " .minimizescreen", el).show();
    }
    
    /**
     * Play Video
     * 
     * @param {type} el
     * @returns {undefined}
     */
    function play(el, controls){
        //$(el).parent().siblings()[0].play();
        $("video", el)[0].play();
        
        play_to_pause(el, controls);
    }
    
    /**
     * Play Video
     * 
     * @param {type} el
     * @returns {undefined}
     */
    function pause(el, controls){
        $("video", el)[0].pause();
        
        pause_to_play(el, controls);
    }
    
    /**
     * Play Video
     * 
     * @param {type} el
     * @returns {undefined}
     */
    function fullscreen(el, controls){
        var video = $("video", el)[0];
        
        //video.fullscreen();
        
        video.fullscreen();
        
        /*if (video.requestFullscreen) {
            video.requestFullscreen();
          } else if (video.mozRequestFullScreen) {
            video.mozRequestFullScreen();
          } else if (video.webkitRequestFullscreen) {
            video.webkitRequestFullscreen();
          }*/
        
        fullscreen_to_minimizescreen(el, controls);
    }
})(jQuery);