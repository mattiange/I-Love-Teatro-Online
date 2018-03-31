/*
 * jQuery.fullscreen library v0.4.0
 * Copyright (c) 2013 Vladimir Zhuravlev
 *
 * @license https://github.com/private-face/jquery.fullscreen/blob/master/LICENSE
 *
 * Date: Wed Dec 11 22:45:17 ICT 2013
 **/
(function(e){function t(e){return e!==void 0}function n(t,n,l){var r=function(){};r.prototype=n.prototype,t.prototype=new r,t.prototype.constructor=t,n.prototype.constructor=n,t._super=n.prototype,l&&e.extend(t.prototype,l)}function l(e,n){var l;"string"==typeof e&&(n=e,e=document);for(var i=0;r.length>i;++i){n=n.replace(r[i][0],r[i][1]);for(var o=0;s.length>o;++o)if(l=s[o],l+=0===o?n:n.charAt(0).toUpperCase()+n.substr(1),t(e[l]))return e[l]}return void 0}var r=[["",""],["exit","cancel"],["screen","Screen"]],s=["","o","ms","moz","webkit","webkitCurrent"],i=navigator.userAgent,o=l("fullscreenEnabled"),u=-1!==i.indexOf("Android")&&-1!==i.indexOf("Chrome"),c=!u&&t(l("fullscreenElement"))&&(!t(o)||o===!0),_=e.fn.jquery.split("."),h=2>parseInt(_[0])&&7>parseInt(_[1]),f=function(){this.__options=null,this._fullScreenElement=null,this.__savedStyles={}};f.prototype={_DEFAULT_OPTIONS:{styles:{boxSizing:"border-box",MozBoxSizing:"border-box",WebkitBoxSizing:"border-box"},toggleClass:null},__documentOverflow:"",__htmlOverflow:"",_preventDocumentScroll:function(){this.__documentOverflow=e("body")[0].style.overflow,this.__htmlOverflow=e("html")[0].style.overflow,e("body, html").css("overflow","hidden")},_allowDocumentScroll:function(){e("body")[0].style.overflow=this.__documentOverflow,e("html")[0].style.overflow=this.__htmlOverflow},_fullScreenChange:function(){this.isFullScreen()?(this._preventDocumentScroll(),this._triggerEvents()):(this._allowDocumentScroll(),this._revertStyles(),this._triggerEvents(),this._fullScreenElement=null)},_fullScreenError:function(t){this._revertStyles(),this._fullScreenElement=null,t&&e(document).trigger("fscreenerror",[t])},_triggerEvents:function(){e(this._fullScreenElement).trigger(this.isFullScreen()?"fscreenopen":"fscreenclose"),e(document).trigger("fscreenchange",[this.isFullScreen(),this._fullScreenElement])},_saveAndApplyStyles:function(){var t=e(this._fullScreenElement);this.__savedStyles={};for(var n in this.__options.styles)this.__savedStyles[n]=this._fullScreenElement.style[n],this._fullScreenElement.style[n]=this.__options.styles[n];this.__options.toggleClass&&t.addClass(this.__options.toggleClass)},_revertStyles:function(){var t=e(this._fullScreenElement);for(var n in this.__options.styles)this._fullScreenElement.style[n]=this.__savedStyles[n];this.__options.toggleClass&&t.removeClass(this.__options.toggleClass)},open:function(t,n){t!==this._fullScreenElement&&(this.isFullScreen()&&this.exit(),this._fullScreenElement=t,this.__options=e.extend(!0,{},this._DEFAULT_OPTIONS,n),this._saveAndApplyStyles())},exit:null,isFullScreen:null,isNativelySupported:function(){return c}};var p=function(){p._super.constructor.apply(this,arguments),this.exit=e.proxy(l("exitFullscreen"),document),this._DEFAULT_OPTIONS=e.extend(!0,{},this._DEFAULT_OPTIONS,{styles:{width:"100%",height:"100%"}}),e(document).bind(this._prefixedString("fullscreenchange")+" MSFullscreenChange",e.proxy(this._fullScreenChange,this)).bind(this._prefixedString("fullscreenerror")+" MSFullscreenError",e.proxy(this._fullScreenError,this))};n(p,f,{VENDOR_PREFIXES:["","o","moz","webkit"],_prefixedString:function(t){return e.map(this.VENDOR_PREFIXES,function(e){return e+t}).join(" ")},open:function(e){p._super.open.apply(this,arguments);var t=l(e,"requestFullscreen");t.call(e)},exit:e.noop,isFullScreen:function(){return null!==l("fullscreenElement")},element:function(){return l("fullscreenElement")}});var a=function(){a._super.constructor.apply(this,arguments),this._DEFAULT_OPTIONS=e.extend({},this._DEFAULT_OPTIONS,{styles:{position:"fixed",zIndex:"2147483647",left:0,top:0,bottom:0,right:0}}),this.__delegateKeydownHandler()};n(a,f,{__isFullScreen:!1,__delegateKeydownHandler:function(){var t=e(document);t.delegate("*","keydown.fullscreen",e.proxy(this.__keydownHandler,this));var n=h?t.data("events"):e._data(document).events,l=n.keydown;h?n.live.unshift(n.live.pop()):l.splice(0,0,l.splice(l.delegateCount-1,1)[0])},__keydownHandler:function(e){return this.isFullScreen()&&27===e.which?(this.exit(),!1):!0},_revertStyles:function(){a._super._revertStyles.apply(this,arguments),this._fullScreenElement.offsetHeight},open:function(){a._super.open.apply(this,arguments),this.__isFullScreen=!0,this._fullScreenChange()},exit:function(){this.__isFullScreen=!1,this._fullScreenChange()},isFullScreen:function(){return this.__isFullScreen},element:function(){return this.__isFullScreen?this._fullScreenElement:null}}),e.fullscreen=c?new p:new a,e.fn.fullscreen=function(t){var n=this[0];return t=e.extend({toggleClass:null,overflow:"hidden"},t),t.styles={overflow:t.overflow},delete t.overflow,n&&e.fullscreen.open(n,t),this}})(jQuery);






/**
 * Video Player jQuery
 * HTML5 <video>
 * 
 * @author      Mattia Leonardo Angelillo
 * @email       mattia.angelillo@gmail.com
 * @version     1.0.0beta
 * @copyright   2018, Mattia Leonardo Angelillo (C)
 * @data        12-03-2018
 */

(function ($){
    /**
     * Opzioni del plugin
     * 
     * @param {type} options
     * @returns {lettore_videoL#1.$.fn}
     */
    $.fn.video_player = function (options){
        var settings = $.extend({
            autoplay : false,
            //ID-CLASSE container
            container: {
                id : 'video-container',
                "class" : "video-container"
            },
            //ID-CLASSE video
            video : {
                id : "video",
                "class" : "video"
            },
            //ID-CLASSE controlli
            controls : {
                id : "controls",
                "class" : "controls"
            },
            //ID-CLASSE cover
            cover : {
                "class" : "video-cover"
            },
            volume : 1
        }, options||{});
        
        /**
         * Plugin
         */
        this.each(function (){
            var _this = this;               //Elemento legato al plugin
            var _video = $("video", _this); //Elemento video
            
            //OPZIONI
            var controls = settings.controls;
            var container = settings.container;
            var video = settings.video;
            var cover = settings.cover;
            var volume_ = settings.volume;
            
            //ELEMENTI
            var _cover = $("."+cover.class+" .video" ,_this);
            var _timebar = " #"+controls.id+" .timebar ";
            var _time = _timebar+" .time";
            var _buffer = _timebar + " .buffer";
            var _play = " #"+controls.id+" .play";
            var _pause = " #"+controls.id+" .pause";
            var _volume = " #"+controls.id+" .volume";
            var _duration = " #"+controls.id+" .duration";
            var _fullscreen = " #"+controls.id+" .fullscreen";
            var _mincreen = " #"+controls.id+" .minimizescreen";
            
            var timer = [];//Variabile per conservare tutti i setTimeOut
            
            var full = false;//Fullscreen
            
            $(_this).attr("tabindex", 1);
            
            hideControls(_video);//Nascondo i controlli originali
            addControls($("."+cover.class), controls, volume_);//Visualizzo i controlli
            
            volume(_video, volume_);
            
            //GET autoplay
            if(settings.autoplay){
                autoplay(_video, controls);
            }
            
            //GET Play/Pause se si clicca sul video
            $(_cover).bind("click", function (event){                
                if(!is_play(_video)){
                    play(_video, controls);
                }else{
                    pause(_video, controls);
                }
            });
            
            /*
             * GESTIONE FULLSCREEN
             */
            $(_fullscreen).bind("click", function (event){
                if($.fullscreen.isNativelySupported() && full == false){
                    //full = true;
                    full_to_min_screen(_video, controls);
                    
                    goInFullscreen(_cover);
                }
            });
            $(_mincreen).bind("click", function (event){
                min_to_full_screen(_video, controls);
                
                goOutFullscreen(_cover);
            });
            //Toggle fullscreen con doppio click sul video
            $(_cover).bind("dblclick", function (event){
                if($.fullscreen.isFullScreen()){
                    goOutFullscreen(_cover);
                }else{
                    goInFullscreen(_cover);
                }
                //Mantengo lo stato di riproduzione
                if(is_play(_this+_video)){
                    play(_video, controls);
                }else{
                    pause(_video, controls);
                }
            });
            //Cambio stato fullscreen
            $(document).bind('fscreenchange', function(e, state, elem) {
		if ($.fullscreen.isFullScreen()) {
                    $(_this).addClass("fullscreen");
                
                
                    full_to_min_screen(_video, controls);
		} else {
                    $(_this).removeClass("fullscreen");
                
                
                    min_to_full_screen(_video, controls);
		}
            });
            /****************************
             * EVENTI DA TASTIERA 
            */
            $(_this).bind('keydown', function(event) {
                //$(this).focus();
                if(event.keyCode === 32){
                   var video = $(_video);
                   
                    if(is_play(video)){
                        pause(video, controls);
                    }else{
                        play(video, controls);
                    }
                }
            });
            //----------------FINE EVENTI DA TASTIERA------------------------
            
            //Play
            $(_play, _this).on('click', function (event){
                event.preventDefault();
                
                play(_video, controls);
            });
            
            //Pausa
            $(_pause, _this).on('click', function (event){
                event.preventDefault();
                
                pause(_video, controls);
            });
            
            //Volume
            $(_volume+" .box", _this).on('click', function (event){
                toggle_mute_unmute(_volume);
                
                mute(_video);
            });
            /*$(_volume, _this).on('mouseover', function (){
                $(".bar", this).show();
            }).on('mouseleave', function (){
                $(".bar", this).hide();
            });*/
            $(_volume + " .bar", _this).on( "slidechange", function( event, ui ) {
                var volume_value = $(this).slider("value")/100;
                
                if(volume_value===0){
                    toggle_mute_unmute(_volume);
                }
                
                volume(_video, volume_value);
            });
            ////////////////////////////////////////////////////
            
            //Hover video
            $(_cover, _this).bind("mouseover", function (){
                if(is_play(_video)){
                    controls_fade_in(controls);
                }
            });
            //Leave video
            $(_cover, _this).bind("mouseleave", function (){
                if(is_play(_video)){
                    controls_fade_out(controls);
                }
            });
            //Toggle video controls
            $(_cover, _this).mousemove(function (){
                if(is_play(_video)){
                    controls_fade_in(controls);
                    //Aggiungo i setTimeout all'array
                    timer.push(setTimeout(function(){
                        if(!is_play(_video) === false){
                            controls_fade_out(controls, 1000);
                        }
                    }, 3000));
                }
            });
            //Mantengo i controlli visibili se il mouse è su d loro
            $("#"+controls.id, _this).on('mouseover', function (){
                //Cancello tutti i setTimeout
                for (var i = 0; i < timer.length; i++) {
                    clearTimeout(timer[i]);
                }
                timer = [];//Resetto l'array
                //$(this).stop().fadeIn();
                controls_fade_in(controls);
            }).on('mouseleave', function (){
                if(is_play(_video)){
                    controls_fade_out(controls);
                }
            });
            //Metadati video
            $(_video, _this).on("loadedmetadata", function (e){
                var duration = ($(this).prop('duration')/60);//Minuti
                duration = round_to(duration, 2).toString();
                duration = duration.replace('.',':');
                
                //Aggiungo la durata
                $(_duration+" .end").text(duration);
            });
            //Avanzamento timebar e tempo di ripdroduzione
            $(_video, _this).on("timeupdate", function (e){
                var currentTime = this.currentTime/60;
                currentTime = round_to(currentTime, 2).toFixed(2).toString();
                currentTime = currentTime.replace('.',':');
                var percent = (this.currentTime/this.duration)*100;
                
                $(_duration+" .start").text(currentTime);
                
                $(_time).progressbar("value", percent);
            });
            //Buffer
            $(_video, _this).on("progress", function (e){
                $(_buffer).progressbar("value", $(this)[0].buffered.end(0));
            });
            
            
            
            //Inizializzo la barra di avanzamento temporale
            $(_time, _this).progressbar({
                value: 0
            });
            //Inizializzo la barra di avanzamento del buffer
            $(_buffer, ).progressbar({
                value: 0
            });
            //Inizializzo la barra del volume
            $(_volume+" .bar", _this).slider({
                value : volume_*100
                //orientation: "vertical"
            });
        });
        
        return this;
    };
    
    /**
     * 
     * @param {type} element
     * @returns {undefined}
     */
    function goInFullscreen(element){
        $(element).addClass("fullscreen");
                    
        $(element).fullscreen();
    }
    
    /**
     * 
     * @param {type} element
     * @returns {undefined}
     */
    function goOutFullscreen(element){
        $(element).removeClass("fullscreen");
        
        $.fullscreen.exit();
    }
    
    /**
     * Approsimazione a n posizioni decimali
     * 
     * @param {type} value
     * @param {type} decimalPosition
     * @returns {Number}
     */
    function round_to(value, decimalPosition){
        var i = value*Math.pow(10, decimalPosition);
        i = Math.round(i);
        
        return i/Math.pow(10, decimalPosition);
    }
    
    /**
     * Avvia il video automaticamente
     * 
     * @param {Object} video
     * @param {type} controls
     * @returns null
     */
    function autoplay(video, controls){
        $(video).attr('autoplay', 'autoplay');
        
        //play_to_pause(el, controls);
    };
    
    /**
     * Controlla se il video è in play o in pausa
     * 
     * @param {Object} video Video Html Object
     * @returns {Boolean}
     */
    function is_play(video){
        if(video[0].paused)
            return false;
        else
            return true;
    };
    
    /**
     * Nascondo i controlli originali
     * 
     * @param {Object} video
     * @returns {undefined}
     */
    function hideControls(video){
        video.removeAttr('controls');
    };
    
    /**
     * Aggiungo i controlli personalizzati
     * 
     * @param {Object} el
     * @param {Object} controls
     * @returns {undefined}
     */
    function addControls(el, controls, volume_){
        var html = "<div id='" + controls.id + "' class='" + controls.class + "'>\n\
                            <div class='timebar'>\n\
                                <div class='buffer'></div>\n\
                                <div class='time'></div>\n\
                            </div>\n\
                            <div class='play'></div>\n\
                            <div class='pause' style='display:none;'></div>\n\
                            <div class='volume "+(volume_===0?'muted':'unmuted')+"'>\n\
                                <div class='box'></div>\n\
                                <div class='bar'></div>\n\
                            </div>\n\
                            <div class='fullscreen'></div>\n\
                            <div class='minimizescreen' style='display:none;'></div>\n\
                            <div class='duration'>\n\
                                <div class='start'>0:00</div>\n\
                                <span>/</span>\n\
                                <div class='end'></div>\n\
                            </div>\n\
                        </div>";
        el.append(html);
    };
    
    /**
     * Visualizza il pulsante di pausa
     * 
     * @param {Object} el
     * @param {Object} controls
     * @returns {null}
     */
    function play_to_pause(el, controls){
        el.parent().siblings("#"+controls.id).children(".play").hide();
        el.parent().siblings("#"+controls.id).children(".pause").show();
    }
    
    /**
     * Visualizza il pulsante di play
     * 
     * @param {Object} el
     * @param {Object} controls
     * @returns {null}
     */
    function pause_to_play(el, controls){
        el.parent().siblings("#"+controls.id).children(".pause").hide();
        el.parent().siblings("#"+controls.id).children(".play").show();
    };
    
    /**
     * Visualizza il pulsante di play
     * 
     * @param {Object} el
     * @param {Object} controls
     * @returns {null}
     */
    function full_to_min_screen(el, controls){
        el.parent().siblings("#"+controls.id).children(".fullscreen").hide();
        el.parent().siblings("#"+controls.id).children(".minimizescreen").show();
    };
    
    /**
     * Visualizza il pulsante di play
     * 
     * @param {Object} el
     * @param {Object} controls
     * @returns {null}
     */
    function min_to_full_screen(el, controls){
        el.parent().siblings("#"+controls.id).children(".minimizescreen").hide();
        el.parent().siblings("#"+controls.id).children(".fullscreen").show();
    };
    
    /**
     * 
     * @param {type} el
     * @returns {undefined}
     */
    function toggle_mute_unmute(el){
        $(el).toggleClass('muted');
        $(el).toggleClass('unmuted');
    }
    
    /**
     * 
     * @param {type} controls
     * @returns {undefined}
     */
    function controls_fade_in(controls){
        $("#"+controls.id).stop();
        $("#"+controls.id).fadeIn();
    };
    
    /**
     * 
     * @param {type} controls
     * @returns {undefined}
     */
    function controls_fade_out(controls, time = 500){
        $("#"+controls.id).stop();
        $("#"+controls.id).fadeOut(time);
    };
    
    /**
     * Play Video
     * 
     * @param {type} video
     * @param {type} controls
     * @returns {undefined}
     */
    function play(video, controls){
        video[0].play();
        
        controls_fade_out(controls);
        
        play_to_pause(video, controls);
    }
    
    /**
     * Play Video
     * 
     * @param {type} video
     * @param {type} controls
     * @returns {undefined}
     */
    function pause(video, controls){
        video[0].pause();
        
        controls_fade_in(controls);
        
        pause_to_play(video, controls);
    }
    
    /**
     * Mette/Toglie il muto dal video
     * 
     * @param {type} video
     * @returns {Boolean}
     */
    function mute(video){
        video[0].muted = !video[0].muted;
    }
    
    /**
     * Modifica il volume
     * 
     * @param {type} video
     * @param {type} volume
     */
    function volume(video, volume){
        video[0].volume = volume;
    }
})(jQuery);