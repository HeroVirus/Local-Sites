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
	 * .about-service
	 *
	 *
	 */
	/**************************************************************
	 * currentSection
	**************************************************************/
	new currentSection('.about-service',{
		mediaQuery           : null,
		currentClass         : 'is-current',
		sectionSelector      : '.about-service__section',
		navigationSelector   : '.about-service__progress span',
		centerMode           : true,
		getSectionOffsetEvent: ['load','resize'],
		setCurrentEvent      : ['load','scroll'],
	});















})();
