(function () {
	let fancyAreaSelector = ".fancy-textarea";

	document.addEventListener("DOMContentLoaded", function (event) {
		init();
	});

	function init() {
		if (isFancyTextarea() && isTrumowygLibrary()) {

			jQuery(fancyAreaSelector).trumbowyg({
				lang: "cs",
				btns: [
					['viewHTML'],
					['undo', 'redo'],
					['strong'],
					['link'],
					['unorderedList', 'orderedList'],
				],
				removeformatPasted: true,
			});
		}

	}

	function isTrumowygLibrary() {
		return typeof jQuery(fancyAreaSelector).trumbowyg !== "undefined";
	}

	function isFancyTextarea() {
		return jQuery(fancyAreaSelector).length;
	}

})();