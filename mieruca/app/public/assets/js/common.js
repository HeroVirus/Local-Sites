/**
 *
 * common.js
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
	// const mqUpLg = getComputedStyle(document.documentElement).getPropertyValue('--mqUp-lg');




	/**
	 *
	 * Svg
	 *
	 * imgタグなどからSVGを生成。
	 * common.cssに属するクラスは全てここで一括指定。
	 * ページ固有のものはimgタグやdata属性で直接指定。
	 *
	 */
	window.addEventListener('DOMContentLoaded', function(){
		/**************************************************************
		 * 直接指定
		**************************************************************/
		new changeSvg('img.js-svg',{});
		new changeSvg('[data-class="js-svg"]',{});


		/**************************************************************
		 * 一括指定
		**************************************************************/
		/* ---------- icon ---------- */
		new changeSvg('.c-pin',{ svg: root + 'assets/img/common/icon/pin.svg', });
		new changeSvg('.c-arrow',{ svg: root + 'assets/img/common/icon/arrow3.svg', });

		new changeSvg('.p-pagination__num__bg',{ svg: root + 'assets/img/common/icon/tryangle.svg', });
	});







	/**
	 *
	 *
	 * Settings
	 *
	 *
	 */
	/**************************************************************
	 * cssVariable
	**************************************************************/
	new cssVariable(null,{
		vh: true,
		vw: true,
	});


	/**************************************************************
	 * useragent
	**************************************************************/
	new uaLite({
		device    : true,
		deviceType: true,
		browser   : true,
	});


	/**************************************************************
	 * isCurrent
	**************************************************************/
	new isCurrent('a',{
		currentClass: 'is-current',
		contain     : true,
		containClass: 'is-contain',
	});


	/**************************************************************
	 * lazyload
	**************************************************************/
	new lazyload('.js-lazyload',{
		position : 2,
		setClass : 'is-set',
		objectFit: true,

		getWindowSizeEvent: ['DOMContentLoaded','resize'],
		getScrollTopEvent : ['DOMContentLoaded','scroll'],
		setSourceEvent    : ['DOMContentLoaded','scroll'],
	});


	/**************************************************************
	 * APNG
	 * Safariでジャギるので、APNGをcanvasタグに書き換える。
	**************************************************************/
	// const apngImage = document.querySelectorAll('[src*="apng"]');
	// const changeAPNGCanvas = function(){
	// 	for ( let i = 0; i < apngImage.length; i++ ){
	// 		APNG.animateImage(apngImage[i]);
	// 	}
	// };

	// /* 非対応ブラウザではcanvasタグで代替 */
	// APNG.ifNeeded().then(function () {
	// 	changeAPNGCanvas();
	// });

	// /* 該当のブラウザではcanvasタグで代替 */
	// if(
	// 	document.body.classList.contains('ua-safari') ||
	// 	document.body.classList.contains('ua-ios') ||
	// 	document.body.classList.contains('ua-ipados')
	// ){
	// 	changeAPNGCanvas();
	// }






	/**
	 *
	 *
	 * Common
	 *
	 *
	 */
	/**************************************************************
	 * addClass
	**************************************************************/
	// new addClass('body',{
	// 	addClassEvent: ['load'],
	// 	class        : 'is-load',
	// });


	/**************************************************************
	 * smoothScroll
	**************************************************************/
	const easingFuncs = new getEasing({
		easing: 'easeInOutExpo',
	});

	new smoothScroll('a[href^="#"]',{
		documentTop   : true,
		easingFunction: easingFuncs,
		minus         : [0],
		speed         : 800,
	});






	/**
	 *
	 *
	 * Layout
	 *
	 *
	 */
	/**************************************************************
	 * popup
	**************************************************************/
	new popup('.l-header__button',{
		popupSelector      : '.l-sitemap',
		closeButtonSelector: '.l-sitemap__close',
		bodyFixed          : false,
		bg                 : true,
		bgContainerSelector: null,
		bgStyle            : false,
		bgClass            : 'js-popup-bg',
		smoothScroll       :'a[href^="#"]',
		popupOpenClass     : 'is-open',
		buttonOpenClass    : 'is-open',
		bodyOpenClass      : 'is-sitemap-open',
		basicId            : 'aria-sitemap',
		basicIdIndex       : false,
	});






	/**
	 *
	 *
	 * Project
	 *
	 *
	 */
	/**************************************************************
	 * c-motifs
	 * モチーフが被らないようにtop、main、bottom用divを使って調整
	**************************************************************/
	const pMotifsInit = function(){
		const bg = document.querySelector('.c-motifs');

		if( !bg ) return false;

		let topHeight     = parseInt(getComputedStyle(bg).getPropertyValue('--top-height'));
		let mainBgHeight  = parseInt(getComputedStyle(bg).getPropertyValue('--main-height'));
		let mainPause1    = parseInt(getComputedStyle(bg).getPropertyValue('--main-pause1'));
		let mainPause2    = parseInt(getComputedStyle(bg).getPropertyValue('--main-pause2'));
		let mainPause1End = parseInt(getComputedStyle(bg).getPropertyValue('--main-pause1-end'));




		/* ---------- setCssVariable ---------- */
		const setCssVariable = function(){
			topHeight     = parseInt(getComputedStyle(bg).getPropertyValue('--top-height'));
			mainBgHeight  = parseInt(getComputedStyle(bg).getPropertyValue('--main-height'));
			mainPause1    = parseInt(getComputedStyle(bg).getPropertyValue('--main-pause1'));
			mainPause2    = parseInt(getComputedStyle(bg).getPropertyValue('--main-pause2'));
			mainPause1End = parseInt(getComputedStyle(bg).getPropertyValue('--main-pause1-end'));
		}
		setCssVariable();
		window.addEventListener('resize',setCssVariable);



		/* ---------- for ---------- */
		const top  = bg.querySelector('.c-motifs__top');
		const main = bg.querySelector('.c-motifs__main');


		/* ---------- addHeight ---------- */
		const addHeight = function(){
			const height         = bg.clientHeight;
			const mainExceptionArea = height - topHeight;

			/* 切り捨てで完全リピートできる回数から高さを取得 */
			const mainRepeatLenght = Math.floor( mainExceptionArea / mainBgHeight );
			let mainHeight = mainBgHeight * mainRepeatLenght;

			/* 残りの高さから区切り1,2の高さにはまれば、その分高さを追加 */
			const otherExceptionArea = mainExceptionArea - mainHeight;

			if(
				otherExceptionArea > mainPause1 &&
				otherExceptionArea < mainPause1End
			){
				mainHeight += mainPause1;
			} else {
				if( otherExceptionArea - mainPause1End > 200 ){
					mainHeight += mainPause2;
				}
			}

			/* 高さを付与 */
			main.style.height = mainHeight + 'px';
		}

		addHeight();
		window.addEventListener('load',addHeight);
		window.addEventListener('resize',addHeight);

	}
	pMotifsInit();








	/**
	 *
	 *
	 * Effect
	 *
	 *
	 */
	/**************************************************************
	 * scrollClass
	**************************************************************/
	let scrollClassQuotient = 6;
	let scrollClassSam      = 100;

	if( document.body.classList.contains('ua-pc') ){
		scrollClassQuotient = 5;
		scrollClassSam      = 200;
	}

	new addClass('header[class*="p-hero"]',{
		timeout      : 100,
		addClassEvent: ['load'],
		class        : 'is-shown',
		position     : '',
	});
	new addClass('.js-load-trigger',{
		timeout      : 100,
		addClassEvent: ['load'],
		class        : 'is-shown',
		position     : '',
	});

	new scrollClass('.js-trigger',{
		addClass: 'is-shown',
		sam     : scrollClassSam,
		quotient: scrollClassQuotient,
	});


	/**************************************************************
	 * splittext
	**************************************************************/
	new splitText('.js-splittext',{
		mediaQuery  : null,
		type        : 'cssVariable', // transition or animation or cssVariable
		varName     : '--delay',
		delay       : true,
		delayDefault: 0,
		delayChange : 50,
		data        : false,
		depth       : true,
		splitClass  : ['js-splittext__cell'],
		textClass   : ['js-splittext__text'],
		random      : -1,
	});




})();