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
	 * .js-accordion
	 *
	 *
	 */
	/**************************************************************
	 * Accordion
	**************************************************************/
	class Accordion {
		constructor(element) {
			this.accordion   = element;
			this.button      = this.accordion.querySelector(".js-accordion__button");
			this.body        = this.accordion.querySelector(".js-accordion__body");
			this.innerHeight = this.accordion.querySelector(".js-accordion__body__inner").getBoundingClientRect().height;
			this.ensureDuration();
			this.risezeHeight();
			this.timer = null;

			this.button.addEventListener("click", () => this.toggleAccordion());
		}

		ensureDuration() {
			const durationValue = getComputedStyle(this.body).getPropertyValue('--duration');
			this.duration = durationValue ? parseInt(durationValue, 10) : 400;
			this.body.style.setProperty('--duration', this.duration + 'ms');
		}

		risezeHeight() {
			window.addEventListener("resize", () => {
				this.innerHeight = this.accordion.querySelector(".js-accordion__body__inner").getBoundingClientRect().height;
			});
		}

		toggleAccordion() {
			const archive = document.querySelector(".p-localnav__archive");

			if(this.accordion.classList.contains("-nest") && archive.classList.contains("is-moreshow")) {
				if (this.accordion.classList.contains("is-open")) {
					this.closeAccordion();
				} else {
					this.openAccordion();
				}
			}

			if(!this.accordion.classList.contains("-nest")) {
				if (this.accordion.classList.contains("is-open")) {
					this.closeAccordion();
				} else {
					this.openAccordion();
				}
			}
		}

		closeAccordion() {
			this.accordion.classList.remove("is-open");
			this.body.style.height = this.innerHeight + "px";
			clearTimeout(this.timer);
			this.timer = setTimeout(() => {
				this.body.style.height = "0px";
			}, 100);
		}

		openAccordion() {
			this.accordion.classList.add("is-open");
			this.body.style.height = this.innerHeight + "px";
			clearTimeout(this.timer);
			this.timer = setTimeout(() => {
				this.body.style.height = "auto";
			}, this.duration);
		}
	}

	const accordions = document.querySelectorAll(".js-accordion");
	// 高さの取得後にフォントが適応されると高さが変わるので、100ms待ってフォントの適応後に実行する
	setTimeout(() => {
		accordions.forEach(accordion => new Accordion(accordion));
	},100);




	/**
	 *
	 *
	 * moreShow
	 *
	 *
	 */
	/**************************************************************
	 * MoreShow
	**************************************************************/

	class MoreShow {
		constructor() {
			this.list = document.querySelector(".p-localnav__archive");
			this.listItem = document.querySelectorAll(".p-localnav__archive > li");

			if(this.listItem[4]) {
				this.listItem[4].addEventListener("click", ()=>{
					this.list.classList.add("is-moreshow");
				});
			}
		}
	}
	new MoreShow;

})();
