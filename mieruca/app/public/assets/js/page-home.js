/**
 *
 * page-home.js
 *
 *
 */
(function($) {



	/**
	 *
	 *
	 * Variable
	 *
	 *
	 */
	/**************************************************************
	 * global
	**************************************************************/
	const root = document.body.dataset.root;
	const mqUpLg = getComputedStyle(document.documentElement).getPropertyValue('--mqUp-lg');







	/**
	 *
	 *
	 * .home-kv
	 *
	 *
	 */
	/**************************************************************
	 * kvScrollAnimation
	**************************************************************/
	const kvScrollAnimation = {
		kv      : document.querySelector('.home-kv'),
		inner   : document.querySelector('.home-kv__inner'),
		catch   : document.querySelector('.home-kv__catch'),
		bg      : document.querySelector('.home-kv__bg'),
		bg_inner: document.querySelector('.home-kv__bg__inner__inner'),
		person  : document.querySelector('.home-kv__bg__person'),

		ww: window.clientWidth,
		wh: document.documentElement.clientHeight,
		sy: document.documentElement.scrollTop || document.body.scrollTop,
		init: function(){
			this.loaded = new CustomEvent('loaded');
			this.setVariable();
			this.loading();
			this.getSize();
			this.zoomMove();
			this.shownHidden();
		},
		setVariable: function(){
			const _this = this;

			const setVar = function(){
				const mediaQuery = window.matchMedia( 'screen and ( min-width: '+ mqUpLg +'px )' );

				function checkBreakPoint( mediaQuery ) {
					if ( mediaQuery.matches ) {
						/* PC */
						_this.scaleDefault = .842;
						_this.scaleMax     = 1.18;
						_this.scaleGoal    = 0.357;
					} else{
						/* SP */
						_this.scaleDefault = 1;
						_this.scaleMax     = 1.18;
						_this.scaleGoal    = 0.607;
					}

					_this.scaleUpRange   = _this.scaleMax - _this.scaleDefault;
					_this.scaleDownRange = _this.scaleMax - _this.scaleGoal;
				}

				mediaQuery.addListener( checkBreakPoint ); // ブレイクポイントの度に
				checkBreakPoint( mediaQuery ); // 初回
			}
			setVar();
		},
		loading: function(){
			const _this = this;

			/* ---------- scrolLTo ---------- */
			window.addEventListener('pageshow',function(){
				setTimeout(function(){
					window.scrollTo(0,0);
				},200);
			});


			/* ---------- scroll ---------- */
			const removeEvent = function(){
				event.preventDefault();
			}

			const notWheel = function(){
				document.body.style.overflow = 'hidden';
				document.addEventListener('touchmove', removeEvent, {passive: false});
				document.addEventListener('wheel', removeEvent, {passive: false});
			}
			const canWheel = function(){
				document.body.style.overflow = '';
				document.removeEventListener('touchmove', removeEvent, {passive: false});
				document.removeEventListener('wheel', removeEvent, {passive: false});
			}


			/* ---------- animation ---------- */
			notWheel();

			window.addEventListener('pageshow',function(){
				_this.kv.style.setProperty('--transition-duration','2500ms');
				_this.kv.dataset.chapter = 0;

				setTimeout(function(){
					_this.kv.style.setProperty('--transition-duration','');
					_this.kv.dataset.chapter = 1;
					canWheel();

					setTimeout(function(){
						window.dispatchEvent( _this.loaded );
					},100);

				},2500);
			});
		},
		getSize: function(){
			const _this = this;


			/* ---------- getPosition ---------- */
			const getPosition = function(){
				_this.ww = window.innerWidth;
				_this.wh = document.documentElement.clientHeight;


				/* ----- offset ----- */
				const catchOffset = _this.catch.getBoundingClientRect().top + _this.sy;
				_this.kv.style.setProperty('--catch-offset', catchOffset );


				/* ----- zoomMove ----- */
				_this.zoomFrame   = 2000;
				_this.moveFrame   = 1000;
				_this.txtFrame    = 1400;
				_this.illustFrame = 1000;

				_this.zoomStartPosition = _this.kv.getBoundingClientRect().top + _this.sy;
				_this.zoomEndPosition   = _this.zoomStartPosition + _this.zoomFrame;

				_this.moveStartPosition = _this.zoomEndPosition;
				_this.moveEndPosition   = _this.zoomEndPosition + _this.moveFrame;

				if( _this.ww >= mqUpLg ){
					// _this.moveValue = _this.ww  * .15;
					// _this.moveValue = _this.ww  * .2;
					_this.moveValue = _this.ww  * .3;
				} else{
					_this.moveValue = _this.ww  * .18;
				}

				_this.kv.style.setProperty('--zoom-frame', _this.zoomFrame );
				_this.kv.style.setProperty('--move-frame', _this.moveFrame );
				_this.kv.style.setProperty('--move-value', _this.moveValue );
				_this.kv.style.setProperty('--move-end', _this.moveEndPosition );


				/* ----- preson ----- */
				if( _this.ww >= mqUpLg ){
					_this.personZoomX = _this.ww  * .13;
					_this.personZoomY = _this.ww  * -.08;
					_this.personMoveX = _this.ww  * -.1;
					_this.personMoveY = _this.ww  * .6;
				} else{
					_this.personZoomX = _this.ww  * .06;
					_this.personZoomY = _this.ww  * -.08;
					_this.personMoveX = _this.ww  * 0.02;
					_this.personMoveY = _this.ww  * .2;
				}

				_this.personGoalX = _this.personZoomX + _this.personMoveX;
				_this.personGoalY = _this.personZoomY + _this.personMoveY;



				/* ----- shownHidden ----- */
				_this.txt1Position = _this.moveEndPosition + _this.txtFrame;
				_this.txt2Position = _this.txt1Position + _this.txtFrame;
				_this.txt3Position = _this.txt2Position + _this.txtFrame;

				_this.kv.style.setProperty('--txt-frame', _this.txtFrame );
				_this.kv.style.setProperty('--illust-frame', _this.illustFrame );
			}
			window.addEventListener('loaded',getPosition);
			window.addEventListener('resize',getPosition);


			/* ---------- getSy ---------- */
			const getSy = function(){
				_this.sy = document.documentElement.scrollTop || document.body.scrollTop;
			}
			window.addEventListener('loaded',getSy);
			window.addEventListener('scroll',getSy);
		},
		zoomMove: function(){
			const _this = this;

			/* ---------- judge ---------- */
			const judge = function(){
				if( _this.sy < _this.zoomStartPosition ){
					_this.bg.style.transform     = 'none';
					_this.bg_inner.style.transform = 'translateX(-50%) scale('+ _this.scaleDefault +')';

				} else if( _this.sy > _this.zoomStartPosition && _this.sy < _this.zoomEndPosition  ){
					const ratio = _this.sy / _this.zoomEndPosition;

					const bgScale = _this.scaleDefault + _this.scaleUpRange * ratio;
					const personX = _this.personZoomX * ratio;
					const personY = _this.personZoomY * ratio;

					_this.bg.style.transform       = 'none';
					_this.bg_inner.style.transform = 'translateX(-50%) scale('+ bgScale +')';
					_this.person.style.transform   = 'translate3d('+ personX +'px,'+ personY +'px,0) scale(1)';

				} else if( _this.sy > _this.moveStartPosition && _this.sy < _this.moveEndPosition  ){
					const ratio = (_this.sy - _this.moveStartPosition) / (_this.moveEndPosition - _this.moveStartPosition);

					const bgY         = _this.moveValue * ratio * -1;
					const bgScale     = _this.scaleMax - _this.scaleDownRange * ratio;
					const personX     = _this.personZoomX + _this.personMoveX * ratio;
					const personY     = _this.personZoomY + _this.personMoveY * ratio;
					const personScale = 1 + 0.8 * ratio;

					_this.bg.style.transform       = 'translate3d(0,'+ bgY +'px,0)';
					_this.bg_inner.style.transform = 'translateX(-50%) scale('+ bgScale +')';
					_this.person.style.transform   = 'translate3d('+ personX +'px,'+ personY +'px,0) scale('+ personScale +')';

				} else if( _this.sy > _this.moveEndPosition ){
					_this.bg.style.transform       = 'translate3d(0,-'+ _this.moveValue +'px,0)';
					_this.bg_inner.style.transform = 'translateX(-50%) scale('+ _this.scaleGoal +')';
					_this.person.style.transform   = 'translate3d('+ _this.personGoalX +'px,'+ _this.personGoalY +'px,0) scale(1.8)';

				}
			}

			window.addEventListener('loaded',function(){
				window.addEventListener('scroll',judge);
			});
		},
		shownHidden: function(){
			const _this = this;

			/* ---------- judge ---------- */
			const judge = function(){
				if( _this.sy < _this.zoomEndPosition ){
					_this.kv.dataset.chapter = 1;
				} else if( _this.sy > _this.zoomEndPosition && _this.sy < _this.moveEndPosition ){
					_this.kv.dataset.chapter = 2;
				} else if( _this.sy > _this.moveEndPosition && _this.sy < _this.txt1Position ){
					_this.kv.dataset.chapter = 3;
				} else if( _this.sy > _this.txt1Position && _this.sy < _this.txt2Position ){
					_this.kv.dataset.chapter = 4;
				} else if( _this.sy > _this.txt2Position && _this.sy < _this.txt3Position ){
					_this.kv.dataset.chapter = 5;
				} else{
					_this.kv.dataset.chapter = 6;
				}
			}

			window.addEventListener('loaded',function(){
				window.addEventListener('scroll',judge);
			});
		},
		check: function(){
			const _this = this;

			const visiblePosition = function( size , className , bgColor ){
				const div = document.createElement('div');

				div.setAttribute('class', className );
				div.style.position        = 'absolute';
				div.style.top             = size + 'px';
				div.style.left            = '0';
				div.style.zIndex          = '10000';
				div.style.width           = '100%';
				div.style.height          = '10px';
				div.style.backgroundColor = bgColor ;

				document.body.appendChild( div );
			}
			window.addEventListener('loaded',function(){
				visiblePosition( _this.moveEndPosition , 'txt1Position' , '#fff000' );
				visiblePosition( _this.txt1Position , 'txt1Position' , '#ff0000' );
				visiblePosition( _this.txt2Position , 'txt2Position' , '#ffff00' );
				visiblePosition( _this.txt3Position , 'txt3Position' , '#ff00ff' );
				visiblePosition( _this.illust2Position , 'illust2Position' , '#0000ff' );
			});

		},
	}
	kvScrollAnimation.init();









	/**
	 *
	 *
	 * .home-works
	 *
	 *
	 */
	/**************************************************************
	 * worksCarousel
	**************************************************************/
	const worksCarousel = function(){
		const mainCarousel  = document.querySelector('.home-works__carousel__main');
		const subCarousel   = document.querySelector('.home-works__carousel__sub');

		/* ---------- main Swiper ---------- */
		var mainSwiper = new Swiper( mainCarousel , {
			autoplay     : {
				delay: 4000,
			},
			centeredSlides: true,
			loop          : true,
			speed         : 1000,
			slidesPerView : 'auto',
			navigation: {
				prevEl                 : '.home-works__carousel__main__arrow.-prev',
				nextEl                 : '.home-works__carousel__main__arrow.-next',
				disabledClass          : 'is-disabled',
				hiddenClass            : 'is-hidden',
				lockClass              : 'is-look',
				navigationDisabledClass: 'is-nav-disabled',
			},
		});

		/* ---------- sub Swiper ---------- */
		var subSwiper = new Swiper( subCarousel , {
			autoplay      : false,
			centeredSlides: true,
			loop          : true,
			speed         : 1000,
			slidesPerView : 'auto',
			navigation: {
				prevEl                 : '.home-works__carousel__sub__arrow.-prev',
				nextEl                 : '.home-works__carousel__sub__arrow.-next',
				disabledClass          : 'is-disabled',
				hiddenClass            : 'is-hidden',
				lockClass              : 'is-look',
				navigationDisabledClass: 'is-nav-disabled',
			},
			on: {
				transitionStart: function (swiper) {
					mainSwiper.autoplay.stop();
				},
				transitionEnd: function (swiper) {
					mainSwiper.autoplay.start();
				},
			}
		});
		mainSwiper.controller.control = [ subSwiper ];
		subSwiper.controller.control = [ mainSwiper ];

	}
	worksCarousel();
















})();
