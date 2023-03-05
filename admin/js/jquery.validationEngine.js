/*਀ ⨀ 䤀渀氀椀渀攀 䘀漀爀洀 嘀愀氀椀搀愀琀椀漀渀 䔀渀最椀渀攀 ㈀⸀㘀⸀㈀Ⰰ 樀儀甀攀爀礀 瀀氀甀最椀渀 
 *਀ ⨀ 䌀漀瀀礀爀椀最栀琀⠀挀⤀ ㈀　㄀　Ⰰ 䌀攀搀爀椀挀 䐀甀最愀猀 
 * http://www.position-absolute.com਀ ⨀ 
 * 2.0 Rewrite by Olivier Refalo਀ ⨀ 栀琀琀瀀㨀⼀⼀眀眀眀⸀挀爀椀漀渀椀挀猀⸀挀漀洀 
 *਀ ⨀ 䘀漀爀洀 瘀愀氀椀搀愀琀椀漀渀 攀渀最椀渀攀 愀氀氀漀眀椀渀最 挀甀猀琀漀洀 爀攀最攀砀 爀甀氀攀猀 琀漀 戀攀 愀搀搀攀搀⸀ 
 * Licensed under the MIT License਀ ⨀⼀ 
 (function($) {਀ 
	"use strict";਀ 
	var methods = {਀ 
		/**਀ऀऀ⨀ 䬀椀渀搀 漀昀 琀栀攀 挀漀渀猀琀爀甀挀琀漀爀Ⰰ 挀愀氀氀攀搀 戀攀昀漀爀攀 愀渀礀 愀挀琀椀漀渀 
		* @param {Map} user options਀ऀऀ⨀⼀ 
		init: function(options) {਀ऀऀऀ瘀愀爀 昀漀爀洀 㴀 琀栀椀猀㬀 
			if (!form.data('jqv') || form.data('jqv') == null ) {਀ऀऀऀऀ漀瀀琀椀漀渀猀 㴀 洀攀琀栀漀搀猀⸀开猀愀瘀攀伀瀀琀椀漀渀猀⠀昀漀爀洀Ⰰ 漀瀀琀椀漀渀猀⤀㬀 
				// bind all formError elements to close on click਀ऀऀऀऀ␀⠀搀漀挀甀洀攀渀琀⤀⸀漀渀⠀∀挀氀椀挀欀∀Ⰰ ∀⸀昀漀爀洀䔀爀爀漀爀∀Ⰰ 昀甀渀挀琀椀漀渀⠀⤀ 笀 
					$(this).fadeOut(150, function() {਀ऀऀऀऀऀऀ⼀⼀ 爀攀洀漀瘀攀 瀀爀漀洀瀀琀 漀渀挀攀 椀渀瘀椀猀椀戀氀攀 
						$(this).parent('.formErrorOuter').remove();਀ऀऀऀऀऀऀ␀⠀琀栀椀猀⤀⸀爀攀洀漀瘀攀⠀⤀㬀 
					});਀ऀऀऀऀ紀⤀㬀 
			}਀ऀऀऀ爀攀琀甀爀渀 琀栀椀猀㬀 
		 },਀ऀऀ⼀⨀⨀ 
		* Attachs jQuery.validationEngine to form.submit and field.blur events਀ऀऀ⨀ 吀愀欀攀猀 愀渀 漀瀀琀椀漀渀愀氀 瀀愀爀愀洀猀㨀 愀 氀椀猀琀 漀昀 漀瀀琀椀漀渀猀 
		* ie. jQuery("#formID1").validationEngine('attach', {promptPosition : "centerRight"});਀ऀऀ⨀⼀ 
		attach: function(userOptions) {਀ 
			var form = this;਀ऀऀऀ瘀愀爀 漀瀀琀椀漀渀猀㬀 
਀ऀऀऀ椀昀⠀甀猀攀爀伀瀀琀椀漀渀猀⤀ 
				options = methods._saveOptions(form, userOptions);਀ऀऀऀ攀氀猀攀 
				options = form.data('jqv');਀ 
			options.validateAttribute = (form.find("[data-validation-engine*=validate]").length) ? "data-validation-engine" : "class";਀ऀऀऀ椀昀 ⠀漀瀀琀椀漀渀猀⸀戀椀渀搀攀搀⤀ 笀 
਀ऀऀऀऀ⼀⼀ 搀攀氀攀最愀琀攀 昀椀攀氀搀猀 
				form.on(options.validationEventTrigger, "["+options.validateAttribute+"*=validate]:not([type=checkbox]):not([type=radio]):not(.datepicker)", methods._onFieldEvent);਀ऀऀऀऀ昀漀爀洀⸀漀渀⠀∀挀氀椀挀欀∀Ⰰ ∀嬀∀⬀漀瀀琀椀漀渀猀⸀瘀愀氀椀搀愀琀攀䄀琀琀爀椀戀甀琀攀⬀∀⨀㴀瘀愀氀椀搀愀琀攀崀嬀琀礀瀀攀㴀挀栀攀挀欀戀漀砀崀Ⰰ嬀∀⬀漀瀀琀椀漀渀猀⸀瘀愀氀椀搀愀琀攀䄀琀琀爀椀戀甀琀攀⬀∀⨀㴀瘀愀氀椀搀愀琀攀崀嬀琀礀瀀攀㴀爀愀搀椀漀崀∀Ⰰ 洀攀琀栀漀搀猀⸀开漀渀䘀椀攀氀搀䔀瘀攀渀琀⤀㬀 
				form.on(options.validationEventTrigger,"["+options.validateAttribute+"*=validate][class*=datepicker]", {"delay": 300}, methods._onFieldEvent);਀ऀऀऀ紀 
			if (options.autoPositionUpdate) {਀ऀऀऀऀ␀⠀眀椀渀搀漀眀⤀⸀戀椀渀搀⠀∀爀攀猀椀稀攀∀Ⰰ 笀 
					"noAnimation": true,਀ऀऀऀऀऀ∀昀漀爀洀䔀氀攀洀∀㨀 昀漀爀洀 
				}, methods.updatePromptsPosition);਀ऀऀऀ紀 
			form.on("click","a[data-validation-engine-skip], a[class*='validate-skip'], button[data-validation-engine-skip], button[class*='validate-skip'], input[data-validation-engine-skip], input[class*='validate-skip']", methods._submitButtonClick);਀ऀऀऀ昀漀爀洀⸀爀攀洀漀瘀攀䐀愀琀愀⠀✀樀焀瘀开猀甀戀洀椀琀䈀甀琀琀漀渀✀⤀㬀 
਀ऀऀऀ⼀⼀ 戀椀渀搀 昀漀爀洀⸀猀甀戀洀椀琀 
			form.on("submit", methods._onSubmitEvent);਀ऀऀऀ爀攀琀甀爀渀 琀栀椀猀㬀 
		},਀ऀऀ⼀⨀⨀ 
		* Unregisters any bindings that may point to jQuery.validaitonEngine਀ऀऀ⨀⼀ 
		detach: function() {਀ 
			var form = this;਀ऀऀऀ瘀愀爀 漀瀀琀椀漀渀猀 㴀 昀漀爀洀⸀搀愀琀愀⠀✀樀焀瘀✀⤀㬀 
਀ऀऀऀ⼀⼀ 甀渀戀椀渀搀 昀椀攀氀搀猀 
			form.find("["+options.validateAttribute+"*=validate]").not("[type=checkbox]").off(options.validationEventTrigger, methods._onFieldEvent);਀ऀऀऀ昀漀爀洀⸀昀椀渀搀⠀∀嬀∀⬀漀瀀琀椀漀渀猀⸀瘀愀氀椀搀愀琀攀䄀琀琀爀椀戀甀琀攀⬀∀⨀㴀瘀愀氀椀搀愀琀攀崀嬀琀礀瀀攀㴀挀栀攀挀欀戀漀砀崀Ⰰ嬀挀氀愀猀猀⨀㴀瘀愀氀椀搀愀琀攀崀嬀琀礀瀀攀㴀爀愀搀椀漀崀∀⤀⸀漀昀昀⠀∀挀氀椀挀欀∀Ⰰ 洀攀琀栀漀搀猀⸀开漀渀䘀椀攀氀搀䔀瘀攀渀琀⤀㬀 
਀ऀऀऀ⼀⼀ 甀渀戀椀渀搀 昀漀爀洀⸀猀甀戀洀椀琀 
			form.off("submit", methods._onSubmitEvent);਀ऀऀऀ昀漀爀洀⸀爀攀洀漀瘀攀䐀愀琀愀⠀✀樀焀瘀✀⤀㬀 
            ਀ऀऀऀ昀漀爀洀⸀漀昀昀⠀∀挀氀椀挀欀∀Ⰰ ∀愀嬀搀愀琀愀ⴀ瘀愀氀椀搀愀琀椀漀渀ⴀ攀渀最椀渀攀ⴀ猀欀椀瀀崀Ⰰ 愀嬀挀氀愀猀猀⨀㴀✀瘀愀氀椀搀愀琀攀ⴀ猀欀椀瀀✀崀Ⰰ 戀甀琀琀漀渀嬀搀愀琀愀ⴀ瘀愀氀椀搀愀琀椀漀渀ⴀ攀渀最椀渀攀ⴀ猀欀椀瀀崀Ⰰ 戀甀琀琀漀渀嬀挀氀愀猀猀⨀㴀✀瘀愀氀椀搀愀琀攀ⴀ猀欀椀瀀✀崀Ⰰ 椀渀瀀甀琀嬀搀愀琀愀ⴀ瘀愀氀椀搀愀琀椀漀渀ⴀ攀渀最椀渀攀ⴀ猀欀椀瀀崀Ⰰ 椀渀瀀甀琀嬀挀氀愀猀猀⨀㴀✀瘀愀氀椀搀愀琀攀ⴀ猀欀椀瀀✀崀∀Ⰰ 洀攀琀栀漀搀猀⸀开猀甀戀洀椀琀䈀甀琀琀漀渀䌀氀椀挀欀⤀㬀 
			form.removeData('jqv_submitButton');਀ 
			if (options.autoPositionUpdate)਀ऀऀऀऀ␀⠀眀椀渀搀漀眀⤀⸀漀昀昀⠀∀爀攀猀椀稀攀∀Ⰰ 洀攀琀栀漀搀猀⸀甀瀀搀愀琀攀倀爀漀洀瀀琀猀倀漀猀椀琀椀漀渀⤀㬀 
਀ऀऀऀ爀攀琀甀爀渀 琀栀椀猀㬀 
		},਀ऀऀ⼀⨀⨀ 
		* Validates either a form or a list of fields, shows prompts accordingly.਀ऀऀ⨀ 一漀琀攀㨀 吀栀攀爀攀 椀猀 渀漀 愀樀愀砀 昀漀爀洀 瘀愀氀椀搀愀琀椀漀渀 眀椀琀栀 琀栀椀猀 洀攀琀栀漀搀Ⰰ 漀渀氀礀 昀椀攀氀搀 愀樀愀砀 瘀愀氀椀搀愀琀椀漀渀 愀爀攀 攀瘀愀氀甀愀琀攀搀 
		*਀ऀऀ⨀ 䀀爀攀琀甀爀渀 琀爀甀攀 椀昀 琀栀攀 昀漀爀洀 瘀愀氀椀搀愀琀攀猀Ⰰ 昀愀氀猀攀 椀昀 椀琀 昀愀椀氀猀 
		*/਀ऀऀ瘀愀氀椀搀愀琀攀㨀 昀甀渀挀琀椀漀渀⠀⤀ 笀 
			var element = $(this);਀ऀऀऀ瘀愀爀 瘀愀氀椀搀 㴀 渀甀氀氀㬀 
਀ऀऀऀ椀昀 ⠀攀氀攀洀攀渀琀⸀椀猀⠀∀昀漀爀洀∀⤀ 簀簀 攀氀攀洀攀渀琀⸀栀愀猀䌀氀愀猀猀⠀∀瘀愀氀椀搀愀琀椀漀渀䔀渀最椀渀攀䌀漀渀琀愀椀渀攀爀∀⤀⤀ 笀 
				if (element.hasClass('validating')) {਀ऀऀऀऀऀ⼀⼀ 昀漀爀洀 椀猀 愀氀爀攀愀搀礀 瘀愀氀椀搀愀琀椀渀最⸀ 
					// Should abort old validation and start new one. I don't know how to implement it.਀ऀऀऀऀऀ爀攀琀甀爀渀 昀愀氀猀攀㬀 
				} else {				਀ऀऀऀऀऀ攀氀攀洀攀渀琀⸀愀搀搀䌀氀愀猀猀⠀✀瘀愀氀椀搀愀琀椀渀最✀⤀㬀 
					var options = element.data('jqv');਀ऀऀऀऀऀ瘀愀爀 瘀愀氀椀搀 㴀 洀攀琀栀漀搀猀⸀开瘀愀氀椀搀愀琀攀䘀椀攀氀搀猀⠀琀栀椀猀⤀㬀 
਀ऀऀऀऀऀ⼀⼀ 䤀昀 琀栀攀 昀漀爀洀 搀漀攀猀渀✀琀 瘀愀氀椀搀愀琀攀Ⰰ 挀氀攀愀爀 琀栀攀 ✀瘀愀氀椀搀愀琀椀渀最✀ 挀氀愀猀猀 戀攀昀漀爀攀 琀栀攀 甀猀攀爀 栀愀猀 愀 挀栀愀渀挀攀 琀漀 猀甀戀洀椀琀 愀最愀椀渀 
					setTimeout(function(){਀ऀऀऀऀऀऀ攀氀攀洀攀渀琀⸀爀攀洀漀瘀攀䌀氀愀猀猀⠀✀瘀愀氀椀搀愀琀椀渀最✀⤀㬀 
					}, 100);਀ऀऀऀऀऀ椀昀 ⠀瘀愀氀椀搀 ☀☀ 漀瀀琀椀漀渀猀⸀漀渀匀甀挀挀攀猀猀⤀ 笀 
						options.onSuccess();਀ऀऀऀऀऀ紀 攀氀猀攀 椀昀 ⠀℀瘀愀氀椀搀 ☀☀ 漀瀀琀椀漀渀猀⸀漀渀䘀愀椀氀甀爀攀⤀ 笀 
						options.onFailure();਀ऀऀऀऀऀ紀 
				}਀ऀऀऀ紀 攀氀猀攀 椀昀 ⠀攀氀攀洀攀渀琀⸀椀猀⠀✀昀漀爀洀✀⤀ 簀簀 攀氀攀洀攀渀琀⸀栀愀猀䌀氀愀猀猀⠀✀瘀愀氀椀搀愀琀椀漀渀䔀渀最椀渀攀䌀漀渀琀愀椀渀攀爀✀⤀⤀ 笀 
				element.removeClass('validating');਀ऀऀऀ紀 攀氀猀攀 笀 
				// field validation਀ऀऀऀऀ瘀愀爀 昀漀爀洀 㴀 攀氀攀洀攀渀琀⸀挀氀漀猀攀猀琀⠀✀昀漀爀洀Ⰰ ⸀瘀愀氀椀搀愀琀椀漀渀䔀渀最椀渀攀䌀漀渀琀愀椀渀攀爀✀⤀Ⰰ 
					options = (form.data('jqv')) ? form.data('jqv') : $.validationEngine.defaults,਀ऀऀऀऀऀ瘀愀氀椀搀 㴀 洀攀琀栀漀搀猀⸀开瘀愀氀椀搀愀琀攀䘀椀攀氀搀⠀攀氀攀洀攀渀琀Ⰰ 漀瀀琀椀漀渀猀⤀㬀 
਀ऀऀऀऀ椀昀 ⠀瘀愀氀椀搀 ☀☀ 漀瀀琀椀漀渀猀⸀漀渀䘀椀攀氀搀匀甀挀挀攀猀猀⤀ 
					options.onFieldSuccess();਀ऀऀऀऀ攀氀猀攀 椀昀 ⠀漀瀀琀椀漀渀猀⸀漀渀䘀椀攀氀搀䘀愀椀氀甀爀攀 ☀☀ 漀瀀琀椀漀渀猀⸀䤀渀瘀愀氀椀搀䘀椀攀氀搀猀⸀氀攀渀最琀栀 㸀 　⤀ 笀 
					options.onFieldFailure();਀ऀऀऀऀ紀 
			}਀ऀऀऀ椀昀⠀漀瀀琀椀漀渀猀⸀漀渀嘀愀氀椀搀愀琀椀漀渀䌀漀洀瀀氀攀琀攀⤀ 笀 
				// !! ensures that an undefined return is interpreted as return false but allows a onValidationComplete() to possibly return true and have form continue processing਀ऀऀऀऀ爀攀琀甀爀渀 ℀℀漀瀀琀椀漀渀猀⸀漀渀嘀愀氀椀搀愀琀椀漀渀䌀漀洀瀀氀攀琀攀⠀昀漀爀洀Ⰰ 瘀愀氀椀搀⤀㬀 
			}਀ऀऀऀ爀攀琀甀爀渀 瘀愀氀椀搀㬀 
		},਀ऀऀ⼀⨀⨀ 
		*  Redraw prompts position, useful when you change the DOM state when validating਀ऀऀ⨀⼀ 
		updatePromptsPosition: function(event) {਀ 
			if (event && this == window) {਀ऀऀऀऀ瘀愀爀 昀漀爀洀 㴀 攀瘀攀渀琀⸀搀愀琀愀⸀昀漀爀洀䔀氀攀洀㬀 
				var noAnimation = event.data.noAnimation;਀ऀऀऀ紀 
			else਀ऀऀऀऀ瘀愀爀 昀漀爀洀 㴀 ␀⠀琀栀椀猀⸀挀氀漀猀攀猀琀⠀✀昀漀爀洀Ⰰ ⸀瘀愀氀椀搀愀琀椀漀渀䔀渀最椀渀攀䌀漀渀琀愀椀渀攀爀✀⤀⤀㬀 
਀ऀऀऀ瘀愀爀 漀瀀琀椀漀渀猀 㴀 昀漀爀洀⸀搀愀琀愀⠀✀樀焀瘀✀⤀㬀 
			// No option, take default one਀ऀऀऀ昀漀爀洀⸀昀椀渀搀⠀✀嬀✀⬀漀瀀琀椀漀渀猀⸀瘀愀氀椀搀愀琀攀䄀琀琀爀椀戀甀琀攀⬀✀⨀㴀瘀愀氀椀搀愀琀攀崀✀⤀⸀渀漀琀⠀∀㨀搀椀猀愀戀氀攀搀∀⤀⸀攀愀挀栀⠀昀甀渀挀琀椀漀渀⠀⤀笀 
				var field = $(this);਀ऀऀऀऀ椀昀 ⠀漀瀀琀椀漀渀猀⸀瀀爀攀琀琀礀匀攀氀攀挀琀 ☀☀ 昀椀攀氀搀⸀椀猀⠀∀㨀栀椀搀搀攀渀∀⤀⤀ 
				  field = form.find("#" + options.usePrefix + field.attr('id') + options.useSuffix);਀ऀऀऀऀ瘀愀爀 瀀爀漀洀瀀琀 㴀 洀攀琀栀漀搀猀⸀开最攀琀倀爀漀洀瀀琀⠀昀椀攀氀搀⤀㬀 
				var promptText = $(prompt).find(".formErrorContent").html();਀ 
				if(prompt)਀ऀऀऀऀऀ洀攀琀栀漀搀猀⸀开甀瀀搀愀琀攀倀爀漀洀瀀琀⠀昀椀攀氀搀Ⰰ ␀⠀瀀爀漀洀瀀琀⤀Ⰰ 瀀爀漀洀瀀琀吀攀砀琀Ⰰ 甀渀搀攀昀椀渀攀搀Ⰰ 昀愀氀猀攀Ⰰ 漀瀀琀椀漀渀猀Ⰰ 渀漀䄀渀椀洀愀琀椀漀渀⤀㬀 
			});਀ऀऀऀ爀攀琀甀爀渀 琀栀椀猀㬀 
		},਀ऀऀ⼀⨀⨀ 
		* Displays a prompt on a element.਀ऀऀ⨀ 一漀琀攀 琀栀愀琀 琀栀攀 攀氀攀洀攀渀琀 渀攀攀搀猀 愀渀 椀搀℀ 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀匀琀爀椀渀最紀 瀀爀漀洀瀀琀吀攀砀琀 栀琀洀氀 琀攀砀琀 琀漀 搀椀猀瀀氀愀礀 琀礀瀀攀 
		* @param {String} type the type of bubble: 'pass' (green), 'load' (black) anything else (red)਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀匀琀爀椀渀最紀 瀀漀猀猀椀戀氀攀 瘀愀氀甀攀猀 琀漀瀀䰀攀昀琀Ⰰ 琀漀瀀刀椀最栀琀Ⰰ 戀漀琀琀漀洀䰀攀昀琀Ⰰ 挀攀渀琀攀爀刀椀最栀琀Ⰰ 戀漀琀琀漀洀刀椀最栀琀 
		*/਀ऀऀ猀栀漀眀倀爀漀洀瀀琀㨀 昀甀渀挀琀椀漀渀⠀瀀爀漀洀瀀琀吀攀砀琀Ⰰ 琀礀瀀攀Ⰰ 瀀爀漀洀瀀琀倀漀猀椀琀椀漀渀Ⰰ 猀栀漀眀䄀爀爀漀眀⤀ 笀 
			var form = this.closest('form, .validationEngineContainer');਀ऀऀऀ瘀愀爀 漀瀀琀椀漀渀猀 㴀 昀漀爀洀⸀搀愀琀愀⠀✀樀焀瘀✀⤀㬀 
			// No option, take default one਀ऀऀऀ椀昀⠀℀漀瀀琀椀漀渀猀⤀ 
				options = methods._saveOptions(this, options);਀ऀऀऀ椀昀⠀瀀爀漀洀瀀琀倀漀猀椀琀椀漀渀⤀ 
				options.promptPosition=promptPosition;਀ऀऀऀ漀瀀琀椀漀渀猀⸀猀栀漀眀䄀爀爀漀眀 㴀 猀栀漀眀䄀爀爀漀眀㴀㴀琀爀甀攀㬀 
਀ऀऀऀ洀攀琀栀漀搀猀⸀开猀栀漀眀倀爀漀洀瀀琀⠀琀栀椀猀Ⰰ 瀀爀漀洀瀀琀吀攀砀琀Ⰰ 琀礀瀀攀Ⰰ 昀愀氀猀攀Ⰰ 漀瀀琀椀漀渀猀⤀㬀 
			return this;਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 䌀氀漀猀攀猀 昀漀爀洀 攀爀爀漀爀 瀀爀漀洀瀀琀猀Ⰰ 䌀䄀一 戀攀 椀渀瘀椀搀甀愀氀 
		*/਀ऀऀ栀椀搀攀㨀 昀甀渀挀琀椀漀渀⠀⤀ 笀 
			 var form = $(this).closest('form, .validationEngineContainer');਀ऀऀऀ 瘀愀爀 漀瀀琀椀漀渀猀 㴀 昀漀爀洀⸀搀愀琀愀⠀✀樀焀瘀✀⤀㬀 
			 var fadeDuration = (options && options.fadeDuration) ? options.fadeDuration : 0.3;਀ऀऀऀ 瘀愀爀 挀氀漀猀椀渀最琀愀最㬀 
			 ਀ऀऀऀ 椀昀⠀␀⠀琀栀椀猀⤀⸀椀猀⠀∀昀漀爀洀∀⤀ 簀簀 ␀⠀琀栀椀猀⤀⸀栀愀猀䌀氀愀猀猀⠀∀瘀愀氀椀搀愀琀椀漀渀䔀渀最椀渀攀䌀漀渀琀愀椀渀攀爀∀⤀⤀ 笀 
				 closingtag = "parentForm"+methods._getClassName($(this).attr("id"));਀ऀऀऀ 紀 攀氀猀攀 笀 
				 closingtag = methods._getClassName($(this).attr("id")) +"formError";਀ऀऀऀ 紀 
			 $('.'+closingtag).fadeTo(fadeDuration, 0.3, function() {਀ऀऀऀऀ ␀⠀琀栀椀猀⤀⸀瀀愀爀攀渀琀⠀✀⸀昀漀爀洀䔀爀爀漀爀伀甀琀攀爀✀⤀⸀爀攀洀漀瘀攀⠀⤀㬀 
				 $(this).remove();਀ऀऀऀ 紀⤀㬀 
			 return this;਀ऀऀ 紀Ⰰ 
		 /**਀ऀऀ ⨀ 䌀氀漀猀攀猀 愀氀氀 攀爀爀漀爀 瀀爀漀洀瀀琀猀 漀渀 琀栀攀 瀀愀最攀 
		 */਀ऀऀ 栀椀搀攀䄀氀氀㨀 昀甀渀挀琀椀漀渀⠀⤀ 笀 
਀ऀऀऀ 瘀愀爀 昀漀爀洀 㴀 琀栀椀猀㬀 
			 var options = form.data('jqv');਀ऀऀऀ 瘀愀爀 搀甀爀愀琀椀漀渀 㴀 漀瀀琀椀漀渀猀 㼀 漀瀀琀椀漀渀猀⸀昀愀搀攀䐀甀爀愀琀椀漀渀㨀㌀　　㬀 
			 $('.formError').fadeTo(duration, 300, function() {਀ऀऀऀऀ ␀⠀琀栀椀猀⤀⸀瀀愀爀攀渀琀⠀✀⸀昀漀爀洀䔀爀爀漀爀伀甀琀攀爀✀⤀⸀爀攀洀漀瘀攀⠀⤀㬀 
				 $(this).remove();਀ऀऀऀ 紀⤀㬀 
			 return this;਀ऀऀ 紀Ⰰ 
		/**਀ऀऀ⨀ 吀礀瀀椀挀愀氀氀礀 挀愀氀氀攀搀 眀栀攀渀 甀猀攀爀 攀砀椀猀琀猀 愀 昀椀攀氀搀 甀猀椀渀最 琀愀戀 漀爀 愀 洀漀甀猀攀 挀氀椀挀欀Ⰰ 琀爀椀最最攀爀猀 愀 昀椀攀氀搀 
		* validation਀ऀऀ⨀⼀ 
		_onFieldEvent: function(event) {਀ऀऀऀ瘀愀爀 昀椀攀氀搀 㴀 ␀⠀琀栀椀猀⤀㬀 
			var form = field.closest('form, .validationEngineContainer');਀ऀऀऀ瘀愀爀 漀瀀琀椀漀渀猀 㴀 昀漀爀洀⸀搀愀琀愀⠀✀樀焀瘀✀⤀㬀 
			options.eventTrigger = "field";਀ऀऀऀ⼀⼀ 瘀愀氀椀搀愀琀攀 琀栀攀 挀甀爀爀攀渀琀 昀椀攀氀搀 
			window.setTimeout(function() {਀ऀऀऀऀ洀攀琀栀漀搀猀⸀开瘀愀氀椀搀愀琀攀䘀椀攀氀搀⠀昀椀攀氀搀Ⰰ 漀瀀琀椀漀渀猀⤀㬀 
				if (options.InvalidFields.length == 0 && options.onFieldSuccess) {਀ऀऀऀऀऀ漀瀀琀椀漀渀猀⸀漀渀䘀椀攀氀搀匀甀挀挀攀猀猀⠀⤀㬀 
				} else if (options.InvalidFields.length > 0 && options.onFieldFailure) {਀ऀऀऀऀऀ漀瀀琀椀漀渀猀⸀漀渀䘀椀攀氀搀䘀愀椀氀甀爀攀⠀⤀㬀 
				}਀ऀऀऀ紀Ⰰ ⠀攀瘀攀渀琀⸀搀愀琀愀⤀ 㼀 攀瘀攀渀琀⸀搀愀琀愀⸀搀攀氀愀礀 㨀 　⤀㬀 
਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 䌀愀氀氀攀搀 眀栀攀渀 琀栀攀 昀漀爀洀 椀猀 猀甀戀洀椀琀攀搀Ⰰ 猀栀漀眀猀 瀀爀漀洀瀀琀猀 愀挀挀漀爀搀椀渀最氀礀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 
		*            form਀ऀऀ⨀ 䀀爀攀琀甀爀渀 昀愀氀猀攀 椀昀 昀漀爀洀 猀甀戀洀椀猀猀椀漀渀 渀攀攀搀猀 琀漀 戀攀 挀愀渀挀攀氀氀攀搀 
		*/਀ऀऀ开漀渀匀甀戀洀椀琀䔀瘀攀渀琀㨀 昀甀渀挀琀椀漀渀⠀⤀ 笀 
			var form = $(this);਀ऀऀऀ瘀愀爀 漀瀀琀椀漀渀猀 㴀 昀漀爀洀⸀搀愀琀愀⠀✀樀焀瘀✀⤀㬀 
			਀ऀऀऀ⼀⼀挀栀攀挀欀 椀昀 椀琀 椀猀 琀爀椀最最攀爀 昀爀漀洀 猀欀椀瀀瀀攀搀 戀甀琀琀漀渀 
			if (form.data("jqv_submitButton")){਀ऀऀऀऀ瘀愀爀 猀甀戀洀椀琀䈀甀琀琀漀渀 㴀 ␀⠀∀⌀∀ ⬀ 昀漀爀洀⸀搀愀琀愀⠀∀樀焀瘀开猀甀戀洀椀琀䈀甀琀琀漀渀∀⤀⤀㬀 
				if (submitButton){਀ऀऀऀऀऀ椀昀 ⠀猀甀戀洀椀琀䈀甀琀琀漀渀⸀氀攀渀最琀栀 㸀 　⤀笀 
						if (submitButton.hasClass("validate-skip") || submitButton.attr("data-validation-engine-skip") == "true")਀ऀऀऀऀऀऀऀ爀攀琀甀爀渀 琀爀甀攀㬀 
					}਀ऀऀऀऀ紀 
			}਀ 
			options.eventTrigger = "submit";਀ 
			// validate each field ਀ऀऀऀ⼀⼀ ⠀ⴀ 猀欀椀瀀 昀椀攀氀搀 愀樀愀砀 瘀愀氀椀搀愀琀椀漀渀Ⰰ 渀漀琀 渀攀挀攀猀猀愀爀礀 䤀䘀 眀攀 眀椀氀氀 瀀攀爀昀漀爀洀 愀渀 愀樀愀砀 昀漀爀洀 瘀愀氀椀搀愀琀椀漀渀⤀ 
			var r=methods._validateFields(form);਀ 
			if (r && options.ajaxFormValidation) {਀ऀऀऀऀ洀攀琀栀漀搀猀⸀开瘀愀氀椀搀愀琀攀䘀漀爀洀圀椀琀栀䄀樀愀砀⠀昀漀爀洀Ⰰ 漀瀀琀椀漀渀猀⤀㬀 
				// cancel form auto-submission - process with async call onAjaxFormComplete਀ऀऀऀऀ爀攀琀甀爀渀 昀愀氀猀攀㬀 
			}਀ 
			if(options.onValidationComplete) {਀ऀऀऀऀ⼀⼀ ℀℀ 攀渀猀甀爀攀猀 琀栀愀琀 愀渀 甀渀搀攀昀椀渀攀搀 爀攀琀甀爀渀 椀猀 椀渀琀攀爀瀀爀攀琀攀搀 愀猀 爀攀琀甀爀渀 昀愀氀猀攀 戀甀琀 愀氀氀漀眀猀 愀 漀渀嘀愀氀椀搀愀琀椀漀渀䌀漀洀瀀氀攀琀攀⠀⤀ 琀漀 瀀漀猀猀椀戀氀礀 爀攀琀甀爀渀 琀爀甀攀 愀渀搀 栀愀瘀攀 昀漀爀洀 挀漀渀琀椀渀甀攀 瀀爀漀挀攀猀猀椀渀最 
				return !!options.onValidationComplete(form, r);਀ऀऀऀ紀 
			return r;਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 刀攀琀甀爀渀 琀爀甀攀 椀昀 琀栀攀 愀樀愀砀 昀椀攀氀搀 瘀愀氀椀搀愀琀椀漀渀猀 瀀愀猀猀攀搀 猀漀 昀愀爀 
		* @param {Object} options਀ऀऀ⨀ 䀀爀攀琀甀爀渀 琀爀甀攀Ⰰ 椀猀 愀氀氀 愀樀愀砀 瘀愀氀椀搀愀琀椀漀渀 瀀愀猀猀攀搀 猀漀 昀愀爀 ⠀爀攀洀攀洀戀攀爀 愀樀愀砀 椀猀 愀猀礀渀挀⤀ 
		*/਀ऀऀ开挀栀攀挀欀䄀樀愀砀匀琀愀琀甀猀㨀 昀甀渀挀琀椀漀渀⠀漀瀀琀椀漀渀猀⤀ 笀 
			var status = true;਀ऀऀऀ␀⸀攀愀挀栀⠀漀瀀琀椀漀渀猀⸀愀樀愀砀嘀愀氀椀搀䌀愀挀栀攀Ⰰ 昀甀渀挀琀椀漀渀⠀欀攀礀Ⰰ 瘀愀氀甀攀⤀ 笀 
				if (!value) {਀ऀऀऀऀऀ猀琀愀琀甀猀 㴀 昀愀氀猀攀㬀 
					// break the each਀ऀऀऀऀऀ爀攀琀甀爀渀 昀愀氀猀攀㬀 
				}਀ऀऀऀ紀⤀㬀 
			return status;਀ऀऀ紀Ⰰ 
		਀ऀऀ⼀⨀⨀ 
		* Return true if the ajax field is validated਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀匀琀爀椀渀最紀 昀椀攀氀搀椀搀 
		* @param {Object} options਀ऀऀ⨀ 䀀爀攀琀甀爀渀 琀爀甀攀Ⰰ 椀昀 瘀愀氀椀搀愀琀椀漀渀 瀀愀猀猀攀搀Ⰰ 昀愀氀猀攀 椀昀 昀愀氀猀攀 漀爀 搀漀攀猀渀✀琀 攀砀椀猀琀 
		*/਀ऀऀ开挀栀攀挀欀䄀樀愀砀䘀椀攀氀搀匀琀愀琀甀猀㨀 昀甀渀挀琀椀漀渀⠀昀椀攀氀搀椀搀Ⰰ 漀瀀琀椀漀渀猀⤀ 笀 
			return options.ajaxValidCache[fieldid] == true;਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 嘀愀氀椀搀愀琀攀猀 昀漀爀洀 昀椀攀氀搀猀Ⰰ 猀栀漀眀猀 瀀爀漀洀瀀琀猀 愀挀挀漀爀搀椀渀最氀礀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 
		*            form਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀猀欀椀瀀䄀樀愀砀䘀椀攀氀搀嘀愀氀椀搀愀琀椀漀渀紀 
		*            boolean - when set to true, ajax field validation is skipped, typically used when the submit button is clicked਀ऀऀ⨀ 
		* @return true if form is valid, false if not, undefined if ajax form validation is done਀ऀऀ⨀⼀ 
		_validateFields: function(form) {਀ऀऀऀ瘀愀爀 漀瀀琀椀漀渀猀 㴀 昀漀爀洀⸀搀愀琀愀⠀✀樀焀瘀✀⤀㬀 
਀ऀऀऀ⼀⼀ 琀栀椀猀 瘀愀爀椀愀戀氀攀 椀猀 猀攀琀 琀漀 琀爀甀攀 椀昀 愀渀 攀爀爀漀爀 椀猀 昀漀甀渀搀 
			var errorFound = false;਀ 
			// Trigger hook, start validation਀ऀऀऀ昀漀爀洀⸀琀爀椀最最攀爀⠀∀樀焀瘀⸀昀漀爀洀⸀瘀愀氀椀搀愀琀椀渀最∀⤀㬀 
			// first, evaluate status of non ajax fields਀ऀऀऀ瘀愀爀 昀椀爀猀琀开攀爀爀㴀渀甀氀氀㬀 
			form.find('['+options.validateAttribute+'*=validate]').not(":disabled").each( function() {਀ऀऀऀऀ瘀愀爀 昀椀攀氀搀 㴀 ␀⠀琀栀椀猀⤀㬀 
				var names = [];਀ऀऀऀऀ椀昀 ⠀␀⸀椀渀䄀爀爀愀礀⠀昀椀攀氀搀⸀愀琀琀爀⠀✀渀愀洀攀✀⤀Ⰰ 渀愀洀攀猀⤀ 㰀 　⤀ 笀 
					errorFound |= methods._validateField(field, options);਀ऀऀऀऀऀ椀昀 ⠀攀爀爀漀爀䘀漀甀渀搀 ☀☀ 昀椀爀猀琀开攀爀爀㴀㴀渀甀氀氀⤀ 
						if (field.is(":hidden") && options.prettySelect)਀ऀऀऀऀऀऀऀ昀椀爀猀琀开攀爀爀 㴀 昀椀攀氀搀 㴀 昀漀爀洀⸀昀椀渀搀⠀∀⌀∀ ⬀ 漀瀀琀椀漀渀猀⸀甀猀攀倀爀攀昀椀砀 ⬀ 洀攀琀栀漀搀猀⸀开樀焀匀攀氀攀挀琀漀爀⠀昀椀攀氀搀⸀愀琀琀爀⠀✀椀搀✀⤀⤀ ⬀ 漀瀀琀椀漀渀猀⸀甀猀攀匀甀昀昀椀砀⤀㬀 
						else {਀ 
							//Check if we need to adjust what element to show the prompt on਀ऀऀऀऀऀऀऀ⼀⼀愀渀搀 愀渀搀 猀甀挀栀 猀挀爀漀氀氀 琀漀 椀渀猀琀攀愀搀 
							if(field.data('jqv-prompt-at') instanceof jQuery ){਀ऀऀऀऀऀऀऀऀ昀椀攀氀搀 㴀 昀椀攀氀搀⸀搀愀琀愀⠀✀樀焀瘀ⴀ瀀爀漀洀瀀琀ⴀ愀琀✀⤀㬀 
							} else if(field.data('jqv-prompt-at')) {਀ऀऀऀऀऀऀऀऀ昀椀攀氀搀 㴀 ␀⠀昀椀攀氀搀⸀搀愀琀愀⠀✀樀焀瘀ⴀ瀀爀漀洀瀀琀ⴀ愀琀✀⤀⤀㬀 
							}਀ऀऀऀऀऀऀऀ昀椀爀猀琀开攀爀爀㴀昀椀攀氀搀㬀 
						}਀ऀऀऀऀऀ椀昀 ⠀漀瀀琀椀漀渀猀⸀搀漀一漀琀匀栀漀眀䄀氀氀䔀爀爀漀猀伀渀匀甀戀洀椀琀⤀ 
						return false;਀ऀऀऀऀऀ渀愀洀攀猀⸀瀀甀猀栀⠀昀椀攀氀搀⸀愀琀琀爀⠀✀渀愀洀攀✀⤀⤀㬀 
਀ऀऀऀऀऀ⼀⼀椀昀 漀瀀琀椀漀渀 猀攀琀Ⰰ 猀琀漀瀀 挀栀攀挀欀椀渀最 瘀愀氀椀搀愀琀椀漀渀 爀甀氀攀猀 愀昀琀攀爀 漀渀攀 攀爀爀漀爀 椀猀 昀漀甀渀搀 
					if(options.showOneMessage == true && errorFound){਀ऀऀऀऀऀऀ爀攀琀甀爀渀 昀愀氀猀攀㬀 
					}਀ऀऀऀऀ紀 
			});਀ 
			// second, check to see if all ajax calls completed ok਀ऀऀऀ⼀⼀ 攀爀爀漀爀䘀漀甀渀搀 簀㴀 ℀洀攀琀栀漀搀猀⸀开挀栀攀挀欀䄀樀愀砀匀琀愀琀甀猀⠀漀瀀琀椀漀渀猀⤀㬀 
਀ऀऀऀ⼀⼀ 琀栀椀爀搀Ⰰ 挀栀攀挀欀 猀琀愀琀甀猀 愀渀搀 猀挀爀漀氀氀 琀栀攀 挀漀渀琀愀椀渀攀爀 愀挀挀漀爀搀椀渀最氀礀 
			form.trigger("jqv.form.result", [errorFound]);਀ 
			if (errorFound) {਀ऀऀऀऀ椀昀 ⠀漀瀀琀椀漀渀猀⸀猀挀爀漀氀氀⤀ 笀 
					var destination=first_err.offset().top;਀ऀऀऀऀऀ瘀愀爀 昀椀砀氀攀昀琀 㴀 昀椀爀猀琀开攀爀爀⸀漀昀昀猀攀琀⠀⤀⸀氀攀昀琀㬀 
਀ऀऀऀऀऀ⼀⼀瀀爀漀洀瀀琀 瀀漀猀椀琀椀漀渀椀渀最 愀搀樀甀猀琀洀攀渀琀 猀甀瀀瀀漀爀琀⸀ 唀猀愀最攀㨀 瀀漀猀椀琀椀漀渀吀礀瀀攀㨀堀猀栀椀昀琀Ⰰ夀猀栀椀昀琀 ⠀昀漀爀 攀砀⸀㨀 戀漀琀琀漀洀䰀攀昀琀㨀⬀㈀　 漀爀 戀漀琀琀漀洀䰀攀昀琀㨀ⴀ㈀　Ⰰ⬀㄀　⤀ 
					var positionType=options.promptPosition;਀ऀऀऀऀऀ椀昀 ⠀琀礀瀀攀漀昀⠀瀀漀猀椀琀椀漀渀吀礀瀀攀⤀㴀㴀✀猀琀爀椀渀最✀ ☀☀ 瀀漀猀椀琀椀漀渀吀礀瀀攀⸀椀渀搀攀砀伀昀⠀∀㨀∀⤀℀㴀ⴀ㄀⤀ 
						positionType=positionType.substring(0,positionType.indexOf(":"));਀ 
					if (positionType!="bottomRight" && positionType!="bottomLeft") {਀ऀऀऀऀऀऀ瘀愀爀 瀀爀漀洀瀀琀开攀爀爀㴀 洀攀琀栀漀搀猀⸀开最攀琀倀爀漀洀瀀琀⠀昀椀爀猀琀开攀爀爀⤀㬀 
						if (prompt_err) {਀ऀऀऀऀऀऀऀ搀攀猀琀椀渀愀琀椀漀渀㴀瀀爀漀洀瀀琀开攀爀爀⸀漀昀昀猀攀琀⠀⤀⸀琀漀瀀㬀 
						}਀ऀऀऀऀऀ紀 
					਀ऀऀऀऀऀ⼀⼀ 伀昀昀猀攀琀 琀栀攀 愀洀漀甀渀琀 琀栀攀 瀀愀最攀 猀挀爀漀氀氀猀 戀礀 愀渀 愀洀漀甀渀琀 椀渀 瀀砀 琀漀 愀挀挀漀洀漀搀愀琀攀 昀椀砀攀搀 攀氀攀洀攀渀琀猀 愀琀 琀漀瀀 漀昀 瀀愀最攀 
					if (options.scrollOffset) {਀ऀऀऀऀऀऀ搀攀猀琀椀渀愀琀椀漀渀 ⴀ㴀 漀瀀琀椀漀渀猀⸀猀挀爀漀氀氀伀昀昀猀攀琀㬀 
					}਀ 
					// get the position of the first error, there should be at least one, no need to check this਀ऀऀऀऀऀ⼀⼀瘀愀爀 搀攀猀琀椀渀愀琀椀漀渀 㴀 昀漀爀洀⸀昀椀渀搀⠀∀⸀昀漀爀洀䔀爀爀漀爀㨀渀漀琀⠀✀⸀最爀攀攀渀倀漀瀀甀瀀✀⤀㨀昀椀爀猀琀∀⤀⸀漀昀昀猀攀琀⠀⤀⸀琀漀瀀㬀 
					if (options.isOverflown) {਀ऀऀऀऀऀऀ瘀愀爀 漀瘀攀爀昀氀漀眀䐀䤀嘀 㴀 ␀⠀漀瀀琀椀漀渀猀⸀漀瘀攀爀昀氀漀眀渀䐀䤀嘀⤀㬀 
						if(!overflowDIV.length) return false;਀ऀऀऀऀऀऀ瘀愀爀 猀挀爀漀氀氀䌀漀渀琀愀椀渀攀爀匀挀爀漀氀氀 㴀 漀瘀攀爀昀氀漀眀䐀䤀嘀⸀猀挀爀漀氀氀吀漀瀀⠀⤀㬀 
						var scrollContainerPos = -parseInt(overflowDIV.offset().top);਀ 
						destination += scrollContainerScroll + scrollContainerPos - 5;਀ऀऀऀऀऀऀ瘀愀爀 猀挀爀漀氀氀䌀漀渀琀愀椀渀攀爀 㴀 ␀⠀漀瀀琀椀漀渀猀⸀漀瘀攀爀昀氀漀眀渀䐀䤀嘀 ⬀ ∀㨀渀漀琀⠀㨀愀渀椀洀愀琀攀搀⤀∀⤀㬀 
਀ऀऀऀऀऀऀ猀挀爀漀氀氀䌀漀渀琀愀椀渀攀爀⸀愀渀椀洀愀琀攀⠀笀 猀挀爀漀氀氀吀漀瀀㨀 搀攀猀琀椀渀愀琀椀漀渀 紀Ⰰ ㄀㄀　　Ⰰ 昀甀渀挀琀椀漀渀⠀⤀笀 
							if(options.focusFirstField) first_err.focus();਀ऀऀऀऀऀऀ紀⤀㬀 
਀ऀऀऀऀऀ紀 攀氀猀攀 笀 
						$("html, body").animate({਀ऀऀऀऀऀऀऀ猀挀爀漀氀氀吀漀瀀㨀 搀攀猀琀椀渀愀琀椀漀渀 
						}, 1100, function(){਀ऀऀऀऀऀऀऀ椀昀⠀漀瀀琀椀漀渀猀⸀昀漀挀甀猀䘀椀爀猀琀䘀椀攀氀搀⤀ 昀椀爀猀琀开攀爀爀⸀昀漀挀甀猀⠀⤀㬀 
						});਀ऀऀऀऀऀऀ␀⠀∀栀琀洀氀Ⰰ 戀漀搀礀∀⤀⸀愀渀椀洀愀琀攀⠀笀猀挀爀漀氀氀䰀攀昀琀㨀 昀椀砀氀攀昀琀紀Ⰰ㄀㄀　　⤀ 
					}਀ 
				} else if(options.focusFirstField)਀ऀऀऀऀऀ昀椀爀猀琀开攀爀爀⸀昀漀挀甀猀⠀⤀㬀 
				return false;਀ऀऀऀ紀 
			return true;਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 吀栀椀猀 洀攀琀栀漀搀 椀猀 挀愀氀氀攀搀 琀漀 瀀攀爀昀漀爀洀 愀渀 愀樀愀砀 昀漀爀洀 瘀愀氀椀搀愀琀椀漀渀⸀ 
		* During this process all the (field, value) pairs are sent to the server which returns a list of invalid fields or true਀ऀऀ⨀ 
		* @param {jqObject} form਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䴀愀瀀紀 漀瀀琀椀漀渀猀 
		*/਀ऀऀ开瘀愀氀椀搀愀琀攀䘀漀爀洀圀椀琀栀䄀樀愀砀㨀 昀甀渀挀琀椀漀渀⠀昀漀爀洀Ⰰ 漀瀀琀椀漀渀猀⤀ 笀 
਀ऀऀऀ瘀愀爀 搀愀琀愀 㴀 昀漀爀洀⸀猀攀爀椀愀氀椀稀攀⠀⤀㬀 
									var type = (options.ajaxFormValidationMethod) ? options.ajaxFormValidationMethod : "GET";਀ऀऀऀ瘀愀爀 甀爀氀 㴀 ⠀漀瀀琀椀漀渀猀⸀愀樀愀砀䘀漀爀洀嘀愀氀椀搀愀琀椀漀渀唀刀䰀⤀ 㼀 漀瀀琀椀漀渀猀⸀愀樀愀砀䘀漀爀洀嘀愀氀椀搀愀琀椀漀渀唀刀䰀 㨀 昀漀爀洀⸀愀琀琀爀⠀∀愀挀琀椀漀渀∀⤀㬀 
									var dataType = (options.dataType) ? options.dataType : "json";਀ऀऀऀ␀⸀愀樀愀砀⠀笀 
				type: type,਀ऀऀऀऀ甀爀氀㨀 甀爀氀Ⰰ 
				cache: false,਀ऀऀऀऀ搀愀琀愀吀礀瀀攀㨀 搀愀琀愀吀礀瀀攀Ⰰ 
				data: data,਀ऀऀऀऀ昀漀爀洀㨀 昀漀爀洀Ⰰ 
				methods: methods,਀ऀऀऀऀ漀瀀琀椀漀渀猀㨀 漀瀀琀椀漀渀猀Ⰰ 
				beforeSend: function() {਀ऀऀऀऀऀ爀攀琀甀爀渀 漀瀀琀椀漀渀猀⸀漀渀䈀攀昀漀爀攀䄀樀愀砀䘀漀爀洀嘀愀氀椀搀愀琀椀漀渀⠀昀漀爀洀Ⰰ 漀瀀琀椀漀渀猀⤀㬀 
				},਀ऀऀऀऀ攀爀爀漀爀㨀 昀甀渀挀琀椀漀渀⠀搀愀琀愀Ⰰ 琀爀愀渀猀瀀漀爀琀⤀ 笀 
					if (options.onFailure) {਀ऀऀऀऀऀऀ漀瀀琀椀漀渀猀⸀漀渀䘀愀椀氀甀爀攀⠀搀愀琀愀Ⰰ 琀爀愀渀猀瀀漀爀琀⤀㬀 
					} else {਀ऀऀऀऀऀऀ洀攀琀栀漀搀猀⸀开愀樀愀砀䔀爀爀漀爀⠀搀愀琀愀Ⰰ 琀爀愀渀猀瀀漀爀琀⤀㬀 
					}਀ऀऀऀऀ紀Ⰰ 
				success: function(json) {਀ऀऀऀऀऀ椀昀 ⠀⠀搀愀琀愀吀礀瀀攀 㴀㴀 ∀樀猀漀渀∀⤀ ☀☀ ⠀樀猀漀渀 ℀㴀㴀 琀爀甀攀⤀⤀ 笀 
						// getting to this case doesn't necessary means that the form is invalid਀ऀऀऀऀऀऀ⼀⼀ 琀栀攀 猀攀爀瘀攀爀 洀愀礀 爀攀琀甀爀渀 最爀攀攀渀 漀爀 挀氀漀猀椀渀最 瀀爀漀洀瀀琀 愀挀琀椀漀渀猀 
						// this flag helps figuring it out਀ऀऀऀऀऀऀ瘀愀爀 攀爀爀漀爀䤀渀䘀漀爀洀㴀昀愀氀猀攀㬀 
						for (var i = 0; i < json.length; i++) {਀ऀऀऀऀऀऀऀ瘀愀爀 瘀愀氀甀攀 㴀 樀猀漀渀嬀椀崀㬀 
਀ऀऀऀऀऀऀऀ瘀愀爀 攀爀爀漀爀䘀椀攀氀搀䤀搀 㴀 瘀愀氀甀攀嬀　崀㬀 
							var errorField = $($("#" + errorFieldId)[0]);਀ 
							// make sure we found the element਀ऀऀऀऀऀऀऀ椀昀 ⠀攀爀爀漀爀䘀椀攀氀搀⸀氀攀渀最琀栀 㴀㴀 ㄀⤀ 笀 
਀ऀऀऀऀऀऀऀऀ⼀⼀ 瀀爀漀洀瀀琀吀攀砀琀 漀爀 猀攀氀攀挀琀漀爀 
								var msg = value[2];਀ऀऀऀऀऀऀऀऀ⼀⼀ 椀昀 琀栀攀 昀椀攀氀搀 椀猀 瘀愀氀椀搀 
								if (value[1] == true) {਀ 
									if (msg == ""  || !msg){਀ऀऀऀऀऀऀऀऀऀऀ⼀⼀ 椀昀 昀漀爀 猀漀洀攀 爀攀愀猀漀渀Ⰰ 猀琀愀琀甀猀㴀㴀琀爀甀攀 愀渀搀 攀爀爀漀爀㴀∀∀Ⰰ 樀甀猀琀 挀氀漀猀攀 琀栀攀 瀀爀漀洀瀀琀 
										methods._closePrompt(errorField);਀ऀऀऀऀऀऀऀऀऀ紀 攀氀猀攀 笀 
										// the field is valid, but we are displaying a green prompt਀ऀऀऀऀऀऀऀऀऀऀ椀昀 ⠀漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀嬀洀猀最崀⤀ 笀 
											var txt = options.allrules[msg].alertTextOk;਀ऀऀऀऀऀऀऀऀऀऀऀ椀昀 ⠀琀砀琀⤀ 
												msg = txt;਀ऀऀऀऀऀऀऀऀऀऀ紀 
										if (options.showPrompts) methods._showPrompt(errorField, msg, "pass", false, options, true);਀ऀऀऀऀऀऀऀऀऀ紀 
								} else {਀ऀऀऀऀऀऀऀऀऀ⼀⼀ 琀栀攀 昀椀攀氀搀 椀猀 椀渀瘀愀氀椀搀Ⰰ 猀栀漀眀 琀栀攀 爀攀搀 攀爀爀漀爀 瀀爀漀洀瀀琀 
									errorInForm|=true;਀ऀऀऀऀऀऀऀऀऀ椀昀 ⠀漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀嬀洀猀最崀⤀ 笀 
										var txt = options.allrules[msg].alertText;਀ऀऀऀऀऀऀऀऀऀऀ椀昀 ⠀琀砀琀⤀ 
											msg = txt;਀ऀऀऀऀऀऀऀऀऀ紀 
									if(options.showPrompts) methods._showPrompt(errorField, msg, "", false, options, true);਀ऀऀऀऀऀऀऀऀ紀 
							}਀ऀऀऀऀऀऀ紀 
						options.onAjaxFormComplete(!errorInForm, form, json, options);਀ऀऀऀऀऀ紀 攀氀猀攀 
						options.onAjaxFormComplete(true, form, json, options);਀ 
				}਀ऀऀऀ紀⤀㬀 
਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 嘀愀氀椀搀愀琀攀猀 昀椀攀氀搀Ⰰ 猀栀漀眀猀 瀀爀漀洀瀀琀猀 愀挀挀漀爀搀椀渀最氀礀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 
		*            field਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䄀爀爀愀礀嬀匀琀爀椀渀最崀紀 
		*            field's validation rules਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䴀愀瀀紀 
		*            user options਀ऀऀ⨀ 䀀爀攀琀甀爀渀 昀愀氀猀攀 椀昀 昀椀攀氀搀 椀猀 瘀愀氀椀搀 ⠀䤀琀 椀猀 椀渀瘀攀爀猀攀搀 昀漀爀 ⨀昀椀攀氀搀猀⨀Ⰰ 椀琀 爀攀琀甀爀渀 昀愀氀猀攀 漀渀 瘀愀氀椀搀愀琀攀 愀渀搀 琀爀甀攀 漀渀 攀爀爀漀爀猀⸀⤀ 
		*/਀ऀऀ开瘀愀氀椀搀愀琀攀䘀椀攀氀搀㨀 昀甀渀挀琀椀漀渀⠀昀椀攀氀搀Ⰰ 漀瀀琀椀漀渀猀Ⰰ 猀欀椀瀀䄀樀愀砀嘀愀氀椀搀愀琀椀漀渀⤀ 笀 
			if (!field.attr("id")) {਀ऀऀऀऀ昀椀攀氀搀⸀愀琀琀爀⠀∀椀搀∀Ⰰ ∀昀漀爀洀ⴀ瘀愀氀椀搀愀琀椀漀渀ⴀ昀椀攀氀搀ⴀ∀ ⬀ ␀⸀瘀愀氀椀搀愀琀椀漀渀䔀渀最椀渀攀⸀昀椀攀氀搀䤀搀䌀漀甀渀琀攀爀⤀㬀 
				++$.validationEngine.fieldIdCounter;਀ऀऀऀ紀 
਀           椀昀 ⠀℀漀瀀琀椀漀渀猀⸀瘀愀氀椀搀愀琀攀一漀渀嘀椀猀椀戀氀攀䘀椀攀氀搀猀 ☀☀ ⠀昀椀攀氀搀⸀椀猀⠀∀㨀栀椀搀搀攀渀∀⤀ ☀☀ ℀漀瀀琀椀漀渀猀⸀瀀爀攀琀琀礀匀攀氀攀挀琀 簀簀 昀椀攀氀搀⸀瀀愀爀攀渀琀⠀⤀⸀椀猀⠀∀㨀栀椀搀搀攀渀∀⤀⤀⤀ 
				return false;਀ 
			var rulesParsing = field.attr(options.validateAttribute);਀ऀऀऀ瘀愀爀 最攀琀刀甀氀攀猀 㴀 ⼀瘀愀氀椀搀愀琀攀尀嬀⠀⸀⨀⤀尀崀⼀⸀攀砀攀挀⠀爀甀氀攀猀倀愀爀猀椀渀最⤀㬀 
਀ऀऀऀ椀昀 ⠀℀最攀琀刀甀氀攀猀⤀ 
				return false;਀ऀऀऀ瘀愀爀 猀琀爀 㴀 最攀琀刀甀氀攀猀嬀㄀崀㬀 
			var rules = str.split(/\[|,|\]/);਀ 
			// true if we ran the ajax validation, tells the logic to stop messing with prompts਀ऀऀऀ瘀愀爀 椀猀䄀樀愀砀嘀愀氀椀搀愀琀漀爀 㴀 昀愀氀猀攀㬀 
			var fieldName = field.attr("name");਀ऀऀऀ瘀愀爀 瀀爀漀洀瀀琀吀攀砀琀 㴀 ∀∀㬀 
			var promptType = "";਀ऀऀऀ瘀愀爀 爀攀焀甀椀爀攀搀 㴀 昀愀氀猀攀㬀 
			var limitErrors = false;਀ऀऀऀ漀瀀琀椀漀渀猀⸀椀猀䔀爀爀漀爀 㴀 昀愀氀猀攀㬀 
			options.showArrow = true;਀ऀऀऀ 
			// If the programmer wants to limit the amount of error messages per field,਀ऀऀऀ椀昀 ⠀漀瀀琀椀漀渀猀⸀洀愀砀䔀爀爀漀爀猀倀攀爀䘀椀攀氀搀 㸀 　⤀ 笀 
				limitErrors = true;਀ऀऀऀ紀 
਀ऀऀऀ瘀愀爀 昀漀爀洀 㴀 ␀⠀昀椀攀氀搀⸀挀氀漀猀攀猀琀⠀∀昀漀爀洀Ⰰ ⸀瘀愀氀椀搀愀琀椀漀渀䔀渀最椀渀攀䌀漀渀琀愀椀渀攀爀∀⤀⤀㬀 
			// Fix for adding spaces in the rules਀ऀऀऀ昀漀爀 ⠀瘀愀爀 椀 㴀 　㬀 椀 㰀 爀甀氀攀猀⸀氀攀渀最琀栀㬀 椀⬀⬀⤀ 笀 
				rules[i] = rules[i].replace(" ", "");਀ऀऀऀऀ⼀⼀ 刀攀洀漀瘀攀 愀渀礀 瀀愀爀猀椀渀最 攀爀爀漀爀猀 
				if (rules[i] === '') {਀ऀऀऀऀऀ搀攀氀攀琀攀 爀甀氀攀猀嬀椀崀㬀 
				}਀ऀऀऀ紀 
਀ऀऀऀ昀漀爀 ⠀瘀愀爀 椀 㴀 　Ⰰ 昀椀攀氀搀开攀爀爀漀爀猀 㴀 　㬀 椀 㰀 爀甀氀攀猀⸀氀攀渀最琀栀㬀 椀⬀⬀⤀ 笀 
				਀ऀऀऀऀ⼀⼀ 䤀昀 眀攀 愀爀攀 氀椀洀椀琀椀渀最 攀爀爀漀爀猀Ⰰ 愀渀搀 栀愀瘀攀 栀椀琀 琀栀攀 洀愀砀Ⰰ 戀爀攀愀欀 
				if (limitErrors && field_errors >= options.maxErrorsPerField) {਀ऀऀऀऀऀ⼀⼀ 䤀昀 眀攀 栀愀瘀攀渀✀琀 栀椀琀 愀 爀攀焀甀椀爀攀搀 礀攀琀Ⰰ 挀栀攀挀欀 琀漀 猀攀攀 椀昀 琀栀攀爀攀 椀猀 漀渀攀 椀渀 琀栀攀 瘀愀氀椀搀愀琀椀漀渀 爀甀氀攀猀 昀漀爀 琀栀椀猀 
					// field and that it's index is greater or equal to our current index਀ऀऀऀऀऀ椀昀 ⠀℀爀攀焀甀椀爀攀搀⤀ 笀 
						var have_required = $.inArray('required', rules);਀ऀऀऀऀऀऀ爀攀焀甀椀爀攀搀 㴀 ⠀栀愀瘀攀开爀攀焀甀椀爀攀搀 ℀㴀 ⴀ㄀ ☀☀  栀愀瘀攀开爀攀焀甀椀爀攀搀 㸀㴀 椀⤀㬀 
					}਀ऀऀऀऀऀ戀爀攀愀欀㬀 
				}਀ऀऀऀऀ 
				਀ऀऀऀऀ瘀愀爀 攀爀爀漀爀䴀猀最 㴀 甀渀搀攀昀椀渀攀搀㬀 
				switch (rules[i]) {਀ 
					case "required":਀ऀऀऀऀऀऀ爀攀焀甀椀爀攀搀 㴀 琀爀甀攀㬀 
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._required);਀ऀऀऀऀऀऀ戀爀攀愀欀㬀 
					case "custom":਀ऀऀऀऀऀऀ攀爀爀漀爀䴀猀最 㴀 洀攀琀栀漀搀猀⸀开最攀琀䔀爀爀漀爀䴀攀猀猀愀最攀⠀昀漀爀洀Ⰰ 昀椀攀氀搀Ⰰ 爀甀氀攀猀嬀椀崀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀Ⰰ 洀攀琀栀漀搀猀⸀开挀甀猀琀漀洀⤀㬀 
						break;਀ऀऀऀऀऀ挀愀猀攀 ∀最爀漀甀瀀刀攀焀甀椀爀攀搀∀㨀 
						// Check is its the first of group, if not, reload validation with first field਀ऀऀऀऀऀऀ⼀⼀ 䄀一䐀 挀漀渀琀椀渀甀攀 渀漀爀洀愀氀 瘀愀氀椀搀愀琀椀漀渀 漀渀 瀀爀攀猀攀渀琀 昀椀攀氀搀 
						var classGroup = "["+options.validateAttribute+"*=" +rules[i + 1] +"]";਀ऀऀऀऀऀऀ瘀愀爀 昀椀爀猀琀伀昀䜀爀漀甀瀀 㴀 昀漀爀洀⸀昀椀渀搀⠀挀氀愀猀猀䜀爀漀甀瀀⤀⸀攀焀⠀　⤀㬀 
						if(firstOfGroup[0] != field[0]){਀ 
							methods._validateField(firstOfGroup, options, skipAjaxValidation); ਀ऀऀऀऀऀऀऀ漀瀀琀椀漀渀猀⸀猀栀漀眀䄀爀爀漀眀 㴀 琀爀甀攀㬀 
਀ऀऀऀऀऀऀ紀 
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._groupRequired);਀ऀऀऀऀऀऀ椀昀⠀攀爀爀漀爀䴀猀最⤀  爀攀焀甀椀爀攀搀 㴀 琀爀甀攀㬀 
						options.showArrow = false;਀ऀऀऀऀऀऀ戀爀攀愀欀㬀 
					case "ajax":਀ऀऀऀऀऀऀ⼀⼀ 䄀䨀䄀堀 搀攀昀愀甀氀琀猀 琀漀 爀攀琀甀爀渀椀渀最 椀琀✀猀 氀漀愀搀椀渀最 洀攀猀猀愀最攀 
						errorMsg = methods._ajax(field, rules, i, options);਀ऀऀऀऀऀऀ椀昀 ⠀攀爀爀漀爀䴀猀最⤀ 笀 
							promptType = "load";਀ऀऀऀऀऀऀ紀 
						break;਀ऀऀऀऀऀ挀愀猀攀 ∀洀椀渀匀椀稀攀∀㨀 
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._minSize);਀ऀऀऀऀऀऀ戀爀攀愀欀㬀 
					case "maxSize":਀ऀऀऀऀऀऀ攀爀爀漀爀䴀猀最 㴀 洀攀琀栀漀搀猀⸀开最攀琀䔀爀爀漀爀䴀攀猀猀愀最攀⠀昀漀爀洀Ⰰ 昀椀攀氀搀Ⰰ 爀甀氀攀猀嬀椀崀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀Ⰰ 洀攀琀栀漀搀猀⸀开洀愀砀匀椀稀攀⤀㬀 
						break;਀ऀऀऀऀऀ挀愀猀攀 ∀洀椀渀∀㨀 
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._min);਀ऀऀऀऀऀऀ戀爀攀愀欀㬀 
					case "max":਀ऀऀऀऀऀऀ攀爀爀漀爀䴀猀最 㴀 洀攀琀栀漀搀猀⸀开最攀琀䔀爀爀漀爀䴀攀猀猀愀最攀⠀昀漀爀洀Ⰰ 昀椀攀氀搀Ⰰ 爀甀氀攀猀嬀椀崀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀Ⰰ 洀攀琀栀漀搀猀⸀开洀愀砀⤀㬀 
						break;਀ऀऀऀऀऀ挀愀猀攀 ∀瀀愀猀琀∀㨀 
						errorMsg = methods._getErrorMessage(form, field,rules[i], rules, i, options, methods._past);਀ऀऀऀऀऀऀ戀爀攀愀欀㬀 
					case "future":਀ऀऀऀऀऀऀ攀爀爀漀爀䴀猀最 㴀 洀攀琀栀漀搀猀⸀开最攀琀䔀爀爀漀爀䴀攀猀猀愀最攀⠀昀漀爀洀Ⰰ 昀椀攀氀搀Ⰰ爀甀氀攀猀嬀椀崀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀Ⰰ 洀攀琀栀漀搀猀⸀开昀甀琀甀爀攀⤀㬀 
						break;਀ऀऀऀऀऀ挀愀猀攀 ∀搀愀琀攀刀愀渀最攀∀㨀 
						var classGroup = "["+options.validateAttribute+"*=" + rules[i + 1] + "]";਀ऀऀऀऀऀऀ漀瀀琀椀漀渀猀⸀昀椀爀猀琀伀昀䜀爀漀甀瀀 㴀 昀漀爀洀⸀昀椀渀搀⠀挀氀愀猀猀䜀爀漀甀瀀⤀⸀攀焀⠀　⤀㬀 
						options.secondOfGroup = form.find(classGroup).eq(1);਀ 
						//if one entry out of the pair has value then proceed to run through validation਀ऀऀऀऀऀऀ椀昀 ⠀漀瀀琀椀漀渀猀⸀昀椀爀猀琀伀昀䜀爀漀甀瀀嬀　崀⸀瘀愀氀甀攀 簀簀 漀瀀琀椀漀渀猀⸀猀攀挀漀渀搀伀昀䜀爀漀甀瀀嬀　崀⸀瘀愀氀甀攀⤀ 笀 
							errorMsg = methods._getErrorMessage(form, field,rules[i], rules, i, options, methods._dateRange);਀ऀऀऀऀऀऀ紀 
						if (errorMsg) required = true;਀ऀऀऀऀऀऀ漀瀀琀椀漀渀猀⸀猀栀漀眀䄀爀爀漀眀 㴀 昀愀氀猀攀㬀 
						break;਀ 
					case "dateTimeRange":਀ऀऀऀऀऀऀ瘀愀爀 挀氀愀猀猀䜀爀漀甀瀀 㴀 ∀嬀∀⬀漀瀀琀椀漀渀猀⸀瘀愀氀椀搀愀琀攀䄀琀琀爀椀戀甀琀攀⬀∀⨀㴀∀ ⬀ 爀甀氀攀猀嬀椀 ⬀ ㄀崀 ⬀ ∀崀∀㬀 
						options.firstOfGroup = form.find(classGroup).eq(0);਀ऀऀऀऀऀऀ漀瀀琀椀漀渀猀⸀猀攀挀漀渀搀伀昀䜀爀漀甀瀀 㴀 昀漀爀洀⸀昀椀渀搀⠀挀氀愀猀猀䜀爀漀甀瀀⤀⸀攀焀⠀㄀⤀㬀 
਀ऀऀऀऀऀऀ⼀⼀椀昀 漀渀攀 攀渀琀爀礀 漀甀琀 漀昀 琀栀攀 瀀愀椀爀 栀愀猀 瘀愀氀甀攀 琀栀攀渀 瀀爀漀挀攀攀搀 琀漀 爀甀渀 琀栀爀漀甀最栀 瘀愀氀椀搀愀琀椀漀渀 
						if (options.firstOfGroup[0].value || options.secondOfGroup[0].value) {਀ऀऀऀऀऀऀऀ攀爀爀漀爀䴀猀最 㴀 洀攀琀栀漀搀猀⸀开最攀琀䔀爀爀漀爀䴀攀猀猀愀最攀⠀昀漀爀洀Ⰰ 昀椀攀氀搀Ⰰ爀甀氀攀猀嬀椀崀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀Ⰰ 洀攀琀栀漀搀猀⸀开搀愀琀攀吀椀洀攀刀愀渀最攀⤀㬀 
						}਀ऀऀऀऀऀऀ椀昀 ⠀攀爀爀漀爀䴀猀最⤀ 爀攀焀甀椀爀攀搀 㴀 琀爀甀攀㬀 
						options.showArrow = false;਀ऀऀऀऀऀऀ戀爀攀愀欀㬀 
					case "maxCheckbox":਀ऀऀऀऀऀऀ昀椀攀氀搀 㴀 ␀⠀昀漀爀洀⸀昀椀渀搀⠀∀椀渀瀀甀琀嬀渀愀洀攀㴀✀∀ ⬀ 昀椀攀氀搀一愀洀攀 ⬀ ∀✀崀∀⤀⤀㬀 
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._maxCheckbox);਀ऀऀऀऀऀऀ戀爀攀愀欀㬀 
					case "minCheckbox":਀ऀऀऀऀऀऀ昀椀攀氀搀 㴀 ␀⠀昀漀爀洀⸀昀椀渀搀⠀∀椀渀瀀甀琀嬀渀愀洀攀㴀✀∀ ⬀ 昀椀攀氀搀一愀洀攀 ⬀ ∀✀崀∀⤀⤀㬀 
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._minCheckbox);਀ऀऀऀऀऀऀ戀爀攀愀欀㬀 
					case "equals":਀ऀऀऀऀऀऀ攀爀爀漀爀䴀猀最 㴀 洀攀琀栀漀搀猀⸀开最攀琀䔀爀爀漀爀䴀攀猀猀愀最攀⠀昀漀爀洀Ⰰ 昀椀攀氀搀Ⰰ 爀甀氀攀猀嬀椀崀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀Ⰰ 洀攀琀栀漀搀猀⸀开攀焀甀愀氀猀⤀㬀 
						break;਀ऀऀऀऀऀ挀愀猀攀 ∀昀甀渀挀䌀愀氀氀∀㨀 
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._funcCall);਀ऀऀऀऀऀऀ戀爀攀愀欀㬀 
					case "creditCard":਀ऀऀऀऀऀऀ攀爀爀漀爀䴀猀最 㴀 洀攀琀栀漀搀猀⸀开最攀琀䔀爀爀漀爀䴀攀猀猀愀最攀⠀昀漀爀洀Ⰰ 昀椀攀氀搀Ⰰ 爀甀氀攀猀嬀椀崀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀Ⰰ 洀攀琀栀漀搀猀⸀开挀爀攀搀椀琀䌀愀爀搀⤀㬀 
						break;਀ऀऀऀऀऀ挀愀猀攀 ∀挀漀渀搀刀攀焀甀椀爀攀搀∀㨀 
						errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._condRequired);਀ऀऀऀऀऀऀ椀昀 ⠀攀爀爀漀爀䴀猀最 ℀㴀㴀 甀渀搀攀昀椀渀攀搀⤀ 笀 
							required = true;਀ऀऀऀऀऀऀ紀 
						break;਀ 
					default:਀ऀऀऀऀ紀 
				਀ऀऀऀऀ瘀愀爀 攀渀搀开瘀愀氀椀搀愀琀椀漀渀 㴀 昀愀氀猀攀㬀 
				਀ऀऀऀऀ⼀⼀ 䤀昀 眀攀 眀攀爀攀 瀀愀猀猀攀搀 戀愀挀欀 愀渀 洀攀猀猀愀最攀 漀戀樀攀挀琀Ⰰ 挀栀攀挀欀 眀栀愀琀 琀栀攀 猀琀愀琀甀猀 眀愀猀 琀漀 搀攀琀攀爀洀椀渀攀 眀栀愀琀 琀漀 搀漀 
				if (typeof errorMsg == "object") {਀ऀऀऀऀऀ猀眀椀琀挀栀 ⠀攀爀爀漀爀䴀猀最⸀猀琀愀琀甀猀⤀ 笀 
						case "_break":਀ऀऀऀऀऀऀऀ攀渀搀开瘀愀氀椀搀愀琀椀漀渀 㴀 琀爀甀攀㬀 
							break;਀ऀऀऀऀऀऀ⼀⼀ 䤀昀 眀攀 栀愀瘀攀 愀渀 攀爀爀漀爀 洀攀猀猀愀最攀Ⰰ 猀攀琀 攀爀爀漀爀䴀猀最 琀漀 琀栀攀 攀爀爀漀爀 洀攀猀猀愀最攀 
						case "_error":਀ऀऀऀऀऀऀऀ攀爀爀漀爀䴀猀最 㴀 攀爀爀漀爀䴀猀最⸀洀攀猀猀愀最攀㬀 
							break;਀ऀऀऀऀऀऀ⼀⼀ 䤀昀 眀攀 眀愀渀琀 琀漀 琀栀爀漀眀 愀渀 攀爀爀漀爀Ⰰ 戀甀琀 渀漀琀 猀栀漀眀 愀 瀀爀漀洀瀀琀Ⰰ 爀攀琀甀爀渀 攀愀爀氀礀 眀椀琀栀 琀爀甀攀 
						case "_error_no_prompt":਀ऀऀऀऀऀऀऀ爀攀琀甀爀渀 琀爀甀攀㬀 
							break;਀ऀऀऀऀऀऀ⼀⼀ 䄀渀礀琀栀椀渀最 攀氀猀攀 眀攀 挀漀渀琀椀渀甀攀 漀渀 
						default:਀ऀऀऀऀऀऀऀ戀爀攀愀欀㬀 
					}਀ऀऀऀऀ紀 
				਀ऀऀऀऀ⼀⼀ 䤀昀 椀琀 栀愀猀 戀攀攀渀 猀瀀攀挀椀昀椀攀搀 琀栀愀琀 瘀愀氀椀搀愀琀椀漀渀 猀栀漀甀氀搀 攀渀搀 渀漀眀Ⰰ 戀爀攀愀欀 
				if (end_validation) {਀ऀऀऀऀऀ戀爀攀愀欀㬀 
				}਀ऀऀऀऀ 
				// If we have a string, that means that we have an error, so add it to the error message.਀ऀऀऀऀ椀昀 ⠀琀礀瀀攀漀昀 攀爀爀漀爀䴀猀最 㴀㴀 ✀猀琀爀椀渀最✀⤀ 笀 
					promptText += errorMsg + "<br/>";਀ऀऀऀऀऀ漀瀀琀椀漀渀猀⸀椀猀䔀爀爀漀爀 㴀 琀爀甀攀㬀 
					field_errors++;਀ऀऀऀऀ紀ऀ 
			}਀ऀऀऀ⼀⼀ 䤀昀 琀栀攀 爀甀氀攀猀 爀攀焀甀椀爀攀搀 椀猀 渀漀琀 愀搀搀攀搀Ⰰ 愀渀 攀洀瀀琀礀 昀椀攀氀搀 椀猀 渀漀琀 瘀愀氀椀搀愀琀攀搀 
			//the 3rd condition is added so that even empty password fields should be equal਀ऀऀऀ⼀⼀漀琀栀攀爀眀椀猀攀 椀昀 漀渀攀 椀猀 昀椀氀氀攀搀 愀渀搀 愀渀漀琀栀攀爀 氀攀昀琀 攀洀瀀琀礀Ⰰ 琀栀攀 ∀攀焀甀愀氀∀ 挀漀渀搀椀琀椀漀渀 眀漀甀氀搀 昀愀椀氀 
			//which does not make any sense਀ऀऀऀ椀昀⠀℀爀攀焀甀椀爀攀搀 ☀☀ ℀⠀昀椀攀氀搀⸀瘀愀氀⠀⤀⤀ ☀☀ 昀椀攀氀搀⸀瘀愀氀⠀⤀⸀氀攀渀最琀栀 㰀 ㄀ ☀☀ 爀甀氀攀猀⸀椀渀搀攀砀伀昀⠀∀攀焀甀愀氀猀∀⤀ 㰀 　⤀ 漀瀀琀椀漀渀猀⸀椀猀䔀爀爀漀爀 㴀 昀愀氀猀攀㬀 
਀ऀऀऀ⼀⼀ 䠀愀挀欀 昀漀爀 爀愀搀椀漀⼀挀栀攀挀欀戀漀砀 最爀漀甀瀀 戀甀琀琀漀渀Ⰰ 琀栀攀 瘀愀氀椀搀愀琀椀漀渀 最漀 椀渀琀漀 琀栀攀 
			// first radio/checkbox of the group਀ऀऀऀ瘀愀爀 昀椀攀氀搀吀礀瀀攀 㴀 昀椀攀氀搀⸀瀀爀漀瀀⠀∀琀礀瀀攀∀⤀㬀 
			var positionType=field.data("promptPosition") || options.promptPosition;਀ 
			if ((fieldType == "radio" || fieldType == "checkbox") && form.find("input[name='" + fieldName + "']").size() > 1) {਀ऀऀऀऀ椀昀⠀瀀漀猀椀琀椀漀渀吀礀瀀攀 㴀㴀㴀 ✀椀渀氀椀渀攀✀⤀ 笀 
					field = $(form.find("input[name='" + fieldName + "'][type!=hidden]:last"));਀ऀऀऀऀ紀 攀氀猀攀 笀 
				field = $(form.find("input[name='" + fieldName + "'][type!=hidden]:first"));਀ऀऀऀऀ紀 
				options.showArrow = false;਀ऀऀऀ紀 
਀ऀऀऀ椀昀⠀昀椀攀氀搀⸀椀猀⠀∀㨀栀椀搀搀攀渀∀⤀ ☀☀ 漀瀀琀椀漀渀猀⸀瀀爀攀琀琀礀匀攀氀攀挀琀⤀ 笀 
				field = form.find("#" + options.usePrefix + methods._jqSelector(field.attr('id')) + options.useSuffix);਀ऀऀऀ紀 
਀ऀऀऀ椀昀 ⠀漀瀀琀椀漀渀猀⸀椀猀䔀爀爀漀爀 ☀☀ 漀瀀琀椀漀渀猀⸀猀栀漀眀倀爀漀洀瀀琀猀⤀笀 
				methods._showPrompt(field, promptText, promptType, false, options);਀ऀऀऀ紀攀氀猀攀笀 
				if (!isAjaxValidator) methods._closePrompt(field);਀ऀऀऀ紀 
਀ऀऀऀ椀昀 ⠀℀椀猀䄀樀愀砀嘀愀氀椀搀愀琀漀爀⤀ 笀 
				field.trigger("jqv.field.result", [field, options.isError, promptText]);਀ऀऀऀ紀 
਀ऀऀऀ⼀⨀ 刀攀挀漀爀搀 攀爀爀漀爀 ⨀⼀ 
			var errindex = $.inArray(field[0], options.InvalidFields);਀ऀऀऀ椀昀 ⠀攀爀爀椀渀搀攀砀 㴀㴀 ⴀ㄀⤀ 笀 
				if (options.isError)਀ऀऀऀऀ漀瀀琀椀漀渀猀⸀䤀渀瘀愀氀椀搀䘀椀攀氀搀猀⸀瀀甀猀栀⠀昀椀攀氀搀嬀　崀⤀㬀 
			} else if (!options.isError) {਀ऀऀऀऀ漀瀀琀椀漀渀猀⸀䤀渀瘀愀氀椀搀䘀椀攀氀搀猀⸀猀瀀氀椀挀攀⠀攀爀爀椀渀搀攀砀Ⰰ ㄀⤀㬀 
			}਀ऀऀऀऀ 
			methods._handleStatusCssClasses(field, options);਀ऀ 
			/* run callback function for each field */਀ऀऀऀ椀昀 ⠀漀瀀琀椀漀渀猀⸀椀猀䔀爀爀漀爀 ☀☀ 漀瀀琀椀漀渀猀⸀漀渀䘀椀攀氀搀䘀愀椀氀甀爀攀⤀ 
				options.onFieldFailure(field);਀ 
			if (!options.isError && options.onFieldSuccess)਀ऀऀऀऀ漀瀀琀椀漀渀猀⸀漀渀䘀椀攀氀搀匀甀挀挀攀猀猀⠀昀椀攀氀搀⤀㬀 
਀ऀऀऀ爀攀琀甀爀渀 漀瀀琀椀漀渀猀⸀椀猀䔀爀爀漀爀㬀 
		},਀ऀऀ⼀⨀⨀ 
		* Handling css classes of fields indicating result of validation ਀ऀऀ⨀ 
		* @param {jqObject}਀ऀऀ⨀            昀椀攀氀搀 
		* @param {Array[String]}਀ऀऀ⨀            昀椀攀氀搀✀猀 瘀愀氀椀搀愀琀椀漀渀 爀甀氀攀猀             
		* @private਀ऀऀ⨀⼀ 
		_handleStatusCssClasses: function(field, options) {਀ऀऀऀ⼀⨀ 爀攀洀漀瘀攀 愀氀氀 挀氀愀猀猀攀猀 ⨀⼀ 
			if(options.addSuccessCssClassToField)਀ऀऀऀऀ昀椀攀氀搀⸀爀攀洀漀瘀攀䌀氀愀猀猀⠀漀瀀琀椀漀渀猀⸀愀搀搀匀甀挀挀攀猀猀䌀猀猀䌀氀愀猀猀吀漀䘀椀攀氀搀⤀㬀 
			਀ऀऀऀ椀昀⠀漀瀀琀椀漀渀猀⸀愀搀搀䘀愀椀氀甀爀攀䌀猀猀䌀氀愀猀猀吀漀䘀椀攀氀搀⤀ 
				field.removeClass(options.addFailureCssClassToField);਀ऀऀऀ 
			/* Add classes */਀ऀऀऀ椀昀 ⠀漀瀀琀椀漀渀猀⸀愀搀搀匀甀挀挀攀猀猀䌀猀猀䌀氀愀猀猀吀漀䘀椀攀氀搀 ☀☀ ℀漀瀀琀椀漀渀猀⸀椀猀䔀爀爀漀爀⤀ 
				field.addClass(options.addSuccessCssClassToField);਀ऀऀऀ 
			if (options.addFailureCssClassToField && options.isError)਀ऀऀऀऀ昀椀攀氀搀⸀愀搀搀䌀氀愀猀猀⠀漀瀀琀椀漀渀猀⸀愀搀搀䘀愀椀氀甀爀攀䌀猀猀䌀氀愀猀猀吀漀䘀椀攀氀搀⤀㬀ऀऀ 
		},਀ऀऀ 
		 /********************਀ऀऀ  ⨀ 开最攀琀䔀爀爀漀爀䴀攀猀猀愀最攀 
		  *਀ऀऀ  ⨀ 䀀瀀愀爀愀洀 昀漀爀洀 
		  * @param field਀ऀऀ  ⨀ 䀀瀀愀爀愀洀 爀甀氀攀 
		  * @param rules਀ऀऀ  ⨀ 䀀瀀愀爀愀洀 椀 
		  * @param options਀ऀऀ  ⨀ 䀀瀀愀爀愀洀 漀爀椀最椀渀愀氀嘀愀氀椀搀愀琀椀漀渀䴀攀琀栀漀搀 
		  * @return {*}਀ऀऀ  ⨀ 䀀瀀爀椀瘀愀琀攀 
		  */਀ऀऀ 开最攀琀䔀爀爀漀爀䴀攀猀猀愀最攀㨀昀甀渀挀琀椀漀渀 ⠀昀漀爀洀Ⰰ 昀椀攀氀搀Ⰰ 爀甀氀攀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀Ⰰ 漀爀椀最椀渀愀氀嘀愀氀椀搀愀琀椀漀渀䴀攀琀栀漀搀⤀ 笀 
			 // If we are using the custon validation type, build the index for the rule.਀ऀऀऀ ⼀⼀ 伀琀栀攀爀眀椀猀攀 椀昀 眀攀 愀爀攀 搀漀椀渀最 愀 昀甀渀挀琀椀漀渀 挀愀氀氀Ⰰ 洀愀欀攀 琀栀攀 挀愀氀氀 愀渀搀 爀攀琀甀爀渀 琀栀攀 漀戀樀攀挀琀 
			 // that is passed back.਀ऀ ऀऀ 瘀愀爀 爀甀氀攀开椀渀搀攀砀 㴀 樀儀甀攀爀礀⸀椀渀䄀爀爀愀礀⠀爀甀氀攀Ⰰ 爀甀氀攀猀⤀㬀 
			 if (rule === "custom" || rule === "funcCall") {਀ऀऀऀऀ 瘀愀爀 挀甀猀琀漀洀开瘀愀氀椀搀愀琀椀漀渀开琀礀瀀攀 㴀 爀甀氀攀猀嬀爀甀氀攀开椀渀搀攀砀 ⬀ ㄀崀㬀 
				 rule = rule + "[" + custom_validation_type + "]";਀ऀऀऀऀ ⼀⼀ 䐀攀氀攀琀攀 琀栀攀 爀甀氀攀 昀爀漀洀 琀栀攀 爀甀氀攀猀 愀爀爀愀礀 猀漀 琀栀愀琀 椀琀 搀漀攀猀渀✀琀 琀爀礀 琀漀 挀愀氀氀 琀栀攀 
			    // same rule over again਀ऀऀऀ    搀攀氀攀琀攀⠀爀甀氀攀猀嬀爀甀氀攀开椀渀搀攀砀崀⤀㬀 
			 }਀ऀऀऀ ⼀⼀ 䌀栀愀渀最攀 琀栀攀 爀甀氀攀 琀漀 琀栀攀 挀漀洀瀀漀猀椀琀攀 爀甀氀攀Ⰰ 椀昀 椀琀 眀愀猀 搀椀昀昀攀爀攀渀琀 昀爀漀洀 琀栀攀 漀爀椀最椀渀愀氀 
			 var alteredRule = rule;਀ 
਀ऀऀऀ 瘀愀爀 攀氀攀洀攀渀琀开挀氀愀猀猀攀猀 㴀 ⠀昀椀攀氀搀⸀愀琀琀爀⠀∀搀愀琀愀ⴀ瘀愀氀椀搀愀琀椀漀渀ⴀ攀渀最椀渀攀∀⤀⤀ 㼀 昀椀攀氀搀⸀愀琀琀爀⠀∀搀愀琀愀ⴀ瘀愀氀椀搀愀琀椀漀渀ⴀ攀渀最椀渀攀∀⤀ 㨀 昀椀攀氀搀⸀愀琀琀爀⠀∀挀氀愀猀猀∀⤀㬀 
			 var element_classes_array = element_classes.split(" ");਀ 
			 // Call the original validation method. If we are dealing with dates or checkboxes, also pass the form਀ऀऀऀ 瘀愀爀 攀爀爀漀爀䴀猀最㬀 
			 if (rule == "future" || rule == "past"  || rule == "maxCheckbox" || rule == "minCheckbox") {਀ऀऀऀऀ 攀爀爀漀爀䴀猀最 㴀 漀爀椀最椀渀愀氀嘀愀氀椀搀愀琀椀漀渀䴀攀琀栀漀搀⠀昀漀爀洀Ⰰ 昀椀攀氀搀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀⤀㬀 
			 } else {਀ऀऀऀऀ 攀爀爀漀爀䴀猀最 㴀 漀爀椀最椀渀愀氀嘀愀氀椀搀愀琀椀漀渀䴀攀琀栀漀搀⠀昀椀攀氀搀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀⤀㬀 
			 }਀ 
			 // If the original validation method returned an error and we have a custom error message,਀ऀऀऀ ⼀⼀ 爀攀琀甀爀渀 琀栀攀 挀甀猀琀漀洀 洀攀猀猀愀最攀 椀渀猀琀攀愀搀⸀ 伀琀栀攀爀眀椀猀攀 爀攀琀甀爀渀 琀栀攀 漀爀椀最椀渀愀氀 攀爀爀漀爀 洀攀猀猀愀最攀⸀ 
			 if (errorMsg != undefined) {਀ऀऀऀऀ 瘀愀爀 挀甀猀琀漀洀开洀攀猀猀愀最攀 㴀 洀攀琀栀漀搀猀⸀开最攀琀䌀甀猀琀漀洀䔀爀爀漀爀䴀攀猀猀愀最攀⠀␀⠀昀椀攀氀搀⤀Ⰰ 攀氀攀洀攀渀琀开挀氀愀猀猀攀猀开愀爀爀愀礀Ⰰ 愀氀琀攀爀攀搀刀甀氀攀Ⰰ 漀瀀琀椀漀渀猀⤀㬀 
				 if (custom_message) errorMsg = custom_message;਀ऀऀऀ 紀 
			 return errorMsg;਀ 
		 },਀ऀऀ 开最攀琀䌀甀猀琀漀洀䔀爀爀漀爀䴀攀猀猀愀最攀㨀昀甀渀挀琀椀漀渀 ⠀昀椀攀氀搀Ⰰ 挀氀愀猀猀攀猀Ⰰ 爀甀氀攀Ⰰ 漀瀀琀椀漀渀猀⤀ 笀 
			var custom_message = false;਀ऀऀऀ瘀愀爀 瘀愀氀椀搀椀琀礀倀爀漀瀀 㴀 ⼀帀挀甀猀琀漀洀尀嬀⸀⨀尀崀␀⼀⸀琀攀猀琀⠀爀甀氀攀⤀ 㼀 洀攀琀栀漀搀猀⸀开瘀愀氀椀搀椀琀礀倀爀漀瀀嬀∀挀甀猀琀漀洀∀崀 㨀 洀攀琀栀漀搀猀⸀开瘀愀氀椀搀椀琀礀倀爀漀瀀嬀爀甀氀攀崀㬀 
			 // If there is a validityProp for this rule, check to see if the field has an attribute for it਀ऀऀऀ椀昀 ⠀瘀愀氀椀搀椀琀礀倀爀漀瀀 ℀㴀 甀渀搀攀昀椀渀攀搀⤀ 笀 
				custom_message = field.attr("data-errormessage-"+validityProp);਀ऀऀऀऀ⼀⼀ 䤀昀 琀栀攀爀攀 眀愀猀 愀渀 攀爀爀漀爀 洀攀猀猀愀最攀 昀漀爀 椀琀Ⰰ 爀攀琀甀爀渀 琀栀攀 洀攀猀猀愀最攀 
				if (custom_message != undefined) ਀ऀऀऀऀऀ爀攀琀甀爀渀 挀甀猀琀漀洀开洀攀猀猀愀最攀㬀 
			}਀ऀऀऀ挀甀猀琀漀洀开洀攀猀猀愀最攀 㴀 昀椀攀氀搀⸀愀琀琀爀⠀∀搀愀琀愀ⴀ攀爀爀漀爀洀攀猀猀愀最攀∀⤀㬀 
			 // If there is an inline custom error message, return it਀ऀऀऀ椀昀 ⠀挀甀猀琀漀洀开洀攀猀猀愀最攀 ℀㴀 甀渀搀攀昀椀渀攀搀⤀  
				return custom_message;਀ऀऀऀ瘀愀爀 椀搀 㴀 ✀⌀✀ ⬀ 昀椀攀氀搀⸀愀琀琀爀⠀∀椀搀∀⤀㬀 
			// If we have custom messages for the element's id, get the message for the rule from the id.਀ऀऀऀ⼀⼀ 伀琀栀攀爀眀椀猀攀Ⰰ 椀昀 眀攀 栀愀瘀攀 挀甀猀琀漀洀 洀攀猀猀愀最攀猀 昀漀爀 琀栀攀 攀氀攀洀攀渀琀✀猀 挀氀愀猀猀攀猀Ⰰ 甀猀攀 琀栀攀 昀椀爀猀琀 挀氀愀猀猀 洀攀猀猀愀最攀 眀攀 昀椀渀搀 椀渀猀琀攀愀搀⸀ 
			if (typeof options.custom_error_messages[id] != "undefined" &&਀ऀऀऀऀ琀礀瀀攀漀昀 漀瀀琀椀漀渀猀⸀挀甀猀琀漀洀开攀爀爀漀爀开洀攀猀猀愀最攀猀嬀椀搀崀嬀爀甀氀攀崀 ℀㴀 ∀甀渀搀攀昀椀渀攀搀∀ ⤀ 笀 
						  custom_message = options.custom_error_messages[id][rule]['message'];਀ऀऀऀ紀 攀氀猀攀 椀昀 ⠀挀氀愀猀猀攀猀⸀氀攀渀最琀栀 㸀 　⤀ 笀 
				for (var i = 0; i < classes.length && classes.length > 0; i++) {਀ऀऀऀऀऀ 瘀愀爀 攀氀攀洀攀渀琀开挀氀愀猀猀 㴀 ∀⸀∀ ⬀ 挀氀愀猀猀攀猀嬀椀崀㬀 
					if (typeof options.custom_error_messages[element_class] != "undefined" &&਀ऀऀऀऀऀऀ琀礀瀀攀漀昀 漀瀀琀椀漀渀猀⸀挀甀猀琀漀洀开攀爀爀漀爀开洀攀猀猀愀最攀猀嬀攀氀攀洀攀渀琀开挀氀愀猀猀崀嬀爀甀氀攀崀 ℀㴀 ∀甀渀搀攀昀椀渀攀搀∀⤀ 笀 
							custom_message = options.custom_error_messages[element_class][rule]['message'];਀ऀऀऀऀऀऀऀ戀爀攀愀欀㬀 
					}਀ऀऀऀऀ紀 
			}਀ऀऀऀ椀昀 ⠀℀挀甀猀琀漀洀开洀攀猀猀愀最攀 ☀☀ 
				typeof options.custom_error_messages[rule] != "undefined" &&਀ऀऀऀऀ琀礀瀀攀漀昀 漀瀀琀椀漀渀猀⸀挀甀猀琀漀洀开攀爀爀漀爀开洀攀猀猀愀最攀猀嬀爀甀氀攀崀嬀✀洀攀猀猀愀最攀✀崀 ℀㴀 ∀甀渀搀攀昀椀渀攀搀∀⤀笀 
					 custom_message = options.custom_error_messages[rule]['message'];਀ऀऀऀ 紀 
			 return custom_message;਀ऀऀ 紀Ⰰ 
		 _validityProp: {਀ऀऀऀ ∀爀攀焀甀椀爀攀搀∀㨀 ∀瘀愀氀甀攀ⴀ洀椀猀猀椀渀最∀Ⰰ 
			 "custom": "custom-error",਀ऀऀऀ ∀最爀漀甀瀀刀攀焀甀椀爀攀搀∀㨀 ∀瘀愀氀甀攀ⴀ洀椀猀猀椀渀最∀Ⰰ 
			 "ajax": "custom-error",਀ऀऀऀ ∀洀椀渀匀椀稀攀∀㨀 ∀爀愀渀最攀ⴀ甀渀搀攀爀昀氀漀眀∀Ⰰ 
			 "maxSize": "range-overflow",਀ऀऀऀ ∀洀椀渀∀㨀 ∀爀愀渀最攀ⴀ甀渀搀攀爀昀氀漀眀∀Ⰰ 
			 "max": "range-overflow",਀ऀऀऀ ∀瀀愀猀琀∀㨀 ∀琀礀瀀攀ⴀ洀椀猀洀愀琀挀栀∀Ⰰ 
			 "future": "type-mismatch",਀ऀऀऀ ∀搀愀琀攀刀愀渀最攀∀㨀 ∀琀礀瀀攀ⴀ洀椀猀洀愀琀挀栀∀Ⰰ 
			 "dateTimeRange": "type-mismatch",਀ऀऀऀ ∀洀愀砀䌀栀攀挀欀戀漀砀∀㨀 ∀爀愀渀最攀ⴀ漀瘀攀爀昀氀漀眀∀Ⰰ 
			 "minCheckbox": "range-underflow",਀ऀऀऀ ∀攀焀甀愀氀猀∀㨀 ∀瀀愀琀琀攀爀渀ⴀ洀椀猀洀愀琀挀栀∀Ⰰ 
			 "funcCall": "custom-error",਀ऀऀऀ ∀挀爀攀搀椀琀䌀愀爀搀∀㨀 ∀瀀愀琀琀攀爀渀ⴀ洀椀猀洀愀琀挀栀∀Ⰰ 
			 "condRequired": "value-missing"਀ऀऀ 紀Ⰰ 
		/**਀ऀऀ⨀ 刀攀焀甀椀爀攀搀 瘀愀氀椀搀愀琀椀漀渀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 昀椀攀氀搀 
		* @param {Array[String]} rules਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀椀渀琀紀 椀 爀甀氀攀猀 椀渀搀攀砀 
		* @param {Map}਀ऀऀ⨀            甀猀攀爀 漀瀀琀椀漀渀猀 
		* @param {bool} condRequired flag when method is used for internal purpose in condRequired check਀ऀऀ⨀ 䀀爀攀琀甀爀渀 愀渀 攀爀爀漀爀 猀琀爀椀渀最 椀昀 瘀愀氀椀搀愀琀椀漀渀 昀愀椀氀攀搀 
		*/਀ऀऀ开爀攀焀甀椀爀攀搀㨀 昀甀渀挀琀椀漀渀⠀昀椀攀氀搀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀Ⰰ 挀漀渀搀刀攀焀甀椀爀攀搀⤀ 笀 
			switch (field.prop("type")) {਀ऀऀऀऀ挀愀猀攀 ∀琀攀砀琀∀㨀 
				case "password":਀ऀऀऀऀ挀愀猀攀 ∀琀攀砀琀愀爀攀愀∀㨀 
				case "file":਀ऀऀऀऀ挀愀猀攀 ∀猀攀氀攀挀琀ⴀ漀渀攀∀㨀 
				case "select-multiple":਀ऀऀऀऀ搀攀昀愀甀氀琀㨀 
					var field_val      = $.trim( field.val()                               );਀ऀऀऀऀऀ瘀愀爀 搀瘀开瀀氀愀挀攀栀漀氀搀攀爀 㴀 ␀⸀琀爀椀洀⠀ 昀椀攀氀搀⸀愀琀琀爀⠀∀搀愀琀愀ⴀ瘀愀氀椀搀愀琀椀漀渀ⴀ瀀氀愀挀攀栀漀氀搀攀爀∀⤀ ⤀㬀 
					var placeholder    = $.trim( field.attr("placeholder")                 );਀ऀऀऀऀऀ椀昀 ⠀ 
						   ( !field_val                                    )਀ऀऀऀऀऀऀ簀簀 ⠀ 搀瘀开瀀氀愀挀攀栀漀氀搀攀爀 ☀☀ 昀椀攀氀搀开瘀愀氀 㴀㴀 搀瘀开瀀氀愀挀攀栀漀氀搀攀爀 ⤀ 
						|| ( placeholder    && field_val == placeholder    )਀ऀऀऀऀऀ⤀ 笀 
						return options.allrules[rules[i]].alertText;਀ऀऀऀऀऀ紀 
					break;਀ऀऀऀऀ挀愀猀攀 ∀爀愀搀椀漀∀㨀 
				case "checkbox":਀ऀऀऀऀऀ⼀⼀ 渀攀眀 瘀愀氀椀搀愀琀椀漀渀 猀琀礀氀攀 琀漀 漀渀氀礀 挀栀攀挀欀 搀攀瀀攀渀搀攀渀琀 昀椀攀氀搀 
					if (condRequired) {਀ऀऀऀऀऀऀ椀昀 ⠀℀昀椀攀氀搀⸀愀琀琀爀⠀✀挀栀攀挀欀攀搀✀⤀⤀ 笀 
							return options.allrules[rules[i]].alertTextCheckboxMultiple;਀ऀऀऀऀऀऀ紀 
						break;਀ऀऀऀऀऀ紀 
					// old validation style਀ऀऀऀऀऀ瘀愀爀 昀漀爀洀 㴀 昀椀攀氀搀⸀挀氀漀猀攀猀琀⠀∀昀漀爀洀Ⰰ ⸀瘀愀氀椀搀愀琀椀漀渀䔀渀最椀渀攀䌀漀渀琀愀椀渀攀爀∀⤀㬀 
					var name = field.attr("name");਀ऀऀऀऀऀ椀昀 ⠀昀漀爀洀⸀昀椀渀搀⠀∀椀渀瀀甀琀嬀渀愀洀攀㴀✀∀ ⬀ 渀愀洀攀 ⬀ ∀✀崀㨀挀栀攀挀欀攀搀∀⤀⸀猀椀稀攀⠀⤀ 㴀㴀 　⤀ 笀 
						if (form.find("input[name='" + name + "']:visible").size() == 1)਀ऀऀऀऀऀऀऀ爀攀琀甀爀渀 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀嬀爀甀氀攀猀嬀椀崀崀⸀愀氀攀爀琀吀攀砀琀䌀栀攀挀欀戀漀砀攀㬀 
						else਀ऀऀऀऀऀऀऀ爀攀琀甀爀渀 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀嬀爀甀氀攀猀嬀椀崀崀⸀愀氀攀爀琀吀攀砀琀䌀栀攀挀欀戀漀砀䴀甀氀琀椀瀀氀攀㬀 
					}਀ऀऀऀऀऀ戀爀攀愀欀㬀 
			}਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 嘀愀氀椀搀愀琀攀 琀栀愀琀 ㄀ 昀爀漀洀 琀栀攀 最爀漀甀瀀 昀椀攀氀搀 椀猀 爀攀焀甀椀爀攀搀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 昀椀攀氀搀 
		* @param {Array[String]} rules਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀椀渀琀紀 椀 爀甀氀攀猀 椀渀搀攀砀 
		* @param {Map}਀ऀऀ⨀            甀猀攀爀 漀瀀琀椀漀渀猀 
		* @return an error string if validation failed਀ऀऀ⨀⼀ 
		_groupRequired: function(field, rules, i, options) {਀ऀऀऀ瘀愀爀 挀氀愀猀猀䜀爀漀甀瀀 㴀 ∀嬀∀⬀漀瀀琀椀漀渀猀⸀瘀愀氀椀搀愀琀攀䄀琀琀爀椀戀甀琀攀⬀∀⨀㴀∀ ⬀爀甀氀攀猀嬀椀 ⬀ ㄀崀 ⬀∀崀∀㬀 
			var isValid = false;਀ऀऀऀ⼀⼀ 䌀栀攀挀欀 愀氀氀 昀椀攀氀搀猀 昀爀漀洀 琀栀攀 最爀漀甀瀀 
			field.closest("form, .validationEngineContainer").find(classGroup).each(function(){਀ऀऀऀऀ椀昀⠀℀洀攀琀栀漀搀猀⸀开爀攀焀甀椀爀攀搀⠀␀⠀琀栀椀猀⤀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀⤀⤀笀 
					isValid = true;਀ऀऀऀऀऀ爀攀琀甀爀渀 昀愀氀猀攀㬀 
				}਀ऀऀऀ紀⤀㬀  
਀ऀऀऀ椀昀⠀℀椀猀嘀愀氀椀搀⤀ 笀 
		  return options.allrules[rules[i]].alertText;਀ऀऀ紀 
		},਀ऀऀ⼀⨀⨀ 
		* Validate rules਀ऀऀ⨀ 
		* @param {jqObject} field਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䄀爀爀愀礀嬀匀琀爀椀渀最崀紀 爀甀氀攀猀 
		* @param {int} i rules index਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䴀愀瀀紀 
		*            user options਀ऀऀ⨀ 䀀爀攀琀甀爀渀 愀渀 攀爀爀漀爀 猀琀爀椀渀最 椀昀 瘀愀氀椀搀愀琀椀漀渀 昀愀椀氀攀搀 
		*/਀ऀऀ开挀甀猀琀漀洀㨀 昀甀渀挀琀椀漀渀⠀昀椀攀氀搀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀⤀ 笀 
			var customRule = rules[i + 1];਀ऀऀऀ瘀愀爀 爀甀氀攀 㴀 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀嬀挀甀猀琀漀洀刀甀氀攀崀㬀 
			var fn;਀ऀऀऀ椀昀⠀℀爀甀氀攀⤀ 笀 
				alert("jqv:custom rule not found - "+customRule);਀ऀऀऀऀ爀攀琀甀爀渀㬀 
			}਀ऀऀऀ 
			if(rule["regex"]) {਀ऀऀऀऀ 瘀愀爀 攀砀㴀爀甀氀攀⸀爀攀最攀砀㬀 
					if(!ex) {਀ऀऀऀऀऀऀ愀氀攀爀琀⠀∀樀焀瘀㨀挀甀猀琀漀洀 爀攀最攀砀 渀漀琀 昀漀甀渀搀 ⴀ ∀⬀挀甀猀琀漀洀刀甀氀攀⤀㬀 
						return;਀ऀऀऀऀऀ紀 
					var pattern = new RegExp(ex);਀ 
					if (!pattern.test(field.val())) return options.allrules[customRule].alertText;਀ऀऀऀऀऀ 
			} else if(rule["func"]) {਀ऀऀऀऀ昀渀 㴀 爀甀氀攀嬀∀昀甀渀挀∀崀㬀  
				 ਀ऀऀऀऀ椀昀 ⠀琀礀瀀攀漀昀⠀昀渀⤀ ℀㴀㴀 ∀昀甀渀挀琀椀漀渀∀⤀ 笀 
					alert("jqv:custom parameter 'function' is no function - "+customRule);਀ऀऀऀऀऀऀ爀攀琀甀爀渀㬀 
				}਀ऀऀऀऀ  
				if (!fn(field, rules, i, options))਀ऀऀऀऀऀ爀攀琀甀爀渀 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀嬀挀甀猀琀漀洀刀甀氀攀崀⸀愀氀攀爀琀吀攀砀琀㬀 
			} else {਀ऀऀऀऀ愀氀攀爀琀⠀∀樀焀瘀㨀挀甀猀琀漀洀 琀礀瀀攀 渀漀琀 愀氀氀漀眀攀搀 ∀⬀挀甀猀琀漀洀刀甀氀攀⤀㬀 
					return;਀ऀऀऀ紀 
		},਀ऀऀ⼀⨀⨀ 
		* Validate custom function outside of the engine scope਀ऀऀ⨀ 
		* @param {jqObject} field਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䄀爀爀愀礀嬀匀琀爀椀渀最崀紀 爀甀氀攀猀 
		* @param {int} i rules index਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䴀愀瀀紀 
		*            user options਀ऀऀ⨀ 䀀爀攀琀甀爀渀 愀渀 攀爀爀漀爀 猀琀爀椀渀最 椀昀 瘀愀氀椀搀愀琀椀漀渀 昀愀椀氀攀搀 
		*/਀ऀऀ开昀甀渀挀䌀愀氀氀㨀 昀甀渀挀琀椀漀渀⠀昀椀攀氀搀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀⤀ 笀 
			var functionName = rules[i + 1];਀ऀऀऀ瘀愀爀 昀渀㬀 
			if(functionName.indexOf('.') >-1)਀ऀऀऀ笀 
				var namespaces = functionName.split('.');਀ऀऀऀऀ瘀愀爀 猀挀漀瀀攀 㴀 眀椀渀搀漀眀㬀 
				while(namespaces.length)਀ऀऀऀऀ笀 
					scope = scope[namespaces.shift()];਀ऀऀऀऀ紀 
				fn = scope;਀ऀऀऀ紀 
			else਀ऀऀऀऀ昀渀 㴀 眀椀渀搀漀眀嬀昀甀渀挀琀椀漀渀一愀洀攀崀 簀簀 漀瀀琀椀漀渀猀⸀挀甀猀琀漀洀䘀甀渀挀琀椀漀渀猀嬀昀甀渀挀琀椀漀渀一愀洀攀崀㬀 
			if (typeof(fn) == 'function')਀ऀऀऀऀ爀攀琀甀爀渀 昀渀⠀昀椀攀氀搀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀⤀㬀 
਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 䘀椀攀氀搀 洀愀琀挀栀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 昀椀攀氀搀 
		* @param {Array[String]} rules਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀椀渀琀紀 椀 爀甀氀攀猀 椀渀搀攀砀 
		* @param {Map}਀ऀऀ⨀            甀猀攀爀 漀瀀琀椀漀渀猀 
		* @return an error string if validation failed਀ऀऀ⨀⼀ 
		_equals: function(field, rules, i, options) {਀ऀऀऀ瘀愀爀 攀焀甀愀氀猀䘀椀攀氀搀 㴀 爀甀氀攀猀嬀椀 ⬀ ㄀崀㬀 
਀ऀऀऀ椀昀 ⠀昀椀攀氀搀⸀瘀愀氀⠀⤀ ℀㴀 ␀⠀∀⌀∀ ⬀ 攀焀甀愀氀猀䘀椀攀氀搀⤀⸀瘀愀氀⠀⤀⤀ 
				return options.allrules.equals.alertText;਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 䌀栀攀挀欀 琀栀攀 洀愀砀椀洀甀洀 猀椀稀攀 ⠀椀渀 挀栀愀爀愀挀琀攀爀猀⤀ 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 昀椀攀氀搀 
		* @param {Array[String]} rules਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀椀渀琀紀 椀 爀甀氀攀猀 椀渀搀攀砀 
		* @param {Map}਀ऀऀ⨀            甀猀攀爀 漀瀀琀椀漀渀猀 
		* @return an error string if validation failed਀ऀऀ⨀⼀ 
		_maxSize: function(field, rules, i, options) {਀ऀऀऀ瘀愀爀 洀愀砀 㴀 爀甀氀攀猀嬀椀 ⬀ ㄀崀㬀 
			var len = field.val().length;਀ 
			if (len > max) {਀ऀऀऀऀ瘀愀爀 爀甀氀攀 㴀 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀⸀洀愀砀匀椀稀攀㬀 
				return rule.alertText + max + rule.alertText2;਀ऀऀऀ紀 
		},਀ऀऀ⼀⨀⨀ 
		* Check the minimum size (in characters)਀ऀऀ⨀ 
		* @param {jqObject} field਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䄀爀爀愀礀嬀匀琀爀椀渀最崀紀 爀甀氀攀猀 
		* @param {int} i rules index਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䴀愀瀀紀 
		*            user options਀ऀऀ⨀ 䀀爀攀琀甀爀渀 愀渀 攀爀爀漀爀 猀琀爀椀渀最 椀昀 瘀愀氀椀搀愀琀椀漀渀 昀愀椀氀攀搀 
		*/਀ऀऀ开洀椀渀匀椀稀攀㨀 昀甀渀挀琀椀漀渀⠀昀椀攀氀搀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀⤀ 笀 
			var min = rules[i + 1];਀ऀऀऀ瘀愀爀 氀攀渀 㴀 昀椀攀氀搀⸀瘀愀氀⠀⤀⸀氀攀渀最琀栀㬀 
਀ऀऀऀ椀昀 ⠀氀攀渀 㰀 洀椀渀⤀ 笀 
				var rule = options.allrules.minSize;਀ऀऀऀऀ爀攀琀甀爀渀 爀甀氀攀⸀愀氀攀爀琀吀攀砀琀 ⬀ 洀椀渀 ⬀ 爀甀氀攀⸀愀氀攀爀琀吀攀砀琀㈀㬀 
			}਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 䌀栀攀挀欀 渀甀洀戀攀爀 洀椀渀椀洀甀洀 瘀愀氀甀攀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 昀椀攀氀搀 
		* @param {Array[String]} rules਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀椀渀琀紀 椀 爀甀氀攀猀 椀渀搀攀砀 
		* @param {Map}਀ऀऀ⨀            甀猀攀爀 漀瀀琀椀漀渀猀 
		* @return an error string if validation failed਀ऀऀ⨀⼀ 
		_min: function(field, rules, i, options) {਀ऀऀऀ瘀愀爀 洀椀渀 㴀 瀀愀爀猀攀䘀氀漀愀琀⠀爀甀氀攀猀嬀椀 ⬀ ㄀崀⤀㬀 
			var len = parseFloat(field.val());਀ 
			if (len < min) {਀ऀऀऀऀ瘀愀爀 爀甀氀攀 㴀 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀⸀洀椀渀㬀 
				if (rule.alertText2) return rule.alertText + min + rule.alertText2;਀ऀऀऀऀ爀攀琀甀爀渀 爀甀氀攀⸀愀氀攀爀琀吀攀砀琀 ⬀ 洀椀渀㬀 
			}਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 䌀栀攀挀欀 渀甀洀戀攀爀 洀愀砀椀洀甀洀 瘀愀氀甀攀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 昀椀攀氀搀 
		* @param {Array[String]} rules਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀椀渀琀紀 椀 爀甀氀攀猀 椀渀搀攀砀 
		* @param {Map}਀ऀऀ⨀            甀猀攀爀 漀瀀琀椀漀渀猀 
		* @return an error string if validation failed਀ऀऀ⨀⼀ 
		_max: function(field, rules, i, options) {਀ऀऀऀ瘀愀爀 洀愀砀 㴀 瀀愀爀猀攀䘀氀漀愀琀⠀爀甀氀攀猀嬀椀 ⬀ ㄀崀⤀㬀 
			var len = parseFloat(field.val());਀ 
			if (len >max ) {਀ऀऀऀऀ瘀愀爀 爀甀氀攀 㴀 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀⸀洀愀砀㬀 
				if (rule.alertText2) return rule.alertText + max + rule.alertText2;਀ऀऀऀऀ⼀⼀漀爀攀昀愀氀漀㨀 琀漀 爀攀瘀椀攀眀Ⰰ 愀氀猀漀 搀漀 琀栀攀 琀爀愀渀猀氀愀琀椀漀渀猀 
				return rule.alertText + max;਀ऀऀऀ紀 
		},਀ऀऀ⼀⨀⨀ 
		* Checks date is in the past਀ऀऀ⨀ 
		* @param {jqObject} field਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䄀爀爀愀礀嬀匀琀爀椀渀最崀紀 爀甀氀攀猀 
		* @param {int} i rules index਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䴀愀瀀紀 
		*            user options਀ऀऀ⨀ 䀀爀攀琀甀爀渀 愀渀 攀爀爀漀爀 猀琀爀椀渀最 椀昀 瘀愀氀椀搀愀琀椀漀渀 昀愀椀氀攀搀 
		*/਀ऀऀ开瀀愀猀琀㨀 昀甀渀挀琀椀漀渀⠀昀漀爀洀Ⰰ 昀椀攀氀搀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀⤀ 笀 
਀ऀऀऀ瘀愀爀 瀀㴀爀甀氀攀猀嬀椀 ⬀ ㄀崀㬀 
			var fieldAlt = $(form.find("*[name='" + p.replace(/^#+/, '') + "']"));਀ऀऀऀ瘀愀爀 瀀搀愀琀攀㬀 
਀ऀऀऀ椀昀 ⠀瀀⸀琀漀䰀漀眀攀爀䌀愀猀攀⠀⤀ 㴀㴀 ∀渀漀眀∀⤀ 笀 
				pdate = new Date();਀ऀऀऀ紀 攀氀猀攀 椀昀 ⠀甀渀搀攀昀椀渀攀搀 ℀㴀 昀椀攀氀搀䄀氀琀⸀瘀愀氀⠀⤀⤀ 笀 
				if (fieldAlt.is(":disabled"))਀ऀऀऀऀऀ爀攀琀甀爀渀㬀 
				pdate = methods._parseDate(fieldAlt.val());਀ऀऀऀ紀 攀氀猀攀 笀 
				pdate = methods._parseDate(p);਀ऀऀऀ紀 
			var vdate = methods._parseDate(field.val());਀ 
			if (vdate > pdate ) {਀ऀऀऀऀ瘀愀爀 爀甀氀攀 㴀 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀⸀瀀愀猀琀㬀 
				if (rule.alertText2) return rule.alertText + methods._dateToString(pdate) + rule.alertText2;਀ऀऀऀऀ爀攀琀甀爀渀 爀甀氀攀⸀愀氀攀爀琀吀攀砀琀 ⬀ 洀攀琀栀漀搀猀⸀开搀愀琀攀吀漀匀琀爀椀渀最⠀瀀搀愀琀攀⤀㬀 
			}਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 䌀栀攀挀欀猀 搀愀琀攀 椀猀 椀渀 琀栀攀 昀甀琀甀爀攀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 昀椀攀氀搀 
		* @param {Array[String]} rules਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀椀渀琀紀 椀 爀甀氀攀猀 椀渀搀攀砀 
		* @param {Map}਀ऀऀ⨀            甀猀攀爀 漀瀀琀椀漀渀猀 
		* @return an error string if validation failed਀ऀऀ⨀⼀ 
		_future: function(form, field, rules, i, options) {਀ 
			var p=rules[i + 1];਀ऀऀऀ瘀愀爀 昀椀攀氀搀䄀氀琀 㴀 ␀⠀昀漀爀洀⸀昀椀渀搀⠀∀⨀嬀渀愀洀攀㴀✀∀ ⬀ 瀀⸀爀攀瀀氀愀挀攀⠀⼀帀⌀⬀⼀Ⰰ ✀✀⤀ ⬀ ∀✀崀∀⤀⤀㬀 
			var pdate;਀ 
			if (p.toLowerCase() == "now") {਀ऀऀऀऀ瀀搀愀琀攀 㴀 渀攀眀 䐀愀琀攀⠀⤀㬀 
			} else if (undefined != fieldAlt.val()) {਀ऀऀऀऀ椀昀 ⠀昀椀攀氀搀䄀氀琀⸀椀猀⠀∀㨀搀椀猀愀戀氀攀搀∀⤀⤀ 
					return;਀ऀऀऀऀ瀀搀愀琀攀 㴀 洀攀琀栀漀搀猀⸀开瀀愀爀猀攀䐀愀琀攀⠀昀椀攀氀搀䄀氀琀⸀瘀愀氀⠀⤀⤀㬀 
			} else {਀ऀऀऀऀ瀀搀愀琀攀 㴀 洀攀琀栀漀搀猀⸀开瀀愀爀猀攀䐀愀琀攀⠀瀀⤀㬀 
			}਀ऀऀऀ瘀愀爀 瘀搀愀琀攀 㴀 洀攀琀栀漀搀猀⸀开瀀愀爀猀攀䐀愀琀攀⠀昀椀攀氀搀⸀瘀愀氀⠀⤀⤀㬀 
਀ऀऀऀ椀昀 ⠀瘀搀愀琀攀 㰀 瀀搀愀琀攀 ⤀ 笀 
				var rule = options.allrules.future;਀ऀऀऀऀ椀昀 ⠀爀甀氀攀⸀愀氀攀爀琀吀攀砀琀㈀⤀ 
					return rule.alertText + methods._dateToString(pdate) + rule.alertText2;਀ऀऀऀऀ爀攀琀甀爀渀 爀甀氀攀⸀愀氀攀爀琀吀攀砀琀 ⬀ 洀攀琀栀漀搀猀⸀开搀愀琀攀吀漀匀琀爀椀渀最⠀瀀搀愀琀攀⤀㬀 
			}਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 䌀栀攀挀欀猀 椀昀 瘀愀氀椀搀 搀愀琀攀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀猀琀爀椀渀最紀 搀愀琀攀 猀琀爀椀渀最 
		* @return a bool based on determination of valid date਀ऀऀ⨀⼀ 
		_isDate: function (value) {਀ऀऀऀ瘀愀爀 搀愀琀攀刀攀最䔀砀 㴀 渀攀眀 刀攀最䔀砀瀀⠀⼀帀尀搀笀㐀紀嬀尀⼀尀ⴀ崀⠀　㼀嬀㄀ⴀ㤀崀簀㄀嬀　㄀㈀崀⤀嬀尀⼀尀ⴀ崀⠀　㼀嬀㄀ⴀ㤀崀簀嬀㄀㈀崀嬀　ⴀ㤀崀簀㌀嬀　㄀崀⤀␀簀帀⠀㼀㨀⠀㼀㨀⠀㼀㨀　㼀嬀㄀㌀㔀㜀㠀崀簀㄀嬀　㈀崀⤀⠀尀⼀簀ⴀ⤀㌀㄀⤀簀⠀㼀㨀⠀㼀㨀　㼀嬀㄀Ⰰ㌀ⴀ㤀崀簀㄀嬀　ⴀ㈀崀⤀⠀尀⼀簀ⴀ⤀⠀㼀㨀㈀㤀簀㌀　⤀⤀⤀⠀尀⼀簀ⴀ⤀⠀㼀㨀嬀㄀ⴀ㤀崀尀搀尀搀尀搀簀尀搀嬀㄀ⴀ㤀崀尀搀尀搀簀尀搀尀搀嬀㄀ⴀ㤀崀尀搀簀尀搀尀搀尀搀嬀㄀ⴀ㤀崀⤀␀簀帀⠀㼀㨀⠀㼀㨀　㼀嬀㄀ⴀ㤀崀簀㄀嬀　ⴀ㈀崀⤀⠀尀⼀簀ⴀ⤀⠀㼀㨀　㼀嬀㄀ⴀ㤀崀簀㄀尀搀簀㈀嬀　ⴀ㠀崀⤀⤀⠀尀⼀簀ⴀ⤀⠀㼀㨀嬀㄀ⴀ㤀崀尀搀尀搀尀搀簀尀搀嬀㄀ⴀ㤀崀尀搀尀搀簀尀搀尀搀嬀㄀ⴀ㤀崀尀搀簀尀搀尀搀尀搀嬀㄀ⴀ㤀崀⤀␀簀帀⠀　㼀㈀⠀尀⼀簀ⴀ⤀㈀㤀⤀⠀尀⼀簀ⴀ⤀⠀㼀㨀⠀㼀㨀　嬀㐀㠀崀　　簀嬀㄀㌀㔀㜀㤀崀嬀㈀㘀崀　　簀嬀㈀㐀㘀㠀崀嬀　㐀㠀崀　　⤀簀⠀㼀㨀尀搀尀搀⤀㼀⠀㼀㨀　嬀㐀㠀崀簀嬀㈀㐀㘀㠀崀嬀　㐀㠀崀簀嬀㄀㌀㔀㜀㤀崀嬀㈀㘀崀⤀⤀␀⼀⤀㬀 
			return dateRegEx.test(value);਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 䌀栀攀挀欀猀 椀昀 瘀愀氀椀搀 搀愀琀攀 琀椀洀攀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀猀琀爀椀渀最紀 搀愀琀攀 猀琀爀椀渀最 
		* @return a bool based on determination of valid date time਀ऀऀ⨀⼀ 
		_isDateTime: function (value){਀ऀऀऀ瘀愀爀 搀愀琀攀吀椀洀攀刀攀最䔀砀 㴀 渀攀眀 刀攀最䔀砀瀀⠀⼀帀尀搀笀㐀紀嬀尀⼀尀ⴀ崀⠀　㼀嬀㄀ⴀ㤀崀簀㄀嬀　㄀㈀崀⤀嬀尀⼀尀ⴀ崀⠀　㼀嬀㄀ⴀ㤀崀簀嬀㄀㈀崀嬀　ⴀ㤀崀簀㌀嬀　㄀崀⤀尀猀⬀⠀㄀嬀　㄀㈀崀簀　㼀嬀㄀ⴀ㤀崀⤀笀㄀紀㨀⠀　㼀嬀㄀ⴀ㔀崀簀嬀　ⴀ㘀崀嬀　ⴀ㤀崀⤀笀㄀紀㨀⠀　㼀嬀　ⴀ㘀崀簀嬀　ⴀ㘀崀嬀　ⴀ㤀崀⤀笀㄀紀尀猀⬀⠀愀洀簀瀀洀簀䄀䴀簀倀䴀⤀笀㄀紀␀簀帀⠀㼀㨀⠀㼀㨀⠀㼀㨀　㼀嬀㄀㌀㔀㜀㠀崀簀㄀嬀　㈀崀⤀⠀尀⼀簀ⴀ⤀㌀㄀⤀簀⠀㼀㨀⠀㼀㨀　㼀嬀㄀Ⰰ㌀ⴀ㤀崀簀㄀嬀　ⴀ㈀崀⤀⠀尀⼀簀ⴀ⤀⠀㼀㨀㈀㤀簀㌀　⤀⤀⤀⠀尀⼀簀ⴀ⤀⠀㼀㨀嬀㄀ⴀ㤀崀尀搀尀搀尀搀簀尀搀嬀㄀ⴀ㤀崀尀搀尀搀簀尀搀尀搀嬀㄀ⴀ㤀崀尀搀簀尀搀尀搀尀搀嬀㄀ⴀ㤀崀⤀␀簀帀⠀⠀㄀嬀　㄀㈀崀簀　㼀嬀㄀ⴀ㤀崀⤀笀㄀紀尀⼀⠀　㼀嬀㄀ⴀ㤀崀簀嬀㄀㈀崀嬀　ⴀ㤀崀簀㌀嬀　㄀崀⤀笀㄀紀尀⼀尀搀笀㈀Ⰰ㐀紀尀猀⬀⠀㄀嬀　㄀㈀崀簀　㼀嬀㄀ⴀ㤀崀⤀笀㄀紀㨀⠀　㼀嬀㄀ⴀ㔀崀簀嬀　ⴀ㘀崀嬀　ⴀ㤀崀⤀笀㄀紀㨀⠀　㼀嬀　ⴀ㘀崀簀嬀　ⴀ㘀崀嬀　ⴀ㤀崀⤀笀㄀紀尀猀⬀⠀愀洀簀瀀洀簀䄀䴀簀倀䴀⤀笀㄀紀⤀␀⼀⤀㬀 
			return dateTimeRegEx.test(value);਀ऀऀ紀Ⰰ 
		//Checks if the start date is before the end date਀ऀऀ⼀⼀爀攀琀甀爀渀猀 琀爀甀攀 椀昀 攀渀搀 椀猀 氀愀琀攀爀 琀栀愀渀 猀琀愀爀琀 
		_dateCompare: function (start, end) {਀ऀऀऀ爀攀琀甀爀渀 ⠀渀攀眀 䐀愀琀攀⠀猀琀愀爀琀⸀琀漀匀琀爀椀渀最⠀⤀⤀ 㰀 渀攀眀 䐀愀琀攀⠀攀渀搀⸀琀漀匀琀爀椀渀最⠀⤀⤀⤀㬀 
		},਀ऀऀ⼀⨀⨀ 
		* Checks date range਀ऀऀ⨀ 
		* @param {jqObject} first field name਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 猀攀挀漀渀搀 昀椀攀氀搀 渀愀洀攀 
		* @return an error string if validation failed਀ऀऀ⨀⼀ 
		_dateRange: function (field, rules, i, options) {਀ऀऀऀ⼀⼀愀爀攀 渀漀琀 戀漀琀栀 瀀漀瀀甀氀愀琀攀搀 
			if ((!options.firstOfGroup[0].value && options.secondOfGroup[0].value) || (options.firstOfGroup[0].value && !options.secondOfGroup[0].value)) {਀ऀऀऀऀ爀攀琀甀爀渀 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀嬀爀甀氀攀猀嬀椀崀崀⸀愀氀攀爀琀吀攀砀琀 ⬀ 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀嬀爀甀氀攀猀嬀椀崀崀⸀愀氀攀爀琀吀攀砀琀㈀㬀 
			}਀ 
			//are not both dates਀ऀऀऀ椀昀 ⠀℀洀攀琀栀漀搀猀⸀开椀猀䐀愀琀攀⠀漀瀀琀椀漀渀猀⸀昀椀爀猀琀伀昀䜀爀漀甀瀀嬀　崀⸀瘀愀氀甀攀⤀ 簀簀 ℀洀攀琀栀漀搀猀⸀开椀猀䐀愀琀攀⠀漀瀀琀椀漀渀猀⸀猀攀挀漀渀搀伀昀䜀爀漀甀瀀嬀　崀⸀瘀愀氀甀攀⤀⤀ 笀 
				return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;਀ऀऀऀ紀 
਀ऀऀऀ⼀⼀愀爀攀 戀漀琀栀 搀愀琀攀猀 戀甀琀 爀愀渀最攀 椀猀 漀昀昀 
			if (!methods._dateCompare(options.firstOfGroup[0].value, options.secondOfGroup[0].value)) {਀ऀऀऀऀ爀攀琀甀爀渀 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀嬀爀甀氀攀猀嬀椀崀崀⸀愀氀攀爀琀吀攀砀琀 ⬀ 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀嬀爀甀氀攀猀嬀椀崀崀⸀愀氀攀爀琀吀攀砀琀㈀㬀 
			}਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 䌀栀攀挀欀猀 搀愀琀攀 琀椀洀攀 爀愀渀最攀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 昀椀爀猀琀 昀椀攀氀搀 渀愀洀攀 
		* @param {jqObject} second field name਀ऀऀ⨀ 䀀爀攀琀甀爀渀 愀渀 攀爀爀漀爀 猀琀爀椀渀最 椀昀 瘀愀氀椀搀愀琀椀漀渀 昀愀椀氀攀搀 
		*/਀ऀऀ开搀愀琀攀吀椀洀攀刀愀渀最攀㨀 昀甀渀挀琀椀漀渀 ⠀昀椀攀氀搀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀⤀ 笀 
			//are not both populated਀ऀऀऀ椀昀 ⠀⠀℀漀瀀琀椀漀渀猀⸀昀椀爀猀琀伀昀䜀爀漀甀瀀嬀　崀⸀瘀愀氀甀攀 ☀☀ 漀瀀琀椀漀渀猀⸀猀攀挀漀渀搀伀昀䜀爀漀甀瀀嬀　崀⸀瘀愀氀甀攀⤀ 簀簀 ⠀漀瀀琀椀漀渀猀⸀昀椀爀猀琀伀昀䜀爀漀甀瀀嬀　崀⸀瘀愀氀甀攀 ☀☀ ℀漀瀀琀椀漀渀猀⸀猀攀挀漀渀搀伀昀䜀爀漀甀瀀嬀　崀⸀瘀愀氀甀攀⤀⤀ 笀 
				return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;਀ऀऀऀ紀 
			//are not both dates਀ऀऀऀ椀昀 ⠀℀洀攀琀栀漀搀猀⸀开椀猀䐀愀琀攀吀椀洀攀⠀漀瀀琀椀漀渀猀⸀昀椀爀猀琀伀昀䜀爀漀甀瀀嬀　崀⸀瘀愀氀甀攀⤀ 簀簀 ℀洀攀琀栀漀搀猀⸀开椀猀䐀愀琀攀吀椀洀攀⠀漀瀀琀椀漀渀猀⸀猀攀挀漀渀搀伀昀䜀爀漀甀瀀嬀　崀⸀瘀愀氀甀攀⤀⤀ 笀 
				return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;਀ऀऀऀ紀 
			//are both dates but range is off਀ऀऀऀ椀昀 ⠀℀洀攀琀栀漀搀猀⸀开搀愀琀攀䌀漀洀瀀愀爀攀⠀漀瀀琀椀漀渀猀⸀昀椀爀猀琀伀昀䜀爀漀甀瀀嬀　崀⸀瘀愀氀甀攀Ⰰ 漀瀀琀椀漀渀猀⸀猀攀挀漀渀搀伀昀䜀爀漀甀瀀嬀　崀⸀瘀愀氀甀攀⤀⤀ 笀 
				return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;਀ऀऀऀ紀 
		},਀ऀऀ⼀⨀⨀ 
		* Max number of checkbox selected਀ऀऀ⨀ 
		* @param {jqObject} field਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䄀爀爀愀礀嬀匀琀爀椀渀最崀紀 爀甀氀攀猀 
		* @param {int} i rules index਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䴀愀瀀紀 
		*            user options਀ऀऀ⨀ 䀀爀攀琀甀爀渀 愀渀 攀爀爀漀爀 猀琀爀椀渀最 椀昀 瘀愀氀椀搀愀琀椀漀渀 昀愀椀氀攀搀 
		*/਀ऀऀ开洀愀砀䌀栀攀挀欀戀漀砀㨀 昀甀渀挀琀椀漀渀⠀昀漀爀洀Ⰰ 昀椀攀氀搀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀⤀ 笀 
਀ऀऀऀ瘀愀爀 渀戀䌀栀攀挀欀 㴀 爀甀氀攀猀嬀椀 ⬀ ㄀崀㬀 
			var groupname = field.attr("name");਀ऀऀऀ瘀愀爀 最爀漀甀瀀匀椀稀攀 㴀 昀漀爀洀⸀昀椀渀搀⠀∀椀渀瀀甀琀嬀渀愀洀攀㴀✀∀ ⬀ 最爀漀甀瀀渀愀洀攀 ⬀ ∀✀崀㨀挀栀攀挀欀攀搀∀⤀⸀猀椀稀攀⠀⤀㬀 
			if (groupSize > nbCheck) {਀ऀऀऀऀ漀瀀琀椀漀渀猀⸀猀栀漀眀䄀爀爀漀眀 㴀 昀愀氀猀攀㬀 
				if (options.allrules.maxCheckbox.alertText2)਀ऀऀऀऀऀ 爀攀琀甀爀渀 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀⸀洀愀砀䌀栀攀挀欀戀漀砀⸀愀氀攀爀琀吀攀砀琀 ⬀ ∀ ∀ ⬀ 渀戀䌀栀攀挀欀 ⬀ ∀ ∀ ⬀ 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀⸀洀愀砀䌀栀攀挀欀戀漀砀⸀愀氀攀爀琀吀攀砀琀㈀㬀 
				return options.allrules.maxCheckbox.alertText;਀ऀऀऀ紀 
		},਀ऀऀ⼀⨀⨀ 
		* Min number of checkbox selected਀ऀऀ⨀ 
		* @param {jqObject} field਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䄀爀爀愀礀嬀匀琀爀椀渀最崀紀 爀甀氀攀猀 
		* @param {int} i rules index਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䴀愀瀀紀 
		*            user options਀ऀऀ⨀ 䀀爀攀琀甀爀渀 愀渀 攀爀爀漀爀 猀琀爀椀渀最 椀昀 瘀愀氀椀搀愀琀椀漀渀 昀愀椀氀攀搀 
		*/਀ऀऀ开洀椀渀䌀栀攀挀欀戀漀砀㨀 昀甀渀挀琀椀漀渀⠀昀漀爀洀Ⰰ 昀椀攀氀搀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀⤀ 笀 
਀ऀऀऀ瘀愀爀 渀戀䌀栀攀挀欀 㴀 爀甀氀攀猀嬀椀 ⬀ ㄀崀㬀 
			var groupname = field.attr("name");਀ऀऀऀ瘀愀爀 最爀漀甀瀀匀椀稀攀 㴀 昀漀爀洀⸀昀椀渀搀⠀∀椀渀瀀甀琀嬀渀愀洀攀㴀✀∀ ⬀ 最爀漀甀瀀渀愀洀攀 ⬀ ∀✀崀㨀挀栀攀挀欀攀搀∀⤀⸀猀椀稀攀⠀⤀㬀 
			if (groupSize < nbCheck) {਀ऀऀऀऀ漀瀀琀椀漀渀猀⸀猀栀漀眀䄀爀爀漀眀 㴀 昀愀氀猀攀㬀 
				return options.allrules.minCheckbox.alertText + " " + nbCheck + " " + options.allrules.minCheckbox.alertText2;਀ऀऀऀ紀 
		},਀ऀऀ⼀⨀⨀ 
		* Checks that it is a valid credit card number according to the਀ऀऀ⨀ 䰀甀栀渀 挀栀攀挀欀猀甀洀 愀氀最漀爀椀琀栀洀⸀ 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 昀椀攀氀搀 
		* @param {Array[String]} rules਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀椀渀琀紀 椀 爀甀氀攀猀 椀渀搀攀砀 
		* @param {Map}਀ऀऀ⨀            甀猀攀爀 漀瀀琀椀漀渀猀 
		* @return an error string if validation failed਀ऀऀ⨀⼀ 
		_creditCard: function(field, rules, i, options) {਀ऀऀऀ⼀⼀猀瀀愀挀攀猀 愀渀搀 搀愀猀栀攀猀 洀愀礀 戀攀 瘀愀氀椀搀 挀栀愀爀愀挀琀攀爀猀Ⰰ 戀甀琀 洀甀猀琀 戀攀 猀琀爀椀瀀瀀攀搀 琀漀 挀愀氀挀甀氀愀琀攀 琀栀攀 挀栀攀挀欀猀甀洀⸀ 
			var valid = false, cardNumber = field.val().replace(/ +/g, '').replace(/-+/g, '');਀ 
			var numDigits = cardNumber.length;਀ऀऀऀ椀昀 ⠀渀甀洀䐀椀最椀琀猀 㸀㴀 ㄀㐀 ☀☀ 渀甀洀䐀椀最椀琀猀 㰀㴀 ㄀㘀 ☀☀ 瀀愀爀猀攀䤀渀琀⠀挀愀爀搀一甀洀戀攀爀⤀ 㸀 　⤀ 笀 
਀ऀऀऀऀ瘀愀爀 猀甀洀 㴀 　Ⰰ 椀 㴀 渀甀洀䐀椀最椀琀猀 ⴀ ㄀Ⰰ 瀀漀猀 㴀 ㄀Ⰰ 搀椀最椀琀Ⰰ 氀甀栀渀 㴀 渀攀眀 匀琀爀椀渀最⠀⤀㬀 
				do {਀ऀऀऀऀऀ搀椀最椀琀 㴀 瀀愀爀猀攀䤀渀琀⠀挀愀爀搀一甀洀戀攀爀⸀挀栀愀爀䄀琀⠀椀⤀⤀㬀 
					luhn += (pos++ % 2 == 0) ? digit * 2 : digit;਀ऀऀऀऀ紀 眀栀椀氀攀 ⠀ⴀⴀ椀 㸀㴀 　⤀ 
਀ऀऀऀऀ昀漀爀 ⠀椀 㴀 　㬀 椀 㰀 氀甀栀渀⸀氀攀渀最琀栀㬀 椀⬀⬀⤀ 笀 
					sum += parseInt(luhn.charAt(i));਀ऀऀऀऀ紀 
				valid = sum % 10 == 0;਀ऀऀऀ紀 
			if (!valid) return options.allrules.creditCard.alertText;਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 䄀樀愀砀 昀椀攀氀搀 瘀愀氀椀搀愀琀椀漀渀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 昀椀攀氀搀 
		* @param {Array[String]} rules਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀椀渀琀紀 椀 爀甀氀攀猀 椀渀搀攀砀 
		* @param {Map}਀ऀऀ⨀            甀猀攀爀 漀瀀琀椀漀渀猀 
		* @return nothing! the ajax validator handles the prompts itself਀ऀऀ⨀⼀ 
		 _ajax: function(field, rules, i, options) {਀ 
			 var errorSelector = rules[i + 1];਀ऀऀऀ 瘀愀爀 爀甀氀攀 㴀 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀嬀攀爀爀漀爀匀攀氀攀挀琀漀爀崀㬀 
			 var extraData = rule.extraData;਀ऀऀऀ 瘀愀爀 攀砀琀爀愀䐀愀琀愀䐀礀渀愀洀椀挀 㴀 爀甀氀攀⸀攀砀琀爀愀䐀愀琀愀䐀礀渀愀洀椀挀㬀 
			 var data = {਀ऀऀऀऀ∀昀椀攀氀搀䤀搀∀ 㨀 昀椀攀氀搀⸀愀琀琀爀⠀∀椀搀∀⤀Ⰰ 
				"fieldValue" : field.val()਀ऀऀऀ 紀㬀 
਀ऀऀऀ 椀昀 ⠀琀礀瀀攀漀昀 攀砀琀爀愀䐀愀琀愀 㴀㴀㴀 ∀漀戀樀攀挀琀∀⤀ 笀 
				$.extend(data, extraData);਀ऀऀऀ 紀 攀氀猀攀 椀昀 ⠀琀礀瀀攀漀昀 攀砀琀爀愀䐀愀琀愀 㴀㴀㴀 ∀猀琀爀椀渀最∀⤀ 笀 
				var tempData = extraData.split("&");਀ऀऀऀऀ昀漀爀⠀瘀愀爀 椀 㴀 　㬀 椀 㰀 琀攀洀瀀䐀愀琀愀⸀氀攀渀最琀栀㬀 椀⬀⬀⤀ 笀 
					var values = tempData[i].split("=");਀ऀऀऀऀऀ椀昀 ⠀瘀愀氀甀攀猀嬀　崀 ☀☀ 瘀愀氀甀攀猀嬀　崀⤀ 笀 
						data[values[0]] = values[1];਀ऀऀऀऀऀ紀 
				}਀ऀऀऀ 紀 
਀ऀऀऀ 椀昀 ⠀攀砀琀爀愀䐀愀琀愀䐀礀渀愀洀椀挀⤀ 笀 
				 var tmpData = [];਀ऀऀऀऀ 瘀愀爀 搀漀洀䤀搀猀 㴀 匀琀爀椀渀最⠀攀砀琀爀愀䐀愀琀愀䐀礀渀愀洀椀挀⤀⸀猀瀀氀椀琀⠀∀Ⰰ∀⤀㬀 
				 for (var i = 0; i < domIds.length; i++) {਀ऀऀऀऀऀ 瘀愀爀 椀搀 㴀 搀漀洀䤀搀猀嬀椀崀㬀 
					 if ($(id).length) {਀ऀऀऀऀऀऀ 瘀愀爀 椀渀瀀甀琀嘀愀氀甀攀 㴀 昀椀攀氀搀⸀挀氀漀猀攀猀琀⠀∀昀漀爀洀Ⰰ ⸀瘀愀氀椀搀愀琀椀漀渀䔀渀最椀渀攀䌀漀渀琀愀椀渀攀爀∀⤀⸀昀椀渀搀⠀椀搀⤀⸀瘀愀氀⠀⤀㬀 
						 var keyValue = id.replace('#', '') + '=' + escape(inputValue);਀ऀऀऀऀऀऀ 搀愀琀愀嬀椀搀⸀爀攀瀀氀愀挀攀⠀✀⌀✀Ⰰ ✀✀⤀崀 㴀 椀渀瀀甀琀嘀愀氀甀攀㬀 
					 }਀ऀऀऀऀ 紀 
			 }਀ऀऀऀ  
			 // If a field change event triggered this we want to clear the cache for this ID਀ऀऀऀ 椀昀 ⠀漀瀀琀椀漀渀猀⸀攀瘀攀渀琀吀爀椀最最攀爀 㴀㴀 ∀昀椀攀氀搀∀⤀ 笀 
				delete(options.ajaxValidCache[field.attr("id")]);਀ऀऀऀ 紀 
਀ऀऀऀ ⼀⼀ 䤀昀 琀栀攀爀攀 椀猀 愀渀 攀爀爀漀爀 漀爀 椀昀 琀栀攀 琀栀攀 昀椀攀氀搀 椀猀 愀氀爀攀愀搀礀 瘀愀氀椀搀愀琀攀搀Ⰰ 搀漀 渀漀琀 爀攀ⴀ攀砀攀挀甀琀攀 䄀䨀䄀堀 
			 if (!options.isError && !methods._checkAjaxFieldStatus(field.attr("id"), options)) {਀ऀऀऀऀ ␀⸀愀樀愀砀⠀笀 
					 type: options.ajaxFormValidationMethod,਀ऀऀऀऀऀ 甀爀氀㨀 爀甀氀攀⸀甀爀氀Ⰰ 
					 cache: false,਀ऀऀऀऀऀ 搀愀琀愀吀礀瀀攀㨀 ∀樀猀漀渀∀Ⰰ 
					 data: data,਀ऀऀऀऀऀ 昀椀攀氀搀㨀 昀椀攀氀搀Ⰰ 
					 rule: rule,਀ऀऀऀऀऀ 洀攀琀栀漀搀猀㨀 洀攀琀栀漀搀猀Ⰰ 
					 options: options,਀ऀऀऀऀऀ 戀攀昀漀爀攀匀攀渀搀㨀 昀甀渀挀琀椀漀渀⠀⤀ 笀紀Ⰰ 
					 error: function(data, transport) {਀ऀऀऀऀऀऀ椀昀 ⠀漀瀀琀椀漀渀猀⸀漀渀䘀愀椀氀甀爀攀⤀ 笀 
							options.onFailure(data, transport);਀ऀऀऀऀऀऀ紀 攀氀猀攀 笀 
							methods._ajaxError(data, transport);਀ऀऀऀऀऀऀ紀 
					 },਀ऀऀऀऀऀ 猀甀挀挀攀猀猀㨀 昀甀渀挀琀椀漀渀⠀樀猀漀渀⤀ 笀 
਀ऀऀऀऀऀऀ ⼀⼀ 愀猀礀渀挀栀爀漀渀漀甀猀氀礀 挀愀氀氀攀搀 漀渀 猀甀挀挀攀猀猀Ⰰ 搀愀琀愀 椀猀 琀栀攀 樀猀漀渀 愀渀猀眀攀爀 昀爀漀洀 琀栀攀 猀攀爀瘀攀爀 
						 var errorFieldId = json[0];਀ऀऀऀऀऀऀ ⼀⼀瘀愀爀 攀爀爀漀爀䘀椀攀氀搀 㴀 ␀⠀␀⠀∀⌀∀ ⬀ 攀爀爀漀爀䘀椀攀氀搀䤀搀⤀嬀　崀⤀㬀 
						 var errorField = $("#"+ errorFieldId).eq(0);਀ 
						 // make sure we found the element਀ऀऀऀऀऀऀ 椀昀 ⠀攀爀爀漀爀䘀椀攀氀搀⸀氀攀渀最琀栀 㴀㴀 ㄀⤀ 笀 
							 var status = json[1];਀ऀऀऀऀऀऀऀ ⼀⼀ 爀攀愀搀 琀栀攀 漀瀀琀椀漀渀愀氀 洀猀最 昀爀漀洀 琀栀攀 猀攀爀瘀攀爀 
							 var msg = json[2];਀ऀऀऀऀऀऀऀ 椀昀 ⠀℀猀琀愀琀甀猀⤀ 笀 
								 // Houston we got a problem - display an red prompt਀ऀऀऀऀऀऀऀऀ 漀瀀琀椀漀渀猀⸀愀樀愀砀嘀愀氀椀搀䌀愀挀栀攀嬀攀爀爀漀爀䘀椀攀氀搀䤀搀崀 㴀 昀愀氀猀攀㬀 
								 options.isError = true;਀ 
								 // resolve the msg prompt਀ऀऀऀऀऀऀऀऀ 椀昀⠀洀猀最⤀ 笀 
									 if (options.allrules[msg]) {਀ऀऀऀऀऀऀऀऀऀऀ 瘀愀爀 琀砀琀 㴀 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀嬀洀猀最崀⸀愀氀攀爀琀吀攀砀琀㬀 
										 if (txt) {਀ऀऀऀऀऀऀऀऀऀऀऀ洀猀最 㴀 琀砀琀㬀 
							}਀ऀऀऀऀऀऀऀऀऀ 紀 
								 }਀ऀऀऀऀऀऀऀऀ 攀氀猀攀 
									msg = rule.alertText;਀ 
								 if (options.showPrompts) methods._showPrompt(errorField, msg, "", true, options);਀ऀऀऀऀऀऀऀ 紀 攀氀猀攀 笀 
								 options.ajaxValidCache[errorFieldId] = true;਀ 
								 // resolves the msg prompt਀ऀऀऀऀऀऀऀऀ 椀昀⠀洀猀最⤀ 笀 
									 if (options.allrules[msg]) {਀ऀऀऀऀऀऀऀऀऀऀ 瘀愀爀 琀砀琀 㴀 漀瀀琀椀漀渀猀⸀愀氀氀爀甀氀攀猀嬀洀猀最崀⸀愀氀攀爀琀吀攀砀琀伀欀㬀 
										 if (txt) {਀ऀऀऀऀऀऀऀऀऀऀऀ洀猀最 㴀 琀砀琀㬀 
							}਀ऀऀऀऀऀऀऀऀऀ 紀 
								 }਀ऀऀऀऀऀऀऀऀ 攀氀猀攀 
								 msg = rule.alertTextOk;਀ 
								 if (options.showPrompts) {਀ऀऀऀऀऀऀऀऀऀ ⼀⼀ 猀攀攀 椀昀 眀攀 猀栀漀甀氀搀 搀椀猀瀀氀愀礀 愀 最爀攀攀渀 瀀爀漀洀瀀琀 
									 if (msg)਀ऀऀऀऀऀऀऀऀऀऀ洀攀琀栀漀搀猀⸀开猀栀漀眀倀爀漀洀瀀琀⠀攀爀爀漀爀䘀椀攀氀搀Ⰰ 洀猀最Ⰰ ∀瀀愀猀猀∀Ⰰ 琀爀甀攀Ⰰ 漀瀀琀椀漀渀猀⤀㬀 
									 else਀ऀऀऀऀऀऀऀऀऀऀ洀攀琀栀漀搀猀⸀开挀氀漀猀攀倀爀漀洀瀀琀⠀攀爀爀漀爀䘀椀攀氀搀⤀㬀 
								}਀ऀऀऀऀऀऀऀऀ 
								 // If a submit form triggered this, we want to re-submit the form਀ऀऀऀऀऀऀऀऀ 椀昀 ⠀漀瀀琀椀漀渀猀⸀攀瘀攀渀琀吀爀椀最最攀爀 㴀㴀 ∀猀甀戀洀椀琀∀⤀ 
									field.closest("form").submit();਀ऀऀऀऀऀऀऀ 紀 
						 }਀ऀऀऀऀऀऀ 攀爀爀漀爀䘀椀攀氀搀⸀琀爀椀最最攀爀⠀∀樀焀瘀⸀昀椀攀氀搀⸀爀攀猀甀氀琀∀Ⰰ 嬀攀爀爀漀爀䘀椀攀氀搀Ⰰ 漀瀀琀椀漀渀猀⸀椀猀䔀爀爀漀爀Ⰰ 洀猀最崀⤀㬀 
					 }਀ऀऀऀऀ 紀⤀㬀 
				 ਀ऀऀऀऀ 爀攀琀甀爀渀 爀甀氀攀⸀愀氀攀爀琀吀攀砀琀䰀漀愀搀㬀 
			 }਀ऀऀ 紀Ⰰ 
		/**਀ऀऀ⨀ 䌀漀洀洀漀渀 洀攀琀栀漀搀 琀漀 栀愀渀搀氀攀 愀樀愀砀 攀爀爀漀爀猀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀伀戀樀攀挀琀紀 搀愀琀愀 
		* @param {Object} transport਀ऀऀ⨀⼀ 
		_ajaxError: function(data, transport) {਀ऀऀऀ椀昀⠀搀愀琀愀⸀猀琀愀琀甀猀 㴀㴀 　 ☀☀ 琀爀愀渀猀瀀漀爀琀 㴀㴀 渀甀氀氀⤀ 
				alert("The page is not served from a server! ajax call failed");਀ऀऀऀ攀氀猀攀 椀昀⠀琀礀瀀攀漀昀 挀漀渀猀漀氀攀 ℀㴀 ∀甀渀搀攀昀椀渀攀搀∀⤀ 
				console.log("Ajax error: " + data.status + " " + transport);਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 搀愀琀攀 ⴀ㸀 猀琀爀椀渀最 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀伀戀樀攀挀琀紀 搀愀琀攀 
		*/਀ऀऀ开搀愀琀攀吀漀匀琀爀椀渀最㨀 昀甀渀挀琀椀漀渀⠀搀愀琀攀⤀ 笀 
			return date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 倀愀爀猀攀猀 愀渀 䤀匀伀 搀愀琀攀 
		* @param {String} d਀ऀऀ⨀⼀ 
		_parseDate: function(d) {਀ 
			var dateParts = d.split("-");਀ऀऀऀ椀昀⠀搀愀琀攀倀愀爀琀猀㴀㴀搀⤀ 
				dateParts = d.split("/");਀ऀऀऀ椀昀⠀搀愀琀攀倀愀爀琀猀㴀㴀搀⤀ 笀 
				dateParts = d.split(".");਀ऀऀऀऀ爀攀琀甀爀渀 渀攀眀 䐀愀琀攀⠀搀愀琀攀倀愀爀琀猀嬀㈀崀Ⰰ ⠀搀愀琀攀倀愀爀琀猀嬀㄀崀 ⴀ ㄀⤀Ⰰ 搀愀琀攀倀愀爀琀猀嬀　崀⤀㬀 
			}਀ऀऀऀ爀攀琀甀爀渀 渀攀眀 䐀愀琀攀⠀搀愀琀攀倀愀爀琀猀嬀　崀Ⰰ ⠀搀愀琀攀倀愀爀琀猀嬀㄀崀 ⴀ ㄀⤀ Ⰰ搀愀琀攀倀愀爀琀猀嬀㈀崀⤀㬀 
		},਀ऀऀ⼀⨀⨀ 
		* Builds or updates a prompt with the given information਀ऀऀ⨀ 
		* @param {jqObject} field਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀匀琀爀椀渀最紀 瀀爀漀洀瀀琀吀攀砀琀 栀琀洀氀 琀攀砀琀 琀漀 搀椀猀瀀氀愀礀 琀礀瀀攀 
		* @param {String} type the type of bubble: 'pass' (green), 'load' (black) anything else (red)਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀戀漀漀氀攀愀渀紀 愀樀愀砀攀搀 ⴀ 甀猀攀 琀漀 洀愀爀欀 昀椀攀氀搀猀 琀栀愀渀 戀攀椀渀最 瘀愀氀椀搀愀琀攀搀 眀椀琀栀 愀樀愀砀 
		* @param {Map} options user options਀ऀऀ⨀⼀ 
		 _showPrompt: function(field, promptText, type, ajaxed, options, ajaxform) {਀ऀऀ ऀ⼀⼀䌀栀攀挀欀 椀昀 眀攀 渀攀攀搀 琀漀 愀搀樀甀猀琀 眀栀愀琀 攀氀攀洀攀渀琀 琀漀 猀栀漀眀 琀栀攀 瀀爀漀洀瀀琀 漀渀 
			if(field.data('jqv-prompt-at') instanceof jQuery ){਀ऀऀऀऀ昀椀攀氀搀 㴀 昀椀攀氀搀⸀搀愀琀愀⠀✀樀焀瘀ⴀ瀀爀漀洀瀀琀ⴀ愀琀✀⤀㬀 
			} else if(field.data('jqv-prompt-at')) {਀ऀऀऀऀ昀椀攀氀搀 㴀 ␀⠀昀椀攀氀搀⸀搀愀琀愀⠀✀樀焀瘀ⴀ瀀爀漀洀瀀琀ⴀ愀琀✀⤀⤀㬀 
			}਀ 
			 var prompt = methods._getPrompt(field);਀ऀऀऀ ⼀⼀ 吀栀攀 愀樀愀砀 猀甀戀洀椀琀 攀爀爀漀爀猀 愀爀攀 渀漀琀 猀攀攀 栀愀猀 愀渀 攀爀爀漀爀 椀渀 琀栀攀 昀漀爀洀Ⰰ 
			 // When the form errors are returned, the engine see 2 bubbles, but those are ebing closed by the engine at the same time਀ऀऀऀ ⼀⼀ 䈀攀挀愀甀猀攀 渀漀 攀爀爀漀爀 眀愀猀 昀漀甀渀搀 戀攀昀漀爀 猀甀戀洀椀琀琀椀渀最 
			 if(ajaxform) prompt = false;਀ऀऀऀ ⼀⼀ 䌀栀攀挀欀 琀栀愀琀 琀栀攀爀攀 椀猀 椀渀搀搀攀搀 琀攀砀琀 
			 if($.trim(promptText)){ ਀ऀऀऀऀ 椀昀 ⠀瀀爀漀洀瀀琀⤀ 
					methods._updatePrompt(field, prompt, promptText, type, ajaxed, options);਀ऀऀऀऀ 攀氀猀攀 
					methods._buildPrompt(field, promptText, type, ajaxed, options);਀ऀऀऀ紀 
		 },਀ऀऀ⼀⨀⨀ 
		* Builds and shades a prompt for the given field.਀ऀऀ⨀ 
		* @param {jqObject} field਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀匀琀爀椀渀最紀 瀀爀漀洀瀀琀吀攀砀琀 栀琀洀氀 琀攀砀琀 琀漀 搀椀猀瀀氀愀礀 琀礀瀀攀 
		* @param {String} type the type of bubble: 'pass' (green), 'load' (black) anything else (red)਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀戀漀漀氀攀愀渀紀 愀樀愀砀攀搀 ⴀ 甀猀攀 琀漀 洀愀爀欀 昀椀攀氀搀猀 琀栀愀渀 戀攀椀渀最 瘀愀氀椀搀愀琀攀搀 眀椀琀栀 愀樀愀砀 
		* @param {Map} options user options਀ऀऀ⨀⼀ 
		_buildPrompt: function(field, promptText, type, ajaxed, options) {਀ 
			// create the prompt਀ऀऀऀ瘀愀爀 瀀爀漀洀瀀琀 㴀 ␀⠀✀㰀搀椀瘀㸀✀⤀㬀 
			prompt.addClass(methods._getClassName(field.attr("id")) + "formError");਀ऀऀऀ⼀⼀ 愀搀搀 愀 挀氀愀猀猀 渀愀洀攀 琀漀 椀搀攀渀琀椀昀礀 琀栀攀 瀀愀爀攀渀琀 昀漀爀洀 漀昀 琀栀攀 瀀爀漀洀瀀琀 
			prompt.addClass("parentForm"+methods._getClassName(field.closest('form, .validationEngineContainer').attr("id")));਀ऀऀऀ瀀爀漀洀瀀琀⸀愀搀搀䌀氀愀猀猀⠀∀昀漀爀洀䔀爀爀漀爀∀⤀㬀 
਀ऀऀऀ猀眀椀琀挀栀 ⠀琀礀瀀攀⤀ 笀 
				case "pass":਀ऀऀऀऀऀ瀀爀漀洀瀀琀⸀愀搀搀䌀氀愀猀猀⠀∀最爀攀攀渀倀漀瀀甀瀀∀⤀㬀 
					break;਀ऀऀऀऀ挀愀猀攀 ∀氀漀愀搀∀㨀 
					prompt.addClass("blackPopup");਀ऀऀऀऀऀ戀爀攀愀欀㬀 
				default:਀ऀऀऀऀऀ⼀⨀ 椀琀 栀愀猀 攀爀爀漀爀  ⨀⼀ 
					//alert("unknown popup type:"+type);਀ऀऀऀ紀 
			if (ajaxed)਀ऀऀऀऀ瀀爀漀洀瀀琀⸀愀搀搀䌀氀愀猀猀⠀∀愀樀愀砀攀搀∀⤀㬀 
਀ऀऀऀ⼀⼀ 挀爀攀愀琀攀 琀栀攀 瀀爀漀洀瀀琀 挀漀渀琀攀渀琀 
			var promptContent = $('<div>').addClass("formErrorContent").html(promptText).appendTo(prompt);਀ 
			// determine position type਀ऀऀऀ瘀愀爀 瀀漀猀椀琀椀漀渀吀礀瀀攀㴀昀椀攀氀搀⸀搀愀琀愀⠀∀瀀爀漀洀瀀琀倀漀猀椀琀椀漀渀∀⤀ 簀簀 漀瀀琀椀漀渀猀⸀瀀爀漀洀瀀琀倀漀猀椀琀椀漀渀㬀 
਀ऀऀऀ⼀⼀ 挀爀攀愀琀攀 琀栀攀 挀猀猀 愀爀爀漀眀 瀀漀椀渀琀椀渀最 愀琀 琀栀攀 昀椀攀氀搀 
			// note that there is no triangle on max-checkbox and radio਀ऀऀऀ椀昀 ⠀漀瀀琀椀漀渀猀⸀猀栀漀眀䄀爀爀漀眀⤀ 笀 
				var arrow = $('<div>').addClass("formErrorArrow");਀ 
				//prompt positioning adjustment support. Usage: positionType:Xshift,Yshift (for ex.: bottomLeft:+20 or bottomLeft:-20,+10)਀ऀऀऀऀ椀昀 ⠀琀礀瀀攀漀昀⠀瀀漀猀椀琀椀漀渀吀礀瀀攀⤀㴀㴀✀猀琀爀椀渀最✀⤀  
				{਀ऀऀऀऀऀ瘀愀爀 瀀漀猀㴀瀀漀猀椀琀椀漀渀吀礀瀀攀⸀椀渀搀攀砀伀昀⠀∀㨀∀⤀㬀 
					if(pos!=-1)਀ऀऀऀऀऀऀ瀀漀猀椀琀椀漀渀吀礀瀀攀㴀瀀漀猀椀琀椀漀渀吀礀瀀攀⸀猀甀戀猀琀爀椀渀最⠀　Ⰰ瀀漀猀⤀㬀 
				}਀ 
				switch (positionType) {਀ऀऀऀऀऀ挀愀猀攀 ∀戀漀琀琀漀洀䰀攀昀琀∀㨀 
					case "bottomRight":਀ऀऀऀऀऀऀ瀀爀漀洀瀀琀⸀昀椀渀搀⠀∀⸀昀漀爀洀䔀爀爀漀爀䌀漀渀琀攀渀琀∀⤀⸀戀攀昀漀爀攀⠀愀爀爀漀眀⤀㬀 
						arrow.addClass("formErrorArrowBottom").html('<div class="line1"><!-- --></div><div class="line2"><!-- --></div><div class="line3"><!-- --></div><div class="line4"><!-- --></div><div class="line5"><!-- --></div><div class="line6"><!-- --></div><div class="line7"><!-- --></div><div class="line8"><!-- --></div><div class="line9"><!-- --></div><div class="line10"><!-- --></div>');਀ऀऀऀऀऀऀ戀爀攀愀欀㬀 
					case "topLeft":਀ऀऀऀऀऀ挀愀猀攀 ∀琀漀瀀刀椀最栀琀∀㨀 
						arrow.html('<div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div>');਀ऀऀऀऀऀऀ瀀爀漀洀瀀琀⸀愀瀀瀀攀渀搀⠀愀爀爀漀眀⤀㬀 
						break;਀ऀऀऀऀ紀 
			}਀ऀऀऀ⼀⼀ 䄀搀搀 挀甀猀琀漀洀 瀀爀漀洀瀀琀 挀氀愀猀猀 
			if (options.addPromptClass)਀ऀऀऀऀ瀀爀漀洀瀀琀⸀愀搀搀䌀氀愀猀猀⠀漀瀀琀椀漀渀猀⸀愀搀搀倀爀漀洀瀀琀䌀氀愀猀猀⤀㬀 
਀            ⼀⼀ 䄀搀搀 挀甀猀琀漀洀 瀀爀漀洀瀀琀 挀氀愀猀猀 搀攀昀椀渀攀搀 椀渀 攀氀攀洀攀渀琀 
            var requiredOverride = field.attr('data-required-class');਀            椀昀⠀爀攀焀甀椀爀攀搀伀瘀攀爀爀椀搀攀 ℀㴀㴀 甀渀搀攀昀椀渀攀搀⤀ 笀 
                prompt.addClass(requiredOverride);਀            紀 攀氀猀攀 笀 
                if(options.prettySelect) {਀                    椀昀⠀␀⠀✀⌀✀ ⬀ 昀椀攀氀搀⸀愀琀琀爀⠀✀椀搀✀⤀⤀⸀渀攀砀琀⠀⤀⸀椀猀⠀✀猀攀氀攀挀琀✀⤀⤀ 笀 
                        var prettyOverrideClass = $('#' + field.attr('id').substr(options.usePrefix.length).substring(options.useSuffix.length)).attr('data-required-class');਀                        椀昀⠀瀀爀攀琀琀礀伀瘀攀爀爀椀搀攀䌀氀愀猀猀 ℀㴀㴀 甀渀搀攀昀椀渀攀搀⤀ 笀 
                            prompt.addClass(prettyOverrideClass);਀                        紀 
                    }਀                紀 
            }਀ 
			prompt.css({਀ऀऀऀऀ∀漀瀀愀挀椀琀礀∀㨀 　 
			});਀ऀऀऀ椀昀⠀瀀漀猀椀琀椀漀渀吀礀瀀攀 㴀㴀㴀 ✀椀渀氀椀渀攀✀⤀ 笀 
				prompt.addClass("inline");਀ऀऀऀऀ椀昀⠀琀礀瀀攀漀昀 昀椀攀氀搀⸀愀琀琀爀⠀✀搀愀琀愀ⴀ瀀爀漀洀瀀琀ⴀ琀愀爀最攀琀✀⤀ ℀㴀㴀 ✀甀渀搀攀昀椀渀攀搀✀ ☀☀ ␀⠀✀⌀✀⬀昀椀攀氀搀⸀愀琀琀爀⠀✀搀愀琀愀ⴀ瀀爀漀洀瀀琀ⴀ琀愀爀最攀琀✀⤀⤀⸀氀攀渀最琀栀 㸀 　⤀ 笀 
					prompt.appendTo($('#'+field.attr('data-prompt-target')));਀ऀऀऀऀ紀 攀氀猀攀 笀 
					field.after(prompt);਀ऀऀऀऀ紀 
			} else {਀ऀऀऀऀ昀椀攀氀搀⸀戀攀昀漀爀攀⠀瀀爀漀洀瀀琀⤀㬀ऀऀऀऀ 
			}਀ऀऀऀ 
			var pos = methods._calculatePosition(field, prompt, options);਀ऀऀऀ瀀爀漀洀瀀琀⸀挀猀猀⠀笀 
				'position': positionType === 'inline' ? 'relative' : 'absolute',਀ऀऀऀऀ∀琀漀瀀∀㨀 瀀漀猀⸀挀愀氀氀攀爀吀漀瀀倀漀猀椀琀椀漀渀Ⰰ 
				"left": pos.callerleftPosition,਀ऀऀऀऀ∀洀愀爀最椀渀吀漀瀀∀㨀 瀀漀猀⸀洀愀爀最椀渀吀漀瀀匀椀稀攀Ⰰ 
				"opacity": 0਀ऀऀऀ紀⤀⸀搀愀琀愀⠀∀挀愀氀氀攀爀䘀椀攀氀搀∀Ⰰ 昀椀攀氀搀⤀㬀 
			਀ 
			if (options.autoHidePrompt) {਀ऀऀऀऀ猀攀琀吀椀洀攀漀甀琀⠀昀甀渀挀琀椀漀渀⠀⤀笀 
					prompt.animate({਀ऀऀऀऀऀऀ∀漀瀀愀挀椀琀礀∀㨀 　 
					},function(){਀ऀऀऀऀऀऀ瀀爀漀洀瀀琀⸀挀氀漀猀攀猀琀⠀✀⸀昀漀爀洀䔀爀爀漀爀伀甀琀攀爀✀⤀⸀爀攀洀漀瘀攀⠀⤀㬀 
						prompt.remove();਀ऀऀऀऀऀ紀⤀㬀 
				}, options.autoHideDelay);਀ऀऀऀ紀  
			return prompt.animate({਀ऀऀऀऀ∀漀瀀愀挀椀琀礀∀㨀 　⸀㠀㜀 
			});਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 唀瀀搀愀琀攀猀 琀栀攀 瀀爀漀洀瀀琀 琀攀砀琀 昀椀攀氀搀 ⴀ 琀栀攀 昀椀攀氀搀 昀漀爀 眀栀椀挀栀 琀栀攀 瀀爀漀洀瀀琀 
		* @param {jqObject} field਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀匀琀爀椀渀最紀 瀀爀漀洀瀀琀吀攀砀琀 栀琀洀氀 琀攀砀琀 琀漀 搀椀猀瀀氀愀礀 琀礀瀀攀 
		* @param {String} type the type of bubble: 'pass' (green), 'load' (black) anything else (red)਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀戀漀漀氀攀愀渀紀 愀樀愀砀攀搀 ⴀ 甀猀攀 琀漀 洀愀爀欀 昀椀攀氀搀猀 琀栀愀渀 戀攀椀渀最 瘀愀氀椀搀愀琀攀搀 眀椀琀栀 愀樀愀砀 
		* @param {Map} options user options਀ऀऀ⨀⼀ 
		_updatePrompt: function(field, prompt, promptText, type, ajaxed, options, noAnimation) {਀ 
			if (prompt) {਀ऀऀऀऀ椀昀 ⠀琀礀瀀攀漀昀 琀礀瀀攀 ℀㴀㴀 ∀甀渀搀攀昀椀渀攀搀∀⤀ 笀 
					if (type == "pass")਀ऀऀऀऀऀऀ瀀爀漀洀瀀琀⸀愀搀搀䌀氀愀猀猀⠀∀最爀攀攀渀倀漀瀀甀瀀∀⤀㬀 
					else਀ऀऀऀऀऀऀ瀀爀漀洀瀀琀⸀爀攀洀漀瘀攀䌀氀愀猀猀⠀∀最爀攀攀渀倀漀瀀甀瀀∀⤀㬀 
਀ऀऀऀऀऀ椀昀 ⠀琀礀瀀攀 㴀㴀 ∀氀漀愀搀∀⤀ 
						prompt.addClass("blackPopup");਀ऀऀऀऀऀ攀氀猀攀 
						prompt.removeClass("blackPopup");਀ऀऀऀऀ紀 
				if (ajaxed)਀ऀऀऀऀऀ瀀爀漀洀瀀琀⸀愀搀搀䌀氀愀猀猀⠀∀愀樀愀砀攀搀∀⤀㬀 
				else਀ऀऀऀऀऀ瀀爀漀洀瀀琀⸀爀攀洀漀瘀攀䌀氀愀猀猀⠀∀愀樀愀砀攀搀∀⤀㬀 
਀ऀऀऀऀ瀀爀漀洀瀀琀⸀昀椀渀搀⠀∀⸀昀漀爀洀䔀爀爀漀爀䌀漀渀琀攀渀琀∀⤀⸀栀琀洀氀⠀瀀爀漀洀瀀琀吀攀砀琀⤀㬀 
਀ऀऀऀऀ瘀愀爀 瀀漀猀 㴀 洀攀琀栀漀搀猀⸀开挀愀氀挀甀氀愀琀攀倀漀猀椀琀椀漀渀⠀昀椀攀氀搀Ⰰ 瀀爀漀洀瀀琀Ⰰ 漀瀀琀椀漀渀猀⤀㬀 
				var css = {"top": pos.callerTopPosition,਀ऀऀऀऀ∀氀攀昀琀∀㨀 瀀漀猀⸀挀愀氀氀攀爀氀攀昀琀倀漀猀椀琀椀漀渀Ⰰ 
				"marginTop": pos.marginTopSize};਀ 
				if (noAnimation)਀ऀऀऀऀऀ瀀爀漀洀瀀琀⸀挀猀猀⠀挀猀猀⤀㬀 
				else਀ऀऀऀऀऀ瀀爀漀洀瀀琀⸀愀渀椀洀愀琀攀⠀挀猀猀⤀㬀 
			}਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 䌀氀漀猀攀猀 琀栀攀 瀀爀漀洀瀀琀 愀猀猀漀挀椀愀琀攀搀 眀椀琀栀 琀栀攀 最椀瘀攀渀 昀椀攀氀搀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 
		*            field਀ऀऀ⨀⼀ 
		 _closePrompt: function(field) {਀ऀऀऀ 瘀愀爀 瀀爀漀洀瀀琀 㴀 洀攀琀栀漀搀猀⸀开最攀琀倀爀漀洀瀀琀⠀昀椀攀氀搀⤀㬀 
			 if (prompt)਀ऀऀऀऀ 瀀爀漀洀瀀琀⸀昀愀搀攀吀漀⠀∀昀愀猀琀∀Ⰰ 　Ⰰ 昀甀渀挀琀椀漀渀⠀⤀ 笀 
					 prompt.parent('.formErrorOuter').remove();਀ऀऀऀऀऀ 瀀爀漀洀瀀琀⸀爀攀洀漀瘀攀⠀⤀㬀 
				 });਀ऀऀ 紀Ⰰ 
		 closePrompt: function(field) {਀ऀऀऀ 爀攀琀甀爀渀 洀攀琀栀漀搀猀⸀开挀氀漀猀攀倀爀漀洀瀀琀⠀昀椀攀氀搀⤀㬀 
		 },਀ऀऀ⼀⨀⨀ 
		* Returns the error prompt matching the field if any਀ऀऀ⨀ 
		* @param {jqObject}਀ऀऀ⨀            昀椀攀氀搀 
		* @return undefined or the error prompt (jqObject)਀ऀऀ⨀⼀ 
		_getPrompt: function(field) {਀ऀऀऀऀ瘀愀爀 昀漀爀洀䤀搀 㴀 ␀⠀昀椀攀氀搀⤀⸀挀氀漀猀攀猀琀⠀✀昀漀爀洀Ⰰ ⸀瘀愀氀椀搀愀琀椀漀渀䔀渀最椀渀攀䌀漀渀琀愀椀渀攀爀✀⤀⸀愀琀琀爀⠀✀椀搀✀⤀㬀 
			var className = methods._getClassName(field.attr("id")) + "formError";਀ऀऀऀऀ瘀愀爀 洀愀琀挀栀 㴀 ␀⠀∀⸀∀ ⬀ 洀攀琀栀漀搀猀⸀开攀猀挀愀瀀攀䔀砀瀀爀攀猀猀椀漀渀⠀挀氀愀猀猀一愀洀攀⤀ ⬀ ✀⸀瀀愀爀攀渀琀䘀漀爀洀✀ ⬀ 洀攀琀栀漀搀猀⸀开最攀琀䌀氀愀猀猀一愀洀攀⠀昀漀爀洀䤀搀⤀⤀嬀　崀㬀 
			if (match)਀ऀऀऀ爀攀琀甀爀渀 ␀⠀洀愀琀挀栀⤀㬀 
		},਀ऀऀ⼀⨀⨀ 
		  * Returns the escapade classname਀ऀऀ  ⨀ 
		  * @param {selector}਀ऀऀ  ⨀            挀氀愀猀猀一愀洀攀 
		  */਀ऀऀ  开攀猀挀愀瀀攀䔀砀瀀爀攀猀猀椀漀渀㨀 昀甀渀挀琀椀漀渀 ⠀猀攀氀攀挀琀漀爀⤀ 笀 
			  return selector.replace(/([#;&,\.\+\*\~':"\!\^$\[\]\(\)=>\|])/g, "\\$1");਀ऀऀ  紀Ⰰ 
		/**਀ऀऀ ⨀ 爀攀琀甀爀渀猀 琀爀甀攀 椀昀 眀攀 愀爀攀 椀渀 愀 刀吀䰀攀搀 搀漀挀甀洀攀渀琀 
		 *਀ऀऀ ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 昀椀攀氀搀 
		 */਀ऀऀ椀猀刀吀䰀㨀 昀甀渀挀琀椀漀渀⠀昀椀攀氀搀⤀ 
		{਀ऀऀऀ瘀愀爀 ␀搀漀挀甀洀攀渀琀 㴀 ␀⠀搀漀挀甀洀攀渀琀⤀㬀 
			var $body = $('body');਀ऀऀऀ瘀愀爀 爀琀氀 㴀 
				(field && field.hasClass('rtl')) ||਀ऀऀऀऀ⠀昀椀攀氀搀 ☀☀ ⠀昀椀攀氀搀⸀愀琀琀爀⠀✀搀椀爀✀⤀ 簀簀 ✀✀⤀⸀琀漀䰀漀眀攀爀䌀愀猀攀⠀⤀㴀㴀㴀✀爀琀氀✀⤀ 簀簀 
				$document.hasClass('rtl') ||਀ऀऀऀऀ⠀␀搀漀挀甀洀攀渀琀⸀愀琀琀爀⠀✀搀椀爀✀⤀ 簀簀 ✀✀⤀⸀琀漀䰀漀眀攀爀䌀愀猀攀⠀⤀㴀㴀㴀✀爀琀氀✀ 簀簀 
				$body.hasClass('rtl') ||਀ऀऀऀऀ⠀␀戀漀搀礀⸀愀琀琀爀⠀✀搀椀爀✀⤀ 簀簀 ✀✀⤀⸀琀漀䰀漀眀攀爀䌀愀猀攀⠀⤀㴀㴀㴀✀爀琀氀✀㬀 
			return Boolean(rtl);਀ऀऀ紀Ⰰ 
		/**਀ऀऀ⨀ 䌀愀氀挀甀氀愀琀攀猀 瀀爀漀洀瀀琀 瀀漀猀椀琀椀漀渀 
		*਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 
		*            field਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀樀焀伀戀樀攀挀琀紀 
		*            the prompt਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䴀愀瀀紀 
		*            options਀ऀऀ⨀ 䀀爀攀琀甀爀渀 瀀漀猀椀琀椀漀渀猀 
		*/਀ऀऀ开挀愀氀挀甀氀愀琀攀倀漀猀椀琀椀漀渀㨀 昀甀渀挀琀椀漀渀 ⠀昀椀攀氀搀Ⰰ 瀀爀漀洀瀀琀䔀氀洀琀Ⰰ 漀瀀琀椀漀渀猀⤀ 笀 
਀ऀऀऀ瘀愀爀 瀀爀漀洀瀀琀吀漀瀀倀漀猀椀琀椀漀渀Ⰰ 瀀爀漀洀瀀琀氀攀昀琀倀漀猀椀琀椀漀渀Ⰰ 洀愀爀最椀渀吀漀瀀匀椀稀攀㬀 
			var fieldWidth 	= field.width();਀ऀऀऀ瘀愀爀 昀椀攀氀搀䰀攀昀琀 ऀ㴀 昀椀攀氀搀⸀瀀漀猀椀琀椀漀渀⠀⤀⸀氀攀昀琀㬀  
			var fieldTop 	=  field.position().top;਀ऀऀऀ瘀愀爀 昀椀攀氀搀䠀攀椀最栀琀 ऀ㴀  昀椀攀氀搀⸀栀攀椀最栀琀⠀⤀㬀ऀ 
			var promptHeight = promptElmt.height();਀ 
਀ऀऀऀ⼀⼀ 椀猀 琀栀攀 昀漀爀洀 挀漀渀琀愀椀渀攀搀 椀渀 愀渀 漀瘀攀爀昀氀漀眀渀 挀漀渀琀愀椀渀攀爀㼀 
			promptTopPosition = promptleftPosition = 0;਀ऀऀऀ⼀⼀ 挀漀洀瀀攀渀猀愀琀椀漀渀 昀漀爀 琀栀攀 愀爀爀漀眀 
			marginTopSize = -promptHeight;਀ऀऀ 
਀ऀऀऀ⼀⼀瀀爀漀洀瀀琀 瀀漀猀椀琀椀漀渀椀渀最 愀搀樀甀猀琀洀攀渀琀 猀甀瀀瀀漀爀琀 
			//now you can adjust prompt position਀ऀऀऀ⼀⼀甀猀愀最攀㨀 瀀漀猀椀琀椀漀渀吀礀瀀攀㨀堀猀栀椀昀琀Ⰰ夀猀栀椀昀琀 
			//for example:਀ऀऀऀ⼀⼀   戀漀琀琀漀洀䰀攀昀琀㨀⬀㈀　 洀攀愀渀猀 戀漀琀琀漀洀䰀攀昀琀 瀀漀猀椀琀椀漀渀 猀栀椀昀琀攀搀 戀礀 ㈀　 瀀椀砀攀氀猀 爀椀最栀琀 栀漀爀椀稀漀渀琀愀氀氀礀 
			//   topRight:20, -15 means topRight position shifted by 20 pixels to right and 15 pixels to top਀ऀऀऀ⼀⼀夀漀甀 挀愀渀 甀猀攀 ⬀瀀椀砀攀氀猀Ⰰ ⴀ 瀀椀砀攀氀猀⸀ 䤀昀 渀漀 猀椀最渀 椀猀 瀀爀漀瘀椀搀攀搀 琀栀愀渀 ⬀ 椀猀 搀攀昀愀甀氀琀⸀ 
			var positionType=field.data("promptPosition") || options.promptPosition;਀ऀऀऀ瘀愀爀 猀栀椀昀琀㄀㴀∀∀㬀 
			var shift2="";਀ऀऀऀ瘀愀爀 猀栀椀昀琀堀㴀　㬀 
			var shiftY=0;਀ऀऀऀ椀昀 ⠀琀礀瀀攀漀昀⠀瀀漀猀椀琀椀漀渀吀礀瀀攀⤀㴀㴀✀猀琀爀椀渀最✀⤀ 笀 
				//do we have any position adjustments ?਀ऀऀऀऀ椀昀 ⠀瀀漀猀椀琀椀漀渀吀礀瀀攀⸀椀渀搀攀砀伀昀⠀∀㨀∀⤀℀㴀ⴀ㄀⤀ 笀 
					shift1=positionType.substring(positionType.indexOf(":")+1);਀ऀऀऀऀऀ瀀漀猀椀琀椀漀渀吀礀瀀攀㴀瀀漀猀椀琀椀漀渀吀礀瀀攀⸀猀甀戀猀琀爀椀渀最⠀　Ⰰ瀀漀猀椀琀椀漀渀吀礀瀀攀⸀椀渀搀攀砀伀昀⠀∀㨀∀⤀⤀㬀 
਀ऀऀऀऀऀ⼀⼀椀昀 愀渀礀 愀搀瘀愀渀挀攀搀 瀀漀猀椀琀椀漀渀椀渀最 眀椀氀氀 戀攀 渀攀攀搀攀搀 ⠀瀀攀爀挀攀渀琀猀 漀爀 猀漀洀攀琀栀椀渀最 攀氀猀攀⤀ ⴀ 瀀愀爀猀攀爀 猀栀漀甀氀搀 戀攀 愀搀搀攀搀 栀攀爀攀 
					//for now we use simple parseInt()਀ 
					//do we have second parameter?਀ऀऀऀऀऀ椀昀 ⠀猀栀椀昀琀㄀⸀椀渀搀攀砀伀昀⠀∀Ⰰ∀⤀ ℀㴀ⴀ㄀⤀ 笀 
						shift2=shift1.substring(shift1.indexOf(",") +1);਀ऀऀऀऀऀऀ猀栀椀昀琀㄀㴀猀栀椀昀琀㄀⸀猀甀戀猀琀爀椀渀最⠀　Ⰰ猀栀椀昀琀㄀⸀椀渀搀攀砀伀昀⠀∀Ⰰ∀⤀⤀㬀 
						shiftY=parseInt(shift2);਀ऀऀऀऀऀऀ椀昀 ⠀椀猀一愀一⠀猀栀椀昀琀夀⤀⤀ 猀栀椀昀琀夀㴀　㬀 
					};਀ 
					shiftX=parseInt(shift1);਀ऀऀऀऀऀ椀昀 ⠀椀猀一愀一⠀猀栀椀昀琀㄀⤀⤀ 猀栀椀昀琀㄀㴀　㬀 
਀ऀऀऀऀ紀㬀 
			};਀ 
			਀ऀऀऀ猀眀椀琀挀栀 ⠀瀀漀猀椀琀椀漀渀吀礀瀀攀⤀ 笀 
				default:਀ऀऀऀऀ挀愀猀攀 ∀琀漀瀀刀椀最栀琀∀㨀 
					promptleftPosition +=  fieldLeft + fieldWidth - 30;਀ऀऀऀऀऀ瀀爀漀洀瀀琀吀漀瀀倀漀猀椀琀椀漀渀 ⬀㴀  昀椀攀氀搀吀漀瀀㬀 
					break;਀ 
				case "topLeft":਀ऀऀऀऀऀ瀀爀漀洀瀀琀吀漀瀀倀漀猀椀琀椀漀渀 ⬀㴀  昀椀攀氀搀吀漀瀀㬀 
					promptleftPosition += fieldLeft; ਀ऀऀऀऀऀ戀爀攀愀欀㬀 
਀ऀऀऀऀ挀愀猀攀 ∀挀攀渀琀攀爀刀椀最栀琀∀㨀 
					promptTopPosition = fieldTop+4;਀ऀऀऀऀऀ洀愀爀最椀渀吀漀瀀匀椀稀攀 㴀 　㬀 
					promptleftPosition= fieldLeft + field.outerWidth(true)+5;਀ऀऀऀऀऀ戀爀攀愀欀㬀 
				case "centerLeft":਀ऀऀऀऀऀ瀀爀漀洀瀀琀氀攀昀琀倀漀猀椀琀椀漀渀 㴀 昀椀攀氀搀䰀攀昀琀 ⴀ ⠀瀀爀漀洀瀀琀䔀氀洀琀⸀眀椀搀琀栀⠀⤀ ⬀ ㈀⤀㬀 
					promptTopPosition = fieldTop+4;਀ऀऀऀऀऀ洀愀爀最椀渀吀漀瀀匀椀稀攀 㴀 　㬀 
					਀ऀऀऀऀऀ戀爀攀愀欀㬀 
਀ऀऀऀऀ挀愀猀攀 ∀戀漀琀琀漀洀䰀攀昀琀∀㨀 
					promptTopPosition = fieldTop + field.height() + 5;਀ऀऀऀऀऀ洀愀爀最椀渀吀漀瀀匀椀稀攀 㴀 　㬀 
					promptleftPosition = fieldLeft;਀ऀऀऀऀऀ戀爀攀愀欀㬀 
				case "bottomRight":਀ऀऀऀऀऀ瀀爀漀洀瀀琀氀攀昀琀倀漀猀椀琀椀漀渀 㴀 昀椀攀氀搀䰀攀昀琀 ⬀ 昀椀攀氀搀圀椀搀琀栀 ⴀ ㌀　㬀 
					promptTopPosition =  fieldTop +  field.height() + 5;਀ऀऀऀऀऀ洀愀爀最椀渀吀漀瀀匀椀稀攀 㴀 　㬀 
					break;਀ऀऀऀऀ挀愀猀攀 ∀椀渀氀椀渀攀∀㨀 
					promptleftPosition = 0;਀ऀऀऀऀऀ瀀爀漀洀瀀琀吀漀瀀倀漀猀椀琀椀漀渀 㴀 　㬀 
					marginTopSize = 0;਀ऀऀऀ紀㬀 
਀ऀऀ 
਀ऀऀऀ⼀⼀愀瀀瀀氀礀 愀搀樀甀猀洀攀渀琀猀 椀昀 愀渀礀 
			promptleftPosition += shiftX;਀ऀऀऀ瀀爀漀洀瀀琀吀漀瀀倀漀猀椀琀椀漀渀  ⬀㴀 猀栀椀昀琀夀㬀 
਀ऀऀऀ爀攀琀甀爀渀 笀 
				"callerTopPosition": promptTopPosition + "px",਀ऀऀऀऀ∀挀愀氀氀攀爀氀攀昀琀倀漀猀椀琀椀漀渀∀㨀 瀀爀漀洀瀀琀氀攀昀琀倀漀猀椀琀椀漀渀 ⬀ ∀瀀砀∀Ⰰ 
				"marginTopSize": marginTopSize + "px"਀ऀऀऀ紀㬀 
		},਀ऀऀ⼀⨀⨀ 
		* Saves the user options and variables in the form.data਀ऀऀ⨀ 
		* @param {jqObject}਀ऀऀ⨀            昀漀爀洀 ⴀ 琀栀攀 昀漀爀洀 眀栀攀爀攀 琀栀攀 甀猀攀爀 漀瀀琀椀漀渀 猀栀漀甀氀搀 戀攀 猀愀瘀攀搀 
		* @param {Map}਀ऀऀ⨀            漀瀀琀椀漀渀猀 ⴀ 琀栀攀 甀猀攀爀 漀瀀琀椀漀渀猀 
		* @return the user options (extended from the defaults)਀ऀऀ⨀⼀ 
		 _saveOptions: function(form, options) {਀ 
			 // is there a language localisation ?਀ऀऀऀ 椀昀 ⠀␀⸀瘀愀氀椀搀愀琀椀漀渀䔀渀最椀渀攀䰀愀渀最甀愀最攀⤀ 
			 var allRules = $.validationEngineLanguage.allRules;਀ऀऀऀ 攀氀猀攀 
			 $.error("jQuery.validationEngine rules are not loaded, plz add localization files to the page");਀ऀऀऀ ⼀⼀ ⴀⴀⴀ 䤀渀琀攀爀渀愀氀猀 䐀伀 一伀吀 吀伀唀䌀䠀 漀爀 伀嘀䔀刀䰀伀䄀䐀 ⴀⴀⴀ 
			 // validation rules and i18਀ऀऀऀ ␀⸀瘀愀氀椀搀愀琀椀漀渀䔀渀最椀渀攀⸀搀攀昀愀甀氀琀猀⸀愀氀氀爀甀氀攀猀 㴀 愀氀氀刀甀氀攀猀㬀 
਀ऀऀऀ 瘀愀爀 甀猀攀爀伀瀀琀椀漀渀猀 㴀 ␀⸀攀砀琀攀渀搀⠀琀爀甀攀Ⰰ笀紀Ⰰ␀⸀瘀愀氀椀搀愀琀椀漀渀䔀渀最椀渀攀⸀搀攀昀愀甀氀琀猀Ⰰ漀瀀琀椀漀渀猀⤀㬀 
਀ऀऀऀ 昀漀爀洀⸀搀愀琀愀⠀✀樀焀瘀✀Ⰰ 甀猀攀爀伀瀀琀椀漀渀猀⤀㬀 
			 return userOptions;਀ऀऀ 紀Ⰰ 
਀ऀऀ ⼀⨀⨀ 
		 * Removes forbidden characters from class name਀ऀऀ ⨀ 䀀瀀愀爀愀洀 笀匀琀爀椀渀最紀 挀氀愀猀猀一愀洀攀 
		 */਀ऀऀ 开最攀琀䌀氀愀猀猀一愀洀攀㨀 昀甀渀挀琀椀漀渀⠀挀氀愀猀猀一愀洀攀⤀ 笀 
			 if(className)਀ऀऀऀऀ 爀攀琀甀爀渀 挀氀愀猀猀一愀洀攀⸀爀攀瀀氀愀挀攀⠀⼀㨀⼀最Ⰰ ∀开∀⤀⸀爀攀瀀氀愀挀攀⠀⼀尀⸀⼀最Ⰰ ∀开∀⤀㬀 
					  },਀ऀऀ⼀⨀⨀ 
		 * Escape special character for jQuery selector਀ऀऀ ⨀ 栀琀琀瀀㨀⼀⼀琀漀琀愀氀搀攀瘀⸀挀漀洀⼀挀漀渀琀攀渀琀⼀攀猀挀愀瀀椀渀最ⴀ挀栀愀爀愀挀琀攀爀猀ⴀ最攀琀ⴀ瘀愀氀椀搀ⴀ樀焀甀攀爀礀ⴀ椀搀 
		 * @param {String} selector਀ऀऀ ⨀⼀ 
		 _jqSelector: function(str){਀ऀऀऀ爀攀琀甀爀渀 猀琀爀⸀爀攀瀀氀愀挀攀⠀⼀⠀嬀㬀☀Ⰰ尀⸀尀⬀尀⨀尀縀✀㨀∀尀℀尀帀⌀␀─䀀尀嬀尀崀尀⠀尀⤀㴀㸀尀簀崀⤀⼀最Ⰰ ✀尀尀␀㄀✀⤀㬀 
		},਀ऀऀ⼀⨀⨀ 
		* Conditionally required field਀ऀऀ⨀ 
		* @param {jqObject} field਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䄀爀爀愀礀嬀匀琀爀椀渀最崀紀 爀甀氀攀猀 
		* @param {int} i rules index਀ऀऀ⨀ 䀀瀀愀爀愀洀 笀䴀愀瀀紀 
		* user options਀ऀऀ⨀ 䀀爀攀琀甀爀渀 愀渀 攀爀爀漀爀 猀琀爀椀渀最 椀昀 瘀愀氀椀搀愀琀椀漀渀 昀愀椀氀攀搀 
		*/਀ऀऀ开挀漀渀搀刀攀焀甀椀爀攀搀㨀 昀甀渀挀琀椀漀渀⠀昀椀攀氀搀Ⰰ 爀甀氀攀猀Ⰰ 椀Ⰰ 漀瀀琀椀漀渀猀⤀ 笀 
			var idx, dependingField;਀ 
			for(idx = (i + 1); idx < rules.length; idx++) {਀ऀऀऀऀ搀攀瀀攀渀搀椀渀最䘀椀攀氀搀 㴀 樀儀甀攀爀礀⠀∀⌀∀ ⬀ 爀甀氀攀猀嬀椀搀砀崀⤀⸀昀椀爀猀琀⠀⤀㬀 
਀ऀऀऀऀ⼀⨀ 唀猀攀 开爀攀焀甀椀爀攀搀 昀漀爀 搀攀琀攀爀洀椀渀椀渀最 眀攀琀栀攀爀 搀攀瀀攀渀搀椀渀最䘀椀攀氀搀 栀愀猀 愀 瘀愀氀甀攀⸀ 
				 * There is logic there for handling all field types, and default value; so we won't replicate that here਀ऀऀऀऀ ⨀ 䤀渀搀椀挀愀琀攀 琀栀椀猀 猀瀀攀挀椀愀氀 甀猀攀 戀礀 猀攀琀琀椀渀最 琀栀攀 氀愀猀琀 瀀愀爀愀洀攀琀攀爀 琀漀 琀爀甀攀 猀漀 眀攀 漀渀氀礀 瘀愀氀椀搀愀琀攀 琀栀攀 搀攀瀀攀渀搀椀渀最䘀椀攀氀搀 漀渀 挀栀愀挀欀戀漀砀攀猀 愀渀搀 爀愀搀椀漀 戀甀琀琀漀渀猀 ⠀⌀㐀㘀㈀⤀ 
				 */਀ऀऀऀऀ椀昀 ⠀搀攀瀀攀渀搀椀渀最䘀椀攀氀搀⸀氀攀渀最琀栀 ☀☀ 洀攀琀栀漀搀猀⸀开爀攀焀甀椀爀攀搀⠀搀攀瀀攀渀搀椀渀最䘀椀攀氀搀Ⰰ 嬀∀爀攀焀甀椀爀攀搀∀崀Ⰰ 　Ⰰ 漀瀀琀椀漀渀猀Ⰰ 琀爀甀攀⤀ 㴀㴀 甀渀搀攀昀椀渀攀搀⤀ 笀 
					/* We now know any of the depending fields has a value,਀ऀऀऀऀऀ ⨀ 猀漀 眀攀 挀愀渀 瘀愀氀椀搀愀琀攀 琀栀椀猀 昀椀攀氀搀 愀猀 瀀攀爀 渀漀爀洀愀氀 爀攀焀甀椀爀攀搀 挀漀搀攀 
					 */਀ऀऀऀऀऀ爀攀琀甀爀渀 洀攀琀栀漀搀猀⸀开爀攀焀甀椀爀攀搀⠀昀椀攀氀搀Ⰰ 嬀∀爀攀焀甀椀爀攀搀∀崀Ⰰ 　Ⰰ 漀瀀琀椀漀渀猀⤀㬀 
				}਀ऀऀऀ紀 
		},਀ 
	    _submitButtonClick: function(event) {਀ऀ        瘀愀爀 戀甀琀琀漀渀 㴀 ␀⠀琀栀椀猀⤀㬀 
	        var form = button.closest('form, .validationEngineContainer');਀ऀ        昀漀爀洀⸀搀愀琀愀⠀∀樀焀瘀开猀甀戀洀椀琀䈀甀琀琀漀渀∀Ⰰ 戀甀琀琀漀渀⸀愀琀琀爀⠀∀椀搀∀⤀⤀㬀 
	    }਀ऀऀ  紀㬀 
਀ऀ ⼀⨀⨀ 
	 * Plugin entry point.਀ऀ ⨀ 夀漀甀 洀愀礀 瀀愀猀猀 愀渀 愀挀琀椀漀渀 愀猀 愀 瀀愀爀愀洀攀琀攀爀 漀爀 愀 氀椀猀琀 漀昀 漀瀀琀椀漀渀猀⸀ 
	 * if none, the init and attach methods are being called.਀ऀ ⨀ 刀攀洀攀洀戀攀爀㨀 椀昀 礀漀甀 瀀愀猀猀 漀瀀琀椀漀渀猀Ⰰ 琀栀攀 愀琀琀愀挀栀攀搀 洀攀琀栀漀搀 椀猀 一伀吀 挀愀氀氀攀搀 愀甀琀漀洀愀琀椀挀愀氀氀礀 
	 *਀ऀ ⨀ 䀀瀀愀爀愀洀 笀匀琀爀椀渀最紀 
	 *            method (optional) action਀ऀ ⨀⼀ 
	 $.fn.validationEngine = function(method) {਀ 
		 var form = $(this);਀ऀऀ 椀昀⠀℀昀漀爀洀嬀　崀⤀ 爀攀琀甀爀渀 昀漀爀洀㬀  ⼀⼀ 猀琀漀瀀 栀攀爀攀 椀昀 琀栀攀 昀漀爀洀 搀漀攀猀 渀漀琀 攀砀椀猀琀 
਀ऀऀ 椀昀 ⠀琀礀瀀攀漀昀⠀洀攀琀栀漀搀⤀ 㴀㴀 ✀猀琀爀椀渀最✀ ☀☀ 洀攀琀栀漀搀⸀挀栀愀爀䄀琀⠀　⤀ ℀㴀 ✀开✀ ☀☀ 洀攀琀栀漀搀猀嬀洀攀琀栀漀搀崀⤀ 笀 
਀ऀऀऀ ⼀⼀ 洀愀欀攀 猀甀爀攀 椀渀椀琀 椀猀 挀愀氀氀攀搀 漀渀挀攀 
			 if(method != "showPrompt" && method != "hide" && method != "hideAll")਀ऀऀऀ 洀攀琀栀漀搀猀⸀椀渀椀琀⸀愀瀀瀀氀礀⠀昀漀爀洀⤀㬀 
਀ऀऀऀ 爀攀琀甀爀渀 洀攀琀栀漀搀猀嬀洀攀琀栀漀搀崀⸀愀瀀瀀氀礀⠀昀漀爀洀Ⰰ 䄀爀爀愀礀⸀瀀爀漀琀漀琀礀瀀攀⸀猀氀椀挀攀⸀挀愀氀氀⠀愀爀最甀洀攀渀琀猀Ⰰ ㄀⤀⤀㬀 
		 } else if (typeof method == 'object' || !method) {਀ 
			 // default constructor with or without arguments਀ऀऀऀ 洀攀琀栀漀搀猀⸀椀渀椀琀⸀愀瀀瀀氀礀⠀昀漀爀洀Ⰰ 愀爀最甀洀攀渀琀猀⤀㬀 
			 return methods.attach.apply(form);਀ऀऀ 紀 攀氀猀攀 笀 
			 $.error('Method ' + method + ' does not exist in jQuery.validationEngine');਀ऀऀ 紀 
	};਀ 
਀ 
	// LEAK GLOBAL OPTIONS਀ऀ␀⸀瘀愀氀椀搀愀琀椀漀渀䔀渀最椀渀攀㴀 笀昀椀攀氀搀䤀搀䌀漀甀渀琀攀爀㨀 　Ⰰ搀攀昀愀甀氀琀猀㨀笀 
਀ऀऀ⼀⼀ 一愀洀攀 漀昀 琀栀攀 攀瘀攀渀琀 琀爀椀最最攀爀椀渀最 昀椀攀氀搀 瘀愀氀椀搀愀琀椀漀渀 
		validationEventTrigger: "blur",਀ऀऀ⼀⼀ 䄀甀琀漀洀愀琀椀挀愀氀氀礀 猀挀爀漀氀氀 瘀椀攀眀瀀漀爀琀 琀漀 琀栀攀 昀椀爀猀琀 攀爀爀漀爀 
		scroll: true,਀ऀऀ⼀⼀ 䘀漀挀甀猀 漀渀 琀栀攀 昀椀爀猀琀 椀渀瀀甀琀 
		focusFirstField:true,਀ऀऀ⼀⼀ 匀栀漀眀 瀀爀漀洀瀀琀猀Ⰰ 猀攀琀 琀漀 昀愀氀猀攀 琀漀 搀椀猀愀戀氀攀 瀀爀漀洀瀀琀猀 
		showPrompts: true,਀       ⼀⼀ 匀栀漀甀氀搀 眀攀 愀琀琀攀洀瀀琀 琀漀 瘀愀氀椀搀愀琀攀 渀漀渀ⴀ瘀椀猀椀戀氀攀 椀渀瀀甀琀 昀椀攀氀搀猀 挀漀渀琀愀椀渀攀搀 椀渀 琀栀攀 昀漀爀洀㼀 ⠀唀猀攀昀甀氀 椀渀 挀愀猀攀猀 漀昀 琀愀戀戀攀搀 挀漀渀琀愀椀渀攀爀猀Ⰰ 攀⸀最⸀ 樀儀甀攀爀礀ⴀ唀䤀 琀愀戀猀⤀ 
       validateNonVisibleFields: false,਀ऀऀ⼀⼀ 伀瀀攀渀椀渀最 戀漀砀 瀀漀猀椀琀椀漀渀Ⰰ 瀀漀猀猀椀戀氀攀 氀漀挀愀琀椀漀渀猀 愀爀攀㨀 琀漀瀀䰀攀昀琀Ⰰ 
		// topRight, bottomLeft, centerRight, bottomRight, inline਀ऀऀ⼀⼀ 椀渀氀椀渀攀 最攀琀猀 椀渀猀攀爀琀攀搀 愀昀琀攀爀 琀栀攀 瘀愀氀椀搀愀琀攀搀 昀椀攀氀搀 漀爀 椀渀琀漀 愀渀 攀氀攀洀攀渀琀 猀瀀攀挀椀昀椀攀搀 椀渀 搀愀琀愀ⴀ瀀爀漀洀瀀琀ⴀ琀愀爀最攀琀 
		promptPosition: "topRight",਀ऀऀ戀椀渀搀䴀攀琀栀漀搀㨀∀戀椀渀搀∀Ⰰ 
		// internal, automatically set to true when it parse a _ajax rule਀ऀऀ椀渀氀椀渀攀䄀樀愀砀㨀 昀愀氀猀攀Ⰰ 
		// if set to true, the form data is sent asynchronously via ajax to the form.action url (get)਀ऀऀ愀樀愀砀䘀漀爀洀嘀愀氀椀搀愀琀椀漀渀㨀 昀愀氀猀攀Ⰰ 
		// The url to send the submit ajax validation (default to action)਀ऀऀ愀樀愀砀䘀漀爀洀嘀愀氀椀搀愀琀椀漀渀唀刀䰀㨀 昀愀氀猀攀Ⰰ 
		// HTTP method used for ajax validation਀ऀऀ愀樀愀砀䘀漀爀洀嘀愀氀椀搀愀琀椀漀渀䴀攀琀栀漀搀㨀 ✀最攀琀✀Ⰰ 
		// Ajax form validation callback method: boolean onComplete(form, status, errors, options)਀ऀऀ⼀⼀ 爀攀琀甀渀猀 昀愀氀猀攀 椀昀 琀栀攀 昀漀爀洀⸀猀甀戀洀椀琀 攀瘀攀渀琀 渀攀攀搀猀 琀漀 戀攀 挀愀渀挀攀氀攀搀⸀ 
		onAjaxFormComplete: $.noop,਀ऀऀ⼀⼀ 挀愀氀氀攀搀 爀椀最栀琀 戀攀昀漀爀攀 琀栀攀 愀樀愀砀 挀愀氀氀Ⰰ 洀愀礀 爀攀琀甀爀渀 昀愀氀猀攀 琀漀 挀愀渀挀攀氀 
		onBeforeAjaxFormValidation: $.noop,਀ऀऀ⼀⼀ 匀琀漀瀀猀 昀漀爀洀 昀爀漀洀 猀甀戀洀椀琀琀椀渀最 愀渀搀 攀砀攀挀甀琀攀 昀甀渀挀琀椀漀渀 愀猀猀椀挀椀愀琀攀搀 眀椀琀栀 椀琀 
		onValidationComplete: false,਀ 
		// Used when you have a form fields too close and the errors messages are on top of other disturbing viewing messages਀ऀऀ搀漀一漀琀匀栀漀眀䄀氀氀䔀爀爀漀猀伀渀匀甀戀洀椀琀㨀 昀愀氀猀攀Ⰰ 
		// Object where you store custom messages to override the default error messages਀ऀऀ挀甀猀琀漀洀开攀爀爀漀爀开洀攀猀猀愀最攀猀㨀笀紀Ⰰ 
		// true if you want to vind the input fields਀ऀऀ戀椀渀搀攀搀㨀 琀爀甀攀Ⰰ 
		// set to true, when the prompt arrow needs to be displayed਀ऀऀ猀栀漀眀䄀爀爀漀眀㨀 琀爀甀攀Ⰰ 
		// did one of the validation fail ? kept global to stop further ajax validations਀ऀऀ椀猀䔀爀爀漀爀㨀 昀愀氀猀攀Ⰰ 
		// Limit how many displayed errors a field can have਀ऀऀ洀愀砀䔀爀爀漀爀猀倀攀爀䘀椀攀氀搀㨀 昀愀氀猀攀Ⰰ 
		਀ऀऀ⼀⼀ 䌀愀挀栀攀猀 昀椀攀氀搀 瘀愀氀椀搀愀琀椀漀渀 猀琀愀琀甀猀Ⰰ 琀礀瀀椀挀愀氀氀礀 漀渀氀礀 戀愀搀 猀琀愀琀甀猀 愀爀攀 挀爀攀愀琀攀搀⸀ 
		// the array is used during ajax form validation to detect issues early and prevent an expensive submit਀ऀऀ愀樀愀砀嘀愀氀椀搀䌀愀挀栀攀㨀 笀紀Ⰰ 
		// Auto update prompt position after window resize਀ऀऀ愀甀琀漀倀漀猀椀琀椀漀渀唀瀀搀愀琀攀㨀 昀愀氀猀攀Ⰰ 
਀ऀऀ䤀渀瘀愀氀椀搀䘀椀攀氀搀猀㨀 嬀崀Ⰰ 
		onFieldSuccess: false,਀ऀऀ漀渀䘀椀攀氀搀䘀愀椀氀甀爀攀㨀 昀愀氀猀攀Ⰰ 
		onSuccess: false,਀ऀऀ漀渀䘀愀椀氀甀爀攀㨀 昀愀氀猀攀Ⰰ 
		validateAttribute: "class",਀ऀऀ愀搀搀匀甀挀挀攀猀猀䌀猀猀䌀氀愀猀猀吀漀䘀椀攀氀搀㨀 ∀∀Ⰰ 
		addFailureCssClassToField: "",਀ऀऀ 
		// Auto-hide prompt਀ऀऀ愀甀琀漀䠀椀搀攀倀爀漀洀瀀琀㨀 昀愀氀猀攀Ⰰ 
		// Delay before auto-hide਀ऀऀ愀甀琀漀䠀椀搀攀䐀攀氀愀礀㨀 ㄀　　　　Ⰰ 
		// Fade out duration while hiding the validations਀ऀऀ昀愀搀攀䐀甀爀愀琀椀漀渀㨀 　⸀㌀Ⰰ 
	 // Use Prettify select library਀ऀ 瀀爀攀琀琀礀匀攀氀攀挀琀㨀 昀愀氀猀攀Ⰰ 
	 // Add css class on prompt਀ऀ 愀搀搀倀爀漀洀瀀琀䌀氀愀猀猀 㨀 ∀∀Ⰰ 
	 // Custom ID uses prefix਀ऀ 甀猀攀倀爀攀昀椀砀㨀 ∀∀Ⰰ 
	 // Custom ID uses suffix਀ऀ 甀猀攀匀甀昀昀椀砀㨀 ∀∀Ⰰ 
	 // Only show one message per error prompt਀ऀ 猀栀漀眀伀渀攀䴀攀猀猀愀最攀㨀 昀愀氀猀攀 
	}};਀ऀ␀⠀昀甀渀挀琀椀漀渀⠀⤀笀␀⸀瘀愀氀椀搀愀琀椀漀渀䔀渀最椀渀攀⸀搀攀昀愀甀氀琀猀⸀瀀爀漀洀瀀琀倀漀猀椀琀椀漀渀 㴀 洀攀琀栀漀搀猀⸀椀猀刀吀䰀⠀⤀㼀✀琀漀瀀䰀攀昀琀✀㨀∀琀漀瀀刀椀最栀琀∀紀⤀㬀 
})(jQuery);਀ 
਀�