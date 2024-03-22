/**
 *
 * component-form.js
 *
 *
 */
(function($) {

	/**************************************************************
	 * contactForm
	**************************************************************/
	const easingFuncs = new getEasing({
		easing: 'easeInOutQuart',
	});

	/******************************************
	 * baseOptions
	******************************************/
	const baseOptions = {
		controlClass: 'p-form__control',
		button      : '.p-form__button',
		submit      : '.p-form__submit a',
		check       : '.p-form__check a',

		required: [
			'[name="f_name"],[name="f_kana"],[name="f_mail"],[name="f_mail-check"],[name="f_address"],[name="f_message"]',
		],
		linkageRequired: null,
		requiredStatus : false,

		stepFunctions      : null,
		agree              : '[name="f_policy"]',
		emailCheck         : true,
		emailCheckRegex    : /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/,
		emailConfirm       : true,
		emailConfirmArray  : ['[name="f_mail"]','[name="f_mail-check"]'],
		telCheck           : true,
		telCheckRegex      : /^[0-9]+$/,
		yubinBango         : false,
		textareaPlaceholder: false,

		animation          : true,
		animationSpeed     : 500,
		animationDifference: [0],
		animationPosition  : 0,
		animationHierarchy : 1,
		animationEasing    : easingFuncs,

		errorTextClass       : ['p-form__error'],
		errorTextEmailCheck  : '<span class="c-crop">※正しい形式で入力してください。</span>',
		errorTextEmailConfirm: '<span class="c-crop">※メールアドレスが一致していません。</span>',
		errorTextTelCheck    : '<span class="c-crop">※正しい形式で入力してください。</span>',
		errorTextRequired    : '<span class="c-crop">※[name-ja]は必須項目です。</span>',

		errorClass   : 'is-error',
		disabledClass: 'is-disabled',
		doneClass    : 'is-done',
	};




	/******************************************
	 * p-form--contact
	******************************************/
	const contactOptions = {
	}

	for( let option in baseOptions){
		contactOptions[option] = baseOptions[option];
	}

	new contactForm('.p-form--contact', contactOptions );







})();
