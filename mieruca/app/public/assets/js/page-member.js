/**
 *
 * page-home.js
 *
 *
 */
(function ($) {

	/**
	 *
	 *
	 * .js-readmore
	 *
	 *
	 */
	/**************************************************************
	 * readmore
	**************************************************************/
	class ReadMore {
		constructor(element) {
			this.accordion      = element;
			this.button         = this.accordion.querySelector(".js-readmore__button");
			this.body           = this.accordion.querySelector(".js-readmore__body");
			this.closeText      = "元に戻す";
			this.moreText       = "続きを読む";
			this.pcLimitLine      = 3;
			this.spLimitLine      = 4;
			this.timer          = null;
			this.numberOfLines  = null;
			this.minHeight      = null;
			this.mediaQueryList = matchMedia("(min-width: 1024px)");
			this.accordion.classList.add("is-ready");
			this.lineHeight();
			this.ensureDuration();
			this.button.addEventListener("click", () => this.toggleAccordion());
			window.addEventListener("resize", () => {
				this.lineHeight();
			});
		}

		lineHeight() {
			let txt = this.accordion.querySelector(".js-readmore__body__inner > p");
			let lineHeight = parseFloat(window.getComputedStyle(txt).fontSize) * 2;
			this.inner = this.accordion.querySelector(".js-readmore__body__inner");
			this.innerHeight = Math.round(this.inner.getBoundingClientRect().height);
			this.numberOfLines = Math.round(this.innerHeight / lineHeight);

			let limitLine = this.mediaQueryList.matches ? this.pcLimitLine : this.spLimitLine;
			this.minHeight = limitLine * lineHeight;

			if (this.numberOfLines > limitLine) {
				if (!this.accordion.classList.contains("is-active")) {
					this.accordion.classList.add("is-active");
				}
				if (!this.accordion.classList.contains("is-open")) {
					this.body.style.height = this.minHeight + "px";
				}
			} else {
				if (this.accordion.classList.contains("is-active")) {
					this.accordion.classList.remove("is-active");
					this.body.style.height = "auto";
					this.button.textContent = this.moreText;
				}
				if(this.accordion.classList.contains("is-open")) {
					this.accordion.classList.remove("is-open");
					this.body.style.height = "auto";
					this.button.textContent = this.moreText;
				}
			}
		}

		ensureDuration() {
			const durationValue = getComputedStyle(this.body).getPropertyValue('--duration');
			this.duration = durationValue ? parseInt(durationValue, 10) : 400;
			this.body.style.setProperty('--duration', this.duration + 'ms');
		}

		toggleAccordion() {
			if (this.accordion.classList.contains("is-open")) {
				this.closeAccordion();
			} else {
				this.openAccordion();
			}
		}

		closeAccordion() {
			this.accordion.classList.remove("is-open");
			this.body.style.height = this.innerHeight + "px";

			clearTimeout(this.timer);
			this.timer = setTimeout(() => {
				this.body.style.height = this.minHeight + "px";
				this.button.textContent = this.moreText;
			}, 100);
		}

		openAccordion() {
			this.accordion.classList.add("is-open");
			this.button.textContent = this.closeText;
			this.body.style.height = this.innerHeight + "px";
			clearTimeout(this.timer);
			this.timer = setTimeout(() => {
				this.body.style.height = "";
			}, this.duration);
		}
	}

	const accordions = document.querySelectorAll(".js-readmore");
	setTimeout(() => {
		accordions.forEach(accordion => new ReadMore(accordion));
	}, 100);

})();
