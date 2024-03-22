/**
 *
 * @name   : base.js
 * @author : Taichi Matsutaka
 *
 * Copyright (C) 2021 - 2023 Taichi Matsutaka
 *
 *
 */
(function($) {


	/**
	 *
	 *
	 * Base
	 *
	 *
	 */
	/**************************************************************
	 * AnimationFrame
	**************************************************************/
	const requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
	const cancelAnimationFrame  = window.cancelAnimationFrame || window.mozcancelAnimationFrame || window.webkitcancelAnimationFrame || window.mscancelAnimationFrame;
	window.requestAnimationFrame = requestAnimationFrame;
	window.cancelAnimationFrame  = cancelAnimationFrame;





	/**************************************************************
	 * customEventSetting
	**************************************************************/
	const customEventSetting = function(){
		if ( typeof window.CustomEvent === "function" ) return false;

		function CustomEvent ( event, params ) {
			params = params || { bubbles: false, cancelable: false, detail: undefined };
			var evt = document.createEvent( 'CustomEvent' );
			evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
			return evt;
		}

		CustomEvent.prototype = window.Event.prototype;
		window.CustomEvent = CustomEvent;
	}
	customEventSetting();






	/**************************************************************
	 * telUserAgent
	**************************************************************/
	const telUserAgent = function(){
		const target       = document.querySelectorAll('[href^="tel"]:not([data-pc-href])');
		const pcHrefTarget = document.querySelectorAll('[data-pc-href]');

		if( !navigator.userAgent.match(/(iPhone|Android)/) ){
			for ( let i = 0; i < target.length; i++ ) {
				target[i].style.pointerEvents = 'none';
				target[i].addEventListener('click',function(e){
					e.preventDefault();
				},false);
			}

			for ( let i = 0; i < pcHrefTarget.length; i++ ) {
				const pcHref = pcHrefTarget[i].dataset.pcHref;

				if( pcHref ){
					pcHrefTarget[i].setAttribute('href',pcHref);
				}
			}
		}
	}
	telUserAgent();





	/**************************************************************
	 * imgAttribute
	**************************************************************/
	const imgAttribute = function(){
		const target = document.getElementsByTagName('img');

		for ( let i = 0; i < target.length; i++ ) {
			target[i].setAttribute('onmousedown','return false');   //ドラッグ無効
			target[i].setAttribute('onselectstart','return false'); //ドラッグ無効
			// target[i].setAttribute('oncontextmenu','return false'); //右クリック無効
		}
	}
	imgAttribute();





	/**************************************************************
	 * isView
	**************************************************************/
	const isView = function(){
		const target = document.querySelectorAll('body *');
		console.log( target );

		for ( let i = 0; i < target.length; i++ ) {
			/* ---------- callback ---------- */
			const callback = function(entries) {
				if( entries[0].isIntersecting === true ){
					target[i].classList.add('is-view');
				} else{
					target[i].classList.remove('is-view');
				}
			}

			/* ---------- options ---------- */
			const options = {
				rootMargin: "0px 0px"
			}

			/* ---------- observer ---------- */
			let observer = new IntersectionObserver(callback,options);
			observer.observe( target[i] );
		}
	}
	// isView();








	/**
	 *
	 *
	 * Scope
	 *
	 *
	 */
	/**************************************************************
	 * judgeYoutube
	**************************************************************/
	const judgeYoutube = function(){
		const target = document.querySelectorAll('.c-youtube2');

		for ( let i = 0; i < target.length; i++ ) {
			const iframe = target[i].querySelector('iframe[src*="youtube"]');

			if( iframe ){
				target[i].classList.add('is-aspect');
			}
		}
	}
	judgeYoutube();



















})();

/*! addClass.js | v2.2.0 | license Copyright (C) 2020 - 2023 Taichi Matsutaka */
/*
 *
 * @name    : addClass.js
 * @content : addClass
 * @creation: 2020.01.30
 * @update  : 2023.06.17
 * @version : 2.2.0
 *
 */
(function(global) {[]
	global.addClass = function(node,options){

		/////////////////////////////////////////////
		// defaults options
		/////////////////////////////////////////////
		this.nodeElements = Array.prototype.slice.call( document.querySelectorAll( node ) ,0) ;

		const defaults = {
			class         : '',
			timeout       : '',
			position      : '',
			remove        : true,
			addClassEvent : ['load'],
			getOffsetEvent: ['DOMContentLoaded','load','resize'],
		}


		/////////////////////////////////////////////
		// options
		/////////////////////////////////////////////
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;
		this.flg = false;


		/////////////////////////////////////////////
		// base
		/////////////////////////////////////////////
		this.removes = [];
		this.base();


	};
	addClass.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;

			this.nodeElements.forEach(function(target) {
				let position = 0;


				/////////////////////////////////////////////
				// getPosition
				/////////////////////////////////////////////
				if( options['position'] !== '' ){
					let regexp = new RegExp('^(\\+|\\-)?(0[1-9]{0,2}|\\d{0,3})(,\\d{3})*(\\.[0-9]+)?$', 'g');

					if( regexp.test(options['position']) === true ){
						position = options['position'];
						new Number( position );
					} else{
						const position_element = target.querySelector( options['position'] );

						const getOffset = function(){
							let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
							position = position_element.getBoundingClientRect().top + scrollTop;;
						}

						for ( let i = 0; i < options['getOffsetEvent'].length; i++ ) {
							window.addEventListener( options['getOffsetEvent'][i] ,getOffset);
						}

						/* ---------- removes ---------- */
						_this.removes.push( function(){
							for ( let i = 0; i < options['getOffsetEvent'].length; i++ ) {
								window.removeEventListener( options['getOffsetEvent'][i] ,getOffset);
							}
						});
					}
				}



				/////////////////////////////////////////////
				// setClass
				/////////////////////////////////////////////
				let setClass = '';


				if( options['timeout'] !== '' ){
					// セットタイムアウトのみ
					setClass = function(){
						setTimeout(function(){
							_this.addClass(target);
						}, options['timeout'] );
					}
				} else if( options['position'] !== '' && options['remove'] === true ){
					// 外す機能付きスクロール
					setClass = function(){
						let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
						if( scrollTop > position ) _this.addClass(target);
						else _this.removeClass(target);;
					}
				} else if( options['position'] !== '' ){
					// スクロールのみ
					setClass = function(){
						let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
						if( scrollTop > position ) _this.addClass(target);
					}
				} else{
					// それ以外
					setClass = function(){
						_this.addClass(target);
					}
				}



				/////////////////////////////////////////////
				// addClassEvent
				/////////////////////////////////////////////
				for ( let i = 0; i < options['addClassEvent'].length; i++ ) {
					window.addEventListener( options['addClassEvent'][i] ,setClass );
				}

				/* ---------- removes ---------- */
				_this.removes.push( function(){
					for ( let i = 0; i < options['addClassEvent'].length; i++ ) {
						window.removeEventListener( options['addClassEvent'][i] ,setClass );
					}
				});


			});

		},
		addClass: function( target ){
			const _this   = this;
			const options = this.options;

			/////////////////////////////////////////////
			// addClass
			/////////////////////////////////////////////
			if( _this.flg == false ){
				target.classList.add( options['class'] );
				_this.flg = true;
			}
		},
		removeClass: function( target ){
			const _this   = this;
			const options = this.options;

			/////////////////////////////////////////////
			// removeClass
			/////////////////////////////////////////////
			if( _this.flg == true ){
				target.classList.remove( options['class'] );
				_this.flg = false;
			}
		},
		remove: function(){
			/* removes に追加された関数をforで一つずつ実行する。 */
			const removes = this.removes;

			if( !removes ) return;

			for ( let i = 0; i < removes.length; i++ ) {
				removes[i]();
			}
		},
	};

})(this);

/*! changeSvg.js | v1.5.0 | license Copyright (C) 2021 - 2022 Taichi Matsutaka */
/*
 *
 * @name    : changeSvg.js
 * @content : changeSvg
 * @url     : https://github.com/taichaaan/js-changeSvg
 * @creation: 2021.06.08
 * @update  : 2022.09.23
 * @version : 1.5.0
 *
 */
(function(global) {[]
	global.changeSvg = function(target,options){
		///////////////////////////////////////////////////////////////
		// defaults options
		///////////////////////////////////////////////////////////////
		this.targetElements = Array.prototype.slice.call( document.querySelectorAll( target ) ,0) ;

		const defaults = {
			svg        : null,
			alt        : null,
			class      : null,
			immedStart : false,
			setSvgEvent: ['DOMContentLoaded'],

			onChange: null, // function( svg )
		}


		///////////////////////////////////////////////////////////////
		// options
		///////////////////////////////////////////////////////////////
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		///////////////////////////////////////////////////////////////
		// base
		///////////////////////////////////////////////////////////////
		this.base();


	};
	changeSvg.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;


			///////////////////////////////////////////////////////////////
			// callback
			///////////////////////////////////////////////////////////////
			const onChange = function( svg ){
				if( typeof options['onChange'] === 'function' ){
					options['onChange']( svg );
				}
			}


			///////////////////////////////////////////////////////////////
			// base
			///////////////////////////////////////////////////////////////
			const setSvg = function( target ){
				const tag = target.tagName;

				if( options['svg'] == null ){
					if( tag === 'IMG' ){
						var url       = target.getAttribute('src');
						var alt       = target.getAttribute('alt');
						var className = target.getAttribute('class');
					} else{
						var url       = target.dataset.svg;
						var alt       = target.dataset.alt;
						var className = target.dataset.class;
					}
				} else{
					var url       = options['svg'];
					var alt       = options['alt'];
					var className = options['class'];
				}


				const xhr = new XMLHttpRequest();
				xhr.open( 'GET', url , true );
				xhr.send(null);

				xhr.addEventListener('load',function(){
					const xml = xhr.responseXML;

					if (!xml) return;

					/* ---------- svgの作成 --------- */
					const svg  = xml.documentElement;
					const defs = svg.querySelector('defs');
					const path = svg.querySelectorAll('path');

					const width   = svg.getAttribute('width');
					const height  = svg.getAttribute('height');
					const viewBox = svg.getAttribute('viewBox');

					svg.removeAttribute('xmlns');
					svg.setAttribute('class', className );

					if( !viewBox && width && height ){
						svg.removeAttribute('width');
						svg.removeAttribute('height');
						svg.setAttribute('viewBox','0 0 '+ width +' ' + height + '');
					}

					if( alt ){
						const title = document.createElement('title');
						title.innerHTML = alt;
						svg.insertBefore(title, svg.firstChild);
					}

					if( path ){
						for ( let i = 0; i < path.length; i++ ) {
							path[i].removeAttribute('class');
							path[i].removeAttribute('fill');
						}
					}

					if( defs ){
						defs.parentNode.removeChild(defs);
					}


					/* ---------- 追加 --------- */
					if( tag === 'IMG' ){
						if( target.parentNode ){
							target.parentNode.insertBefore(svg, target);
							target.parentNode.removeChild(target);

							/* ---------- callback ---------- */
							onChange( svg );
						}
					} else{
						target.removeAttribute('data-svg');
						target.removeAttribute('data-alt');
						target.removeAttribute('data-class');
						target.appendChild( svg );

						/* ---------- callback ---------- */
						onChange( svg );
					}
				});
			}



			///////////////////////////////////////////////////////////////
			// forEach
			///////////////////////////////////////////////////////////////
			this.targetElements.forEach(function(target) {
				for ( let i = 0; i < options['setSvgEvent'].length; i++ ) {
					window.addEventListener( options['setSvgEvent'][i] , setSvg( target ) );
				}
			});

			if( options['immedStart'] === true ){
				_this.targetElements.forEach(function(target) {
					setSvg( target );
				});
			}



		},
	};

})(this);

/*! contactForm.js | v4.8.0 | license Copyright (C) 2020 - 2023 Taichi Matsutaka */
/*
 *
 * @name    : contactForm.js
 * @content : contactForm
 * @creation: 2020.05.07
 * @update  : 2023.04.29
 * @version : 4.8.0
 *
 */
(function(global) {[]
	global.contactForm = function(target,options){
		/**************************************************************
		 * defaults options
		**************************************************************/
		this.targetElements = Array.prototype.slice.call( document.querySelectorAll( target ) ,0) ;

		const defaults = {
			controlClass: 'p-form__control',
			button      : '.p-form__button',
			submit      : '.p-form__submit',
			check       : '.p-form__check',

			required: [
				'[name="f_type"],[name="f_name"],[name="f_kana"],[name="f_mail"],[name="f_tel"]',
			],
			linkageRequired      : null,
			requiredStatus       : false,
			requiredStatusCurrent: '.js-count__current',
			requiredStatusTotal  : '.js-count__total',

			stepFunctions      : null,
			agree              : '[name="f_policy"]',
			emailCheck         : true,
			emailCheckRegex    : /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/,
			emailConfirm       : true,
			emailConfirmArray  : ['[name="f_mail"]','[name="f_mail-check"]'],
			telCheck           : true,
			telCheckRegex      : /^[0-9]+$/,
			yubinBango         : true,
			textareaPlaceholder: false,
			textareaSelector   : '.js-textarea',
			textareaDummyClass : 'p-form__txtbox--dummy',
			textareaKeepHeight : false,

			animation          : true,
			animationSpeed     : 500,
			animationDifference: [0],
			animationPosition  : 0,
			animationHierarchy : 1,
			animationEasing    : function (t, b, c, d) { return c * t / d + b; },

			errorTextClass       : [],
			errorTextEmailCheck  : '正しい形式で入力してください。',
			errorTextEmailConfirm: '確認用のメールアドレスが一致していません。',
			errorTextTelCheck    : '正しい形式で入力してください。',
			errorTextRequired    : '必須項目を入力してください。',

			errorClass   : 'is-error',
			disabledClass: 'is-disabled',
			doneClass    : 'is-done',
		}


		/**************************************************************
		 * options
		**************************************************************/
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		/**************************************************************
		 * base
		**************************************************************/
		this.removes = [];
		this.base();


	};
	contactForm.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;


			this.targetElements.forEach(function(target) {
				/**************************************************************
				 * variable
				**************************************************************/
				const form        = target;
				const button      = target.querySelector( options['button'] );
				const check       = target.querySelector( options['check'] );
				const submit      = target.querySelector( options['submit'] );
				const agree       = target.querySelectorAll( options['agree'] );
				const agreeLength = agree.length;

				let nowStep    = 1;
				let stepLength = 1;

				if( options['stepFunctions'] != null ) {
					stepLength = options['stepFunctions'].length;
				}

				let required = '';
				let email    = '';
				let tel      = '';

				if( stepLength > 1 ){
					target.dataset.state = nowStep;
					required = target.querySelectorAll( options['required'][ nowStep - 1 ] );
					email    = target.querySelectorAll('[data-step="' + nowStep + '"] [type="email"]');
					tel      = target.querySelectorAll('[data-step="' + nowStep + '"] [type="tel"]');

					/* stepFunctions */
					options['stepFunctions'][ nowStep - 1 ]();

				} else{
					required = target.querySelectorAll( options['required'][0] );
					email    = target.querySelectorAll('[type="email"]');
					tel      = target.querySelectorAll('[type="tel"]');
				}

				/*
				 * errorFlgs
				 *
				 * チェック項目毎に個別で管理
				 *
				 * trueがエラーあり、falseがエラーなし
				 * 通常は送信できる状態で、エラーがあればtrueに変更し送信させない。
				 *
				 */
				let errorFlg_required     = false;
				let errorFlg_emailCheck   = false;
				let errorFlg_emailConfirm = false;
				let errorFlg_telCheck     = false;


				/**************************************************************
				 * form reset
				**************************************************************/
				// form.reset();





				/**************************************************************
				 * searchControl
				 * controlClass を持つ親要素を取得
				**************************************************************/
				const searchControl = function( target ){
					let parents = [target];
					let parent = '';
					let control = target;

					for ( let i = 0; i > -1; i++ ) {
						parent = parents[i].parentNode;

						if( parent.classList.contains( options['controlClass'] ) ){
							control = parent;
							break;
						} else{
							parents.push(parent);
						}
					}

					return control;
				}



				/**************************************************************
				 * erroeMessage
				 * エラーメッセージの出力・削除
				**************************************************************/
				const erroeMessage = {
					add: function( target , text ){
						/* ---------- エラーメッセージを表示 ---------- */
						/* ----- pタグの準備 ----- */
						const p = document.createElement('p');

						/* ----- [name-ja] の部分をデータ属性の「data-name-ja」に置き換える ----- */
						const nameJa = target.dataset.nameJa;
						if( nameJa ) text = text.replace( '[name-ja]', nameJa );

						/* ----- 準備 ----- */
						p.innerHTML = text;
						p.classList.add( 'js-error-text' );

						/* ----- pタグを挿入するcontrolを取得 ----- */
						let control = searchControl( target );

						/* ----- pタグを追加 ----- */
						control.parentNode.appendChild( p );

						/* ----- オリジナルのクラスがあれば追加 ----- */
						for ( let i = 0; i < options['errorTextClass'].length; i++ ) {
							p.classList.add( options['errorTextClass'][i] );
						}

						/* ---------- エラークラスをcontrolに付与 ---------- */
						control.classList.remove( options['doneClass'] );
						control.classList.add( options['errorClass'] );
					},
					remove: function( target ){
						for ( let i = 0; i < target.length; i++ ) {
							/* ---------- エラーメッセージを削除 ---------- */
							let control = target[i].previousElementSibling;
							target[i].parentNode.removeChild( target[i] );

							/* ---------- エラークラスをcontrolから削除 ---------- */
							control.classList.remove( options['errorClass'] );
						}
					}
				}



				/**************************************************************
				 * checkDone
				 * 入力済みかのチェック
				 * 対象はcontrolClassの中の「input,select,textarea」である
				**************************************************************/
				const checkDone = function(){
					const input = target.querySelectorAll('.' + options['controlClass'] + ' input,' + '.' + options['controlClass'] + ' select,' + '.' + options['controlClass'] + ' textarea');


					/* ---------- isDone ---------- */
					const isDone = function( input ){
						const control = searchControl( input );

						/* ----- get value ----- */
						let value = '';

						if( input.type === 'radio' || input.type === 'checkbox' ){
							/* radio、checkboxの時は nameから複数を取得 */
							const inputs = target.querySelectorAll( '[name="'+ input.name +'"]' );

							for ( let j = 0; j < inputs.length; j++) {
								if( inputs[j].checked == true ){
									value = inputs[j].value;
									break;
								}
							}
						} else{
							/* 通常は valueを取得 */
							value = input.value;
						}

						/* ----- 判定 ----- */
						if( value !== '' ){
							control.classList.add( options['doneClass'] );
						} else{
							control.classList.remove( options['doneClass'] );
						}
					}


					/* ---------- check ---------- */
					for ( let i = 0; i < input.length; i++ ) {
						input[i].addEventListener('change',function(){
							isDone( input[i] );
						});
					}
				}
				checkDone();




				/**************************************************************
				 * linkageRequired
				 * チェックボックスに連動して必須項目を変更
				**************************************************************/
				const linkageRequired = function(){
					if( options['linkageRequired'] == null ) return false;


					/* ---------- Object.valuesが使えないブラウザでは、下記を実行 ---------- */
					if( !Object.values ) {
						Object.values = function(obj) {
							return Object.keys(obj).map(function(key) { return obj[key]; });
						}
					}

					/* ---------- オブジェクトを配列に変換 ---------- */
					let switchArray   = Object.keys( options['linkageRequired'] );
					let requiredArray = Object.values( options['linkageRequired'] );

					/* ---------- 要素を配列に格納 ---------- */
					let switchInput   = [];
					for ( let i = 0; i < switchArray.length; i++ ) {
						if( target.querySelector( switchArray[i] ) ){
							switchInput.push( target.querySelector( switchArray[i] ) );
						}
					}


					/* ---------- 判定 ---------- */
					for ( let i = 0; i < switchInput.length; i++ ) {
						switchInput[i].addEventListener('change',function(){

							let linkage_required = '';

							/* ----- 全てのinputをチェック ----- */
							for ( let i = 0; i < switchInput.length; i++ ) {
								if( switchInput[i].checked == true ){
									/* ----- checkedだったら、必須項目に追加 ----- */
									linkage_required += ',';
									linkage_required += requiredArray[i];
								} else{
									/* ----- checkedではなかったら、エラーメッセージを削除 ----- */
									let notRequiredInput = target.querySelectorAll( requiredArray[i] );

									for ( let i = 0; i < notRequiredInput.length; i++ ) {
										let control = searchControl( notRequiredInput[i] );
										let erroeText = control.parentNode.querySelectorAll('.js-error-text');
										erroeMessage.remove( erroeText );
									}
								}
							}

							/* ----- 変化した必須項目をセット -----  */
							required = target.querySelectorAll( options['required'] + linkage_required );
							requiredCheck.change( required );

						});
					}
				}
				linkageRequired();




				/**************************************************************
				 * agreeClick
				 * プライバシーポリシーのチェックでbuttonのクラスを制御
				**************************************************************/
				const agreeClick = function(){
					let agreeCount = 0;

					for ( let i = 0; i < agree.length; i++ ) {
						if( agree[i].checked == true ){
							agreeCount++;
						}
					}

					if( agreeCount == agreeLength ){
						button.classList.remove( options['disabledClass'] );
					} else{
						button.classList.add( options['disabledClass'] );
					}
				}

				if( button && agree ){
					button.classList.add( options['disabledClass'] );

					for ( let i = 0; i < agree.length; i++ ) {
						agree[i].addEventListener('change',function(){
							agreeClick();
						});
					}

					window.addEventListener('pageshow',function(){
						agreeClick();
					});
				}




				/**************************************************************
				 * requiredCheck
				 * 必須項目の判定
				**************************************************************/
				const requiredCheck = {
					check: function( input ){
						/* ---------- 判定 ---------- */
						let value = '';

						/* ----- get value ----- */
						if( input.type === 'radio' || input.type === 'checkbox' ){
							/* radio、checkboxの時は nameから複数を取得 */
							const inputs = target.querySelectorAll( '[name="'+ input.name +'"]' );

							for ( let j = 0; j < inputs.length; j++) {
								if( inputs[j].checked == true ){
									value = inputs[j].value;
									break;
								}
							}
						} else{
							/* 通常はは valueを取得 */
							value = input.value;
						}

						/* ----- 判定 ----- */
						if( value === '' ){
							erroeMessage.add( input , options['errorTextRequired'] );
							errorFlg_required = true;
						}
					},
					change: function( target ){
						/* ---------- change event ---------- */
						const _this = this;


						for ( let i = 0; i < target.length; i++) {
							target[i].addEventListener('change',function(){
								/* メッセージを削除 */
								let control = searchControl( this );
								let erroeText = control.parentNode.querySelectorAll('.js-error-text');
								erroeMessage.remove( erroeText );

								/* errorFlg初期化 */
								errorFlg_required = false;

								/* 判定 */
								_this.check( target[i] );
							});
						}
					},
					submit: function(){
						/* ---------- エラーメッセージを表示 ---------- */
						const _this = this;
						let name = '';

						for ( let i = 0; i < required.length; i++ ) {
							/* ----- ひとつ前のnameと現在のnameが一緒だったらスキップ ----- */
							if( name === required[i].name ){
								continue;
							}

							/* 判定 */
							_this.check( required[i] );

							/* ----- nameを再セット ----- */
							name = required[i].name;
						}
					}
				}
				requiredCheck.change( required );


				/**************************************************************
				 * yubinBango
				 * YubinBango.jsと連動
				 * YubinBango.jsで郵便番号から都道府県、市区町村などが自動で入力されますが、
				 * changeイベントが発動しません。
				 * それを補うために、郵便番号を入力したら、自動入力される要素も合わせて必須項目のチェックを行います。
				**************************************************************/
				if( options['yubinBango'] === true ){
					const postalCode = document.querySelector('.p-postal-code');
					const autoInput  = document.querySelectorAll('.p-region,.p-locality,.p-street-address');

					postalCode.addEventListener('change',function(){
						for ( let i = 0; i < autoInput.length; i++ ) {
							/* メッセージを削除 */
							let control = searchControl( autoInput[i] );
							let erroeText = control.parentNode.querySelectorAll('.js-error-text');
							erroeMessage.remove( erroeText );

							/* errorFlg初期化 */
							errorFlg_required = false;

							/* 判定 */
							setTimeout(function(){
								requiredCheck.check( autoInput[i] );
							},300);
						}
					});
				}





				/**************************************************************
				 * telCheck
				 * 電話番号が数字かどうか判定（ハイフンありでも機能）
				**************************************************************/
				const telCheck = {
					check: function( input ){
						/* ---------- 判定 ---------- */
						let value = input.value;

						if( options['telCheckRegex'] == '/^[0-9]+$/' ){
							// 数字のチェックだったら、ハイフンを削除して判定
							value = value.replace(/[━.*‐.*―.*－.*\-.*ー.*\-]/gi,'');
						}

						if( value !== '' && !value.match( options['telCheckRegex'] ) ) {
							erroeMessage.add( input , options['errorTextTelCheck'] );
							errorFlg_telCheck = true;
						}
					},
					change: function( target ){
						/* ---------- change event ---------- */
						if( options['telCheck'] === true ){
							const _this = this;

							for ( let i = 0; i < target.length; i++) {
								target[i].addEventListener('change',function(){
									const value = this.value;

									/* 全角を半角にする */
									const halfValue = value.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
										return String.fromCharCode(s.charCodeAt(0) - 65248);
									});
									this.value = halfValue;

									/* メッセージを削除 */
									let control = searchControl( this );
									let erroeText = control.parentNode.querySelectorAll('.js-error-text');
									erroeMessage.remove( erroeText );

									/* errorFlg初期化 */
									errorFlg_telCheck = false;

									/* 判定 */
									_this.check( this );
								});
							}
						}
					},
					submit: function( target ){
						/* ---------- submit ---------- */
						if( options['telCheck'] === true ){
							const _this = this;

							for ( let i = 0; i < target.length; i++) {
								/* 判定 */
								_this.check( target[i] );
							}
						}
					}
				}
				telCheck.change( tel );




				/**************************************************************
				 * emailCheck
				 * メールが正しい形式か判定
				**************************************************************/
				const emailCheck = {
					check: function( input ){
						/* ---------- 判定 ---------- */
						const value = input.value;
						if( value !== '' && !value.match( options['emailCheckRegex'] ) ){
							erroeMessage.add( input , options['errorTextEmailCheck'] );
							errorFlg_emailCheck = true;
						}
					},
					change: function( target ){
						/* ---------- change event ---------- */
						if( options['emailCheck'] === true ){
							const _this = this;

							for ( let i = 0; i < target.length; i++) {
								target[i].addEventListener('change',function(){
									/* メッセージを削除 */
									let control = searchControl( this );
									let erroeText = control.parentNode.querySelectorAll('.js-error-text');
									erroeMessage.remove( erroeText );

									/* errorFlg初期化 */
									errorFlg_emailCheck = false;

									/* 判定 */
									_this.check( this );
								});
							}
						}
					},
					submit: function( target ){
						/* ---------- submit ---------- */
						if( options['emailCheck'] === true ){
							const _this = this;

							for ( let i = 0; i < target.length; i++) {
								/* 判定 */
								_this.check( target[i] );
							}
						}
					}
				}
				emailCheck.change( email );




				/**************************************************************
				 * emailConfirm
				 * メールと確認が合っているかの判定
				**************************************************************/
				const emailConfirm = {
					check: function(){
						/* ---------- 判定 ---------- */
						const email      = document.querySelector( options['emailConfirmArray'][0] );
						const emailAgain = document.querySelector( options['emailConfirmArray'][1] );

						if( email.value !== emailAgain.value ){
							erroeMessage.add( emailAgain , options['errorTextEmailConfirm'] );
							errorFlg_emailConfirm = true;
						}
					},
					change: function(){
						/* ---------- change event ---------- */
						if( options['emailConfirm'] === true ){
							const _this = this;
							const emailAgain = document.querySelector( options['emailConfirmArray'][1] );

							if( emailAgain ){
								emailAgain.addEventListener('change',function(){
									/* メッセージを削除 */
									let control = searchControl( this );
									let erroeText = control.parentNode.querySelectorAll('.js-error-text');
									erroeMessage.remove( erroeText );

									/* errorFlg初期化 */
									errorFlg_emailConfirm = false;

									/* 判定 */
									_this.check( this );
								});
							}
						}
					},
					submit: function(){
						/* ---------- submit ---------- */
						if( options['emailConfirm'] === true ){
							const _this = this;
							const emailAgain = document.querySelector( options['emailConfirmArray'][1] );
							_this.check( emailAgain );
						}
					}
				}
				emailConfirm.change();






				/**************************************************************
				 * textareaPlaceholder
				 * テキストエリアのプレスホルダーは、一部のブラウでで改行できないので、その対策
				**************************************************************/
				if( options['textareaPlaceholder'] === true ){
					const textareaPlaceholder = function(){
						const textarea = document.querySelector( options['textareaSelector'] );

						if( !textarea ) return false;

						const textareaClass = textarea.getAttribute('class');
						const placeholder   = textarea.getAttribute('placeholder');

						/* ---------- プレスホルダーのシングルクォーテーションをダブルクォーテーションに置き換え ---------- */
						const placeholderReplaced = placeholder.replace(/'/g, '"')


						/* ---------- ダミーの要素を作って、そこの高さを取得する ----------  */
						const dummyTextarea = document.createElement('p');
						dummyTextarea.setAttribute('class', textareaClass );
						dummyTextarea.classList.add( options['textareaDummyClass'] );
						dummyTextarea.innerHTML = placeholderReplaced;
						textarea.parentNode.appendChild( dummyTextarea );
						textarea.setAttribute('placeholder',' ');

						/* ----- 配置 ----- */
						textarea.parentNode.style.position = 'relative';

						/* ----- textareaKeepHeight ----- */
						if( options['textareaKeepHeight'] === true ){
							const textareaKeepHeight = function(){
								const height = dummyTextarea.clientHeight;
								textarea.style.height = height + 10 + 'px';
							}

							window.addEventListener('load', textareaKeepHeight );
							window.addEventListener('resize', textareaKeepHeight );
						}


						/* ---------- 入力されたら非表示にする ----------  */
						const checkValue = function(){
							const letterLength = textarea.value.length;

							if( letterLength === 0 ){
								dummyTextarea.classList.remove('is-hidden');
							} else{
								dummyTextarea.classList.add('is-hidden');
							}
						};

						window.addEventListener('load', checkValue );
						textarea.addEventListener('keyup', checkValue );
						textarea.addEventListener('keydown', checkValue );
						textarea.addEventListener('change', checkValue );
					}
					textareaPlaceholder();
				}






				/**************************************************************
				 * scrollAnimation
				 * スクロールアニメーション
				**************************************************************/
				function scrollAnimation( _this ){
					if( options['animation'] == true ){
						let difference = 0;

						/* ---------- difference ---------- */
						if( options['animationDifference'] !== null ){
							let regexp = new RegExp('^(\\+|\\-)?(0[1-9]{0,2}|\\d{0,3})(,\\d{3})*(\\.[0-9]+)?$', 'g');

							for ( let i = 0; i < options['animationDifference'].length; i++ ) {
								if( regexp.test( options['animationDifference'][i] ) == true ){
									// 数値だったら
									difference += options['animationDifference'][i];
								} else{
									// 要素だったら
									let difference_element = document.querySelector( options['animationDifference'][i] );
									difference += difference_element.clientHeight;
								}
							}
						}


						/* ---------- animation ---------- */
						let start_time  = Date.now();
						let scroll_from = window.pageYOffset || document.documentElement.scrollTop;
						let position = _this.getBoundingClientRect().top - difference;

						(function loop() {
							let currentTime = Date.now() - start_time;
							if(currentTime < options['animationSpeed']) {
								scrollTo(0, options['animationEasing'](currentTime, scroll_from, position, options['animationSpeed']));
								window.requestAnimationFrame(loop);
							} else {
								scrollTo(0, position + scroll_from);
							}
						})();

					} else if( options['animation'] == false ){
						window.scrollTo( 0 , options['animationPosition'] );
					}
				}







				/**************************************************************
				 * check click
				 * 確認ボタンを押した時
				**************************************************************/
				if( check ){
					check.addEventListener('click',function(e){
						e.preventDefault();

						/* ----- エラーメッセージ削除 -----  */
						const erroeText = document.querySelectorAll('.js-error-text');
						erroeMessage.remove( erroeText );

						/* ----- エラーチェック -----  */
						requiredCheck.submit();
						telCheck.submit( tel );
						emailCheck.submit( email );
						emailConfirm.submit();


						/* ----- エラーがなければ、フォームを作動 ----- */
						if(
							errorFlg_required     === false &&
							errorFlg_emailCheck   === false &&
							errorFlg_emailConfirm === false &&
							errorFlg_telCheck     === false
						){
							if( nowStep === stepLength ){
								target.submit();
								return false;
							} else{
								nowStep++;
								target.dataset.state = nowStep;

								/* ---------- stepFunctions ---------- */
								if( typeof options['stepFunctions'][ nowStep - 1 ] === 'function' ){
									options['stepFunctions'][ nowStep - 1 ]();
								}

								required = target.querySelectorAll( options['required'][ nowStep - 1 ] );
								email    = target.querySelectorAll('[data-step="' + nowStep + '"] [type="email"]');
								tel      = target.querySelectorAll('[data-step="' + nowStep + '"] [type="tel"]');

								requiredCheck.change( required );
								telCheck.change( tel );
								emailCheck.change( email );
							}
						} else{
							scrollAnimation( target );
						}


						/* ----- 次のためにフラグを初期化 ----- */
						errorFlg_required     = false;
						errorFlg_emailCheck   = false;
						errorFlg_emailConfirm = false;
						errorFlg_telCheck     = false;

					});
				}




				/**************************************************************
				 * submit click
				 * 送信ボタンを押した時
				**************************************************************/
				if( submit ){
					submit.addEventListener('click',function(e){
						e.preventDefault();
						target.submit();
					});
				}




				/**************************************************************
				 * requiredStatus
				 * 全てのエラーチェックが終わって判定するため一番最後
				 *
				 * status配列を、必須項目の分用意する。
				 * 入力済みが1、未入力が0とし、0の個数をカウントし判定する。
				**************************************************************/
				const requiredStatus = {
					currentTarget: document.querySelector( options['requiredStatusCurrent'] ),
					totalTarget  : document.querySelector( options['requiredStatusTotal'] ),
					init         : function(){
						const _this = requiredStatus;

						/* ---------- settings ---------- */
						_this.required  = [];
						_this.status    = [];
						_this.remaining = 0;

						_this.settings();

						/* ---------- load count ---------- */
						// load時は無駄がないように、必須項目のnameの種類分回す。
						for ( let i = 0; i < _this.required.length; i++) {
							_this.count( _this.required[i][0] );
						}

						/* ---------- change count ---------- */
						// change時は、変更されたものを基準に判定する
						// for ( let i = 0; i < required.length; i++) {
						// 	required[i].addEventListener('change', function(){
						// 		_this.count( required[i] );
						// 	});
						// }

						// 自動入力や住所自動入力対応のため、change時に全ての必須項目を判定する
						for ( let i = 0; i < required.length; i++) {
							required[i].addEventListener('change', function(){
								for ( let i = 0; i < _this.required.length; i++) {
									_this.count( _this.required[i][0] );
								}
							});
						}

					},
					settings: function(){
						const _this = requiredStatus;

						// ++した後データ属性をセットするので、-1からスタート
						let length     = -1;
						let nameAarray = [];

						for ( let i = 0; i < required.length; i++ ) {
							/* ---------- total ---------- */
							/*
								checkbox,radioなどnameが同じものは、まとめて一つとカウントする。
								合わせてstatus配列を生成
							*/
							const name = required[i].getAttribute('name');

							if( nameAarray.indexOf( name ) == -1 ){
								nameAarray.push( name );
								_this.status.push( 0 );
								_this.required.push( target.querySelectorAll('[name="'+ name +'"]') );
								length++;
							}

							/* ---------- index ---------- */
							required[i].dataset.n = length;
						}

						// -1からスタートしているので、1を足す
						_this.totalTarget.innerHTML = length + 1;

					},
					count: function( target ){
						const _this = requiredStatus;

						const control = searchControl( target );
						const num     = target.dataset.n;
						const name    = target.getAttribute('name');
						const type    = target.getAttribute('type');

						const inputs = form.querySelectorAll('[name="'+ name +'"]');

						let remaining = 0;


						/* ---------- checkbox,radioの場合、checkedで判定 ---------- */
						if( type == 'checkbox' || type == 'radio' ){
							for ( let i = 0; i < inputs.length; i++ ) {
								if( inputs[i].checked == true ){
									if( !control.classList.contains( options['errorClass'] ) ){
										_this.status[num] = 1;
									} else{
										_this.status[num] = 0;
									}
									break;
								} else{
									_this.status[num] = 0;
								}
							}
						} else{
							/* ---------- それ以外はvalueで判定 ---------- */
							let value = target.value;

							if( value !== "" ){
								if( !control.classList.contains( options['errorClass'] ) ){
									_this.status[num] = 1;
								} else{
									_this.status[num] = 0;
								}
							} else{
								_this.status[num] = 0;
							}
						}

						/* ---------- count ---------- */
						for ( let i = 0; i < _this.status.length; i++ ) {
							if( _this.status[i] == 0 ){
								remaining++;
							}
						}

						/* ---------- セット ---------- */
						_this.currentTarget.innerHTML = remaining;
						_this.remaining = remaining;

						/* ---------- 必須が全て記入されたかのチェック ---------- */
						if( _this.remaining == 0 ){
							// 全てチェックされた時の処理
							button.classList.remove( options['disabledClass'] );
						} else{
							button.classList.add( options['disabledClass'] );
						}

					},
				}

				if( options['requiredStatus'] === true && document.querySelector( options['requiredStatusCurrent'] ) ){
					window.addEventListener('pageshow',function(){
						requiredStatus.init();
					});
				}




			});
		},
	};

})(this);
/*! cssVariable.js | v2.5.0 | license Copyright (C) 2022 Taichi Matsutaka */
/*
 *
 * @name    : cssVariable.js
 * @content : cssVariable
 * @url     : https://github.com/taichaaan/js-cssVariable
 * @creation: 2022.02.25
 * @update  : 2022.12.05
 * @version : 2.5.0
 *
 */
(function(global) {[]
	global.cssVariable = function(target,options){
		///////////////////////////////////////////////////////////////
		// defaults options
		///////////////////////////////////////////////////////////////
		this.targetElements = document.querySelectorAll( target );

		const defaults = {
			vw              : false,
			vh              : false,
			addressbarHeight: false,
			scrollbarWidth  : false,

			thisWidth              : false,
			thisWidthVarName       : '--width',
			thisWidthUnit          : 'px',
			thisWidthTargetSelector: null,
			thisWidthDelay         : 0,
			thisWidthEvent         : null,

			thisHeight              : false,
			thisHeightVarName       : '--height',
			thisHeightUnit          : 'px',
			thisHeightTargetSelector: null,
			thisHeightDelay         : 0,
			thisHeightEvent         : null,
		}


		///////////////////////////////////////////////////////////////
		// options
		///////////////////////////////////////////////////////////////
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		///////////////////////////////////////////////////////////////
		// base
		///////////////////////////////////////////////////////////////
		this.removes = [];
		this.base();


	};
	cssVariable.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;
			const target  = this.targetElements;

			const userAgent = navigator.userAgent;





			///////////////////////////////////////////////////////////////
			// vw
			///////////////////////////////////////////////////////////////
			if( options['vw'] == true ){
				const vw = function(){
					/* ---------- setVariable ---------- */
					const setVariable = function(){
						const window_width = document.documentElement.clientWidth;
						const vw           = window_width / 100;
						document.documentElement.style.setProperty( '--vw', vw + 'px');
					}


					/* ---------- event ---------- */
					window.addEventListener('DOMContentLoaded',setVariable);
					window.addEventListener('resize',setVariable);

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						window.removeEventListener('DOMContentLoaded',setVariable);
						window.removeEventListener('resize',setVariable);
					});
				}
				vw();
			}



			///////////////////////////////////////////////////////////////
			// vh
			///////////////////////////////////////////////////////////////
			if( options['vh'] == true ){
				const vh = function(){
					/* ---------- setVariable ---------- */
					const setVariable = function(){
						const window_width = document.documentElement.clientHeight;
						const vh            = window_width / 100;
						document.documentElement.style.setProperty( '--vh', vh + 'px');
					}

					const onOrientationchange = function(){
						setTimeout(function(){
							setVariable();
						},50);
					}


					/* ---------- event ---------- */
					window.addEventListener('DOMContentLoaded',setVariable);

					if (userAgent.indexOf('iPhone') >= 0 || userAgent.indexOf('iPad') >= 0 || userAgent.indexOf('Android') >= 0){
						window.addEventListener('orientationchange',onOrientationchange);
					} else{
						window.addEventListener('resize',setVariable);
					}

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						window.removeEventListener('DOMContentLoaded',setVariable);
						window.removeEventListener('resize',setVariable);
						window.removeEventListener('orientationchange',onOrientationchange);
					});
				}
				vh();
			}



			///////////////////////////////////////////////////////////////
			// addressbarHeight
			///////////////////////////////////////////////////////////////
			if( options['addressbarHeight'] == true ){
				const addressbarHeight = function(){
					/* ---------- cssの100vhを取得するためのダミー要素を生成 ---------- */
					const dummyElement  = document.createElement('div');
					dummyElement.classList.add('js-cssVariable-100vh');
					dummyElement.style.position      = 'fixed';
					dummyElement.style.top           = '0';
					dummyElement.style.left          = '0';
					dummyElement.style.width         = '100%';
					dummyElement.style.height        = '100vh';
					dummyElement.style.pointerEvents = 'none';
					dummyElement.style.zIndex        = '-999999999999';
					dummyElement.style.opacity       = '0';
					dummyElement.style.visibility    = 'hidden';
					document.body.appendChild( dummyElement );

					/* ---------- setVariable ---------- */
					const setVariable = function(){
						const _100vh        = dummyElement.clientHeight;
						const window_height = window.innerHeight;

						const tabsize = _100vh - window_height;
						document.documentElement.style.setProperty( '--addressbar-height', tabsize + 'px');
					}


					/* ---------- event ---------- */
					window.addEventListener('DOMContentLoaded',setVariable);
					window.addEventListener('resize',setVariable);

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						window.removeEventListener('DOMContentLoaded',setVariable);
						window.removeEventListener('resize',setVariable);
					});
				}
				addressbarHeight();
			}



			///////////////////////////////////////////////////////////////
			// setScrollbarWidth
			///////////////////////////////////////////////////////////////
			if( options['scrollbarWidth'] == true ){
				const scrollbarWidth = function(){
					/* ---------- setVariable ---------- */
					const setVariable = function(){
						const scrollbar = window.innerWidth - document.documentElement.clientWidth;
						document.documentElement.style.setProperty( '--scrollbar-width', scrollbar + 'px');
					}


					/* ---------- event ---------- */
					window.addEventListener('DOMContentLoaded',setVariable);

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						window.removeEventListener('DOMContentLoaded',setVariable);
					});
				}
				scrollbarWidth();
			}



			///////////////////////////////////////////////////////////////
			// thisWidth
			///////////////////////////////////////////////////////////////
			if( options['thisWidth'] == true ){
				const thisWidth = function(){
					/* ---------- setVariable ---------- */
					let setVariable = null;

					if( options['thisWidthTargetSelector'] == null ){
						setVariable = function(){
							setTimeout(function(){
								for ( let i = 0; i < target.length; i++ ) {
									target[i].style.setProperty( options['thisWidthVarName'] , target[i].clientWidth + options['thisWidthUnit'] );
								}
							}, options['thisWidthDelay'] );
						}
					} else{
						setVariable = function(){
							setTimeout(function(){
								for ( let i = 0; i < target.length; i++ ) {
									const innerTarget = target[i].querySelector( options['thisWidthTargetSelector'] );

									if( innerTarget ){
										target[i].style.setProperty( options['thisWidthVarName'] , innerTarget.clientWidth + options['thisWidthUnit'] );
									}
								}
							}, options['thisWidthDelay'] );
						}
					}


					/* ---------- onOrientationchange ---------- */
					const onOrientationchange = function(){
						setTimeout(function(){
							setVariable();
						},50);
					}


					/* ---------- event ---------- */
					window.addEventListener('load',setVariable);

					if (userAgent.indexOf('iPhone') >= 0 || userAgent.indexOf('iPad') >= 0 || userAgent.indexOf('Android') >= 0){
						window.addEventListener('orientationchange',onOrientationchange);
					} else{
						window.addEventListener('resize',setVariable);
					}

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						window.removeEventListener('load',setVariable);
						window.removeEventListener('resize',setVariable);
						window.removeEventListener('orientationchange',onOrientationchange);
					});

					/* ---------- originalEvent ---------- */
					if( options['thisWidthEvent'] != null ){
						for ( let i = 0; i < options['thisWidthEvent'].length; i++ ) {
							window.addEventListener( options['thisWidthEvent'][i] ,setVariable);

							/* ---------- removes ---------- */
							_this.removes.push( function(){
								window.removeEventListener( options['thisWidthEvent'][i] ,setVariable);
							});
						}
					}

				};
				thisWidth();
			}




			///////////////////////////////////////////////////////////////
			// thisHeight
			///////////////////////////////////////////////////////////////
			if( options['thisHeight'] == true ){
				const thisHeight = function(){
					/* ---------- setVariable ---------- */
					let setVariable = null;

					if( options['thisHeightTargetSelector'] == null ){
						setVariable = function(){
							setTimeout(function(){
								for ( let i = 0; i < target.length; i++ ) {
									target[i].style.setProperty( options['thisHeightVarName'] , target[i].clientHeight + options['thisHeightUnit'] );
								}
							}, options['thisHeightDelay'] );
						}
					} else{
						setVariable = function(){
							setTimeout(function(){
								for ( let i = 0; i < target.length; i++ ) {
									const innerTarget = target[i].querySelector( options['thisHeightTargetSelector'] );

									if( innerTarget ){
										target[i].style.setProperty( options['thisHeightVarName'] , innerTarget.clientHeight + options['thisHeightUnit'] );
									}
								}
							}, options['thisHeightDelay'] );
						}
					}


					/* ---------- onOrientationchange ---------- */
					const onOrientationchange = function(){
						setTimeout(function(){
							setVariable();
						},50);
					}


					/* ---------- event ---------- */
					window.addEventListener('load',setVariable);

					if (userAgent.indexOf('iPhone') >= 0 || userAgent.indexOf('iPad') >= 0 || userAgent.indexOf('Android') >= 0){
						window.addEventListener('orientationchange',onOrientationchange);
					} else{
						window.addEventListener('resize',setVariable);
					}

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						window.removeEventListener('load',setVariable);
						window.removeEventListener('resize',setVariable);
						window.removeEventListener('orientationchange',onOrientationchange);
					});

					/* ---------- originalEvent ---------- */
					if( options['thisHeightEvent'] != null ){
						for ( let i = 0; i < options['thisHeightEvent'].length; i++ ) {
							window.addEventListener( options['thisHeightEvent'][i] ,setVariable);

							/* ---------- removes ---------- */
							_this.removes.push( function(){
								window.removeEventListener( options['thisHeightEvent'][i] ,setVariable);
							});
						}
					}

				};
				thisHeight();
			}





		},
		remove: function(){
			/* removes に追加された関数をforで一つずつ実行する。 */
			const removes = this.removes;

			if( !removes ) return;

			for ( let i = 0; i < removes.length; i++ ) {
				removes[i]();
			}
		},
	};

})(this);

/*! currentSection.js | v2.0.2 | license Copyright (C) 2020 - 2024 Taichi Matsutaka */
/*
 *
 * @name    : currentSection.js
 * @content : currentSection
 * @url     : https://github.com/taichaaan/js-currentSection
 * @creation: 2020.04.11
 * @update  : 2024.01.23
 * @version : 2.0.2
 *
 */
(function(global) {[]
	global.currentSection = function(target,options){
		const _this = this;

		/**************************************************************
		 * defaults options
		************************************************************ */
		this.target = Array.prototype.slice.call( document.querySelectorAll( target ) ,0) ;

		const defaults = {
			mediaQuery           : null,
			currentClass         : 'is-current',
			sectionSelector      : '.js-section',
			navigationSelector   : '.js-navigation a',
			centerMode           : false,
			getSectionOffsetEvent: ['load','resize'],
			setCurrentEvent      : ['load','scroll'],

			onChange    : null,
			onScrollStop: null,
		}


		/**************************************************************
		 * options
		************************************************************ */
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		/**************************************************************
		 * property
		************************************************************ */
		this.onStructures   = [];
		this.onRestructures = [];
		this.onDestroys     = [];
		this.startingFLg    = false;

		this.sections    = [];
		this.navigations = [];
		this.offsets     = [];

		this.currentPositions = [];
		this.prevPositions    = [];


		/**************************************************************
		 * method
		**************************************************************/
		this.getSize();
		this.settings();
		this.setupGetOffset();
		this.setupCheckCurrent();
		this.setupScrollStop();
		this.starting();

	};
	currentSection.prototype = {
		getSize: function(){
			const _this = this;

			/**************************************************************
			 * window size
			**************************************************************/
			const getWindowSize = function(){
				_this.wh      = document.documentElement.clientHeight;
				_this.wh_half = _this.wh / 2;
			}
			const getScrollTop = function(){
				_this.sy = document.documentElement.scrollTop || document.body.scrollTop;
			}

			this.onStructures.push( function(){
				window.addEventListener('DOMContentLoaded',getWindowSize);
				window.addEventListener('resize',getWindowSize);
				window.addEventListener('load',getScrollTop);
				window.addEventListener('scroll',getScrollTop);
			});
			this.onRestructures.push( function(){
				getWindowSize();
				getScrollTop();
				window.addEventListener('resize',getWindowSize);
				window.addEventListener('scroll',getScrollTop);
			});
			this.onDestroys.push( function(){
				window.removeEventListener('DOMContentLoaded',getWindowSize);
				window.removeEventListener('resize',getWindowSize);
				window.removeEventListener('load',getScrollTop);
				window.removeEventListener('scroll',getScrollTop);
			});
		},
		settings: function(){
			const _this = this;

			/**************************************************************
			 * addSettings
			**************************************************************/
			const addSettings = function(){
				for (let i = 0; i < _this.target.length; i++) {
					_this.sections[i]    = _this.target[i].querySelectorAll( _this.options['sectionSelector'] );
					_this.navigations[i] = _this.target[i].querySelectorAll( _this.options['navigationSelector'] );
				}

				for ( let i = 0; i < _this.sections.length; i++ ) {
					_this.offsets[i]          = [];
					_this.currentPositions[i] = 0;
					_this.prevPositions[i]    = null;
				}
			}

			this.onStructures.push( function(){
				addSettings();
			});
			this.onRestructures.push( function(){
				addSettings();
			});



			/**************************************************************
			 * removeSettings
			**************************************************************/
			const removeSettings = function(){
				_this.sections    = [];
				_this.navigations = [];
				_this.offsets     = [];

				_this.currentPositions = [];
				_this.prevPositions    = [];
			}

			this.onDestroys.push( function(){
				removeSettings();
			});

		},
		setupGetOffset: function(){
			const _this = this;

			/**************************************************************
			 * setupGetOffset
			 * getOffset関数のセットアップ
			**************************************************************/
			let getSectionOffset = function(){};

			if( _this.options['centerMode'] == true ){
				getSectionOffset = function(){
					for ( let i = 0; i < _this.sections.length; i++ ) {
						for ( let j = 0; j < _this.sections[i].length; j++ ) {
							const offset = _this.sections[i][j].getBoundingClientRect().top + _this.sy - 1;
							_this.offsets[i][j] = offset - _this.wh_half;
						}
					}
				}
			} else{
				getSectionOffset = function(){
					for ( let i = 0; i < _this.sections.length; i++ ) {
						for ( let j = 0; j < _this.sections[i].length; j++ ) {
							const offset = _this.sections[i][j].getBoundingClientRect().top + _this.sy - 1;
							_this.offsets[i][j] = offset;
						}
					}
				}
			}

			this.onStructures.push( function(){
				for ( let i = 0; i < _this.options['getSectionOffsetEvent'].length; i++ ) {
					window.addEventListener( _this.options['getSectionOffsetEvent'][i] ,getSectionOffset);
				}
			});
			this.onRestructures.push( function(){
				for ( let i = 0; i < _this.options['getSectionOffsetEvent'].length; i++ ) {
					window.addEventListener( _this.options['getSectionOffsetEvent'][i] ,getSectionOffset);
				}
			});
			this.onDestroys.push( function(){
				for ( let i = 0; i < _this.options['getSectionOffsetEvent'].length; i++ ) {
					window.removeEventListener( _this.options['getSectionOffsetEvent'][i] ,getSectionOffset);
				}
			});

		},
		setupCheckCurrent: function(){
			const _this = this;

			/**************************************************************
			 * setupCheckCurrent
			 * checkCurrent関数のセットアップ
			**************************************************************/
			const setCurrent = function(){
				for ( let i = 0; i < _this.sections.length; i++ ) {

					if( _this.offsets[i].length ){
						if( _this.sy < _this.offsets[i][0] ){
							_this.navigations[i][0].classList.add( _this.options['currentClass'] );
							_this.currentPositions[i] = -1;
						} else{
							for ( let j = 0; j < _this.offsets[i].length; j++ ) {
								if( _this.sy > _this.offsets[i][j] ){
									_this.currentPositions[i] = j;
								}
							}

							if( _this.navigations[i][ _this.prevPositions[i] ] ){
								_this.navigations[i][ _this.prevPositions[i] ].classList.remove( _this.options['currentClass'] );
							}
							if( _this.navigations[i][ _this.currentPositions[i] ] ){
								_this.navigations[i][ _this.currentPositions[i] ].classList.add( _this.options['currentClass'] );
							}

							if( _this.currentPositions[i] !== _this.prevPositions[i] ){
								if( typeof _this.options['onChange'] === 'function' ){
									_this.options['onChange']( _this.target[i] , _this.currentPositions[i] , _this.prevPositions[i] );
								}
							}

							_this.prevPositions[i] = _this.currentPositions[i];
						}
					}

				}
			}


			this.onStructures.push( function(){
				for ( let i = 0; i < _this.options['setCurrentEvent'].length; i++ ) {
					window.addEventListener( _this.options['setCurrentEvent'][i] ,setCurrent);
				}
			});
			this.onRestructures.push( function(){
				for ( let i = 0; i < _this.options['setCurrentEvent'].length; i++ ) {
					window.addEventListener( _this.options['setCurrentEvent'][i] ,setCurrent);
				}
			});
			this.onDestroys.push( function(){
				for ( let i = 0; i < _this.options['setCurrentEvent'].length; i++ ) {
					window.removeEventListener( _this.options['setCurrentEvent'][i] ,setCurrent);
				}
			});

		},
		setupScrollStop: function(){
			const _this = this;

			/**************************************************************
			 * setupScrollStop
			 * scrollStop関数のセットアップ
			**************************************************************/
			let timeoutId = null;

			const scrollStop = function(){
				clearTimeout( timeoutId ) ;

				timeoutId = setTimeout(function(){
					for ( let i = 0; i < _this.sections.length; i++ ) {
						if( typeof _this.options['onScrollStop'] === 'function' ){
							_this.options['onScrollStop']( _this.target[i] , _this.currentPositions[i] , _this.prevPositions[i] );
						}
					}
				},100);
			}

			this.onStructures.push( function(){
				window.addEventListener('scroll',scrollStop);
			});
			this.onRestructures.push( function(){
				window.addEventListener('scroll',scrollStop);
			});
			this.onDestroys.push( function(){
				window.removeEventListener('scroll',scrollStop);
			});

		},
		starting: function(){
			const _this = this;

			/**************************************************************
			 * starting
			 * ブレイクポイントに合わせて発動
			**************************************************************/
			if( _this.options['mediaQuery'] == null ){
				_this.onStructure();
			} else{
				const breakPoint = function(){
					const mediaQuery = window.matchMedia( _this.options['mediaQuery'] );

					function checkBreakPoint( mediaQuery ) {
						if ( mediaQuery.matches ) {
							if( _this.startingFLg == false ){
								_this.onStructure();
							} else{
								_this.onRestructure();
							}
						} else{
							_this.onDestroy();
						}
					}

					mediaQuery.addListener( checkBreakPoint ); // ブレイクポイントの度に
					checkBreakPoint( mediaQuery ); // 初回
				}
				breakPoint();
			}

			_this.startingFLg = true;
		},
		onStructure: function(){
			/**************************************************************
			 * 構築メソッド
			************************************************************ */
			const onStructures = this.onStructures;
			for ( let i = 0; i < onStructures.length; i++ ) {
				onStructures[i]();
			}
		},
		onRestructure: function(){
			/**************************************************************
			 * 再構築メソッド
			************************************************************ */
			const onRestructures = this.onRestructures;
			for ( let i = 0; i < onRestructures.length; i++ ) {
				onRestructures[i]();
			}
		},
		onDestroy: function(){
			/**************************************************************
			 * 破壊メソッド
			************************************************************ */
			const onDestroys = this.onDestroys;
			for ( let i = 0; i < onDestroys.length; i++ ) {
				onDestroys[i]();
			}
		},
	};

})(this);

/*! getEasing.js | v1.0.0 | license Copyright (C) 2020 Taichi Matsutaka */
/*
 *
 * @name    : getEasing.js
 * @content : getEasing
 * @creation: 2020.05.15
 * @update  : 2020.00.00
 * @version : 1.0.0
 *
 */
(function(global) {[]
	global.getEasing = function(options){
		///////////////////////////////////////////////////////////////
		// defaults options
		///////////////////////////////////////////////////////////////
		const defaults = {
			easing: 'linear',
		}


		///////////////////////////////////////////////////////////////
		// options
		///////////////////////////////////////////////////////////////
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		///////////////////////////////////////////////////////////////
		// base
		///////////////////////////////////////////////////////////////
		const easing = this.base();
		return easing;

	};
	getEasing.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;


			///////////////////////////////////////////////////////////////
			// easingFunctions
			///////////////////////////////////////////////////////////////
			const easingFunctions = {
				linear: function (t, b, c, d) {
						return c * t / d + b;
				},
				jswing: function (t, b, c, d) {
						return c * (0.5 - Math.cos(t / d * Math.PI) / 2) + b;
				},
				swing: function(t, b, c, d) {
						return -c *(t/=d)*(t-2) + b;
				},
				easeInQuad: function (t, b, c, d) {
						return c*(t/=d)*t + b;
				},
				easeOutQuad: function (t, b, c, d) {
						return -c *(t/=d)*(t-2) + b;
				},
				easeInOutQuad: function (t, b, c, d) {
						if ((t/=d/2) < 1) return c/2*t*t + b;
						return -c/2 * ((--t)*(t-2) - 1) + b;
				},
				easeInCubic: function (t, b, c, d) {
						return c*(t/=d)*t*t + b;
				},
				easeOutCubic: function (t, b, c, d) {
						return c*((t=t/d-1)*t*t + 1) + b;
				},
				easeInOutCubic: function (t, b, c, d) {
						if ((t/=d/2) < 1) return c/2*t*t*t + b;
						return c/2*((t-=2)*t*t + 2) + b;
				},
				easeInQuart: function (t, b, c, d) {
						return c*(t/=d)*t*t*t + b;
				},
				easeOutQuart: function (t, b, c, d) {
						return -c * ((t=t/d-1)*t*t*t - 1) + b;
				},
				easeInOutQuart: function (t, b, c, d) {
						if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
						return -c/2 * ((t-=2)*t*t*t - 2) + b;
				},
				easeInQuint: function (t, b, c, d) {
						return c*(t/=d)*t*t*t*t + b;
				},
				easeOutQuint: function (t, b, c, d) {
						return c*((t=t/d-1)*t*t*t*t + 1) + b;
				},
				easeInOutQuint: function (t, b, c, d) {
						if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
						return c/2*((t-=2)*t*t*t*t + 2) + b;
				},
				easeInSine: function (t, b, c, d) {
						return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
				},
				easeOutSine: function (t, b, c, d) {
						return c * Math.sin(t/d * (Math.PI/2)) + b;
				},
				easeInOutSine: function (t, b, c, d) {
						return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
				},
				easeInExpo: function (t, b, c, d) {
						return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
				},
				easeOutExpo: function (t, b, c, d) {
						return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
				},
				easeInOutExpo: function (t, b, c, d) {
						if (t==0) return b;
						if (t==d) return b+c;
						if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
						return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
				},
				easeInCirc: function (t, b, c, d) {
						return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
				},
				easeOutCirc: function (t, b, c, d) {
						return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
				},
				easeInOutCirc: function (t, b, c, d) {
						if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
						return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
				},
				easeInElastic: function (t, b, c, d) {
						var s=1.70158;var p=0;var a=c;
						if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
						if (a < Math.abs(c)) { a=c; var s=p/4; }
						else var s = p/(2*Math.PI) * Math.asin (c/a);
						return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
				},
				easeOutElastic: function (t, b, c, d) {
						var s=1.70158;var p=0;var a=c;
						if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
						if (a < Math.abs(c)) { a=c; var s=p/4; }
						else var s = p/(2*Math.PI) * Math.asin (c/a);
						return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
				},
				easeInOutElastic: function (t, b, c, d) {
						var s=1.70158;var p=0;var a=c;
						if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
						if (a < Math.abs(c)) { a=c; var s=p/4; }
						else var s = p/(2*Math.PI) * Math.asin (c/a);
						if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
						return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
				},
				easeInBack: function (t, b, c, d, s) {
						if (s == undefined) s = 1.70158;
						return c*(t/=d)*t*((s+1)*t - s) + b;
				},
				easeOutBack: function (t, b, c, d, s) {
						if (s == undefined) s = 1.70158;
						return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
				},
				easeInOutBack: function (t, b, c, d, s) {
						if (s == undefined) s = 1.70158;
						if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
						return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
				},
				easeInBounce: function (t, b, c, d) {
						return c - easingFunctions.easeOutBounce (d-t, 0, c, d) + b;
				},
				easeOutBounce: function (t, b, c, d) {
						if ((t/=d) < (1/2.75)) {
							return c*(7.5625*t*t) + b;
						} else if (t < (2/2.75)) {
							return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
						} else if (t < (2.5/2.75)) {
							return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
						} else {
							return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
						}
				},
				easeInOutBounce: function (t, b, c, d) {
						if (t < d/2) return easingFunctions.easeInBounce (t*2, 0, c, d) * .5 + b;
						return easingFunctions.easeOutBounce (t*2-d, 0, c, d) * .5 + c*.5 + b;
				}
			};


			return easingFunctions[ options['easing'] ];
		}
	};

})(this);

/*! isCurrent.js | v3.1.0 | license Copyright (C) 2020 - 2022 Taichi Matsutaka */
/*
 *
 * @name    : isCurrent.js
 * @content : isCurrent
 * @creation: 2020.01.03
 * @update  : 2022.02.11
 * @version : 3.1.0
 *
 */
(function(global) {[]
	global.isCurrent = function(node,options){
		/////////////////////////////////////////////
		// defaults options
		/////////////////////////////////////////////
		this.nodeElements = Array.prototype.slice.call( document.querySelectorAll( node ) ,0) ;

		const defaults = {
			parameterHash: true,
			currentClass : 'is-current',
			contain      : false,
			containClass : 'is-contain',
		}


		/////////////////////////////////////////////
		// options
		/////////////////////////////////////////////
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		/////////////////////////////////////////////
		// base
		/////////////////////////////////////////////
		this.base();


	};
	isCurrent.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;


			/////////////////////////////////////////////
			// 相対パスを取得
			/////////////////////////////////////////////
			function getDir(path) {
				return path.replace(/\\/g, '/').replace(/^[^/]*\/\/[^/]*/, '');
			}
			let page_url = getDir( window.location.href ); // パラメーターやハッシュタグ含め全て相対パスで取得する

			if( options['parameterHash'] === false ){
				// falseならパラメーターやハッシュタグなしの相対パスで取得する
				page_url = window.location.pathname;
			}


			this.nodeElements.forEach(function(target) {
				/////////////////////////////////////////////
				// 判別
				/////////////////////////////////////////////
				let href = target.getAttribute('href');

				if( href == page_url ){
					target.classList.add( options['currentClass'] );
				}

				if( options['contain'] == true ){
					if ( page_url.indexOf( href ) != -1 ) {
						target.classList.add( options['containClass'] );
					}
				}
			});
		},
	};

})(this);

/*! lazyload.js | v3.4.1 | license Copyright (C) 2019 - 2022 Taichi Matsutaka */
/*
 *
 * @name    : lazyload.js
 * @content : lazyload frame
 * @creation: 2019.11.11
 * @update  : 2022.05.17
 * @version : 3.4.1
 *
 */
(function(global) {[]
	global.lazyload = function(target,options){
		///////////////////////////////////////////////////////////////
		// defaults options
		///////////////////////////////////////////////////////////////
		this.targetElements = Array.prototype.slice.call( document.querySelectorAll( target ) ,0) ;

		const defaults = {
			position  : 1,
			setClass  : 'is-set',
			objectFit : true,
			immedStart: false,

			getWindowSizeEvent: ['DOMContentLoaded','resize'],
			getScrollTopEvent : ['DOMContentLoaded','scroll'],
			setSourceEvent    : ['DOMContentLoaded','scroll'],
		}


		///////////////////////////////////////////////////////////////
		// options
		///////////////////////////////////////////////////////////////
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		///////////////////////////////////////////////////////////////
		// base
		///////////////////////////////////////////////////////////////
		this.removes = [];
		this.base();


	};
	lazyload.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;


			///////////////////////////////////////////////////////////////
			// variable
			///////////////////////////////////////////////////////////////
			const propRegex  = /(object-fit|object-position)\s*:\s*([-.\w\s%]+)/g;
			let scrollTop    = 0;
			let windowHeight = document.documentElement.clientHeight;


			///////////////////////////////////////////////////////////////
			// objectFit 判定
			///////////////////////////////////////////////////////////////
			const objectFitStyle = document.createElement('div');
			objectFitStyle.style.cssText = 'object-fit: cover;'

			function getStyle(el) {
				let style = getComputedStyle(el).fontFamily;
				let parsed;
				let props = {};
				while ((parsed = propRegex.exec(style)) !== null) {
					props[parsed[1]] = parsed[2];
				}
				return props;
			}


			//////////////////////////////////////////////////////////////
			// window size
			///////////////////////////////////////////////////////////////
			function getWindowSize(){
				windowHeight = document.documentElement.clientHeight;
			}

			if( options['immedStart'] === true ){
				getWindowSize();
			}

			for ( let i = 0; i < options['getWindowSizeEvent'].length; i++ ) {
				window.addEventListener( options['getWindowSizeEvent'][i] ,getWindowSize);
			}

			/* ---------- removes ---------- */
			_this.removes.push( function(){
				for ( let i = 0; i < options['getWindowSizeEvent'].length; i++ ) {
					window.removeEventListener( options['getWindowSizeEvent'][i] ,getWindowSize);
				}
			});



			///////////////////////////////////////////////////////////////
			// scrollTop
			///////////////////////////////////////////////////////////////
			function getScrollTop(){
				scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
			}

			if( options['immedStart'] === true ){
				getScrollTop();
			}

			for ( let i = 0; i < options['getScrollTopEvent'].length; i++ ) {
				window.addEventListener( options['getScrollTopEvent'][i] ,getScrollTop);
			}

			/* ---------- removes ---------- */
			_this.removes.push( function(){
				for ( let i = 0; i < options['getScrollTopEvent'].length; i++ ) {
					window.removeEventListener( options['getScrollTopEvent'][i] ,getScrollTop);
				}
			});





			this.targetElements.forEach(function(target) {

				///////////////////////////////////////////////////////////////
				// setSource
				///////////////////////////////////////////////////////////////
				function setSource(){
					let position = 1;

					if( options['position'] ){
						position = options['position'];
					}


					let offset = target.getBoundingClientRect().top + scrollTop;
					let starPosition = offset - windowHeight - ( windowHeight * position );

					if( scrollTop > starPosition ){
						if( !target.classList.contains( options['setClass'] ) ){
							const tag = target.tagName;
							let originalSource = target.dataset.original;

							if( tag === 'IMG' ){
								/////////////////////////////////////////////
								// IMG
								/////////////////////////////////////////////
								if( options['objectFit'] == true ){
									if ( !objectFitStyle.style.length ) {
										let style = getStyle(target);
										let fontFamily = style.fontFamily;

										if( style['object-fit'] !== undefined ){
											target.style.backgroundImage = 'url('+ originalSource +')';
										} else{
											target.setAttribute( 'src' , originalSource );
										}
									} else{
										target.setAttribute( 'src' , originalSource );
									}
								} else{
									target.setAttribute( 'src' , originalSource );
								}

								let image = new Image();
								image.src = originalSource;

								image.onload = function(){
									target.classList.add( options['setClass'] );

									target.removeAttribute('data-original');
									window.removeEventListener('scroll', setSource );
								};
							} else if( tag === 'IFRAME' || tag === 'VIDEO'  ){
								/////////////////////////////////////////////
								// IFRAME
								/////////////////////////////////////////////
								target.setAttribute('src',originalSource);
								target.classList.add( options['setClass'] );

								target.removeAttribute('data-original');
								window.removeEventListener('scroll', setSource );

								const isPlay = function(){
									target.classList.add('is-play');
									target.removeEventListener('play',isPlay);
								}

								if( tag === 'VIDEO' ){
									target.addEventListener('play',isPlay);
								}
							}
						}
					}
				}

				if( options['immedStart'] === true ){
					setSource();
				}
				for ( let i = 0; i < options['setSourceEvent'].length; i++ ) {
					window.addEventListener( options['setSourceEvent'][i] ,setSource);
				}

				/* ---------- removes ---------- */
				_this.removes.push( function(){
					for ( let i = 0; i < options['setSourceEvent'].length; i++ ) {
						window.removeEventListener( options['setSourceEvent'][i] ,setSource);
					}
				});



			});
		},
		remove: function(){
			/* removes に追加された関数をforで一つずつ実行する。 */
			const removes = this.removes;

			if( !removes ) return;

			for ( let i = 0; i < removes.length; i++ ) {
				removes[i]();
			}
		},
	};

})(this);

/*! popup.js | v5.3.0 | license Copyright (C) 2018 - 2022 Taichi Matsutaka */
/*
 *
 * @name    : popup.js
 * @content : popup
 * @creation: 2018.11.13
 * @update  : 2022.06.28
 * @version : 5.3.0
 *
 */
(function(global) {[]
	global.popup = function(node,options){
		///////////////////////////////////////////////////////////////
		// defaults options
		///////////////////////////////////////////////////////////////
		this.nodeElements = Array.prototype.slice.call( document.querySelectorAll( node ) ,0) ;
		const _this = this;

		const defaults = {
			popupSelector      : '.js-popup-body',
			closeButtonSelector: null,
			breakPointDown     : null,
			bodyFixed          : true,
			animationTime      : 0,
			// bg
			bg                 : true,
			bgContainerSelector: null,
			bgStyle            : true,
			bgClass            : 'js-popup-bg',
			bgZindex           : 99,
			bgColor            : 'rgba(75,73,72,0.5)',
			bgAnimation        : true,
			bgSpeed            : '500',
			bgEasing           : 'linear',
			// smoothScroll
			smoothScroll   : null,
			// openClass
			popupOpenClass : 'is-open',
			buttonOpenClass: 'is-open',
			bodyOpenClass  : 'is-popup-open',
			basicId        : 'aria-popup-',
			basicIdIndex   : true,

			onOpen : null,
			onClose: null,
		}


		///////////////////////////////////////////////////////////////
		// options
		///////////////////////////////////////////////////////////////
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		///////////////////////////////////////////////////////////////
		// base
		///////////////////////////////////////////////////////////////
		this.removes = [];
		this.base();



	};
	popup.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;

			///////////////////////////////////////////////////////////////
			// variable
			///////////////////////////////////////////////////////////////
			let index = 0;

			let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
			let openFlg   = false;
			let closeFlg  = false;

			let button             = null;
			let popup            = null;
			let bg                 = null;
			let closeButtonSelector_target = null;
			let smoothScroll       = null;

			if( options['closeButtonSelector'] != null ) closeButtonSelector_target = document.querySelectorAll( options['closeButtonSelector'] );
			if( options['smoothScroll'] != null ) smoothScroll = document.querySelectorAll( options['smoothScroll'] );

			let mediaQuerie = '';

			if( options['breakPointDown'] != null ){
				mediaQuerie = window.matchMedia( 'screen and ( max-width: '+ (options['breakPointDown'] - 1 ) +'px )' );
			} else{
				mediaQuerie = window.matchMedia( 'screen and ( min-width: 0px )' );
			}



			///////////////////////////////////////////////////////////////
			// bg
			///////////////////////////////////////////////////////////////
			/* ---------- setting ---------- */
			if( options['bg'] === true ){

				if( !document.querySelector( '.'+options['bgClass'] ) ){
					let div = document.createElement('div');
					div.setAttribute('class',options['bgClass']);

					const bgContainerSelector = document.querySelector( options['bgContainerSelector'] );

					if( options['bgStyle'] === true ){
						div.style.width           = '100%';
						div.style.height          = '100%';
						div.style.position        = 'fixed';
						div.style.top             = '0';
						div.style.left            = '0';
						div.style.backgroundColor = options['bgColor'];
						div.style.zIndex          = options['bgZindex'];
						div.style.opacity         = '0';
						div.style.visibility      = 'hidden';

						if( options['bgAnimation'] === true ){
							div.style.transition         = options['bgEasing'] + ' ' + options['bgSpeed'] + 'ms';
							div.style.transitionProperty = 'opacity,visibility';
						}
					}

					if( bgContainerSelector ){
						bgContainerSelector.appendChild(div);
					} else{
						document.body.appendChild(div);
					}
				}

				bg = document.querySelector('.' + options['bgClass']);

				/* ---------- event ---------- */
				bg.addEventListener('click',function(e){
					e.preventDefault();
					close();
				},false);
			}




			///////////////////////////////////////////////////////////////
			// close
			///////////////////////////////////////////////////////////////
			const close = function(){
				if( openFlg === true && closeFlg === true ){
					popup.classList.remove( options['popupOpenClass'] );
					button.classList.remove( options['buttonOpenClass'] );

					button.setAttribute('aria-expanded','false');
					popup.setAttribute('aria-hidden','true');

					if( options['bg'] === true ){
						bg.style.opacity    = '0';
						bg.style.visibility = 'hidden';
					}

					if( options['bodyFixed'] === true ){
						document.body.style.position = '';
						document.body.style.overflow = '';
						document.body.style.top      = '';
						window.scrollTo(0, scrollTop);
					}


					document.body.classList.remove( options['bodyOpenClass'] );

					closeFlg = false;

					setTimeout(function(){
						openFlg  = false;
					},options['animationTime']);
				}

				/* ---------- onClose ---------- */
				if( typeof options['onClose'] === 'function' ){
					options['onClose']();
				}
			}

			_this.close = close;



			///////////////////////////////////////////////////////////////
			// aria
			// aria-label または aria-labelledbyはHTMLで直接指定する。
			// aria-controls、aria-expanded、aria-hiddenはJavaScriptで指定
			///////////////////////////////////////////////////////////////
			/* ---------- idとaria-controlsは popupベース ---------- */
			const ariaSettings = function(){
				const popups = document.querySelectorAll(options['popupSelector']);

				for ( let i = 0; i < popups.length; i++ ) {
					const number = popups[i].dataset.popup;

					if( options['basicIdIndex'] == false ){
						index = '';
					} else{
						index++;
					}

					/* ---------- popup ---------- */
					popups[i].setAttribute('id', options['basicId'] + index );

					/* ---------- button ---------- */
					if( number ){
						_this.nodeElements[i].setAttribute('aria-controls', options['basicId'] + index );
					} else{
						for ( let j = 0; i < _this.nodeElements.length; i++ ) {
							_this.nodeElements[i].setAttribute('aria-controls', options['basicId'] + index );
						}
					}
				}

			}
			ariaSettings();




			this.nodeElements.forEach(function(target) {
				button = target;

				///////////////////////////////////////////////////////////////
				// aria
				// ブレイクポイントを跨ぐときに初期化
				///////////////////////////////////////////////////////////////
				let number = button.dataset.popup;
				if( number ){
					popup = document.querySelectorAll(options['popupSelector'] +'[data-popup="'+ number +'"]')[0];
				} else{
					popup = document.querySelectorAll(options['popupSelector'])[0];
				}

				/* ---------- aria-expanded , aria-hidden ---------- */
				const ariaData = function(){
					let mediaQuerie = '';
					mediaQuerie = window.matchMedia( 'screen and ( max-width: '+ (options['breakPointDown'] - 1 ) +'px )' );

					const checkBreakPoint = function( mediaQuerie ){
						if ( mediaQuerie.matches ) {
							target.setAttribute('aria-expanded','false');
							popup.setAttribute('aria-hidden','true');
						} else{
							target.setAttribute('aria-expanded','true');
							popup.setAttribute('aria-hidden','false');
						}
					}

					mediaQuerie.addListener( checkBreakPoint ); // ブレイクポイントの度に
					checkBreakPoint( mediaQuerie ); // 初回

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						mediaQuerie.removeListener( checkBreakPoint );
					});
				}

				if( options['breakPointDown'] == null ){
					target.setAttribute('aria-expanded','false');
					popup.setAttribute('aria-hidden','true');
				} else{
					ariaData();
				}



				///////////////////////////////////////////////////////////////
				// open
				///////////////////////////////////////////////////////////////
				target.addEventListener('click',function(e){
					e.preventDefault();

					if ( mediaQuerie.matches ) {
						button = target;
						let number = button.dataset.popup;

						if( number ){
							popup = document.querySelectorAll(options['popupSelector'] +'[data-popup="'+ number +'"]')[0];
						} else{
							popup = document.querySelectorAll(options['popupSelector'])[0];
						}

						if( openFlg === false ){
							button.classList.add( options['buttonOpenClass']);
							popup.classList.add( options['popupOpenClass'] );

							button.setAttribute('aria-expanded','true');
							popup.setAttribute('aria-hidden','false');

							if( options['bg'] === true ){
								bg.style.opacity    = '1';
								bg.style.visibility = 'visible';
							}

							if( options['bodyFixed'] === true ){
								scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
								document.body.style.position = 'fixed';
								document.body.style.overflow = 'hidden';
								document.body.style.top      = -scrollTop+'px';
							}

							document.body.classList.add( options['bodyOpenClass'] );
							openFlg  = true;
							closeFlg = true;

							/* ---------- onOpen ---------- */
							if( typeof options['onOpen'] === 'function' ){
								options['onOpen']( target , popup );
							}

						} else{
							close();
						}
					}
				},false);



				///////////////////////////////////////////////////////////////
				// btn Close
				///////////////////////////////////////////////////////////////
				if( options['closeButtonSelector'] != null ){
					for ( let i = 0; i < closeButtonSelector_target.length; i++ ) {
						closeButtonSelector_target[i].addEventListener('click',function(e){
							e.preventDefault();
							close();
						},false);
					}
				}



				///////////////////////////////////////////////////////////////
				// smooth slick
				///////////////////////////////////////////////////////////////
				if( options['smoothScroll'] != null ){
					for ( let i = 0; i < smoothScroll.length; i++ ) {
						smoothScroll[i].addEventListener('click',function(e){
							e.preventDefault();
							close();
						},false);
					}
				}



				///////////////////////////////////////////////////////////////
				// resize
				///////////////////////////////////////////////////////////////
				/* ブレイクポイントを跨ぐときに閉じる */
				const breakStraddling = function(){
					let mediaQuerie = '';

					if( options['breakPointDown'] != null ){
						mediaQuerie = window.matchMedia( 'screen and ( min-width: '+ (options['breakPointDown'] ) +'px )' );
					}

					const checkBreakPoint = function( mediaQuerie ){
						if ( mediaQuerie.matches ) {
							close();
						}
					}

					mediaQuerie.addListener( checkBreakPoint ); // ブレイクポイントの度に

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						mediaQuerie.removeListener( checkBreakPoint );
					});
				}

				if( options['breakPointDown'] != null ){
					breakStraddling();
				}



			});
		},
		close: function(){
		},
		remove: function(){
			/* removes に追加された関数をforで一つずつ実行する。 */
			const removes = this.removes;

			if( !removes ) return;

			for ( let i = 0; i < removes.length; i++ ) {
				removes[i]();
			}
		},
	}

})(this);

/*! scrollClass.js | v2.5.0 | license Copyright (C) 2020 - 2022 Taichi Matsutaka */
/**
 *
 * @name    : scrollClass.js
 * @content : scrollClass
 * @url     : https://github.com/taichaaan/js-scrollClass
 * @creation: 2020.01.02
 * @update  : 2022.10.24
 * @version : 2.5.0
 *
 */
(function(global) {[]
	global.scrollClass = function(node,options){

		/////////////////////////////////////////////
		// defaults options
		/////////////////////////////////////////////
		this.nodeElements = Array.prototype.slice.call( document.querySelectorAll( node ) ,0) ;

		const defaults = {
			scrollElement: 'body',
			basis        : 'scrollTop',
			addClass     : 'is-shown',
			immedStart   : false,
			sam          : 200,
			quotient     : 5,
			timeout      : 0,
			onShown      : null, // function( target ){},
		}


		/////////////////////////////////////////////
		// options
		/////////////////////////////////////////////
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		/////////////////////////////////////////////
		// base
		/////////////////////////////////////////////
		this.removes = [];
		this.base();


	};
	scrollClass.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;


			///////////////////////////////////////////////////////////////
			// variable
			///////////////////////////////////////////////////////////////
			let length = this.nodeElements.length;
			let endFlg = 0;

			let _window   = '';
			let _document = '';


			if( options['scrollElement'] === 'body' ){
				_window   = window;
				_document = document.documentElement;
			} else{
				_window   = document.querySelector(options['scrollElement']);
				_document = _window;
			}



			///////////////////////////////////////////////////////////////
			// window size
			///////////////////////////////////////////////////////////////
			let window_height = _document.clientHeight;

			function getWindow(){
				window_height = _document.clientHeight;
			}

			window.addEventListener('DOMContentLoaded',getWindow);
			window.addEventListener('resize',getWindow);

			/* ---------- removes ---------- */
			_this.removes.push( function(){
				window.removeEventListener('resize',getWindow);
			});



			///////////////////////////////////////////////////////////////
			// scrollTop
			///////////////////////////////////////////////////////////////
			let scrollTop    = 0;
			let getScrollTop = '';

			if( options['basis'] === 'scrollTop' ){
				getScrollTop = function(){
					scrollTop = _document.scrollTop || document.body.scrollTop;
				}
			} else{
				let scrollTopTarget = document.querySelector( options['basis'] );
				getScrollTop = function(){
					let window_scrollTop = _document.scrollTop || document.body.scrollTop;
					let transform        = scrollTopTarget.dataset.transform;
					scrollTop = window_scrollTop - transform;
				}
			}


			_window.addEventListener('scroll',getScrollTop);

			/* ---------- removes ---------- */
			_this.removes.push( function(){
				_window.removeEventListener('scroll',getScrollTop);
			});



			///////////////////////////////////////////////////////////////
			// getOffsetStart
			///////////////////////////////////////////////////////////////
			let getOffsetStart = null;

			if( options['scrollElement'] === 'body' ){
				getOffsetStart = function( target ){
					const offset_start = target.getBoundingClientRect().top + scrollTop - window_height;
					return offset_start;
				}
			} else{
				getOffsetStart = function( target ){
					const offset_start = target.offsetTop - window_height;
					return offset_start;
				}
			}





			///////////////////////////////////////////////////////////////
			// addClass
			///////////////////////////////////////////////////////////////
			function addClass(){
				for ( let i = 0; i < _this.nodeElements.length; i++) {
					target = _this.nodeElements[i];

					if( !target.classList.contains( options['addClass'] ) ){
						let offset_start = getOffsetStart( target );
						let offset_end   = offset_start + target.offsetHeight + window_height;
						let offset_start_01 = offset_start + window_height / options['quotient'];
						let offset_start_02 = offset_start + options['sam'];

						if( offset_start_01 > offset_start_02 ){
							offset_start = offset_start_02;
						} else{
							offset_start = offset_start_01;
						}

						if( offset_end > scrollTop && scrollTop > offset_start ){
							endFlg++;
							target.classList.add( options['addClass'] );

							/* ---------- onShown ---------- */
							if( typeof options['onShown'] === 'function' ){
								options['onShown']( target );
							}
						}
					}
				}

				if( endFlg == length ){
					window.removeEventListener('load',addClass);
					_window.removeEventListener('scroll',addClass);
				}
			}

			if( options['immedStart'] == true ){
				setTimeout(function(){
					addClass();
				}, options['timeout'] );
			}

			window.addEventListener('load',function(){
				setTimeout(function(){
					addClass();
				}, options['timeout'] );
			});
			// window.addEventListener('load',addClass);
			_window.addEventListener('scroll',addClass);

			/* ---------- removes ---------- */
			_this.removes.push( function(){
				window.removeEventListener('load',addClass);
				_window.removeEventListener('scroll',addClass);
			});


		},
		remove: function(){
			/* removes に追加された関数をforで一つずつ実行する。 */
			const removes = this.removes;

			if( !removes ) return;

			for ( let i = 0; i < removes.length; i++ ) {
				removes[i]();
			}
		},
	};

})(this);

/*! smoothScroll.js | v3.5.0 | license Copyright (C) 2019 - 2022 Taichi Matsutaka */
/**
 *
 * @name    : smoothScroll.js
 * @content : smoothScroll
 * @creation: 2019.??.??
 * @update  : 2022.08.20
 * @version : 3.5.0
 *
 */
(function(global) {[]
	global.smoothScroll = function(node,options){
		/////////////////////////////////////////////
		// defaults options
		/////////////////////////////////////////////
		this.nodeElements = Array.prototype.slice.call( document.querySelectorAll( node ) ,0) ;

		const defaults = {
			window        : window,
			documentTop   : false,
			easingFunction: function (t, b, c, d) { return c * t / d + b; },
			minus         : [0],
			speed         : 800,
			delay         : 0,
		}


		/////////////////////////////////////////////
		// options
		/////////////////////////////////////////////
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		/////////////////////////////////////////////
		// base
		/////////////////////////////////////////////
		this.base();


	};
	smoothScroll.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;


			/////////////////////////////////////////////
			// documentTop
			/////////////////////////////////////////////
			if( options['documentTop'] === true ){
				const documentTop = document.createElement('div');
				documentTop.setAttribute('id','document-top');
				document.body.insertBefore( documentTop , document.body.firstChild );
			}


			/////////////////////////////////////////////
			// scrollElm
			/////////////////////////////////////////////
			const scrollElm = (function() {
				if('scrollingElement' in document) return document.scrollingElement;
				if(navigator.userAgent.indexOf('WebKit') != -1) return document.body;
				return document.documentElement;
			})();


			/////////////////////////////////////////////
			// window
			/////////////////////////////////////////////
			let _window   = '';
			let _windowFrom   = '';

			if( options['window'] === window ){
				_window     = window;
				_windowFrom = scrollElm;
			} else{
				_window     = document.querySelector(options['window']);
				_windowFrom = _window;
			}



			this.nodeElements.forEach(function(target) {
				/////////////////////////////////////////////
				// click
				/////////////////////////////////////////////
				target.addEventListener('click', function(e) {
					e.preventDefault();
					const href           = target.getAttribute('href');
					const dataHref       = target.dataset.href;

					setTimeout(function(){
						const scrollFromTop  = _windowFrom.scrollTop;
						const scrollFromleft = _windowFrom.scrollLeft;
						let startTime        = Date.now();

						/* ----- hrefが#のみだったら、bodyをターゲットにする ----- */
						let scrollTarget = document.body;
						if( dataHref && dataHref !== '#' ){
							scrollTarget = document.querySelector( dataHref );
						} else if( href && href !== '#' ){
							scrollTarget = document.querySelector( href );
						}

						/* ----- 要素が存在したらアニメーション ----- */
						if( scrollTarget ){

							/* ---------- minus ---------- */
							let minus = 0;
							for ( let i = 0; i < options['minus'].length; i++) {
								if( options['minus'][i] !== '' ){
									let regexp = new RegExp('^(\\+|\\-)?(0[1-9]{0,2}|\\d{0,3})(,\\d{3})*(\\.[0-9]+)?$', 'g');

									if( regexp.test( options['minus'][i] ) === true ){
										minus += new Number( options['minus'][i] );
									} else{
										let minusElement = document.querySelectorAll( options['minus'][i] );

										for ( let i = 0; i < minusElement.length; i++ ) {
											minus += minusElement[i].clientHeight;
										}
									}
								}
							}

							/* ---------- offsetTop ---------- */
							const offsetTop  = scrollTarget.getBoundingClientRect().top - minus;
							const offsetLeft = scrollTarget.getBoundingClientRect().left - minus;

							/* ---------- animation ---------- */
							(function loop() {
								let currentTime = Date.now() - startTime;

								if( currentTime < options['speed'] ) {
									_window.scrollTo( options['easingFunction'](currentTime, scrollFromleft, offsetLeft, options['speed']) , options['easingFunction'](currentTime, scrollFromTop, offsetTop, options['speed']) );
									requestAnimationFrame(loop);
								} else {
									_window.scrollTo(offsetLeft + scrollFromleft, offsetTop + scrollFromTop);
								}
							})();
						}

					},options['delay']);

				})
			});
		},
	};

})(this);

/*! splitText.js | v4.1.2 | license Copyright (C) 2020 - 2024 Taichi Matsutaka */
/*
 *
 * @name    : splitText.js
 * @content : splitText
 * @creation: 2020.02.02
 * @update  : 2024.01.10
 * @version : 4.1.2
 *
 */
(function(global) {[]
	global.splitText = function(target,options){
		splitText.prototype.init(target,options);
	};
	splitText.prototype = {
		init: function( target,options ){
			const _this = this;

			/**************************************************************
			 * defaults options
			************************************************************ */
			this.target = Array.prototype.slice.call( document.querySelectorAll( target ) ,0) ;

			const defaults = {
				mediaQuery  : null,
				type        : 'transition', // transition or animation or cssVariable
				varName     : '--transition-delay',
				delay       : true,
				delayDefault: 0,
				delayChange : 50,
				data        : false,
				depth       : false,
				splitClass  : null,
				textClass   : null,
				random      : -1,
			}


			/**************************************************************
			 * options
			************************************************************ */
			for( let option in options){
				defaults[option] = options[option];
			}
			this.options = defaults;


			/**************************************************************
			 * property
			************************************************************ */
			this.onConstructs   = [];
			this.onReconstructs = [];
			this.onDestroys     = [];
			this.startingFLg    = false;

			this.text           = [];
			this.length         = [];
			this.index          = [];
			this.splitText      = [];
			this.tag            = [];
			this.tagFlg         = [];
			this.specialText    = [];
			this.specialTextFlg = [];
			this.delay          = [];


			/**************************************************************
			 * method
			**************************************************************/
			this.settings();
			this.setUpSetInnerHTML();
			this.split();
			this.starting();

		},
		settings: function(){
			const _this = this;


			/**************************************************************
			 * options
			**************************************************************/
			if( _this.options['splitClass'] == null ){
				_this.options['splitClass'] = '';
			}
			if( _this.options['textClass'] == null ){
				_this.options['textClass'] = '';
			}


			/**************************************************************
			 * common setttings
			**************************************************************/
			for (let i = 0; i < _this.target.length; i++) {
				let text     = _this.target[i].innerHTML;
				text         = text.replace(/\r?\n/g, '').replace(/\r?\t/g, '');
				const length = text.length;

				/* ---------- 初期値 ---------- */
				_this.text.push(text);
				_this.length.push(length);
			}



			/**************************************************************
			 * addSettings
			**************************************************************/
			const addSettings = function(){
				_this.index          = [];
				_this.splitText      = [];
				_this.tag            = [];
				_this.tagFlg         = [];
				_this.specialText    = [];
				_this.specialTextFlg = [];
				_this.delay          = [];

				for (let i = 0; i < _this.target.length; i++) {
					_this.target[i].innerHTML = '';
					let delay    = _this.target[i].dataset.delay;

					/* ---------- 初期値 ---------- */
					_this.index.push(0);
					_this.splitText.push('');
					_this.tag.push('');
					_this.tagFlg.push(true);
					_this.specialText.push('');
					_this.specialTextFlg.push(true);

					if( delay ){
						_this.delay.push(new Number( delay ));
					} else{
						_this.delay.push(_this.options['delayDefault']);
					}
				}
			}

			this.onConstructs.push( function(){
				addSettings();
			});
			this.onReconstructs.push( function(){
				addSettings();
			});

		},
		setUpSetInnerHTML : function( target ){
			const _this = this;

			/**************************************************************
			 * initSetInnerHTML
			 * オプションに合わせて変動する関数
			**************************************************************/
			const setClass = function(split,text){
				for ( let i = 0; i < _this.options['splitClass'].length; i++ ) {
					split.classList.add( _this.options['splitClass'][i] );
				}
				for ( let i = 0; i < _this.options['textClass'].length; i++ ) {
					text.classList.add( _this.options['textClass'][i] );
				}
			}



			/**************************************************************
			 * setData
			**************************************************************/
			let setData = '';

			if( _this.options['data'] === true ){
				setData = function(span,c){
					span.dataset.text = c;
				}
			}
			else setData = function(span,c){}



			/**************************************************************
			 * setStyle
			**************************************************************/
			let setStyle = '';

			if( _this.options['type'] === 'transition' ){
				setStyle = function(span,delay){
					span.style.transitionDelay = delay + 'ms';
				}
			} else if( _this.options['type'] === 'animation' ){
				setStyle = function(span,delay){
					span.style.animationDelay = delay + 'ms';
				}
			} else if( _this.options['type'] === 'cssVariable' ){
				setStyle = function(span,delay){
					span.style.setProperty( _this.options['varName'] , delay + 'ms' );
				}
			}



			/**************************************************************
			 * setDelay
			**************************************************************/
			let setDelay = null;
			if( _this.options['random'] !== -1 ){
				/* init */
				let delays = [];
				const randomLength = Number( _this.options['random'] );

				setDelay = function(span,delay){
					if( delays.length === 0 ){
						for ( let i = 0; i < randomLength; i++ ) {
							delays.push( i * _this.options['delayChange'] );
						}
					}

					const random = Math.floor( Math.random() * delays.length );
					setStyle( span , delays[random] );

					delays.splice( random , 1 );
				}
			} else if( _this.options['delay'] === true ){
				setDelay = function(span,delay){
					setStyle( span , delay );
				}
			}
			else setDelay = function(span,delay){}



			/**************************************************************
			 * setInnerHTML
			**************************************************************/
			if( _this.options['depth'] === true ){
				_this.setInnerHTML = function(target,c,delay,split_text){
					if( c === ' ' ){
						c = '&nbsp;';
					}

					const outer = document.createElement('div');
					const span  = document.createElement('span');
					const span2 = document.createElement('span');
					span2.innerHTML = c;
					span.appendChild( span2 );
					outer.appendChild( span );

					// 諸々付与
					setClass(span,span2);
					setData( span2 , c );
					setDelay( span2 , delay );

					split_text = outer.innerHTML;
					return split_text;
				}
			} else{
				_this.setInnerHTML = function(target,c,delay,split_text){
					if( c === ' ' ){
						c = '&nbsp;';
					}

					const outer = document.createElement('div');
					const span  = document.createElement('span');
					span.innerHTML = c;
					outer.appendChild( span );

					// 諸々付与
					setClass(span,span);
					setData( span , c );
					setDelay( span , delay );

					split_text = outer.innerHTML;
					return split_text;
				}
			}

		},
		split: function(){
			const _this = this;

			/**************************************************************
			 * addSplit
			************************************************************ */
			const addSplit = function(){
				for (let i = 0; i < _this.text.length; i++) {
					_this.text[i].split('').forEach(function (c) {
						/* ---------- tag start ---------- */
						if( c === '<' ){
							_this.tagFlg[i] = false;
							_this.tag[i]    = '';
						} else if( c === '&' ){
							_this.specialTextFlg[i] = false;
							_this.specialText[i]    = '';
						}

						/* ---------- splitText ---------- */
						if( _this.tagFlg[i] === true && _this.specialTextFlg[i] === true ){
							_this.splitText[i] += _this.setInnerHTML( _this.target[i] , c , _this.delay[i] , _this.splitText[i] );
							_this.delay[i]     += _this.options['delayChange'];
						} else if( _this.tagFlg[i] === true && _this.specialTextFlg[i] === false ){
							_this.specialText[i] += c;
						} else if( _this.tagFlg[i] === false && _this.specialTextFlg[i] === true ){
							_this.tag[i] += c;
						}

						/* ---------- tag end ---------- */
						if( c === '>' ){
							_this.splitText[i] += _this.tag[i];
							_this.tag[i]     = '';
							_this.tagFlg[i] = true;
						} else if( c === ';' ){
							_this.splitText[i]       += _this.setInnerHTML( _this.target[i] , _this.specialText[i] , _this.delay[i] , _this.splitText[i] );
							_this.delay[i]           += _this.options['delayChange'];
							_this.specialText[i]     = '';
							_this.specialTextFlg[i] = true;
						}

						/* ---------- is-split ---------- */
						_this.index[i]++;
						if( _this.index[i] === _this.length[i]  ){
							_this.target[i].innerHTML = _this.splitText[i];
							_this.target[i].classList.add('is-split');
						}
					});
				}
			}

			this.onConstructs.push( function(){
				addSplit();
			});
			this.onReconstructs.push( function(){
				addSplit();
			});




			/**************************************************************
			 * removeSplit
			************************************************************ */
			const removeSplit = function(){
				for (let i = 0; i < _this.target.length; i++) {
					_this.target[i].innerHTML = _this.text[i];
				}
			}
			this.onDestroys.push( function(){
				removeSplit();
			});


		},
		starting: function( target ){
			const _this = this;

			/**************************************************************
			 * starting
			 * ブレイクポイントに合わせて発動
			**************************************************************/
			if( _this.options['mediaQuery'] == null ){
				_this.onConstruct();
			} else{
				const breakPoint = function(){
					const mediaQuery = window.matchMedia( _this.options['mediaQuery'] );

					function checkBreakPoint( mediaQuery ) {
						if ( mediaQuery.matches ) {
							if( _this.startingFLg == false ){
								_this.onConstruct();
							} else{
								_this.onReconstruct();
							}
						} else{
							_this.onDestroy();
						}
					}

					mediaQuery.addListener( checkBreakPoint ); // ブレイクポイントの度に
					checkBreakPoint( mediaQuery ); // 初回
				}
				breakPoint();
			}

			_this.startingFLg = true;
		},
		onConstruct: function(){
			/**************************************************************
			 * 構築メソッド
			************************************************************ */
			const onConstructs = this.onConstructs;
			for ( let i = 0; i < onConstructs.length; i++ ) {
				onConstructs[i]();
			}
		},
		onReconstruct: function(){
			/**************************************************************
			 * 再構築メソッド
			************************************************************ */
			const onReconstructs = this.onReconstructs;
			for ( let i = 0; i < onReconstructs.length; i++ ) {
				onReconstructs[i]();
			}
		},
		onDestroy: function(){
			/**************************************************************
			 * 破壊メソッド
			************************************************************ */
			const onDestroys = this.onDestroys;
			for ( let i = 0; i < onDestroys.length; i++ ) {
				onDestroys[i]();
			}
		},
	};

})(this);

/*! useragentLite.js | v1.0.1 | license Copyright (C) 2021 Taichi Matsutaka */
/*
 *
 * @name    : useragentLite.js
 * @content : useragentLite
 * @url     : https://github.com/taichaaan/js-useragent
 * @creation: 2021.10.26
 * @update  : 2021.11.01
 * @version : 1.0.1
 *
 */
(function(global) {[]
	global.uaLite = function(options){

		///////////////////////////////////////////////////////////////
		// defaults options
		///////////////////////////////////////////////////////////////
		const defaults = {
			device    : true,
			deviceType: true,
			browser   : true,
		}


		///////////////////////////////////////////////////////////////
		// options
		///////////////////////////////////////////////////////////////
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		///////////////////////////////////////////////////////////////
		// init
		///////////////////////////////////////////////////////////////
		this.init();


	};
	uaLite.prototype = {
		init: function(){
			const _this   = this;
			const options = this.options;

			_this.ua = {};

			_this.judgment();
			_this.addClass();
			// _this.check();
		},
		judgment:function(){
			/*
			 * 判定
			 * いろいろ判定する
			 */
			const _this   = this;
			const options = this.options;

			const ua           = navigator.userAgent.toLowerCase();
			const isTouchstart = window.ontouchstart === null?"touchstart":"click";


			///////////////////////////////////////////////////////////////
			// deviceType
			///////////////////////////////////////////////////////////////
			_this.ua.deviceType = (function(){
				const isTablet     =
					(
						ua.indexOf("windows") !== -1 &&
						ua.indexOf("touch") !== -1 &&
						ua.indexOf("tablet pc") == -1
					)||
					ua.indexOf("ipad") !== -1|| (ua.indexOf("android") !== -1 &&
					ua.indexOf("mobile") == -1)||  (ua.indexOf("firefox") !== -1 &&
					ua.indexOf("tablet") !== -1)|| ua.indexOf("kindle") !== -1|| ua.indexOf("silk") !== -1|| ua.indexOf("playbook") !== -1;
				const isSmartphone =
					(
						ua.indexOf("windows") !== -1 &&
						ua.indexOf("phone") !== -1
					) ||
					ua.indexOf("iphone") !== -1 || ua.indexOf("ipod") !== -1 || (ua.indexOf("android") !== -1 &&
					ua.indexOf("mobile") !== -1) || ( ua.indexOf("firefox") !== -1 &&
					ua.indexOf("mobile") !== -1) || ua.indexOf("blackberry") !== -1;

				if      ( isSmartphone && isTouchstart == 'touchstart' ) return ['smartphone'];
				else if ( isTablet && isTouchstart == 'touchstart' ) return ['tablet'];
				else if ( isTouchstart == 'click' ) return ['pc'];
				else if ( isTouchstart == 'touchstart' ) return ['tablet'];
			})();


			///////////////////////////////////////////////////////////////
			// device
			///////////////////////////////////////////////////////////////
			_this.ua.device = (function(){
				if      ( ua.indexOf('mac') > -1 && !('ontouchend' in document) ) return ['mac'];
				else if ( ua.indexOf('iphone') !== -1 || ua.indexOf('ipod') !== -1 ) return ['iphone'];
				else if ( ua.indexOf('ipad') !== -1 || ua.indexOf('mac') !== -1 && isTouchstart == 'touchstart' ) return ['ipad-mac'];
				else if ( ua.indexOf('ipad') !== - 1) return ['ipad'];
				else if ( ua.indexOf('android') !== -1 ) return ['android'];
				else if ( ua.indexOf('windows') !== -1 && ua.indexOf('phone') !== -1 ) return ['windows-phone'];
				else if ( ua.indexOf('windows') !== -1 ) return ['windows'];
				else return -1;
			})();



			///////////////////////////////////////////////////////////////
			// browser
			///////////////////////////////////////////////////////////////
			_this.ua.browser = (function(){
				if      ( ua.indexOf('edge') !== -1 ) return ['edge'];
				else if ( ua.indexOf("edga") !== -1 ) return ['edga'];
				else if ( ua.indexOf("edgios") !== -1 ) return ['edgios'];
				else if ( ua.indexOf("edg") !== -1 ) return ['edg'];
				else if ( ua.indexOf("iemobile") !== -1 ) return ['iemobile'];
				else if ( ua.indexOf('trident/7') !== -1 ) return ['ie','ie11'];
				else if ( ua.indexOf("msie") !== -1 && ua.indexOf('opera') === -1 ){
					if    ( ua.indexOf("msie 10.") !== -1 ) return ['ie','ie10'];
					else if ( ua.indexOf("msie 9.")  !== -1 ) return ['ie','ie9'];
					else if ( ua.indexOf("msie 8.")  !== -1 ) return ['ie','ie8'];
					else return -1;
				}
				else if ( ua.indexOf('crios')   !== -1 ) return ['crios'];
				else if ( ua.indexOf('gsa')     !== -1 ) return ['gsa'];
				else if ( ua.indexOf('yahoo')   !== -1 ) return ['yahoo'];
				else if ( ua.indexOf('fxios')   !== -1 ) return ['fxios'];
				else if ( ua.indexOf('firefox') !== -1 ) return ['firefox'];
				else if ( ua.indexOf('safari')  !== -1 && ua.indexOf('chrome') === -1 ) return ['safari'];
				else if ( ua.indexOf('chrome')  !== -1 && ua.indexOf('edge') === -1 )   return ['chrome'];
				else if ( ua.indexOf('opera')   !== -1 ) return ['opera'];
				else return -1;
			})();

		},
		addClass: function(){
			/*
			 * addClass
			 * bodyにクラスを付与
			 */
			const _this   = this;
			const options = this.options;

			const body   = document.body;
			const prefix = 'ua-';


			if( options['deviceType']  === true && _this.ua.deviceType !== -1 ){
				for ( let i = 0; i < _this.ua.deviceType.length; i++) {
					body.classList.add( prefix + _this.ua.deviceType[i] );
				}
			}
			if( options['device']  === true && _this.ua.device !== -1 ){
				for ( let i = 0; i < _this.ua.device.length; i++) {
					body.classList.add( prefix + _this.ua.device[i] );
				}
			}
			if( options['browser']  === true && _this.ua.browser !== -1 ){
				for ( let i = 0; i < _this.ua.browser.length; i++) {
					body.classList.add( prefix + _this.ua.browser[i] );
				}
			}

		},
		check: function(){
			/*
			 * 確認用
			 * タブレット、スマホでも確認できるように、アラートで表示
			 */
			const _this   = this;

			let check = '';

			for ( let i = 0; i < _this.ua.deviceType.length; i++) {
				check += _this.ua.deviceType[i] + ' , ';
			}
			for ( let i = 0; i < _this.ua.device.length; i++) {
				check += _this.ua.device[i] + ' , ';
			}
			for ( let i = 0; i < _this.ua.browser.length; i++) {
				check += _this.ua.browser[i] + ' , ';
			}

			alert( check );
		},
	};

})(this);
