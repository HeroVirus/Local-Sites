/**
 *
 * page-service.js
 *
 *
 */
(function($) {

	/**
	 *
	 *
	 * .service-contents
	 *
	 *
	 */
	/**************************************************************
	 * service-illust
	 * isScroll
	**************************************************************/
	new addClass('.service-illust',{
		class        : 'is-scroll',
		position      : '100',
		remove        : true,
		addClassEvent: ['load','scroll'],
	});



	/**************************************************************
	 * currentSection
	**************************************************************/
	/* ---------- pc ---------- */
	new currentSection('.service-contents',{
		mediaQuery           : null,
		currentClass         : 'is-active',
		sectionSelector      : '.service-section1',
		navigationSelector   : '.service-header.-pc > div',
		centerMode           : false,
		getSectionOffsetEvent: ['load','resize'],
		setCurrentEvent      : ['load','scroll'],
	});

	new currentSection('.service-contents',{
		mediaQuery           : null,
		currentClass         : 'is-active',
		sectionSelector      : '.service-section1:nth-of-type(1) .service-section2',
		navigationSelector   : '.service-header.-pc > div:nth-of-type(1) .service-header__icons__item',
		centerMode           : false,
		getSectionOffsetEvent: ['load','resize'],
		setCurrentEvent      : ['load','scroll'],
	});

	new currentSection('.service-contents',{
		mediaQuery           : null,
		currentClass         : 'is-active',
		sectionSelector      : '.service-section1:nth-of-type(3) .service-section2',
		navigationSelector   : '.service-header.-pc > div:nth-of-type(3) .service-header__icons__item',
		centerMode           : false,
		getSectionOffsetEvent: ['load','resize'],
		setCurrentEvent      : ['load','scroll'],
	});


	/* ---------- pc ---------- */
	new currentSection('.service-contents',{
		mediaQuery           : null,
		currentClass         : 'is-active',
		sectionSelector      : '.service-section1:nth-of-type(1) .service-section2',
		navigationSelector   : '.service-section1:nth-of-type(1) .service-header__icons__item',
		centerMode           : false,
		getSectionOffsetEvent: ['load','resize'],
		setCurrentEvent      : ['load','scroll'],
	});

	new currentSection('.service-contents',{
		mediaQuery           : null,
		currentClass         : 'is-active',
		sectionSelector      : '.service-section1:nth-of-type(3) .service-section2',
		navigationSelector   : '.service-section1:nth-of-type(3) .service-header__icons__item',
		centerMode           : false,
		getSectionOffsetEvent: ['load','resize'],
		setCurrentEvent      : ['load','scroll'],
	});





	/**************************************************************
	 * service-header.-sp
	 * isSticky
	**************************************************************/
	const target = document.querySelectorAll('.service-header.-sp');

	const isSticky = function(){
		for ( let i = 0; i < target.length; i++ ) {
			const windowTop = target[i].getBoundingClientRect().top;

			if( windowTop < 10 ){
				target[i].classList.add('is-sticky');
			} else{
				target[i].classList.remove('is-sticky');
			}
		}
	}
	window.addEventListener('load',isSticky);
	window.addEventListener('scroll',isSticky);














})();
